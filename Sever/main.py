#!/usr/bin/env python
# -*- coding: UTF-8 -*-
'''
Created on 2016年1月27日

@author: xiaoqy
'''


import thread

from HttpSever import HttpSever
from HttpSever import SocketSever
from TOOL import mod_config

def main():


   httpServer = mod_config.getConfig("INTERFACE", "IP")
   httpPort = int(mod_config.getConfig("INTERFACE", "PORT"))
   socketServer = mod_config.getConfig("SOCKETSEVER", "IP")
   socketPort = int(mod_config.getConfig("SOCKETSEVER", "PORT"))



   # 创建两个线程
   try:

      thread.start_new_thread( HttpSever.star_httpSever ,(httpServer,httpPort))
      thread.start_new_thread( SocketSever.startSocketSever,(socketServer,socketPort))

   except BaseException as ex:
      print ("Error: unable to start thread")
      print (ex.message)

   while 1:
      pass

if __name__ == "__main__":

   main()