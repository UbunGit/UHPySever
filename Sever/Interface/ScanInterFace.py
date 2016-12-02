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
    添加接口
    '''
    def do_addInterFace(self,data):
        pymysqlHandle = PymysqlHandle() 
        return pymysqlHandle.addInterFace(data["interFaceName"],data["interFaceNameStr"],data["interFacepath"])
    '''
    修改接口信息
    '''
    def do_replaceInteface(self, data):
       
        pymysqlHandle = PymysqlHandle() 
        return pymysqlHandle.replaceIntefaceInfo(data)
    '''
    获取接口列表
    '''
    def do_getInterFaceList(self, data):
        
        LogHandle.log(0, 'Begin：getInterFaceList', self.userName, 0, 'getInterFaceList')  
        pymysqlHandle = PymysqlHandle() 
        returnData = pymysqlHandle.getInterfaceList()
        return returnData
    
    '''
    获取信息
    '''
    def do_getInterFaceInfo(self, data):
       
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
        pymysqlHandle = PymysqlHandle() 
        returnData = pymysqlHandle.getInterfaceParameterList(interFaceName, parameterTypeuse)
        return returnData 

    '''
    获取接口出参数列表
    '''
    def do_getOutputValueList(self, data): 
        interFaceName = data['interFaceName'].encode("utf-8")
        parameterTypeuse = "1002"
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
                    "parameterEndTime":"--",
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
    根据参数id删除参数
    '''
    def do_deleteParameter(self,data):
        pymysqlHandle = PymysqlHandle() 
        return pymysqlHandle.deleteParameter(data)
    
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
    

        
