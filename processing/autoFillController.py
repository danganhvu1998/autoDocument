import re
import numpy as np

def textCapital(data):
    return data.upper()

def textLower(data):
    return data.lower()

#####################################################

def textFirst(data):
    return data.split()[-1]

def textFamily(data):
    return data.split()[0]

def textMid(data):
    words = data.split()
    lenData = len(words)
    if(lenData<3):
        return ""
    result = ""
    for i in range(1, lenData-1):
        result = result + words[i] + " "
    result = result.strip()
    return result

#######################################################

def textYear(data):
    if("/" in data):
        spliter = "/"
    else:
        spliter = "-"
    return data.split(spliter)[2]

def textMonth(data):
    if("/" in data):
        spliter = "/"
    else:
        spliter = "-"
    return data.split(spliter)[1]

def textDay(data):
    if("/" in data):
        spliter = "/"
    else:
        spliter = "-"
    return data.split(spliter)[0]

#####################################################

def dateFormatConverter(date):
    if("/" in date):
        spliter = "/"
    else:
        spliter = "-"
    dayMonthYearDate = date.split(spliter)
    if(len(dayMonthYearDate[1])==1): dayMonthYearDate[1] = "0"+dayMonthYearDate[1]
    if(len(dayMonthYearDate[0])==1): dayMonthYearDate[0] = "0"+dayMonthYearDate[0]
    yearMonthDayDate = dayMonthYearDate[2]+"-"+dayMonthYearDate[1]+"-"+dayMonthYearDate[0]
    return yearMonthDayDate

def businessDayCount(data):
    dayOffs = ['2017-01-02', '2017-01-26', '2017-01-27', '2017-01-30', '2017-01-31', '2017-02-01', '2017-04-06', '2017-05-01', '2017-05-02', '2017-09-04', 
        '2018-01-01', '2018-02-12', '2018-02-13', '2018-02-14', '2018-02-15', '2018-02-16', '2018-02-19', '2018-02-20', '2018-04-25', '2018-04-30', 
        '2018-05-01', '2018-09-03', '2019-01-01', '2019-02-04', '2019-02-05', '2019-02-06', '2019-02-07', '2019-02-08', '2019-04-15', 
        '2019-04-30', '2019-05-01', '2019-09-02']
    dataParameters = data.split("-");
    startDate = dateFormatConverter(dataParameters[0])
    endDate = dateFormatConverter(dataParameters[1])
    endDayIsBusDay = np.is_busday([endDate], holidays=dayOffs)[0]
    workingDayCount = np.busday_count(startDate, endDate, holidays=dayOffs) + endDayIsBusDay
    return workingDayCount
    
#####################################################

def textEnglish(data):
    INTAB = "ạảãàáâậầấẩẫăắằặẳẵóòọõỏôộổỗồốơờớợởỡéèẻẹẽêếềệểễúùụủũưựữửừứíìịỉĩýỳỷỵỹđẠẢÃÀÁÂẬẦẤẨẪĂẮẰẶẲẴÓÒỌÕỎÔỘỔỖỒỐƠỜỚỢỞỠÉÈẺẸẼÊẾỀỆỂỄÚÙỤỦŨƯỰỮỬỪỨÍÌỊỈĨÝỲỶỴỸĐ"
    OUTTAB = "a" * 17 + "o" * 17 + "e" * 11 + "u" * 11 + "i" * 5 + "y" * 5 + "d" + \
             "A" * 17 + "O" * 17 + "E" * 11 + "U" * 11 + "I" * 5 + "Y" * 5 + "D"
    for vText, eText in zip(INTAB, OUTTAB):
        data = data.replace(vText, eText)
    return data

#####################################################

def roundTo0Digit(data):
    try:
        float(data)
        return round(data)
    except:
        return(data)

def roundTo1Digit(data):
    try:
        float(data)
        return round(data, 1)
    except:
        return(data)

def functionCaller(data, require):
    require = require.lower()
    if(require == "capital"):
        return textCapital(data)
    elif(require == "lower"):
        return textLower(data)
    elif(require == "first"):
        return textFirst(data)
    elif(require == "mid"):
        return textMid(data)
    elif(require == "family"):
        return textFamily(data)
    elif(require == "year"):
        return textYear(data)
    elif(require == "month"):
        return textMonth(data)
    elif(require == "day"):
        return textDay(data)
    elif(require == "english"):
        return textEnglish(data)
    elif(require == "busday"):
        return businessDayCount(data)
    elif(require == "calculate"):
        return eval(data)
    elif(require == "round"):
        return roundTo0Digit(data)
    elif(require == "round1"):
        return roundTo1Digit(data)
    return data

def autoForm(data, requires): #paraFrom is like name.first.english.capital
    #print(data, requires)
    for require in requires:
        savedData = data
        try:
            data = functionCaller(data, require)
        except:
            data = savedData
    return str(data)

if __name__ == '__main__':
    print(autoForm("18/07/2018-15/3/2019", ["busday"]))
    print(autoForm("18/07/2018-12/10/2018", ["busday"]))
    print(autoForm("01/8/2018-14/6/2019", ["busday"]))
    print(autoForm("01/8/2018-27/2/2019", ["busday"]))

# REQUIRE LIST
# capital, lower
# first, mid, family
# year, day, month
# english
# hour_count
# $$$({{{[[[dayStart]]]-[[[dayEnd]]].busday}}}-[[[absentDayCount]]]){{{[[[dayStart]]]-[[[dayEnd]]].busday}}}*100$$$%