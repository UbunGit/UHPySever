#!/usr/bin/env python
# encoding: utf-8

import unittest
import os
from TOOL import mod_config

class MyTestCase(unittest.TestCase):
    # 测试 mod_config.getConfig
    def test_Config(self):

        os.chdir("../" )
        syspath = os.getcwd()
        testPath = syspath+mod_config.getConfig("DATAPATH", "DATAPATH")
        self.assertEqual(os.path.exists(testPath), True)



if __name__ == '__main__':
    unittest.main()
