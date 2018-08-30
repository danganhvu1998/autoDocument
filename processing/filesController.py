import os

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
    #print(cmd);
    os.system(cmd)
    return 0

def filesRemove(folderName):
    return 0

def compessedFileMove(folderName):
    return 0