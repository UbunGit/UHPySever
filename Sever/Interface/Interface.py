#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年3月8日

@author: xiaoqy
'''
from PymysqlHandle.PymysqlHandle import PymysqlHandle
from TOOL import LogHandle


class InterfaceHandle(object):
    
    userName = "verstor";
    
    def interfaceMethodo(self, data, user):
            self.userName = user;
            interFaceMetho = data['inefaceMode']
            mname = 'do_' + interFaceMetho
            if not hasattr(self, mname):
                returnDic = {"inforCode":-20001}
                return returnDic
            method = getattr(self, mname)
            return method(data)
   
    '''
    查询会员是否登录
    '''  
    def getLogState(self, data):
        
        if("userName" not in data.keys()):
            userName = None
        else:
            userName = data['userName']   
        if("tel" not in data.keys()):
            tel = None
        else:
            tel = data['tel'] 

        pymysqlHandle = PymysqlHandle() 
        return pymysqlHandle.selectUserInfo(userName, tel);
        
        
    '''
    1.1登录
    '''
    def do_log(self, data):
        
        passWord = data['passWord']
        returnData = self.getLogState(data)
        if returnData:
            
            if returnData['userPassWord'] == passWord:
                data['userLogState'] = 1002
                pymysqlHandle = PymysqlHandle() 
                pymysqlHandle.replaceUserInfo(data)
                returnDic = {"inforCode":0}
                returnDic['result'] = returnData
            else:
                returnDic = {"inforCode":-10002}
        else:
            returnDic = {"inforCode":-10001}
        return returnDic

    '''
    1.2注册
    '''
    def do_register(self, data):
        userName = data['userName']
        telNO = data['telNO']
        passWord = data['passWord']
        pymysqlHandle = PymysqlHandle()           
        returnData = pymysqlHandle.insetUserInfo(userName, telNO, passWord)
        return returnData
    
    '''
    1.3 获取错误码列表
    '''
    def do_getLogList(self, data):  
     
        dataList =LogHandle.getLogList(data)
        if len(dataList)>0:
            returnDic = {"inforCode":0}
            returnDic['result'] = dataList
        else:
            returnDic = {"inforCode":-10004}
        return returnDic
    '''
    1.4 删除错误码
    '''
    def do_deleteLog(self,data):
        LogHandle.deleteLog()
        returnDic = {"inforCode":0}
        returnDic['result'] = "删除成功";
        return returnDic
        
        

        
       
        
    
