#!/usr/bin/env python
# coding=utf-8
'''
Created on 2017年2月10日

@author: UbunGit
'''
import threading
import hashlib
import socket
import base64
import json
from Interface.SocketInterFace import SocketInterFace
from TOOL import mod_config

class websocket_thread(threading.Thread):
    def __init__(self, connection):
        super(websocket_thread, self).__init__()
        self.connection = connection
     
    def run(self):
        print 'new websocket client joined!'
       
        while True:
            data = self.connection.recv(1024)
            socketInterFace = SocketInterFace(self.connection)
            inputdata = parse_data(data);
            print "socket接受到数据："+inputdata;
            if len(inputdata)>0:
                inputdata = json.loads(parse_data(data))
                socketInterFace.socketInterFace(inputdata)
                reply = '\n'
                length = len(reply)
                self.connection.send('%c%c%s' % (0x81, length, reply))
            
def parse_data(msg):
    v = ord(msg[1]) & 0x7f
    if v == 0x7e:
        p = 4
    elif v == 0x7f:
        p = 10
    else:
        p = 2
    mask = msg[p:p+4]
    data = msg[p+4:]
    
    return ''.join([chr(ord(v) ^ ord(mask[k%4])) for k, v in enumerate(data)])
    
def parse_headers(msg):
    headers = {}
    header, data = msg.split('\r\n\r\n', 1)
    for line in header.split('\r\n')[1:]:
        key, value = line.split(': ', 1)
        headers[key] = value
    headers['data'] = data
    return headers

def generate_token(msg):
    key = msg + '258EAFA5-E914-47DA-95CA-C5AB0DC85B11'
    ser_key = hashlib.sha1(key).digest()
    return base64.b64encode(ser_key)
            
def startSocketSever():
    severIP = mod_config.getConfig("SOCKETSEVER", "IP")
    severPort = mod_config.getConfig("SOCKETSEVER", "PORT")
    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    sock.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)

    sock.bind((severIP, int(severPort)))
    sock.listen(5)
    print 'websocket sever '+severIP+severPort+':已开启!'
    while True:
        connection, address = sock.accept()
        try:
            data = connection.recv(1024)
            headers = parse_headers(data)
            token = generate_token(headers['Sec-WebSocket-Key'])
            connection.send('\
HTTP/1.1 101 WebSocket Protocol Hybi-10\r\n\
Upgrade: WebSocket\r\n\
Connection: Upgrade\r\n\
Sec-WebSocket-Accept: %s\r\n\r\n' % token)
            thread = websocket_thread(connection)
            thread.start()
        except socket.timeout:
            print 'websocket connection timeout'