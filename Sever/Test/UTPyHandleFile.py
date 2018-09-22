#!/usr/bin/env python
# encoding: utf-8

import unittest

import sys ,os
sys.path.append(os.path.dirname(os.path.dirname(__file__)))
from Interface.UPAndDown import UPAndDown
from TOOL.CustomError import  CustomError

class MyTestCase(unittest.TestCase):
    print("ceshi")





if __name__ == '__main__':
    unittest.main()
