#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年8月29日

@author: xiaoqy
'''

import unittest
from pymysqlHandle.SqlHandelGlobal import SqlHabdleGlobal

class MyTest(unittest.TestCase):
 
    @classmethod
    def testInterFace(self,data):
        fcAnalyse =  SqlHabdleGlobal()
        dic = SqlHabdleGlobal.connectionDb()
        print dic;
        pass



