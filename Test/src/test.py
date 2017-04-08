#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2017年4月8日

@author: UbunGit
'''


import json
  
date = {u'versions': [{u'status': u'CURRENT', u'id': u'v2.3', u'links': [{u'href': u'http://controller:9292/v2/', u'rel': u'self'}]}, {u'status': u'SUPPORTED', u'id': u'v2.2', u'links': [{u'href': u'http://controller:9292/v2/', u'rel': u'self'}]}, {u'status': u'SUPPORTED', u'id': u'v2.1', u'links': [{u'href': u'http://controller:9292/v2/', u'rel': u'self'}]}, {u'status': u'SUPPORTED', u'id': u'v2.0', u'links': [{u'href': u'http://controller:9292/v2/', u'rel': u'self'}]}, {u'status': u'SUPPORTED', u'id': u'v1.1', u'links': [{u'href': u'http://controller:9292/v1/', u'rel': u'self'}]}, {u'status': u'SUPPORTED', u'id': u'v1.0', u'links': [{u'href': u'http://controller:9292/v1/', u'rel': u'self'}]}]}
  
print json.dumps(date, sort_keys=True, indent=2) # 排序并且缩进两个字符输出
