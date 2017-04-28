#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年8月29日

@author: xiaoqy
'''

from FC3DAnalyse.FC3DProbability import FC3DProbability
from PymysqlHandle.PymysqlHandle import PymysqlHandle
'''
3.7 获取对应出球时间的频率
outdate 出球时间
outType 出球位 1001个位 1002十位 1003 百位
'''
def do_getFrequencyData(data):
        
    fc = FC3DProbability()
    fatherType = fc.getFC3DDataBalanceFatherType();
    dices = {}
    for key, value in enumerate(fatherType):
        data5 = fc.getFrequencyData(data["outdate"],str(value["fatherType"])) 
        dices[str(value["fatherType"])]=data5;
    if len(data) <= 0:
        returnDic = {"inforCode":1004}   
        returnDic['result'] = data
    else:
        returnDic = {"inforCode":0} 
        returnDic['result'] ={}
        returnDic['result']['blanceData'] = dices
        returnDic['result']['endData'] = fc.deleteOutNum(dices)
    return returnDic

for i in range(2017070,2017094):
    data = {}
    data["outNO"] = str(i)
    data["outdate"] = str(i)
    
    pymysqlHandle = PymysqlHandle()
    outresult = pymysqlHandle.getFCDatabyOutData(data)
    outdata = outresult['result']
    outStr = str(outdata['out_ge'])+str(outdata['out_shi'])+str(outdata['out_bai'])
    result =do_getFrequencyData(data)
    enddata = result['result']['endData'];
    print str(outdata['outdate']) +"   "+str(outdata['outNO'])+ "    "+ enddata[outStr]
