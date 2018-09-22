#!/usr/bin/env python
# encoding: utf-8

import unittest

from TOOL import LogHandle

class MyTestCase(unittest.TestCase):
    # 测试 mod_config.getConfig
    def test_Config(self):

        data={u'key5':u'5'}
        keystr = str(data.keys())[1:-1]
        valuestr = str(data.values())[1:-1]

        sql = 'INSERT INTO USER_T ('+keystr+') values ('+valuestr+')';
        print(sql)


if __name__ == '__main__':
    unittest.main()
