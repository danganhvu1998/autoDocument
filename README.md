# autoDocument
This system mainly about controlling students data, and automatically generating student's necessary document with inputed form.

## How to use
To lazy to write

## Install
1. Install Laravel
    * Setting laravel normally
    * env Database Name: "autoDocument"
2. Install Python3
    * install python3
    * setting python3 library
        * pip3 install openpyxl
        * pip3 install python-docx
        * pip3 install mysql-connector
    * setting /processing/.env
        * /processing/.env Database: "autoDocument"
        * other Database info according to mySql
    * linix terminal (every 5 mins run python3 mainController.py): 
        * screen -S pythonLoop
        * cd [...]/processing
        * while true; do python3 mainController.py ; sleep 300; done;