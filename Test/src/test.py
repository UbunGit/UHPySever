#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2017年4月8日

@author: UbunGit
'''

import json
import urllib2
from __builtin__ import int

def testgetFrequencyData(urlpath,params):
    
    req = urllib2.Request(urlpath,json.dumps(params))
    req.add_header('Content-Type', 'application/json')
    
    response = urllib2.urlopen(req)
    return response.read()

flaseNum = 0
trueNum = 0
allOutmoney = 0
allInmoney = 0
for i in range(2016001,2016101):
    
    getFrequencyparams = {'inefaceMode': 'getFrequencyData', 'outType': i,'outdate': i}
    getFrequencyData = testgetFrequencyData('http://192.168.1.27:8889/FCAnalyse',getFrequencyparams)
    datadic = json.loads(getFrequencyData)
    if (datadic['inforCode']) !=0:
        print datadic['result']
        break;

    fcDataparams = {'inefaceMode': 'getFCDatabyOutData', 'outdate': str(i)}
    fcDataparamsData = testgetFrequencyData('http://192.168.1.27:8889/FCAnalyse',fcDataparams)
    fcDatadic = json.loads(fcDataparamsData)
    
    if (fcDatadic['inforCode']) !=0:
        print fcDatadic['result']
        break;
    outdata = str(fcDatadic['result']['out_ge']) +str(fcDatadic['result']['out_shi']) +str(fcDatadic['result']['out_bai']) 
    temarr = []
    allArr = []
    for data in datadic['result']['endData'].keys():
        testblance = float(datadic['result']['endData'][data])
        allArr.append(testblance)
    s =set(allArr) 
    allArr =[i for i in s] 
    allArr.sort() 
   
    temFloat = (allArr.index(float(datadic['result']['endData'][outdata])))/float(len(allArr))
    
    for data in datadic['result']['endData'].keys():
        outballblance = float(datadic['result']['endData'][data])
        floatdata = (allArr.index(outballblance))/float(len(allArr))
        if floatdata< 0.50 and floatdata> 0.00:
            temarr.append(int(data))
    print  str(fcDatadic['result']['outNO'])+"期出球："+str(outdata) +' 个数'+str(len(temarr)) +' 实际'+str(temFloat)  +"  all:"+str(len(allArr))
    
    allOutmoney =allOutmoney+len(temarr)*2 
    if int(outdata) in (temarr):
        trueNum=trueNum+1
        allInmoney =allInmoney+1000  
        print fcDatadic['result']['outdate'] + "=>PASS \t" 
    else:
        print fcDatadic['result']['outdate'] + "=>ERROR \t"
        flaseNum = flaseNum+1
        
print "此次预测总数:" + str(trueNum+flaseNum)
print "正确预测总数:" + str(trueNum)
print "错误预测总数:" + str(flaseNum)
print "正确率:%f", float(trueNum)/(trueNum+flaseNum)
print "总花费："+str(allOutmoney)
print "总收益："+str(allInmoney)
print "净收益："+str(allInmoney-allOutmoney)