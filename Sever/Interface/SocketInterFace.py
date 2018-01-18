#!/usr/bin/env python
# coding=utf-8
'''
Created on 2017年2月10日

@author: UbunGit
'''
import FCTimer

from FC3DAnalyse.FC3DProbability import FC3DProbability
from PymysqlHandle.PymysqlHandle import PymysqlHandle
from PyString import PythonString

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
    4.1 更新3D数据
    '''
    def do_upLoadData(self, data):
        FCTimer.reloadData(self.connection)
        reply = '更新数据成功\n'
        length = len(reply)
        self.connection.send('%c%c%s' % (0x81, length, reply))


    def do_getFrequencyData(self,data):

        fc = FC3DProbability()
        fatherType = fc.getFC3DDataBalanceFatherType();
        dices = {}
        for key, value in enumerate(fatherType):
            data5 = fc.getFrequencyData(data["outdate"],str(value["fatherType"]))
            dices[str(value["fatherType"])]=data5;
        if len(data) <= 0 or len(dices) == 0:
            returnDic = {"inforCode":1004}
            returnDic['result'] = "概率表为空"
        else:
            returnDic = {"inforCode":0}
            returnDic['result'] ={}
            returnDic['result']['blanceData'] = dices
            returnDic['result']['endData'] = fc.deleteOutNum(dices)
        return returnDic

    '''
    4.1 更新3D数据
    '''
    def do_test(self, data):
        for i in range(2017070,2017094):
            data = {}
            data["outNO"] = str(i)
            data["outdate"] = str(i)

            pymysqlHandle = PymysqlHandle()
            outresult = pymysqlHandle.getFCDatabyOutData(data)
            outdata = outresult['result']
            outStr = str(outdata['out_bai'])+str(outdata['out_shi'])+str(outdata['out_ge'])
            result = self.do_getFrequencyData(data)
            reply = ""
            if result["inforCode"] == 0:
                enddata = result['result']['endData'];
                endData  = {}
                endData["outdate"] = str(outdata['outdate'])
                endData["outNum"] = outStr
                endData["Balance"] = enddata[outStr]
                reply = PythonString.jsonUnPase(endData)
                length = len(reply)
                self.connection.send('%c%c%s' % (0x81, length, reply))
            else:
                reply  = result['result']+'\n'
                length = len(reply)
                self.connection.send('%c%c%s' % (0x81, length, reply))
                break;





