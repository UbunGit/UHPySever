#!/usr/bin/env python
# coding=utf-8
'''
Created on 2017年2月10日

@author: UbunGit
'''
import FCTimer
class SocketInterFace(object):
    
    def __init__(self, connection):
        super(SocketInterFace, self).__init__()
        self.connection = connection
    '''
    接口文档相关的查询
    '''
    def socketInterFace(self, data):
       
        interFaceMetho = data['inefaceMode']
        mname = 'do_' + interFaceMetho
        if not hasattr(self, mname):
            returnDic = {"inforCode":-20001}
            print "interFaceMetho=" + mname;
            return returnDic
        method = getattr(self, mname)
        return method(data)
    '''
    2.1 更新3D数据
    '''
    def do_upLoadData(self, data):
        FCTimer.reloadData()
        reply = "更新数据成功"
        length = len(reply)
        self.connection.send('%c%c%s' % (0x81, length, reply))