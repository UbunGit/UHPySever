#!/usr/bin/env python
# coding=utf-8
'''
Created on 2016年6月30日

@author: xiaoqy
'''

'''
开启服务器
'''

from BaseHTTPServer import HTTPServer, BaseHTTPRequestHandler
import socket

from pymysql.err import MySQLError

from Interface.FCAnalyse  import FCAnalyse
from Interface.Interface import InterfaceHandle
from Interface.SamrtHome import SamrtHome
from PyString import PythonString
from TOOL import LogHandle

'''
服务器操作类
'''   
class HTTPSeverHandle(BaseHTTPRequestHandler):  
    
    userName = None  # 用户名
    userTel = None  # 用户绑定电话号码
    userId = None  # 用户id

    def do_OPTIONS(self):
        self.send_response(200, "ok")       
        self.send_header('Access-Control-Allow-Origin', '*')                
        self.send_header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
        self.send_header("Access-Control-Allow-Headers", "X-Requested-With")
        self.send_header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept")
        
    def do_POST(self):
        self.parse_POST() 
         
    def do_GET(self):
        self.send_error(400,
                                "Bad HTTP/0.9 request type (%r)" % 'get') 
          
    def parse_POST(self):
        try:
            path = self.path
            self.send_response(200, "ok")
            self.send_header("Access-Control-Allow-Origin", "*"); 
            self.send_header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
            self.send_header("Access-Control-Allow-Headers", "X-Requested-With")
            self.send_header("Access-Control-Allow-Headers", "X-Requested-With, Content-Type")   
            length = int(self.headers['content-length'])
            acceptType = self.headers.getheader('Accept')
            contentType = self.headers.getheader('Content-Type')
        
            if contentType == 'application/json' or contentType == 'text/json' or contentType == 'json':
                length = int(self.headers.getheader('content-length'))
                field_data = self.rfile.read(length)
                fields = PythonString.jsonPase(field_data)
            else:
                self.send_error(400,
                                "Bad HTTP/0.9 request type contentType:(%r)" % contentType)
                return
            self.send_header("Content-type", acceptType)
            self.end_headers()

            if("userName"  in fields.keys()):
                userName = fields["userName"]
            else:
                userName = "verstor"
            
            if("userTel"  in fields.keys()):
                userTel = fields["userTel"];
            
            interFaceMetho = fields['inefaceMode']   
            LogHandle.log(0, path + ' ' + str(fields), userName, 0, interFaceMetho)   
            
            
            if(path == '/interface'): 
                interface = InterfaceHandle()
                returnData = interface.interfaceMethodo(fields, userName) 
            elif (path == '/samrtHome'):
                interface = SamrtHome()
                returnData = interface.samrtHomeMethodo(fields, userName)
            elif (path == '/FCAnalyse'):
                interface = FCAnalyse()
                returnData = interface.FCAnalyseMethodo(fields, userName)
            else:
                returnData = {"inforCode":-20003};

        except KeyError , ex:
            returnData = {"inforCode":-10006}
            returnData['result'] = 'sever get map value is not key:' + ex.message
            
        except MySQLError , ex:
            returnData = {"inforCode":-10000}
            returnData['result'] = 'sql error:' + ex[1]

        except BaseException , ex:
            returnData = {"inforCode":-20000}
            returnData['result'] = ex.message
           

        finally:
            if returnData['inforCode'] != 0:
                    inforCode = returnData['inforCode']
                    if("result" not in returnData.keys()) :
                        if(not self.errResponses.has_key(inforCode)):
                            inforMsg = "sever error but not define errorcode";
                        else:                                        
                            inforMsg = self.errResponses[inforCode]
                        returnData['result'] = inforMsg 

            returnJson = PythonString.jsonUnPase(returnData)   
            self.wfile.write(returnJson)
            if returnData['inforCode'] != 0:
                LogHandle.log(returnData['inforCode'], returnData['result'] , userName, 2, "["+path+" "+fields['inefaceMode'] +" ]"+interFaceMetho) 
            else:   
                LogHandle.log(returnData['inforCode'], returnData['result'] , userName, 0, "["+path+" "+fields['inefaceMode'] +" ]"+interFaceMetho) 
        
    errResponses = {
        - 20000:('sever is error'),
        - 20001:('interFace not define'),
        - 20002:('input value has nil'),
        - 20003:('interface not define'),
        - 20004:('user not login'),
        - 10000:('sql error'),
        
        - 10001: ('member is not reginst'),
        - 10002:('member is not reginst or passWord is error'),
        - 10003:('member NO is reginsted or telNO is reginsted'),
        - 10004:("select data is null"),
        - 10005:("interface is has in data"),
        - 10006:('sever get map value is not key')
        }  
def star_httpSever():
       
        # 获取本机电脑名
        myname = socket.getfqdn(socket.gethostname())
        # 获取本机ip
        myaddr = socket.gethostbyname(myname)
        myaddr = "192.168.1.27";
        http_server = HTTPServer((myaddr, int(8889)), HTTPSeverHandle)  
        LogHandle.log(0, 'http服务器已开启' + myaddr+":8889" , 'anyone', 0, 'start_Httpserver')
        http_server.serve_forever()  # 设置一直监听并接收请求 

'''
关闭服务器
'''
def stop_server(server):
        server.sorket.close()  


        
     

        

