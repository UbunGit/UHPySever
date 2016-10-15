#!/usr/bin/env python
# encoding: utf-8
'''
HttpRequest.HttpRequestUrllib2 -- shortdesc

HttpRequest.HttpRequestUrllib2 is a description

It defines classes_and_methods

@author:     xiaoqy

@copyright:  2016 organization_name. All rights reserved.

@license:    license
@contact:    296019487@11.com
@deffield    
'''
'''
打开url，返回url的内容
'''

import urllib2


def requestHttp_urllib2(url):
    req = urllib2.Request(url)
    try:
        http = urllib2.urlopen(req)
    except urllib2.HTTPError, e:
        print e.code
    except urllib2.URLError, e:
        print e.reason
    else:
        return http.read()
 
