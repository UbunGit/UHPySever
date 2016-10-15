#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年8月29日

@author: xiaoqy
'''

import unittest
from TOOL import mod_config
from PymysqlHandle.SqlHandelGlobal import SqlHabdleGlobal

class MyTest(unittest.TestCase):
 
    @classmethod
    def testInterFace(self):
        dbname = mod_config.getConfig("database", "dbname")
        print dbname
        pass
    
    
# test =  MyTest()
MyTest.testInterFace()

