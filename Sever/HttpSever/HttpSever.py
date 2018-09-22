#!/usr/bin/env python
# coding=utf-8
'''
Created on 2016年6月30日

@author: xiaoqy
'''

'''
开启服务器
'''

import os, sys, platform, cgi,posixpath,shutil,urllib,mimetypes

from BaseHTTPServer import HTTPServer, BaseHTTPRequestHandler

from pymysql.err import MySQLError

from Interface.FCAnalyse import FCAnalyse
from Interface.Interface import InterfaceHandle
from Interface.SamrtHome import SamrtHome
from Interface.UPAndDown import UPAndDown
from Interface.WXInterFace import WXInterface
from Interface.Shoping import Shoping

from PyString import PythonString
from TOOL import LogHandle,mod_config
from TOOL.CustomError import CustomError



'''
服务器操作类
'''


class HTTPSeverHandle(BaseHTTPRequestHandler):

    userID = None

    def do_OPTIONS(self):
        self.send_response(200, "ok")
        self.send_header('Accept-Encoding','gzip,deflate');
        self.send_header('Access-Control-Allow-Origin', '*');
        self.send_header('Access-Control-Allow-Methods', 'GET, POST,OPTIONS');
        self.send_header("Access-Control-Allow-Headers", "X-Requested-With");
        self.send_header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept, userID,sign,key,secType");
        self.end_headers();


    def do_POST(self):
        self.send_response(200, "ok")
        self.send_header('Accept-Encoding','gzip,deflate');
        self.send_header("Access-Control-Allow-Origin", "*");
        self.send_header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
        self.send_header("Access-Control-Expose-Headers", "Access-Control-Allow-Origin");
        self.send_header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept,userID,sign,key,secType")
        self.parse_POST()

    def do_GET(self):
        """Serve a GET request."""
        # print "....................", threading.currentThread().getName()
        f = self.send_head()
        if f:
            self.copyfile(f, self.wfile)
            f.close()

    def parse_POST(self):

        self.userID = self.headers.getheader('userID')

        length = int(self.headers.getheader('content-length'))
        inputdata = self.rfile.read(length)

        cgi.escape(inputdata, quote=True)
        fields = PythonString.jsonPase(inputdata)
        self.interFaceDef(fields,self.path)

    def interFaceDef(self,data,path):

        try:

            resultcode = 0

            metho = data['metho']
            param = data['param']  if "param" in data.keys() else None
            self.userID = self.headers.getheader('userID');

            LogHandle.log(0, "input: "+str(param), self.userID, 0, path+"/"+metho)

            if (path == '/interface'):
                interface = InterfaceHandle()
                result = interface.interfaceMethodo(param, metho,self.userID)
            elif (path == '/samrtHome'):
                interface = SamrtHome()
                result = interface.samrtHomeMethodo(param, metho,self.userID)
            elif (path == '/FCAnalyse'):
                interface = FCAnalyse()
                result = interface.FCAnalyseMethodo(param, metho,self.userID)
            elif (path == '/UPAndDown'):
                upAndDown = UPAndDown()
                result = upAndDown.upAndDownMethodo(param, metho,self.userID)
            elif (path == '/WXInterface'):
                wxInterface = WXInterface()
                result = wxInterface.upAndDownMethodo(param,metho,self.userID)
            elif (path == '/Shoping'):
                shoping = Shoping()
                result = shoping.interfaceMethodo(param, metho,self.userID)

            else:
                raise CustomError(-10005)

        except KeyError, ex:
            resultcode = -10006
            result = u'sever get map value is not key:'+str(ex)

        except MySQLError, ex:
            resultcode = -10000
            result = 'sql error:' + ex[1]

        except CustomError,ex:
            resultcode = ex.code
            result = ex.__str__()

        except BaseException, ex:
            resultcode = -20000
            result = ex.message

        length = int(self.headers['content-length'])
        acceptType = self.headers.getheader('Accept')
        self.send_header("Content-type", acceptType)

        self.send_header("Access-Control-Expose-Headers", "resultcode")
        self.send_header("resultcode", resultcode)

        self.end_headers()
        returnJson = "";
        if (result):
            returnJson = cgi.escape(PythonString.jsonUnPase(result), quote=False)
        self.wfile.write(returnJson)
        LogHandle.log(resultcode, "output: "+returnJson, self.userID, 0, path+"/"+metho)


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
        path = path.split('?', 1)[0]
        path = path.split('#', 1)[0]
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
        mimetypes.init()  # try to read system mime.types
    extensions_map = mimetypes.types_map.copy()
    extensions_map.update({
        '': 'application/octet-stream',  # Default
        '.py': 'text/plain',
        '.c': 'text/plain',
        '.h': 'text/plain',
    })




def star_httpSever(httpServer,httpPort):


    httpd = HTTPServer((httpServer, int(httpPort)), HTTPSeverHandle)
    # httpd.socket = ssl.wrap_socket (httpd.socket, certfile='./server.pem', server_side=True)
    LogHandle.log(0, 'https服务器已开启' + httpServer + ":"+str(httpPort), 'anyone', 0, 'start_Httpserver')
    httpd.serve_forever()  # 设置一直监听并接收请求


'''
关闭服务器
'''

def stop_server(server):
    server.sorket.close()
