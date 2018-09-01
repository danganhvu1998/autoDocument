import mysqlController as mysqlCtrl
import filesController as filesCtrl
import editFileController as editFileCtrl

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
    

#AUTODOCUMENT
for request in requests:
    requestLog = "request_id: "+str(request[0])+", "
    requestLog += "student_id: "+str(request[1])+", "
    requestLog += "group_file_id: "+str(request[2])+", "
    requestLog += "student_name: "+str(request[3])+", "
    requestLog += "group_file_name: "+str(request[4])+", Result: "
    print(requestProcessor(request))

#DELETE TOO OLD FILE

#UPDATE DATABASE