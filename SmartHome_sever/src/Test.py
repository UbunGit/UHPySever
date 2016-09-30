#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年8月29日

@author: xiaoqy
'''

import unittest
from Interface.FCAnalyse import FCAnalyse
from FC3DAnalyse.FC3DProbability import FC3DProbability

class MyTest(unittest.TestCase):
 
    @classmethod
    def testInterFace(self,data):
        fcAnalyse =  FCAnalyse()
        dic = fcAnalyse.do_getOmitData(data)
        print dic;
        pass
    @classmethod
    def testFC3DProbability(self):
        fc = FC3DProbability()
        fc.loadProbabilityData(5)
    
    @classmethod
    def getList(self,probability,maxcount):

        fc = FC3DProbability()
        istrueCount = 0.0
        allcount = 0.0
        allmony = 0.0
        getMony = 0.0;
        for i in range(2016233, 2016234):
            data =fc.getRecommendMax('2002001', '2016200',probability,str(i),maxcount)
    
            if(data["geIsTrue"] == data["shiIsTrue"] == data["geIsTrue"] == "True"):
                istrueCount = istrueCount+1 
                getMony = getMony+1000;
                print str(i)+" ==> PASS:" +str(2*len(data["outBaiList"])*len(data["outShiList"])*len(data["outGeList"]))
            else:
                print str(i) + " ==> Flase:"+str(2*len(data["outBaiList"])*len(data["outShiList"])*len(data["outGeList"]))
        allmony =allmony+ 2*len(data["outBaiList"])*len(data["outShiList"])*len(data["outGeList"])
        allcount = allcount+1;
        print "赢："+ str(getMony- allmony)
        print istrueCount/allcount;


