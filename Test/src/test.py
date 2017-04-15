#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2017年4月8日

@author: UbunGit
'''

import json
import urllib2

def testgetFrequencyData(urlpath,params):
    
    req = urllib2.Request(urlpath,json.dumps(params))
    req.add_header('Content-Type', 'application/json')
    
    response = urllib2.urlopen(req)
    return response.read()


for i in range(2017001,2017010):
    
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
    if outdata in (datadic['result']['endData']):
        allcount = len(datadic['result']['endData'])
        print fcDatadic['result']['outdate'] + "=>PASS \t" + str(allcount)
    else:
        allcount = len(datadic['result']['endData'])
        print fcDatadic['result']['outdate'] + "=>ERROR \t"+ str(allcount)
    
   