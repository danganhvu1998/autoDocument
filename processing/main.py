import mysqlController as mysqlCtrl

clientRequest = mysqlCtrl.MAIN()
students = clientRequest["students"]
groupFiles = clientRequest["groupFiles"]
requests = clientRequest["requests"]