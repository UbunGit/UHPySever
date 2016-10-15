#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年3月10日

@author: xiaoqy
'''
from PymysqlHandle.PymysqlHandle import PymysqlHandle
from TOOL import LogHandle


class ScanInterFace(object):
    userName = "verstor";
    '''
    接口文档相关的查询
    '''
    def scanInterFaceMethodo(self, data, user):
        self.userName = user;
        interFaceMetho = data['inefaceMode']
        mname = 'do_' + interFaceMetho
        if not hasattr(self, mname):
            returnDic = {"inforCode":-20001}
            print "interFaceMetho=" + mname;
            return returnDic
        method = getattr(self, mname)
        return method(data)
    
    '''
    修改接口信息
    '''
    def do_replaceInteface(self, data):
        try:    
            data_Dic = {"interFaceName":data['interFaceName'],
                    "interFaceNameStr":data['interFaceNameStr'],
                    "interFaceBeginVersions":data['interFaceBeginVersions'],
                    "interFaceEndVersions":data['interFaceEndVersions'],
                    "interFaceBeginTime":data['interFaceBeginTime'],
                    "interFaceEndTime":data['interFaceEndTime'],
                    "interFacepath":data['interFacepath'],
                    "interFaceDescribe":data['interFaceDescribe']
                }
        except BaseException, e:
            LogHandle.writeLog(str(e.args[0]), str(e), self.userName)
            returnDic = {"inforCode":-20002}
            return returnDic
        else:

            pymysqlHandle = PymysqlHandle() 
            return pymysqlHandle.replaceIntefaceInfo(data_Dic)
    '''
    获取接口列表
    '''
    def do_getInterFaceList(self, data):
       
        LogHandle.writeLog(0, '查询接口列表：getInterFaceList：', self.userName)
        pymysqlHandle = PymysqlHandle() 
        returnData = pymysqlHandle.getInterfaceList()
        return returnData
    
    def do_getInterFaceInfo(self, data):
        LogHandle.writeLog(0, '查询接口列表：getInterFaceInfo：', self.userName)
        interFaceName = data['interFaceName']
        pymysqlHandle = PymysqlHandle() 
        returnData = pymysqlHandle.getInterFaceInfo(interFaceName)
        return returnData
    
    '''
    获取接口入参数列表
    '''
    def do_getInputValueList(self, data): 
        interFaceName = data['interFaceName'].encode("utf-8")
        parameterTypeuse = "1001"
        LogHandle.writeLog(0, '查询接口列表：getInputValueList：', self.userName)
        pymysqlHandle = PymysqlHandle() 
        returnData = pymysqlHandle.getInterfaceParameterList(interFaceName, parameterTypeuse)
        return returnData 

    '''
    获取接口出参数列表
    '''
    def do_getOutputValueList(self, data): 
        interFaceName = data['interFaceName'].encode("utf-8")
        parameterTypeuse = "1002"
        LogHandle.writeLog(0, '查询接口列表：getInputValueList：', self.userName)
        pymysqlHandle = PymysqlHandle() 
        returnData = pymysqlHandle.getInterfaceParameterList(interFaceName, parameterTypeuse)
        return returnData 
    '''
    添加接口参数列表
    '''
    def do_addParametervalue(self, data):
          
        data_Dic = {
                    "parameterName":data['parameterName'],
                    "parameterDescribe":data['parameterDescribe'],
                    "parameterEndTime":data['parameterEndTime'],
                    "parameterBeginVersions":data['parameterBeginVersions'],
                    "parameterEndVersions":data['parameterEndVersions'],
                    "parameterType":data['parameterType'],
                    "parameterFatherName":data['parameterFatherName'],
                    "parameterCanNil":data['parameterCanNil'],
                    "parameterTypeuse":data['parameterTypeuse']
                }

        pymysqlHandle = PymysqlHandle() 
        return pymysqlHandle.addParametervalue(data_Dic)

    '''
    获取会员列表
    '''
    def do_getMemberList(self, data): 
        data_Dic = {
                    "pageSize":data['pageSize'],
                    "pageNum":data['pageNum'],
                    }
        pymysqlHandle = PymysqlHandle() 
        return pymysqlHandle.getMemberList(data_Dic)  
    
        '''
    获取会员信息
    '''
    def do_getMemberInfo(self, data): 
       
        pymysqlHandle = PymysqlHandle() 
        cursorData = pymysqlHandle.selectUserInfo(data['memberNO'])  
        returnDic = {"inforCode":0}
        returnDic['result'] = cursorData 
        return returnDic;
    
    '''
    修改会员信息
    '''
    def do_replaceMemberInfo(self, data):
        data_Dic = {
                    "userName":data['userName'],
                    "userPassWord":data['userPassWord'],
                    "userTel":data['userTel'],
                    "userLevel":data['userLevel'],
                    "userLogState":data['userLogState']
                    }

        pymysqlHandle = PymysqlHandle() 
        return pymysqlHandle.replaceUserInfo(data_Dic)
    

        
