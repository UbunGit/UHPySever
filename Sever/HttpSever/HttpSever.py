#!/usr/bin/env python
# coding=utf-8
'''
Created on 2016年6月30日

@author: xiaoqy
'''

'''
开启服务器
'''

import os, sys, platform
import shutil
import posixpath
import urllib, urllib2
import mimetypes
from BaseHTTPServer import HTTPServer, BaseHTTPRequestHandler
import socket

from pymysql.err import MySQLError

from Interface.FCAnalyse  import FCAnalyse
from Interface.Interface import InterfaceHandle
from Interface.SamrtHome import SamrtHome
from Interface.UPAndDown import UPAndDown
from PyString import PythonString
from TOOL import LogHandle
from TOOL import  mod_config

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
        """Serve a GET request."""
        # print "....................", threading.currentThread().getName()
        f = self.send_head()
        if f:
            self.copyfile(f, self.wfile)
            f.close()
          
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
            elif (path == '/UPAndDown'):
                upAndDown = UPAndDown()
                returnData = upAndDown.upAndDownMethodo(fields, userName)
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
                LogHandle.log(returnData['inforCode'], returnJson , userName, 2, "["+path+" "+fields['inefaceMode'] +" ]"+interFaceMetho)
            else:   
                LogHandle.log(returnData['inforCode'], returnJson , userName, 0, "["+path+" "+fields['inefaceMode'] +" ]"+interFaceMetho)
        
    errResponses = {
        - 20000:('sever is error'),
        - 20001:('interFace not define'),
        - 20002:('input value has nil'),
        - 20003:('interface not define'),
        - 20004:('user not login'),
        - 20005:('unkonw'),

        - 10000:('sql error'),
        - 10001: ('member is not reginst'),
        - 10002:('member is not reginst or passWord is error'),
        - 10003:('member NO is reginsted or telNO is reginsted'),
        - 10004:("select data is null"),
        - 10005:("interface is has in data"),
        - 10006:('sever get map value is not key')
        }
    def send_head(self):
        """Common code for GET and HEAD commands.

        This sends the response code and MIME headers.

        Return value is either a file object (which has to be copied
        to the outputfile by the caller unless the command was HEAD,
        and must be closed by the caller under all circumstances), or
        None, in which case the caller has nothing further to do.

        """
        path = self.translate_path(self.path)
        f = None
        if os.path.isdir(path):
            if not self.path.endswith('/'):
                # redirect browser - doing basically what apache does
                self.send_response(301)
                self.send_header("Location", self.path + "/")
                self.end_headers()
                return None
            for index in "index.html", "index.htm":
                index = os.path.join(path, index)
                if os.path.exists(index):
                    path = index
                    break
            else:
                return self.list_directory(path)
        ctype = self.guess_type(path)
        try:
            # Always read in binary mode. Opening files in text mode may cause
            # newline translations, making the actual size of the content
            # transmitted *less* than the content-length!
            f = open(path, 'rb')
        except IOError:
            self.send_error(404, "File not found")
            return None
        self.send_response(200)
        self.send_header("Content-type", ctype)
        fs = os.fstat(f.fileno())
        self.send_header("Content-Length", str(fs[6]))
        self.send_header("Last-Modified", self.date_time_string(fs.st_mtime))
        self.end_headers()
        return f
    def copyfile(self, source, outputfile):
        """Copy all data between two file objects.

        The SOURCE argument is a file object open for reading
        (or anything with a read() method) and the DESTINATION
        argument is a file object open for writing (or
        anything with a write() method).

        The only reason for overriding this would be to change
        the block size or perhaps to replace newlines by CRLF
        -- note however that this the default server uses this
        to copy binary data as well.

        """
        shutil.copyfileobj(source, outputfile)

    def translate_path(self, path):
        """Translate a /-separated PATH to the local filename syntax.

        Components that mean special things to the local file system
        (e.g. drive or directory names) are ignored. (XXX They should
        probably be diagnosed.)

        """
        # abandon query parameters
        path = path.split('?',1)[0]
        path = path.split('#',1)[0]
        path = posixpath.normpath(urllib.unquote(path))
        words = path.split('/')
        words = filter(None, words)
        path = os.getcwd()
        for word in words:
            drive, word = os.path.splitdrive(word)
            head, word = os.path.split(word)
            if word in (os.curdir, os.pardir): continue
            path = os.path.join(path, word)
        return path
    def guess_type(self, path):
        """Guess the type of a file.

        Argument is a PATH (a filename).

        Return value is a string of the form type/subtype,
        usable for a MIME Content-type header.

        The default implementation looks the file's extension
        up in the table self.extensions_map, using application/octet-stream
        as a default; however it would be permissible (if
        slow) to look inside the data to make a better guess.

        """

        base, ext = posixpath.splitext(path)
        if ext in self.extensions_map:
            return self.extensions_map[ext]
        ext = ext.lower()
        if ext in self.extensions_map:
            return self.extensions_map[ext]
        else:
            return self.extensions_map['']

    if not mimetypes.inited:
        mimetypes.init() # try to read system mime.types
    extensions_map = mimetypes.types_map.copy()
    extensions_map.update({
        '': 'application/octet-stream', # Default
        '.py': 'text/plain',
        '.c': 'text/plain',
        '.h': 'text/plain',
    })

def star_httpSever():
       

        severIp = mod_config.getConfig("INTERFACE", "IP")
        severPort = mod_config.getConfig("INTERFACE", "PORT")
        http_server = HTTPServer((severIp, int(severPort)), HTTPSeverHandle)
        LogHandle.log(0, 'http服务器已开启' + severIp+":8889" , 'anyone', 0, 'start_Httpserver')
        http_server.serve_forever()  # 设置一直监听并接收请求 

'''
关闭服务器
'''
def stop_server(server):
        server.sorket.close()  


        
     

        

