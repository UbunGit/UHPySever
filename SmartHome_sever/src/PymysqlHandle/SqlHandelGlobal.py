#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年8月29日

@author: xiaoqy
'''
import pymysql.cursors

DBHOST = '45.78.9.162'  # 数据库地址
PORT = 3306
DBUSER = 'SmartHome'  # 数据库用户名
DBPASSWORD = 'SmartHome'  # 数据库密码
SMARTHOME_DB = 'SmartHomeDb'  # 智能家居表面

class SqlHabdleGlobal(object):
    '''
    数据库公共操作方法
    '''
    
    '''
    连接数据库
    -----------------------------
     2016.3.24 xiaoqy
     html:    1.0.0 
     ios:     1.0.0
     android  1.0.0
    －－－－－－－－－－－－－－－－－
    ''' 
    @classmethod  
    def connectionDb(self):
        
        connection = pymysql.connect(
                                         host=DBHOST,
                                         port=PORT,
                                         user=DBUSER,
                                         password=DBPASSWORD,
                                         db=SMARTHOME_DB,
                                         charset='utf8mb4',
                                         local_infile=1,
                                         cursorclass=pymysql.cursors.DictCursor)
        return connection;
    '''
    判断表是否存在
    '''
    @classmethod
    def isHaveTable(self,tableName):
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            sql = 'select * from information_schema.tables where table_name = "'+tableName+'" AND TABLE_SCHEMA="SmartHomeDb";'
            cursor.execute(sql)
            tablerows = cursor.fetchall()
            if( len(tablerows)>0):
                return True;
            else:
                return False;
        return False
        