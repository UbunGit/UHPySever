#!/usr/bin/env python
#coding=utf-8
'''
Created on 2016年6月30日

@author: xiaoqy
'''

from BaseHTTPServer import HTTPServer, BaseHTTPRequestHandler
from TOOL import LogHandle
from Interface.Interface import InterfaceHandle
from Interface.ScanInterFace import ScanInterFace
from Interface.FCAnalyse  import FCAnalyse
from PyString import PythonString
import socket
'''
开启服务器
'''
def start_server(port):
    
    #获取本机电脑名
    myname = socket.getfqdn(socket.gethostname())
    #获取本机ip
    myaddr = socket.gethostbyname(myname)
    http_server = HTTPServer((myaddr, int(port)), TestHTTPHandle)  
    LogHandle.writeLog(0, '服务器已开启'+myaddr, 'anyone')
    http_server.serve_forever() #设置一直监听并接收请求 
    
    
'''
关闭服务器
'''
def stop_server(server):
    server.sorket.close()
 
'''
服务器操作类
'''   
class TestHTTPHandle(BaseHTTPRequestHandler):  
    
    userName = None #用户名
    userTel = None  #用户绑定电话号码
    userId = None  #用户id
    
    def do_OPTIONS(self):
        self.send_response(200, "ok")
        self.send_header("Access-Control-Allow-Origin","*"); 
        self.send_header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
        self.send_header("Access-Control-Allow-Headers", "X-Requested-With")
        self.send_header("Access-Control-Allow-Headers", "X-Requested-With, Content-Type")  
        self.send_error(400,
                                "Bad HTTP/0.9 request type (%r)" % 'OPTIONS') 
        return;
        
    def do_POST(self):
        self.parse_POST() 
         
    def do_GET(self):
        self.send_error(400,
                                "Bad HTTP/0.9 request type (%r)" % 'get') 
          
    def parse_POST(self):
        try:
        
            LogHandle.writeLog(0, 'POSTbegin', 'anyone')
            path = self.path
            self.send_response(200, "ok")
            self.send_header("Access-Control-Allow-Origin","*"); 
            self.send_header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
            self.send_header("Access-Control-Allow-Headers", "X-Requested-With")
            self.send_header("Access-Control-Allow-Headers", "X-Requested-With, Content-Type")   
            length = int(self.headers['content-length'])
            acceptType =  self.headers.getheader('Accept')
            contentType =  self.headers.getheader('Content-Type')
        
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
#             if("userId"  in fields.keys()):
#                 userId = fields["userId"];
                
#             if(len(userName.encode('utf-8'))<6 and len(userTel.encode('utf-8')<6)):
#                 returnData = {"inforCode":-20004};
#                 LogHandle.writeLog(0, returnData, userName)
#                 
#             el
            if(path =='/interface'): 
                interface = InterfaceHandle()
                returnData = interface.interfaceMethodo(fields,userName) 
            elif (path=='/samrtHome'):
                interface = ScanInterFace()
                returnData = interface.scanInterFaceMethodo(fields,userName)
            elif (path=='/FCAnalyse'):
                interface = FCAnalyse()
                returnData = interface.FCAnalyseMethodo(fields,userName)
            else:
                returnData = {"inforCode":-20003};

        except KeyError ,ex:
            returnData = {"inforCode":-10006}
            LogHandle.writeLog(returnData["inforCode"], ex, userName)
            

        except BaseException ,ex:
            returnData = {"inforCode":-20000}
            print ex;

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
            LogHandle.writeLog(0, returnData, 'anyone')
            LogHandle.writeLog(0, '===POSTEND==', 'anyone')  
        
        
    errResponses = {
        -20000:('sever is error'),           
        -20001:('interFace not define'),
        -20002:('input value has nil'),
        -20003:('interface not define'),
        -20004:('user not login'),
        -10000:('select sql error'),
        
        -10001: ('member is not reginst'),
        -10002:('member is not reginst or passWord is error'),
        -10003:('member NO is reginsted or telNO is reginsted'),
        -10004:("select data is null"),
        -10005:("interface is has in data"),
        -10006:('sever get map value is not key')
        }  
       

        

