#!/usr/bin/env python
# encoding: utf-8 a = '中文' 
'''
Created on 2016年3月11日

@author: xiaoqy
'''
from pymysql.err import MySQLError

from SqlHandelGlobal import SqlHabdleGlobal
from TOOL import LogHandle


SMARTHOMEUSER_TABLE = 'SmartHomeUser_Table'  # 智能家居用户信息表
INTERFAVE_TABLE = 'SmartHomeInterFace_Table'  # 接口数据表
INTERFAVEPARAMETER_TABLE = 'SmartHomeParameter_Table'
from distutils.tests.setuptools_build_ext import if_dl
from StdSuites.AppleScript_Suite import string

class PymysqlHandle(object):
    '''
    数据库操作
    '''
    '''
    注册
    插入用户数据
    -----------------------------
     2016.3.24 xiaoqy
     html:    1.0.0 
     ios:     1.0.0
     android  1.0.0
    －－－－－－－－－－－－－－－－－
    '''
    def insetUserInfo(self, userName, userTel, userPassWord):

        try:
            connection = SqlHabdleGlobal.connectionDb();
            with connection.cursor() as cursor:
                # Create a new record
                sql = 'INSERT INTO ' + SMARTHOMEUSER_TABLE + ' (userName, userPassWord, userTel) VALUES (%s, %s,%s)'
                cursor.execute(sql, (userName, userPassWord, userTel))
                connection.commit()
        except BaseException, e:
            if e.args[0]:
                returnDic = {"inforCode":-10003}
            else:
                returnDic = {"inforCode":-10000}
            return returnDic
        else:
            connection.close() 
            returnDic = {"inforCode":0}
            return returnDic;
    
    '''
    登录
    查询用户信息（1.0.1）
    -----------------------------
     2016.5.13 xiaoqy
     html:    1.0.0 
     ios:     1.0.0
     android  1.0.0\[
    －－－－－－－－－－/ －－－－－－－
    '''   
    def selectUserInfo(self, userName, userTel=''):
            connection = SqlHabdleGlobal.connectionDb();
            with connection.cursor() as cursor:
                # Create a new record
                if len(userName.encode('utf-8')) < 3:
                    userName = userTel;
                sql = 'call p_GetUserInfo(%s)'
                cursor.execute(sql, userName)
                LogHandle.writeLog(0, '数据库操作：p_GetUserInfo:' + sql, userName)
                    
                for row in cursor:
                    if(not row["userLevel"]):
                        row["userLevel"] = "1001"
                    cursorData = row;
                    return cursorData
                
                return 

                    



    '''
    修改会员信息
    '''   
    def replaceUserInfo(self, data):
        
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new record
            sql = 'call p_ReplaceUserInfo(%s,%s,%s,%s,%s)';
            LogHandle.writeLog(0, '数据库操作：replaceIntefaceInfo:' + sql.encode('utf-8'), "anyone")
            
            if("userName"  in data.keys()):
                userName = data['userName']
            else:
                userName = None;
            if("userPassWord"  in data.keys()):
                userPassWord = data['userPassWord']
            else:
                userPassWord = None 
            if("userTel"  in data.keys()):
                userTel = data['userTel']
            else:
                userTel = None 
            if("userLevel"  in data.keys()):
                userLevel = data['userLevel']
            else:
                userLevel = None 
            if("userLogState"  in data.keys()):
                userLogState = data['userLogState']
            else:
                userLogState = None 
            try:   
                cursor.execute(sql, (userName,
                                 userPassWord,
                                 userTel,
                                 userLevel,
                                 userLogState
                                 )
                            );
                connection.commit()
                connection.close() 
                returnDic = {"inforCode":0}
                return returnDic;
            except MySQLError, ex:
                returnData = {"inforCode":ex.args[0]};
                returnData['result'] = ex.args[1]  
                
    '''
    添加新接口  
    -----------------------------
     2016.10.28 xiaoqy
     html:    1.0.0 
     ios:     1.0.0
     android  1.0.0
    －－－－－－－－－－－－－－－－－   
    '''     
    def addInterFace(self,interFaceName,interFaceNameStr,interFacepath):  
        try:
            connection = SqlHabdleGlobal.connectionDb();
            with connection.cursor() as cursor:
                sql ='INSERT SmartHomeInterFace_Table (interFaceName,interFaceNameStr,interFacepath) VALUES (%s,%s,%s);'
                cursor.execute(sql,(interFaceName,interFaceNameStr,interFacepath))
                connection.commit()

        except BaseException, e:
            LogHandle.writeLog(str(e.args[0]), '数据库操作：replaceIntefaceInfo:' + str(e), "anyone")
            returnDic = {"inforCode":-10000}
            return returnDic
        else:
            connection.close() 
            returnDic = {"inforCode":0}
            return returnDic;
    '''
     修改接口数据
    -----------------------------
     2016.3.28 xiaoqy
     html:    1.0.0 
     ios:     1.0.0
     android  1.0.0
    －－－－－－－－－－－－－－－－－
    '''   
    def replaceIntefaceInfo(self, data):
        try:
            interfaceName = data['repInteFaceName'];
            setstr = 'set ';
            for key in data.keys():
                if(key != 'repInteFaceName'):
                    setstr = setstr+key+'=' +data[key]+','
                    
            LogHandle.writeLog(0, 'key='+ str(setstr), "anyone")
            connection = SqlHabdleGlobal.connectionDb();
            with connection.cursor() as cursor:
                sql ='SELECT COUNT(interFaceName) FROM SmartHomeInterFace_Table WHERE interFaceName = interFaceName_in'
                cursor.execute(sql)
                
#                 connection.commit()
        except BaseException, e:
            LogHandle.writeLog(str(e.args[0]), '数据库操作：replaceIntefaceInfo:' + str(e), "anyone")
            returnDic = {"inforCode":-10000}
            return returnDic
        else:
            connection.close() 
            returnDic = {"inforCode":0}
            return returnDic;
    
    '''
    查询接口列表
    -----------------------------
     2016.3.24 xiaoqy
     html:    1.0.0 
     ios:     1.0.0
     android  1.0.0
    －－－－－－－－－－－－－－－－－
    '''  
    def getInterfaceList(self):
        try:
            connection = SqlHabdleGlobal.connectionDb();
            with connection.cursor() as cursor:
                # Create a new record
                sql = 'SELECT * FROM ' + INTERFAVE_TABLE + ' ;'
                cursor.execute(sql)
                LogHandle.writeLog(0, '数据库操作：getInterfaceList:' + sql, 'anyone')
                list = []
                for row in cursor:
                    list.append(row)
                if len(list) <= 0: 
                    returnDic = {"inforCode":-10004}
                else:
                    returnDic = {"inforCode":0}   
                    returnDic['result'] = list
                
                LogHandle.writeLog(returnDic['inforCode'], '数据库操作：getInterfaceList:', 'anyone')
                return returnDic;
                    
        except BaseException, e:

            returnDic = {"inforCode":-10000}
            LogHandle.writeLog(str(e.args[0]),
                               '数据库操作异常：getInterfaceList:' + str(e.args[1]),
                               'anyone')
            return returnDic
        else:
            connection.close() 
            returnDic = {"inforCode":0}
            return returnDic;

    
    ''' 
    查询接口输入输出列表
    -----------------------------
     2016.3.29 xiaoqy
     html:    1.0.0 
     ios:     1.0.0
     android  1.0.0
    －－－－－－－－－－－－－－－－－
    '''  
    def getInterfaceParameterList(self, interFaceName, parameterTypeuse):
        try:
            connection = SqlHabdleGlobal.connectionDb();
            with connection.cursor() as cursor:
                # Create a new record
                sql = 'SELECT * FROM ' + INTERFAVEPARAMETER_TABLE + ' where parameterFatherName=(select interFaceName from ' + INTERFAVE_TABLE + ' where  interFaceName=%s and parameterTypeuse=%s);'
                cursor.execute(sql, (interFaceName, parameterTypeuse))
                LogHandle.writeLog(0, '数据库操作：getInterfaceParameterList:' + sql, 'anyone')
                list = []
                for row in cursor:
                    list.append(row)
                if len(list) <= 0: 
                    returnDic = {"inforCode":-10004}
                else:
                    returnDic = {"inforCode":0}   
                    returnDic['result'] = list
                
                LogHandle.writeLog(returnDic['inforCode'], '数据库操作：getInterfaceList:', 'anyone')
                return returnDic;
                    
        except BaseException, e:

            returnDic = {"inforCode":-10000}
            LogHandle.writeLog(str(e.args[0]),
                               '数据库操作异常：getInterfaceList:' + str(e.args[1]),
                               'anyone')
            return returnDic
        else:
            connection.close() 
            returnDic = {"inforCode":0}
            return returnDic;
     
    ''' 
    查询接口信息
    -----------------------------
     2016.4.1 xiaoqy
     html:    1.0.0 
     ios:     1.0.0
     android  1.0.0
     interFaceName 接口名
    －－－－－－－－－－－－－－－－－
    '''    
    def getInterFaceInfo(self, interFaceName):
        try:
            connection = SqlHabdleGlobal.connectionDb();
            with connection.cursor() as cursor:
                # Create a new record
                sql = 'SELECT * FROM ' + INTERFAVE_TABLE + ' where interFaceName=%s;'
                cursor.execute(sql, interFaceName)
                LogHandle.writeLog(0, '数据库操作：getInterFaceInfo:' + sql, 'anyone')
                list = []
                for row in cursor:
                    list.append(row)
                if len(list) <= 0: 
                    returnDic = {"inforCode":-10004}
                else:
                    returnDic = {"inforCode":0}   
                    returnDic['result'] = list
                
                LogHandle.writeLog(returnDic['inforCode'], '数据库操作：getInterFaceInfo:', 'anyone')
                return returnDic;
                    
        except BaseException, e:

            returnDic = {"inforCode":-10000}
            LogHandle.writeLog(str(e.args[0]),
                               '数据库操作异常：getInterFaceInfo:' + str(e.args[1]),
                               'anyone')
            return returnDic
        else:
            connection.close() 
            returnDic = {"inforCode":0}
            return returnDic;   
    '''
    添加接口输入输出参数
    -----------------------------
     2016.4.12 xiaoqy
     html:    1.0.0 
     ios:     1.0.0
     android  1.0.0
     parameterDic 参数dic
    －－－－－－－－－－－－－－－－－
    ''' 
    def addParametervalue(self, parameterDic):
        try:
            connection = SqlHabdleGlobal.connectionDb();
            with connection.cursor() as cursor:
                # Create a new record
                sql = 'call p_ReplaceInterFaceParameter(%s,%s,%s,%s,%s,%s,%s,%s,%s)'; 
                LogHandle.writeLog(0, '数据库操作：addParametervalue:' + sql.encode('utf-8'), "anyone")
                cursor.execute(sql,
                               (parameterDic['parameterName'],
                               parameterDic['parameterFatherName'],
                               parameterDic['parameterDescribe'],
                               parameterDic['parameterCanNil'],
                               parameterDic['parameterEndTime'],
                               parameterDic['parameterBeginVersions'],
                               parameterDic['parameterEndVersions'],
                               parameterDic['parameterType'],
                               parameterDic['parameterTypeuse']));
                connection.commit()
        except BaseException, e:
            LogHandle.writeLog(str(e.args[0]), '数据库操作：addParametervalue:' + str(e), "anyone")
            returnDic = {"inforCode":-10000}
            return returnDic
        else:
            connection.close() 
            returnDic = {"inforCode":0}
            return returnDic;
        
    '''
    获取会员列表
    '''
    def getMemberList(self, data):
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new record
            sql = 'call p_getUserList()'; 
            LogHandle.writeLog(0, '数据库操作：p_getUserList:' + sql.encode('utf-8'), "anyone")
            cursor.execute(sql);
            connection.commit()
            list = []
            for row in cursor:
                list.append(row)
            if len(list) <= 0: 
                returnDic = {"inforCode":-10004} 
            else:
                returnDic = {"inforCode":0}   
                returnDic['result'] = list
            return returnDic
    
    '''
    获取3d彩票数据
    '''
    def getFC3dData(self, data):
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new record
            beginNum = int(data["pageNum"]) * int(data["pageSize"])
            sql = 'select* from FC3DData_t   order by outNO desc limit ' + str(beginNum) + ',' + data["pageSize"] + ''; 
            LogHandle.writeLog(0, '数据库操作：获取3d彩票数据' + sql.encode('utf-8'), "anyone")
            cursor.execute(sql);
            connection.commit()
            list = []
            for row in cursor:
                row["outdate"] = str(row["outdate"])
                list.append(row)
            if len(list) <= 0: 
                returnDic = {"inforCode":-10004} 
            else:
                returnDic = {"inforCode":0}   
                returnDic['result'] = list
            connection.close() 
            return returnDic
        
    '''
    查询最后一期出球号码
    '''   
    def getLastFCData(self):
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new record
            sql = 'select* from FC3DData_t order by outNO desc limit 0,1'; 
            LogHandle.writeLog(0, '数据库操作：获取3d彩票数据' + sql.encode('utf-8'), "anyone")
            cursor.execute(sql);
            connection.commit()
            list = []
            for row in cursor:
#                 row["outdate"] = str(row["outdate"])
                list.append(row)
            if len(list) <= 0: 
                returnDic = {"inforCode":-10004} 
            else:
                returnDic = {"inforCode":0}   
                returnDic['result'] = list
            connection.close() 
            return returnDic
        
    '''
    加载福彩3d数据到数据库中
    '''       
    def loadFC3DDataByText(self, path):
        
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new record
            sql = 'LOAD DATA LOCAL INFILE "' + path + '" INTO TABLE FC3DData_t FIELDS TERMINATED BY " " LINES TERMINATED BY "\\n"';
            LogHandle.writeLog(0, sql.encode('utf-8'), "anyone")
            cursor.execute(sql);
            connection.commit()
            connection.close() 
    '''
    获取遗漏表数据
    '''        
    def getOmitData(self, data):
        
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new record
            beginNum = int(data["pageNum"]) * int(data["pageSize"])
            sql = 'SELECT * FROM FC3DOmitData_table order by outNO desc limit ' + str(beginNum) + ',' + data["pageSize"] + ''; 
            LogHandle.writeLog(0, '数据库操作：获取3d彩票数据' + sql.encode('utf-8'), "anyone")
            cursor.execute(sql);
            connection.commit()
            list = []
            for row in cursor:
                row["outdate"] = str(row["outdate"])
                list.append(row)
            if len(list) <= 0: 
                returnDic = {"inforCode":-10004} 
            else:
                returnDic = {"inforCode":0}   
                returnDic['result'] = list
            connection.close() 
            return returnDic
        
    def getFactionList(self, data, userName):
        
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new record
            fatherID = data["fatherId"]
            sql = 'SELECT * FROM FunctionData_t where fatherID=' + str(fatherID) 
            LogHandle.writeLog(0, '数据库操作：获取3d彩票数据' + sql.encode('utf-8'), userName)
            cursor.execute(sql);
            connection.commit()
            list = []
            for row in cursor:
                list.append(row)
            connection.close() 
            return list
        
            
        
