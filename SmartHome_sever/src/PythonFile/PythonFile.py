#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年1月27日

@author: xiaoqy
'''
import os
import urllib
import md5
import re
'''
下载url下文件
'''
def saveUrlFile(url,filePath):
    if re.match(r'^https?:/{2}\w.+$', url):  
        m1 = md5.new()   
        m1.update(url) 
        fileName = m1.hexdigest()
        fileExtension = os.path.splitext(url)[1]
        filePath = filePath + fileExtension.split(".")[1] 
   
        if os.path.exists(filePath) is False:  
            os.mkdir(filePath)
            
        filePath = filePath +'/'+ fileName + fileExtension
        urllib.urlretrieve(url,filePath)  
    else:  
        print '下载出错：'+url
    