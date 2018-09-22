#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年3月8日

@author: xiaoqy
'''


import sys ,os,bcrypt,random,string,time

sys.path.append(os.path.dirname(os.path.dirname(__file__)))

from PymysqlHandle.PymysqlHandle import PymysqlHandle

from TOOL import LogHandle
from TOOL.CustomError import CustomError



class InterfaceHandle(object):
    
    def interfaceMethodo(self, data,metho, userID):


            mname = 'do_' + metho
            if not hasattr(self, mname):
                raise CustomError(-20001)
            method = getattr(self, mname)
            return method(data,userID)

        
    '''
    1.1登录
    '''
    def do_login(self, data,userID):

        '''验证入参'''
        if("userName" not in data.keys()):
            raise CustomError(-20005,"userName");
        if("passWord" not in data.keys()):
            raise CustomError(-20005,"passWord");

        passWord = data['passWord'].encode('utf-8')
        userName = data['userName']

        '''获取会员信息'''
        pymysqlHandle = PymysqlHandle()
        result = pymysqlHandle.selectUserInfoWithUserName(userName);
        if result == None:
            raise CustomError(-10001)

        sqlpass = result["passWord"]

        '''验证会员密码'''
        if not bcrypt.checkpw(passWord, sqlpass.encode('utf-8')):
            raise CustomError(-10002)
        '''查询section'''

        section = pymysqlHandle.getSection(result["userID"])

        if section != None:
            nowtime = time.time()
            if nowtime - section["createtime"] > 24*3600:
                pymysqlHandle.deleteSection(result["userID"])
                section = None
            else:
                if data["UUID"] != section["UUID"] and "UUID" in data.keys():
                    raise CustomError(-10001)

        if section == None:
            '''创建section'''
            salt = ''.join(random.sample(string.ascii_letters + string.digits, 32))
            uuid="0000"
            if "UUID" in data.keys():
                uuid = data["UUID"]

            data = {
                'userID':result["userID"],
                'validityPeriod':24,
                'createtime':time.time(),
                'session':salt,
                'UUID':uuid
            }
            pymysqlHandle.insterSection(data)
        del result["passWord"]
        result["section"] = salt
        return result


    '''
    1.2注册
    '''
    def do_register(self, data, userID):

        if("userName" not in data.keys()):
            raise CustomError(-20005,"userName");
        if("passWord" not in data.keys()):
            raise CustomError(-20005,"passWord");
        if("phone" not in data.keys()):
            raise CustomError(-20005,"phone");

        userName = data['userName']
        telNO = data['phone']
        passWord = data['passWord']
        pymysqlHandle = PymysqlHandle()
        sqlpass = bcrypt.hashpw(passWord.encode('utf-8'), bcrypt.gensalt(8))
        pymysqlHandle.insetUserInfo(userName, telNO, sqlpass)
    '''
    获取会员信息
    '''
    def do_getAdminInfo(self,data,userID):
        if("userID" not in data.keys()):
            raise CustomError(-20005,"userID");
        userID = data['userID']
        pymysqlHandle = PymysqlHandle()
        result = pymysqlHandle.selectUserInfo(userID);
        if result == None:
            raise CustomError(-10001)
        return result;

    '''
    修改会员信息
    '''
    def do_replaceUserData(self,data,userID):

        sqlhandle = PymysqlHandle()

        sqlhandle.replaceUserInfo(data,userID)

    '''
    查询会员列表
    '''
    def do_getAdminList (self,data,userID):

        sqlhandle = PymysqlHandle()
        result = sqlhandle.getAdminList(data,userID)
        if result == None:
            raise CustomError(-10001)
        else:
            return result;

    '''
    删除会员
    '''
    def do_removeAdmin(self,data,userID):
        sqlhandle = PymysqlHandle()

        sqlhandle.removeAdmin(data,userID)

    
    '''
    1.3 获取错误码列表
        入参：
        levels 日志等级
        memberNO 会员账号
        business 业务名称
        beginTime 开始时间
        endTime 结束时间
        search 搜索关键词
        pageIndex 页数
        pageNum 每页大小
    '''
    def do_getLogList(self, data,userID):

        dataList =LogHandle.getLogList(data)
        if len(dataList)>0:
            returnDic = {"infoCode":0}
            returnDic['result'] = dataList
        else:
            returnDic = {"infoCode":-10004}
        return returnDic
    '''
    1.4 删除错误码
    '''
    def do_deleteLog(self,data,returnData):
        LogHandle.deleteLog()
        returnDic = {"infoCode":0}
        returnDic['result'] = "删除成功";
        return returnDic




if __name__ == '__main__':

    def login():

        try:
            data = {"userName":"admin",
                    "passWord":"123"};
            inteefaceHandle = InterfaceHandle();
            data = inteefaceHandle.do_login(data);
            print(data);

        except CustomError as e:
            print("login:" +e.__str__())

    def register():
        try:
            data = {"userName":"admin",
                    "passWord":"123456",
                    "phone":"13923497592"};
            inteefaceHandle = InterfaceHandle();
            inteefaceHandle.do_register(data,12);
            print("用户注册成功");

        except CustomError as e:
            print("register:" +e.__str__())
        except Exception as e:
            print(e)


    login();


        

        
       
        
    
