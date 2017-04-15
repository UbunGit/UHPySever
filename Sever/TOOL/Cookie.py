# encoding:utf-8
'''
Created on 2017年4月15日

@author: UbunGit
'''

import json

def getjsonData():
    
    with open("Cookie.json") as json_file:
        
        jsondata  = str(json_file.read())
        if (len(jsondata)==0):
            data = {}
        else:
            data = json.loads(jsondata)
    json_file.close()   
    return data; 
    
def setCookie(key,value):

    cookiedata = getjsonData()
    cookiedata[key] = value;
    with open('Cookie.json', 'wb+') as json_file:
        json_file.write(json.dumps(cookiedata))
    json_file.close() 

def getCookie(key):
    cookiedata = getjsonData()
    if key in cookiedata.keys():
        return cookiedata[key]
    