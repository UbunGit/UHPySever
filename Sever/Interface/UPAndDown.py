#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年3月10日

@author: xiaoqy
'''

from PymysqlHandle.PymysqlHandle import PymysqlHandle
from TOOL import LogHandle
from TOOL import mod_config
import sys
import os

class UPAndDown(object):
    userName = "verstor";
    '''
    接口文档相关的查询
    '''
    def upAndDownMethodo(self, data, user):

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
      生成对应下载文件并返回路径
    '''
    def do_getfileUrl(self,data):

        url = "http://" + mod_config.getConfig("INTERFACE", "IP")+":"+mod_config.getConfig("INTERFACE", "PORT")
        '''
         downType:
         10001 :接口列表文件下载
        '''
        if(data["downType"] == 10001):
            savefile =  sys.path[0] + "/Data/InterFace.cvs"
            if  os.path.exists(savefile):
                os.remove(savefile)
            sqlhandle = PymysqlHandle()
            if(sqlhandle.createInterFacetxt(savefile)):
                url = url + "/Data/InterFace.cvs"
                returnDic = {"inforCode":0}
                returnDic['result'] = {"url":url}
                return returnDic;
            else:
                returnDic = {"inforCode":-1}

        else:
            returnDic = {"inforCode":-1}


