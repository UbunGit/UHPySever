#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2017年8月3日

@author: UbunGit
'''

import os
import re  

'''
获取文件夹中的所有文件
'''
def getFileList(filepath):
    for root, dirs, files in os.walk(filepath):
        for filename in files:
            print filename
        for dirname in dirs:
            print dirname
    return 

'''
获取文件中所有包含语言转换的key
'''
def getFileStr(filename):

    fp=open(filename,"r")  
    for s in fp.readlines():  
        li= re.findall(r"UGLocalizedStr\(@\"(.+?)\"\)",s)
        if(len(li)>0):print("search:",li)  
    fp.close()
    return 

'''
获取对应key的内容
'''
def getFiledata(Key):
    
    return 


# getFileList('/Users/UbunGit/SVN/SanweiduApp/trunk/Sanweidu(overseas)/HLTddpay/Mall/BuyGoods/SureOrders')
getFileStr("/Users/UbunGit/SVN/SanweiduApp/trunk/Sanweidu(overseas)/HLTddpay/Mall/BuyGoods/ShoppingViewControllerNew.m")