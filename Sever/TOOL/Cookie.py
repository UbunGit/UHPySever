# encoding:utf-8
'''
Created on 2017年4月15日

@author: UbunGit
'''

import json

cookiedata = {}
    
def setCookie(key,value):

    cookiedata[key] = value;
    with open('Cookie.json', 'wb+') as json_file:
        json_file.write(json.dumps(cookiedata))
    json_file.close() 

def getCookie(key):

    if key in cookiedata.keys():
        return cookiedata[key]
    
def removeCooKie(key):

    cookiedata.pop(key, None)
    with open('Cookie.json', 'wb+') as json_file:
        json_file.write(json.dumps(cookiedata))
    json_file.close()

def main():
    with open("Cookie.json") as json_file:
        jsondata  = str(json_file.read())
        if (len(jsondata)==0):
            data = {}
        else:
            data = json.loads(jsondata)
    json_file.close()   
    return data;
    
if __name__ == '__main__':
    main()
    

    
    