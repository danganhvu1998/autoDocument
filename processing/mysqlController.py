import mysql.connector
import re

# Take username, password, server from .env
def loginInfoTaker():
    result = {}
    loginInfoFile = open(".env").read()
    loginInfo = re.findall(r"\{\{(.+)\}\}", loginInfoFile)
    if (len(loginInfo)<3):
        result["result"] = 0
    else:
        result["result"] = 1
        result["loginInfo"] = loginInfo
    return result

def requestTaker(mydb):
    cmd = """SELECT request_auto_documents.id, request_auto_documents.student_id, request_auto_documents.group_file_id, students.name, group_files.name, request_auto_documents.errors 
        FROM request_auto_documents  
        INNER JOIN students 
            ON request_auto_documents.student_id=students.id 
        INNER JOIN group_files 
            ON request_auto_documents.group_file_id=group_files.id 
        WHERE request_auto_documents.status=0"""
    mycursor = mydb.cursor()
    mycursor.execute(cmd)
    return mycursor.fetchall()

def studentInfoTaker(mydb, id):
    cmd = """SELECT assigns.value, defines.define1, defines.define2 
        FROM assigns INNER JOIN defines 
        ON assigns.define_id=defines.id 
        WHERE assigns.student_id ="""+str(id)
    mycursor = mydb.cursor()
    mycursor.execute(cmd)
    return mycursor.fetchall()

def groupFileInfoTaker(mydb, id):
    cmd = """SELECT files.file_url 
        FROM assign_group_files INNER JOIN files 
        ON assign_group_files.file_id=files.id 
        WHERE group_file_id="""+str(id)
    mycursor = mydb.cursor()
    mycursor.execute(cmd)
    return mycursor.fetchall()

def translateInfoTaker(mydb):
    cmd = """SELECT vietnamese, japanese 
        FROM translates"""
    mycursor = mydb.cursor()
    mycursor.execute(cmd)
    return mycursor.fetchall()

def MAIN():
    result = {}
    result["students"] = {}
    result["groupFiles"] = {}

    response = loginInfoTaker()
    if(response["result"]==0): return 0
    mydb = mysql.connector.connect(
        host = response["loginInfo"][0],
        user = response["loginInfo"][1],
        passwd = response["loginInfo"][2],
        database = response["loginInfo"][3]
    )
    # Take request info
    result["requests"] = requestTaker(mydb)
    result["translates"] = translateInfoTaker(mydb)

    # Take student info
    for request in result["requests"]:
        # request[0]: id, request[1]: student_id, request[2]: group_file_id
        if( not result["students"].get(request[1]) ): 
            result["students"][request[1]] = studentInfoTaker(mydb, request[1])

    # Take group file info
    for request in result["requests"]:
        # request[0]: id, request[1]: student_id, request[2]: group_file_id
        if( not result["groupFiles"].get(request[2]) ): 
            result["groupFiles"][request[2]] = groupFileInfoTaker(mydb, request[2])
    return result

def updateResult(id, result):
    response = loginInfoTaker()
    if(response["result"]==0): return 0
    mydb = mysql.connector.connect(
        host = response["loginInfo"][0],
        user = response["loginInfo"][1],
        passwd = response["loginInfo"][2],
        database = response["loginInfo"][3]
    )
    cmd = ("UPDATE request_auto_documents SET status = %d WHERE id = %d" % (result, id))
    mycursor = mydb.cursor()
    mycursor.execute(cmd)
    mydb.commit()
    return 0
