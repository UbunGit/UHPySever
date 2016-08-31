#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年1月27日

@author: xiaoqy
'''
import re
import json


'''
获取网页中图片的数组
'''
def gethttpimage(string):
    
    reg = r'<img src="(.+?\.(jpg|gif|bmp|bnp|png))"'
    imgre = re.compile(reg)
    urllist = re.findall(imgre,string)
    return urllist

def jsonPase(source):
    if source:
        return json.JSONDecoder().decode(source)
    else:
        return None;
    
def jsonUnPase(source):
    if source:
        return json.dumps(source)
    else:
        return {"100":"返回结果为空"}