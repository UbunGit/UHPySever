#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年7月29日

@author: xiaoqy
'''
import urllib
import sys
import os


class DownLoadFile(object):
    '''
    classdocs
    '''


#     def __init__(self):
#         '''
#         Constructor
#         '''
    '''
    下载文件到本地
    '''
    def downLoadFile(self,url,savePath):
        
        if(len(url)<0):
            return False
            
        if(len(savePath)<0):
            return False
        # 去除首位空格
        savePath=savePath.strip()
        # 去除尾部 \ 符号
        savePath=savePath.rstrip("\\")
        
        if(os.path.isfile(savePath)): 
            filleName = os.path.basename(savePath)
        else:
            filleName = os.path.basename(url)
            
        filePath = os.path.dirname(savePath)
        if not (os.path.isabs(filePath)):
            filePath = sys.path[0]+"/"+filePath
   
        # 判断路径是否存在
        # 存在     True
        # 不存在   False
        isExists=os.path.exists(filePath)
 
        # 判断结果
        if not isExists:
            # 如果不存在则创建目录
            print filePath+' 创建成功'
            # 创建目录操作函数
            os.makedirs(filePath)

        savePath = filePath+"/"+filleName
        print "下载文件:url"+url+"保存至："+savePath+"..."
        urllib.urlretrieve(url, savePath) 
        print "下载文件:url"+url+"保存至："+savePath+"完成"  
        return savePath;
    
        
#test        
# downLoad = DownLoadFile();
# downLoad.downLoadFile("http://www.17500.cn/getData/3d.TXT", "Data/3d.TXT")