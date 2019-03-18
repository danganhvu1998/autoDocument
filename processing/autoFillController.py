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


def textEnglish(data):
    INTAB = "ạảãàáâậầấẩẫăắằặẳẵóòọõỏôộổỗồốơờớợởỡéèẻẹẽêếềệểễúùụủũưựữửừứíìịỉĩýỳỷỵỹđẠẢÃÀÁÂẬẦẤẨẪĂẮẰẶẲẴÓÒỌÕỎÔỘỔỖỒỐƠỜỚỢỞỠÉÈẺẸẼÊẾỀỆỂỄÚÙỤỦŨƯỰỮỬỪỨÍÌỊỈĨÝỲỶỴỸĐ"
    OUTTAB = "a" * 17 + "o" * 17 + "e" * 11 + "u" * 11 + "i" * 5 + "y" * 5 + "d" + \
             "A" * 17 + "O" * 17 + "E" * 11 + "U" * 11 + "I" * 5 + "Y" * 5 + "D"
    for vText, eText in zip(INTAB, OUTTAB):
        data = data.replace(vText, eText)
    return data


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
    return data

def autoForm(data, requires): #paraFrom is like name.first.english.capital
    #print(data, requires)
    for require in requires:
        savedData = data
        try:
            data = functionCaller(data, require)
        except:
            data = savedData
    return data

if __name__ == '__main__':
    autoForm("Đặng Anh Anh Vũ", ["capital", "mid", "english"])
    autoForm("Đặng Anh Vũ", ["lower", "family", "english"])
    autoForm("15/12/1998", ["day"])
    autoForm("15/12/1998", ["month"])
    autoForm("15/12/1998", ["year"])
    textEnglish("da")

# REQUIRE LIST
# capital, lower
# first, mid, family
# year, day, month
# english
