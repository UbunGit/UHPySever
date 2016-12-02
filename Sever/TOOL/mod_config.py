# encoding:utf-8
'''
Created on 2016年10月14日

@author: UbunGit
'''
import ConfigParser
import os, sys


# 获取config配置文件
def getConfig(section, key):
    config = ConfigParser.ConfigParser(allow_no_value=True)
    path, filename = os.path.split(os.path.abspath(sys.argv[0]))
    path= os.path.join(path,"../")
    path= os.path.abspath(path)
    path = path+"/Install/config.conf"
    config.read(path)
    return config.get(section, key)

# 其中 os.path.split(os.path.realpath(__file__))[0] 得到的是当前文件模块的目录
