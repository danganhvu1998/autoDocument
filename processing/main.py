import mysqlController as mysqlCtrl
import filesController as filesCtrl

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

def requestProcessor(request):
    # PRERUN
    requestLog = "request_id: "+str(request[0])+", "
    requestLog += "student_id: "+str(request[1])+", "
    requestLog += "group_file_id: "+str(request[2])+", "
    requestLog += "student_name: "+str(request[3])+", "
    requestLog += "group_file_name: "+str(request[4])+", Result: "
    files = []
    #groupFiles[request[2]] list of files in request
    for file in groupFiles[request[2]]:
        files.append(file[0])
    folderName = (request[4]+"___"+request[3]).replace(" ", "_")

    #PROCESS
    if(not prepareFile(folderName, files)): return requestLog+"Error: Cannot copy files"
    if(not compress(folderName)): return requestLog+"Error: Cannot compress file"
    return requestLog+"Success!"
    

for request in requests:
    print( requestProcessor(request))