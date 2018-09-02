import mysqlController as mysqlCtrl
import filesController as filesCtrl
import editFileController as editFileCtrl
from time import ctime

#TAKE CLIENT REQUEST 
clientRequest = mysqlCtrl.MAIN()
students = clientRequest["students"]
groupFiles = clientRequest["groupFiles"]
requests = clientRequest["requests"]

def prepareFile(folderName, files):
    try:
        filesCtrl.filesPrepare(folderName, files)
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
    if(not prepareFile(folderName, files)): return "Error: Cannot copy files"
    editFileCtrl.MAIN(folderName, files, students[request[1]])
    if(not compress(folderName)):           return "Error: Cannot compress file"
    if(not moveCompressedFile(folderName)):  return "Error: Cannot move compressed file"
    if(not remove(folderName)):        return "Error: Cannot remove folder"
    return "Success!"
    

#AUTODOCUMENT + LOG
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
