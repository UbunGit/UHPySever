#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年3月10日

@author: xiaoqy
'''

import sys ,os
sys.path.append(os.path.dirname(os.path.dirname(__file__)))
from PymysqlHandle.PymysqlHandle import PymysqlHandle
from TOOL import LogHandle
from TOOL import mod_config
from TOOL.CustomError import CustomError
import sys
import os

class UPAndDown(object):
    userName = "verstor";
    '''
    接口文档相关的查询
    '''
    def upAndDownMethodo(self, data,metho, userID):

        mname = 'do_' + metho
        if not hasattr(self, mname):
            returnDic = {"infoCode":-20001}
            print "interFaceMetho=" + mname;
            return returnDic
        method = getattr(self, mname)
        return method(data,userID)

    ''' 
      生成对应下载文件并返回路径
    '''
    def do_getfileUrl(self,data,userID):

        url = "http://" + mod_config.getConfig("INTERFACE", "IP")+":"+mod_config.getConfig("INTERFACE", "PORT")
        '''
         downType:
         10001 :接口列表文件下载
        '''
        if(data["downType"] == 10001):

            savefile =  sys.path[0] + "/Data/InterFace.cvs"
            url = url + "/Data/InterFace.cvs"
            if  os.path.exists(savefile):
                os.remove(savefile)
            sqlhandle = PymysqlHandle()
            sqlhandle.createInterFacetxt(savefile)

            returnDic = {"infoCode":0}
            returnDic['result'] = {"url":url}
            return returnDic;


        else:
            returnDic = {"infoCode":-1}

    '''
    保存上传的文件
    '''
    def do_saveUpFile(self,data,userID):

        url = "http://" + mod_config.getConfig("INTERFACE", "IP")+":"+mod_config.getConfig("INTERFACE", "PORT")
        uptype = data["upType"]
        updata = data["file"][0]
        #上传接口数据
        if uptype == "1001":

            savefile =  sys.path[0] + "/Data/InterFace.txt"
            if  os.path.exists(savefile):
                os.remove(savefile)
            f = open(savefile, 'w')
            f.write(updata)
            f.close()

            sqlhandle = PymysqlHandle()
            sqlhandle.insterInterfaceData(savefile)
            returnDic = {"infoCode":0}
            returnDic['result'] = "scresss"
        #上传用户头像
        elif (uptype == "1002"):
            saveStr = "/Data/image/"+str(userID)+"head.png"
            savefile =  sys.path[0] + saveStr
            if  os.path.exists(savefile):
                os.remove(savefile)
            f = open(savefile, 'w')
            f.write(updata)
            f.close()

            url = url + saveStr
            headImage = {"headImage":url}
            sqlhandle = PymysqlHandle()
            sqlhandle.replaceUserInfo(headImage,userID)
            return headImage

        else:

            raise CustomError(-20006)

        return returnDic;




