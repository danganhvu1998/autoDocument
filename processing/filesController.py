import os
import time

def filesPrepare(folderName, files):
    path = "../server/public/storage/file/"
    folderPath = "temp/"+folderName+"/"
    # Create Folder
    os.system("mkdir -p "+ folderPath)
    # Copy necessary file
    for file in files:
        fromUrl = path+file
        toUrl = folderPath
        cmd = "cp '"+fromUrl+"' '"+toUrl+"'"
        os.system(cmd)
    return 1

def makeCompress(folderName):
    cmd = "cd temp/ && zip -r '"+folderName+".zip' '"+folderName+"/'"
    os.system(cmd)
    return 1

def compessedFileMove(folderName):
    cmd = "mv 'temp/"+folderName+".zip' '../server/public/storage/file/'"
    print(cmd)
    os.system(cmd)
    return 1

def filesRemove(folderName):
    cmd = "rm -r temp/"+folderName
    os.system(cmd)
    return 1

def cleaner():
    cmd = "rm -r temp/"
    os.system(cmd)
    return 1

def deleteOldFile():
    oneWeekTime = 3600*24*8
    currTime = time.time()
    deleteFiles = os.listdir("../server/public/storage/file/")
    for deleteFile in deleteFiles:
        if(deleteFile.endswith(".zip")):
            existedTime  = currTime - os.stat("../server/public/storage/file/"+deleteFile).st_atime
            if(existedTime>oneWeekTime): os.remove("../server/public/storage/file/"+deleteFile)
