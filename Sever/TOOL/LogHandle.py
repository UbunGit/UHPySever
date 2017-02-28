#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年3月8日

@author: xiaoqy
'''
import logging

import pymysql.cursors

from TOOL import mod_config


import time;


DBHOST = '45.78.9.162'  # 数据库地址
PORT = 3306
DBUSER = 'SmartHome'  # 数据库用户名
DBPASSWORD = 'SmartHome'  # 数据库密码
SMARTHOME_DB = 'SmartHomeDb'  # 智能家居表面


    
'''
连接数据库
-----------------------------
    2016.3.24 xiaoqy
    html:    1.0.0 
    ios:     1.0.0
    android  1.0.0
－－－－－－－－－－－－－－－－－
''' 
def connectionDb():
        
        connection = pymysql.connect(
                                         host=mod_config.getConfig("database", "dbhost"),
                                         port=PORT,
                                         user=DBUSER,
                                         password=DBPASSWORD,
                                         db=SMARTHOME_DB,
                                         charset='utf8',
                                         local_infile=1,
                                         cursorclass=pymysql.cursors.DictCursor,
                                         autocommit=True)
        return connection;
    
def log(code, msg , userName,leve,logBusiness):
    if(len(userName) <= 0):
        userName = "anyOne"
    if code != 0:
        msgInfo = ("\n[%s] code:%s msg:%s\n" % (log_date_time_string(),
                          code,
                          str(msg)
                          )
              )
    else:
        msgInfo = ("[%s] code:%s msg:%s\n" % (log_date_time_string(),
                          code,
                          str(msg)
                          )
              )
    
    logging.info(msgInfo.decode('utf8'));
    addlogInfo(leve,code,str(msg),logBusiness,userName,log_date_time_string())

def addlogInfo (leve,code,msg,logBusiness,userName,time):   
        connection = connectionDb();
        with connection.cursor() as cursor:
            sql ='REPLACE   Log_Table  set logLevels=%s,logCode=%s,logDescription=%s,logBusiness=%s,logMember=%s,logTime=%s'
            cursor.execute(sql,(leve,code,msg,logBusiness,userName,time))
            connection.commit()
        connection.close() 

def getLogList(data):
    
    connection = connectionDb();
    with connection.cursor() as cursor:
        
        sql = 'select * from Log_Table  where logLevels>='+data['levels']    
        if(data['memberNO']):
            sql = sql+' and logMember='+"'"+data['memberNO']+"'"
    
        if(data['business']):
            sql = sql+' and logBusiness='+data['business']
        
        if(not data['beginTime']):
            data['beginTime']='0000-00-00'
        if(not data['endTime']):
            data['endTime']='9999-99-99'
        if(data['beginTime']==data['endTime']):
            sql = sql+' and logTime>'+data['beginTime'] +' order by logTime desc limit 0,100 '
        else:
            sql = sql+' and logTime>='+data['beginTime']+' and substring(logTime,0,10)<'+data['endTime']+' order by logTime desc limit 0,100 '
        cursor.execute(sql)
        connection.commit()    
    datalist = []
    for row in cursor:
        row["logTime"] = str(row["logTime"])
        datalist.append(row)
    connection.close()
    return datalist;

def deleteLog ():   
        connection = connectionDb();
        with connection.cursor() as cursor:
            sql ='DELETE FROM Log_Table WHERE logId>0;'
            cursor.execute(sql)
            connection.commit()
        connection.close() 
        
logging.basicConfig(level=logging.DEBUG)


def log_date_time_string():
    """Return the current time formatted for logging."""
    now = time.time()
    year, month, day, hh, mm, ss, x, y, z = time.localtime(now)
    s = "%04d-%s-%d %d:%d:%d" % (
                year,month,day, hh, mm, ss)
    return s


    
