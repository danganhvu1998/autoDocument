import mysqlController as mysqlCtrl
import filesController as filesCtrl
import editFileController as editFileCtrl
from time import ctime

#TAKE CLIENT REQUEST 
clientRequest = mysqlCtrl.MAIN()
students = clientRequest["students"]
groupFiles = clientRequest["groupFiles"]
requests = clientRequest["requests"]
translates = clientRequest["translates"]

def prepareFile(folderName, files, errors=""):
    try:
        filesCtrl.filesPrepare(folderName, files, errors)
        return 1
    except:
        return 0

def compress(folderName):
    try:
        filesCtrl.makeCompress(folderName)
        return 1
    except:
        return 0

def moveCompressedFile(folderName):
    try:
        filesCtrl.compessedFileMove(folderName)
        return 1
    except:
        return 0

def remove(folderName):
    try:
        filesCtrl.filesRemove(folderName)
        return 1
    except:
        return 0



def requestProcessor(request):
    # PRERUN
    global students
    files = []
    #groupFiles[request[2]] list of files in request
    for file in groupFiles[request[2]]:
        files.append(file[0])
    folderName = (request[4]+"___"+request[3]).replace(" ", "_")

    #PROCESS
    if(not prepareFile(folderName, files, request[5])): return "Error: Cannot copy files"
    editFileCtrl.MAIN(folderName, files, students[request[1]], translates)
    if(not compress(folderName)):           return "Error: Cannot compress file"
    if(not moveCompressedFile(folderName)):  return "Error: Cannot move compressed file"
    if(not remove(folderName)):        return "Error: Cannot remove folder"
    return "Success!"
    

def __MAIN__():
    #AUTODOCUMENT + LOG
    global students, translates, groupFiles, requests
    print("STUDENT:", students)
    print("GROUP FILE:", groupFiles)
    print("REQUEST:", requests)
    #return 0
    for request in requests:
        requestLog = ctime() + " request_id: "+str(request[0])+", "
        requestLog += "student_id: "+str(request[1])+", "
        requestLog += "group_file_id: "+str(request[2])+", "
        requestLog += "student_name: "+str(request[3])+", "
        requestLog += "group_file_name: "+str(request[4])+", Result: "
        result = requestLog + requestProcessor(request)
        logFile = open("log.txt", "a")
        logFile.write(result+"\n")
        logFile.close()
        filesCtrl.cleaner()
        #UPDATE DATABASE
        if(result.endswith("Result: Success!")):
            mysqlCtrl.updateResult(request[0], 1) #SUCCESS
        else:
            mysqlCtrl.updateResult(request[0], -1) #ERROR

    #DELETE TOO OLD FILE
    filesCtrl.deleteOldFile()

if __name__ == '__main__':
    __MAIN__()