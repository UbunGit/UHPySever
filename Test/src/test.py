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
preDataDic = {'0':0,'1':0,'2':0,'3':0,'4':0,'5':0,'6':0,'7':0,'8':0,'9':0}
for i in range(2016001,2016301):
    
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
    
    
    allkeyArr = datadic['result']['endData'].keys()

    if outdata in allkeyArr :
        print "pass "+str(len(allkeyArr))
        trueNum = trueNum+1
        allInmoney = allInmoney+1000
    else:
        print "error "+str(len(allkeyArr))
#         print preDataDic
        flaseNum = flaseNum+1
    allOutmoney =  allOutmoney+len(allkeyArr)*2  
    continue
    allvalueArr = datadic['result']['endData'].values()
    s =set(allvalueArr) 
    allvalueArr =[j for j in s] 
    allvalueArr.sort() 
    
    temarr = []
    minprevalue = max(preDataDic.values())
    sqrprevalue = sum(preDataDic.values())/len(preDataDic.values())
    if (outdata in datadic['result']['endData'].keys()):
        outballblance = float(datadic['result']['endData'][outdata])
    else:
        continue
    for data in allkeyArr:
        testblance = float(datadic['result']['endData'][data])
        floatdata =(allvalueArr.index(str(testblance)))/float(len(allvalueArr))
        keystr = int(floatdata*100/10)
        if  preDataDic[str(keystr)] > sqrprevalue :
            temarr.append(data)

    floatdata =(allvalueArr.index(str(outballblance)))/float(len(allvalueArr))
    keystr = str(int(floatdata*100/10))
    value = float(preDataDic[keystr])+1
    preDataDic[keystr] = value
    if i<  2016050 or len(temarr)>450: 
        continue
    
    if outdata in temarr :
        print "pass "+str(len(temarr))
        trueNum = trueNum+1
        allInmoney = allInmoney+1000
    else:
        print "error "+str(len(temarr))+" truevalue: "+str(value) +" maxValue "+ str(minprevalue)
#         print preDataDic
        flaseNum = flaseNum+1
    allOutmoney =  allOutmoney+len(temarr)*2   
print "此次预测总数:" + str(trueNum+flaseNum)
print "正确预测总数:" + str(trueNum)
print "错误预测总数:" + str(flaseNum)
print "正确率:%f", float(trueNum)/(trueNum+flaseNum)
print "总花费："+str(allOutmoney)
print "总收益："+str(allInmoney)
print "净收益："+str(allInmoney-allOutmoney)
    
