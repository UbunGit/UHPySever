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

import urllib2
import cookielib

def getCookie(url,key):
    
    cookie = cookielib.CookieJar()
    handle = urllib2.HTTPCookieProcessor(cookie)
    opener = urllib2.build_opener(handle)
    response = opener.open(url)
    return  cookie

        

    