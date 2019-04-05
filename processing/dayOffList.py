import re
import numpy as np

dayOffString = """
        "2/1/2017","26/1/2017","27/1/2017","30/1/2017","31/1/2017","1/2/2017","6/4/2017","1/5/2017","2/5/2017", "4/9/2017"
        "1/1/2018","12/2/2018","13/2/2019","14/2/2018","15/2/2018","16/2/2018","19/2/2018","20/2/2018","25/4/2018","30/4/2018","1/5/2018","3/9/2018"
        "1/1/2019","4/2/2019","5/2/2019","6/2/2019","7/2/2019","8/2/2019","15/4/2019","30/4/2019","1/5/2019","2/9/2019"
    """
dayOffStringList = re.findall("\"(\d+/\d+/\d+)\"", dayOffString)
dayoffList = []
for dayOffString in dayOffStringList:
    day = re.findall("\d+", dayOffString)
    if(len(day[1])==1): day[1] = "0"+day[1]
    if(len(day[0])==1): day[0] = "0"+day[0]
    dayoffList.append(day[2]+"-"+day[1]+"-"+day[0])
print(dayoffList)
print(np.busday_count("2017-01-25", "2017-02-02", holidays=dayoffList))