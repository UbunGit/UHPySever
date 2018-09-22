#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年3月8日

@author: xiaoqy
'''

import sys ,os
sys.path.append(os.path.dirname(os.path.dirname(__file__)))

import logging
import pymysql.cursors
import  mod_config
from PyHandleFile.WriteFile import WriteFile

import time;
import json

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
    
def logs(code, msg , userName,leve,logBusiness,connection):

    logtext = log_date_time_string()+"\t"+userName+"\t"+str(code)+"\t"+str(leve)+"\t"+logBusiness+"\t"+msg
    logging.info(json.dumps(logtext.decode('utf8'), sort_keys=True, indent=2));
    length = len(logtext)
    connection.send('%c%c%s' % (0x81, length, logtext))
    log(code,str(msg),userName,leve,logBusiness)
    
def log(code, msg , userName,leve,logBusiness):
    logtext = "%s\t%s\t%6s\t%2s\t%s\t%s" % (log_date_time_string(),userName,str(code),str(leve),logBusiness,msg)
    logging.info(logtext)
    writeFile = WriteFile()
    writeFile.addLog(logtext)

"""
        入参：
        levels 日志等级
        memberNO 会员账号
        business 业务名称
        beginTime 开始时间
        endTime 结束时间
        search 搜索关键词
        pageIndex 页数
        pageNum 每页大小
"""
def getLogList(data):
    
    connection = connectionDb();
    with connection.cursor() as cursor:
 
        sqladdStr = ""
        if(data['levels']):
            sqladdStr = ' logLevels>='+data['levels'] 
        if(data['memberNO']):
            sqladdStr =' logMember='+"'"+data['memberNO']+"'"
    
        if(data['business']):
            sqladdStr = sqladdStr+' and logBusiness LIKE "%'+ data['business'] +'%"'
            
        if(data['search']):
            sqladdStr = sqladdStr+' and ( logBusiness LIKE "%'+ data['search'] +'%" or logMember LIKE "%'+ data['search'] +'%"  or logDescription LIKE "%'+ data['search'] +'%")'
        
        if(not data['beginTime']):
            data['beginTime']='0000-00-00'
        if(not data['endTime']):
            data['endTime']='9999-99-99'
            
        if(data['beginTime']==data['endTime']):
            sqladdStr = sqladdStr+' and logTime>'+data['beginTime'] +' order by logTime'
        else:
            sqladdStr = sqladdStr+' and logTime>='+data['beginTime']+' and substring(logTime,0,10)<'+data['endTime']+' order by logTime'
        allcountSql =   'select count(*) as allCount from Log_Table  where' +  sqladdStr
        
        cursor.execute(allcountSql)
        connection.commit() 
        allcount = cursor.fetchone()
        
        limbegin =  0
        pageNum = 10
        if(data.has_key("pageIndex")):
            limbegin = data['pageIndex']
            limbegin = limbegin*pageNum
        if(data.has_key("pageNum")):
            pageNum = data['pageNum']   
        sql = 'select * from Log_Table  where '+ sqladdStr+ ' desc limit '+str(limbegin) +' , ' + str(pageNum)
        
        cursor.execute(sql)
        connection.commit()    
    datalist = []
    for row in cursor:
        row["logTime"] = str(row["logTime"])
        datalist.append(row)
    connection.close()
    returnData = {}
    returnData.update(allcount)
    returnData["datalist"]=datalist;
    return returnData;

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
    s = "%04d-%s-%d %2d:%2d:%2d" % (
                year,month,day, hh, mm, ss)
    return s

"""
        入参：
        levels 日志等级
        memberNO 会员账号
        business 业务名称
        beginTime 开始时间
        endTime 结束时间
        search 搜索关键词
        pageIndex 页数
        pageNum 每页大小
"""

import datetime
def getLogtext(data):

    '''确定文件并合并'''
    '''录入数据库'''

    '''确定时间'''

    if("beginTime" not in data.keys()):
        begindate = datetime.datetime.strptime('0001-01-01','%Y-%m-%d')
    else:
        begindate = datetime.datetime.strptime(data['begindate'],'%Y-%m-%d')

    if("endTime" not in data.keys()):
        enddate = datetime.datetime.strptime('9999-12-31','%Y-%m-%d')
    else:
        enddate = datetime.datetime.strptime(data['endTime'],'%Y-%m-%d')


    meragefiledir = os.path.dirname(__file__)+("/../Data/log")
    #获取当前文件夹中的文件名称列表
    filenames=os.listdir(meragefiledir)
    #先遍历文件名
    for filename in filenames:
        filename = os.path.splitext(filename)[0]
        fileDate = datetime.datetime.strptime(filename,'%Y-%m-%d')
        if(fileDate>begindate and fileDate<enddate):
            print(filename);
        filename = os.path.abspath(filename)
        print(filename);





if __name__ == '__main__':

    data = {}

    getLogtext(data);

    
