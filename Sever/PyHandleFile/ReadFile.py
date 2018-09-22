# encoding:utf-8
'''
Created on 2016年10月14日

@author: UbunGit
'''
from TOOL import mod_config


class ReadFile(object):

    def test(self):

        print(mod_config.getPathConfig('/Users/ubungit/Git/UHPySever/Sever',"DATAPATH", "DATAPATH"))
        return True;