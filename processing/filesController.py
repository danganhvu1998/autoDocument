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