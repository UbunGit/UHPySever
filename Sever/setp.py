#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年1月27日

@author: xiaoqy
'''
import thread
from HttpSever import HttpSever
from HttpSever import SocketSever


# thread1 = HttpSever.star_httpSever()
# thread1.start()
# 
# thread2 = SocketSever.startSocketSever()
# thread2.start()

# 创建两个线程
try:
   thread.start_new_thread( HttpSever.star_httpSever ,())
   thread.start_new_thread( SocketSever.startSocketSever,())
except BaseException as ex:
   print ("Error: unable to start thread")
   print (ex.message)
   
while 1:
   pass