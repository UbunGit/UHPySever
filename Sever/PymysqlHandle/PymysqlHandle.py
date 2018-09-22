#!/usr/bin/env python
# encoding: utf-8 a = '中文'
'''
Created on 2016年3月11日

@author: xiaoqy
'''

import sys ,os
sys.path.append(os.path.dirname(os.path.dirname(__file__)))
from TOOL.CustomError import CustomError

from pymysql.err import MySQLError
from SqlHandelGlobal import SqlHabdleGlobal




SMARTHOMEUSER_TABLE = 'USER_T'  # 智能家居用户信息表
INTERFAVE_TABLE = 'SmartHomeInterFace_Table'  # 接口数据表
INTERFAVEPARAMETER_TABLE = 'SmartHomeParameter_Table'



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
                sql = 'INSERT INTO USER_T (userName, passWord, phone) VALUES (%s, %s,%s)'
                cursor.execute(sql, (userName, userPassWord, userTel))
                connection.commit()

        except MySQLError as e:
            if e.args[0] == 1062:
                raise CustomError(-10003);
            else:
                raise e;

    def insetUser(self, data):
        try:
            connection = SqlHabdleGlobal.connectionDb();
            with connection.cursor() as cursor:
                # Create a new record
                keystr = ''
                valuestr=''
                for item in data.keys():
                    keystr = keystr+item+','
                    valuestr = valuestr+'"'+data[item]+'",'
                keystr = keystr[0:-1]
                valuestr = valuestr[0:-1]
                sql = 'INSERT INTO USER_T ('+keystr+') VALUES ('+valuestr+')'
                cursor.execute(sql)
                connection.commit()

        except MySQLError as e:
            if e.args[0] == 1062:
                raise CustomError(-10003);
            else:
                raise e;



    '''
    查询用户信息（1.0.1）
    -----------------------------
     2016.5.13 xiaoqy
     html:    1.0.0 
     ios:     1.0.0
     android  1.0.0\[
    －－－－－－－－－－/ －－－－－－－
    '''
    def selectUserInfo(self, userID):

        return self.selectUserInfoBykey("userID",userID)

    def selectUserInfoWithUserName(self, userName):

        return self.selectUserInfoBykey("userName",userName)

    '''
    根据用户唯一键查询用户信息
    '''
    def selectUserInfoBykey(self,key,value):

        if key not in ['userID','userName','phone','wxOpenid','email']:
            raise CustomError(-10007);

        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:

            sql = 'select userID,passWord,userName,email,createTime,status,permissions,phone,headImage,wxOpenid from USER_T where '+key+' = %s';
            cursor.execute(sql, (value))
            for row in cursor:
                cursorData = row;
                return cursorData





    '''
    修改会员信息
    '''
    def replaceUserInfo(self, data,userID):

        userData = self.selectUserInfo(data["userID"]);
        if userData == None:raise CustomError(-10001);

        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new recors
            sql = 'UPDATE USER_T SET '

            for key in data.keys():
                if key == "userID":continue

                if type(data[key]) == int or type(data[key]) == float:
                    sql = sql+key+'='+str(data[key])+','
                else:
                    sql = sql+key+'="'+data[key]+'",'

            sql = sql[0:-1]
            sql = sql+' WHERE userID='+str(data["userID"])
            cursor.execute(sql);
            connection.commit()
            connection.close()



    '''
    获取会员列表
    '''
    def getAdminList(self, data,userID):
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new record
            sql = 'SELECT* FROM USER_T';
            cursor.execute(sql);
            connection.commit()
            adminlist = []
            for row in cursor:
                adminlist.append(row)
            return adminlist;

    '''删除用户'''
    def removeAdmin(self,data,userID):

        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new record
            sql = 'DELETE  FROM USER_T WHERE userID=%s';
            cursor.execute(sql,(data["userID"]));
            connection.commit()
            adminlist = []
            for row in cursor:
                adminlist.append(row)
            return adminlist;

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

        except BaseException:

            returnDic = {"infoCode":-10000}
            return returnDic
        else:
            connection.close()
            returnDic = {"infoCode":0}
            return returnDic;

    '''
    '''
    def deleteInterFace(self,data):

        try:
            interfaceName = data['inteFaceName']
            connection = SqlHabdleGlobal.connectionDb()
            with connection.cursor() as cursor:
                sql ='delete from SmartHomeInterFace_Table where interFaceName=(%s);'
                cursor.execute(sql,(interfaceName))
                connection.commit()

        except BaseException:

            returnDic = {"infoCode":-10000}
            return returnDic
        else:
            connection.close()
            returnDic = {"infoCode":0}
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
                keystr = str(key)
                if(keystr != str("repInteFaceName") and keystr != str("inefaceMode")):
                    setstr = setstr+key+'="' +data[key]+'",'
            setstr = setstr[:-1]
            connection = SqlHabdleGlobal.connectionDb();
            with connection.cursor() as cursor:
                sql ='UPDATE   SmartHomeInterFace_Table  '+setstr+' WHERE interFaceName = "'+interfaceName+'"'
                cursor.execute(sql)
                connection.commit()
        except BaseException:

            returnDic = {"infoCode":-10000}
            return returnDic
        else:
            connection.close()
            returnDic = {"infoCode":0}
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
    def getInterfaceList(self,data):

        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new record
            sql = 'SELECT * FROM ' + INTERFAVE_TABLE
            if("searchKey"  in data.keys()):
                sql = sql + ' where interFaceName  LIKE "%' + data['searchKey'] + '%" or interFaceNameStr  LIKE "%' + data['searchKey'] + '%"'
            sql = sql + ' ;'
            cursor.execute(sql)
            list = []
            for row in cursor:
                list.append(row)
            if len(list) <= 0:
                returnDic = {"infoCode":-10004}
            else:
                returnDic = {"infoCode":0}
                returnDic['result'] = list
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

        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new record
            sql = 'SELECT * FROM ' + INTERFAVEPARAMETER_TABLE + ' where parameterFatherName=(select interFaceName from ' + INTERFAVE_TABLE + ' where  interFaceName=%s and parameterTypeuse=%s);'
            cursor.execute(sql, (interFaceName, parameterTypeuse))

            list = []
            for row in cursor:
                list.append(row)
            if len(list) <= 0:
                returnDic = {"infoCode":-10004}
            else:
                returnDic = {"infoCode":0}
                returnDic['result'] = list

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

        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new record
            sql = 'SELECT * FROM ' + INTERFAVE_TABLE + ' where interFaceName=%s;'
            cursor.execute(sql, interFaceName)
            list = []
            for row in cursor:
                list.append(row)
            if len(list) <= 0:
                returnDic = {"infoCode":-10004}
            else:
                returnDic = {"infoCode":0}
                returnDic['result'] = list
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
        except BaseException as e:
            returnDic = {"infoCode":-10000}
            return returnDic
        else:
            connection.close()
            returnDic = {"infoCode":0}
            return returnDic;

    '''
    根据参数id删除参数
    '''
    def deleteParameter(self,data):
        try:
            connection = SqlHabdleGlobal.connectionDb();
            with connection.cursor() as cursor:
                # Create a new record
                sql = 'DELETE FROM SmartHomeParameter_Table WHERE parameterId=%s;';
                cursor.execute(sql,(data['parameterId']));
                connection.commit()
        except BaseException as e:
            returnDic = {"infoCode":-10000}
            return returnDic
        else:
            connection.close()
            returnDic = {"infoCode":0}
            return returnDic;


    '''
    获取3d彩票数据
    '''
    def getFC3dData(self, data):
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new record
            beginNum = int(data["pageNum"]) * int(data["pageSize"])
            sql = 'select* from FC3DData_t   order by outNO desc limit ' + str(beginNum) + ',' + data["pageSize"] + '';
            cursor.execute(sql);
            connection.commit()
            list = []
            for row in cursor:
                row["outdate"] = str(row["outdate"])
                list.append(row)
            if len(list) <= 0:
                returnDic = {"infoCode":-10004}
            else:
                returnDic = {"infoCode":0}
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
            cursor.execute(sql);
            connection.commit()
            list = []
            for row in cursor:
#                 row["outdate"] = str(row["outdate"])
                list.append(row)
            if len(list) <= 0:
                returnDic = {"infoCode":-10004}
            else:
                returnDic = {"infoCode":0}
                returnDic['result'] = list
            connection.close()
            return returnDic

    def getFCDatabyOutData (self,data):

        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            outdata = None
            if("outNO"  in data.keys()):
                outdata =data["outNO"];
            elif ("outdate"  in data.keys()):
                outdata =data["outdate"];
            else:
                return None
            sql = 'SELECT * FROM FC3DData_t where outNO = "'+outdata +'" or outdate= "'+outdata+'"'
            cursor.execute(sql);
            tablerows = cursor.fetchall()
            if(len(tablerows) == 1):
                result = tablerows[0];
                result["outdate"] = str(result["outdate"])
                returnDic = {"infoCode":0}
                returnDic['result'] = result
            else:
                returnDic = {"infoCode":-10004}
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
            beginNum = (int(data["pageNum"])-1) * int(data["pageSize"])
            sql = 'SELECT * FROM FC3DOmitData_table order by outNO desc limit ' + str(beginNum) + ',' + data["pageSize"] + '';
            cursor.execute(sql);
            connection.commit()
            list = []
            for row in cursor:
                row["outdate"] = str(row["outdate"])
                list.append(row)
            if len(list) <= 0:
                returnDic = {"infoCode":-10004}
            else:
                returnDic = {"infoCode":0}
                returnDic['result'] = list
            connection.close()
            return returnDic

    def getFactionList(self, data, userName):

        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new record
            fatherID = data["fatherId"]
            sql = 'SELECT * FROM FunctionData_t where fatherID=' + str(fatherID)
            print(sql)
            cursor.execute(sql);
            connection.commit()
            list = []
            for row in cursor:
                list.append(row)
            connection.close()
            return list

    '''
    生成接口列表txt
    '''
    def createInterFacetxt(self,savepath):

        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:

            sql = 'select interFaceName,interFaceNameStr,' \
                  'interFaceDescribe,interFacepath,' \
                  'interFaceBeginTime,interFaceEndTime,' \
                  'interFaceBeginVersions,interFaceEndVersions from SmartHomeInterFace_Table into  outfile "'+ savepath +'"';
            cursor.execute(sql);
            connection.commit()
            connection.close()
            return

    '''
    导入接口txt文件到数据库
    '''
    def insterInterfaceData(self,savePath):
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:

            sql = 'DROP TABLE IF  EXISTS tmp_x;' \
                  'CREATE TEMPORARY TABLE tmp_x (interFaceName varchar(255),' \
                  ' interFaceNameStr varchar(255) ,' \
                  ' interFaceDescribe text,' \
                  ' interFacepath text,' \
                  ' interFaceBeginTime text,' \
                  ' interFaceEndTime text,' \
                  ' interFaceBeginVersions text,' \
                  ' interFaceEndVersions text);' \
                  'LOAD DATA LOCAL INFILE ' \
                  '"/Users/ubungit/Git/UHPySever/Sever/Data/InterFace.txt" ' \
                  'INTO TABLE tmp_x FIELDS TERMINATED BY "\t" LINES TERMINATED BY "\n"; ' \
                  'REPLACE  SmartHomeInterFace_Table (interFaceName,interFaceNameStr,interFaceDescribe,interFacepath,' \
                  'interFaceBeginTime,interFaceEndTime,interFaceBeginVersions,interFaceEndVersions)' \
                  'SELECT interFaceName,interFaceNameStr,interFaceDescribe,interFacepath,' \
                  'interFaceBeginTime,interFaceEndTime,interFaceBeginVersions,interFaceEndVersions FROM tmp_x;' \
                  'DROP TABLE IF  EXISTS tmp_x';
            cursor.execute(sql);
            connection.commit()
            connection.close()
            return



    '''插入用户section数据'''
    def insterSection(self,data):

        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            keystr = ''
            valuestr=''
            for item in data.keys():
                keystr = keystr+item+','
                if type(data[item]) == int or type(data[item]) == float:
                    valuestr = valuestr+str(data[item])+','
                else:
                    valuestr = valuestr+'"'+data[item]+'",'
            keystr = keystr[0:-1]
            valuestr = valuestr[0:-1]
            sql = 'INSERT SEDDION_T ('+keystr+') VALUES ('+valuestr+');'
            cursor.execute(sql)
            connection.commit()
            connection.close()

    '''查询用户section数据'''
    def getSection(self,userID):
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            sql = "SELECT * FROM SEDDION_T WHERE userID=%s;"
            cursor.execute(sql,(userID));
            connection.commit()
            connection.close()

    '''删除用户section数据'''
    def deleteSection(self,userID):
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            sql = "delete from SEDDION_T where userID=(%s)"
            cursor.execute(sql,(userID));
            connection.commit()
            connection.close()






