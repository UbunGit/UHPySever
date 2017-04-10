#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年8月18日

@author: xiaoqy
'''

from FC3DAnalyse.FC3DProbability import FC3DProbability
from PymysqlHandle.PymysqlHandle import PymysqlHandle

class FCAnalyse(object):
    '''
    classdocs
    '''
    userName = "verstor";
    '''
    接口文档相关的查询
    '''
    def FCAnalyseMethodo(self, data, user):
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
    3.1获取3D数据
    '''
    def do_getFC3DData(self, data):
      
        pymysqlHandle = PymysqlHandle()
        return pymysqlHandle.getFC3dData(data)
    
    '''
    3.2获取最后一期福彩3D数据
    '''
    def do_getLastFCData(self, data): 
       
        pymysqlHandle = PymysqlHandle()
        return pymysqlHandle.getLastFCData()
    
    '''
    3.3根据出球号或时间获取福彩3D数据
    '''
    def do_getFCDatabyOutData(self, data): 
       
        pymysqlHandle = PymysqlHandle()
        return pymysqlHandle.getFCDatabyOutData(data)
    '''
    3.4获取频率表归纳数据
    '''  
    def do_recommendData(self, data): 
      
        fc = FC3DProbability()
        data = fc.getRecommendData(data["BeginOutNO"], data["EndOutNO"], data["Probability"], data["outtype"]) 
        if len(data) <= 0:
            returnDic = {"inforCode":1004}   
            returnDic['result'] = data
        else:
            returnDic = {"inforCode":0}   
            returnDic['result'] = data
        return returnDic
    '''
    3.5获取推荐的号码
    '''
    def do_getRecommendCode(self, data):

        fc = FC3DProbability()
        data = fc.getRecommend(data["BeginOutNO"], data["EndOutNO"], data["Probability"], data["RecommendOutON"]) 
        if len(data) <= 0:
            returnDic = {"inforCode":1004}   
            returnDic['result'] = data
        else:
            returnDic = {"inforCode":0}   
            returnDic['result'] = data
        return returnDic
    '''
    3.6获取遗漏数据
    '''  
    def do_getOmitData(self, data): 
       
        pymysqlHandle = PymysqlHandle()
        returnDic = pymysqlHandle.getOmitData(data)
        return returnDic
    
    '''
    3.7 获取对应出球时间的频率
    outdate 出球时间
    outType 出球位 1001个位 1002十位 1003 百位
    '''
    def do_getFrequencyData(self,data):
        
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
            dataAll = {};
            for key, value in enumerate(dices):
                daraResult = dices[value];
                for datakey, datavalue in enumerate(daraResult.keys()):
                    if(type(daraResult[datavalue]) != float):
                        dataAll[datavalue] = datakey;
                    else:
                        if(not dataAll.has_key(datavalue)):
                            dataAll[datavalue] =  0.0; 
                        proValue = dataAll[datavalue]+daraResult[datavalue];
                        dataAll[datavalue] = proValue;
                        
            if len(dataAll)>0 :
                dices["all"] = dataAll;
            returnDic['result'] = dices
        return returnDic
    '''
    3.8 根据频率值获取对应比重数据
    fatherType 频率值
    '''
    def do_getFC3DDataBalance(self,data):
        
        fc = FC3DProbability()
        dices =fc.getFC3DDataBalance();
        returnDic = {"inforCode":0} 
        returnDic['result'] = dices
        return returnDic;
    
    '''
    3.9 设置频率比重
    fatherType 频率值
    fatherCount 频率
    balance 比重
    '''
    def do_replaceFC3DDataBalance(self,data):
        
        fc = FC3DProbability()
        if(fc.replaceFC3DDataBalance(data)==1):
            returnDic = {"inforCode":0} 
        else:
            returnDic = {"inforCode":-10000} 
        return returnDic;
