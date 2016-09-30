#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年3月8日

@author: xiaoqy
'''
import logging
import time;
import os


logging.basicConfig(level=logging.DEBUG)
monthname = [None,
                 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

def log_date_time_string():
    """Return the current time formatted for logging."""
    now = time.time()
    year, month, day, hh, mm, ss, x, y, z = time.localtime(now)
    s = "%02d/%3s/%04d %02d:%02d:%02d" % (
                day, monthname[month], year, hh, mm, ss)
    return s

def writeLog(code, msg ,userName):
    if(len(userName)<=0):
        userName = "anyOne"
    if code != 0:
        msgInfo =("-->[%s] ERROR code:%s msg:%s\n" %(log_date_time_string(),
                          code,
                          str(msg)
                          )
              )
    else:
        msgInfo =("-->[%s] code:%s msg:%s\n" %(log_date_time_string(),
                          code,
                          str(msg)
                          )
              )
   
    logpath= os.path.abspath(os.curdir) + "/log"
    isExists=os.path.exists(logpath)
    # 判断结果
    if not isExists:
        # 如果不存在则创建目录
        print logpath+' 创建成功'
        # 创建目录操作函数
        os.makedirs(logpath)
    file_object = open(logpath+"/"+userName+'.log', 'ab')
    file_object.write(msgInfo)
    file_object.close()
    logging.info(msgInfo.decode('utf8'));
    
