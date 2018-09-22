# encoding:utf-8
'''
Created on 2016年10月14日

@author: UbunGit
'''
import ConfigParser
import os, sys

def getPathConfig(path,section, key):
    path = path+"/config.conf"
    config = ConfigParser.ConfigParser(allow_no_value=True)
    config.read(path)
    return config.get(section, key)

# 获取config配置文件
def getConfig(section, key):

    path= os.getcwd()

    return getPathConfig(path,section,key)


# 其中 os.path.split(os.path.realpath(__file__))[0] 得到的是当前文件模块的目录
