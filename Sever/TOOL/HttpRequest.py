#!/usr/bin/env python
#coding=utf8


import httplib, urllib

httpClient = None
try:


    data='%7B%0A%20%20%22reqTime%22%20:%20%221530352711638%22,%0A%20%20%22reqParam%22%20:%20%7B%0A%20%20%20%20%22countryCode%22%20:%20%2286%22,%0A%20%20%20%20%22phone%22%20:%20%2218112345678%22,%0A%20%20%20%20%22type%22%20:%20%221001%22,%0A%20%20%20%20%22memberNo%22%20:%20%2218112345678%22,%0A%20%20%20%20%22userType%22%20:%20%221300%22%0A%20%20%7D%0A%7D'

    headers={
        "appId":"1001",
        "clientUDID":"1cda629f-a247-47e7-97ac-4a76ffff2bdc",
        "countryId":"86",
        "lang":"zh",
        "memberNo":"fury05",
        "osName":"1005",
        "reqCode":"pay003",
        "sign":"1477d32bcc8982421c8dcc4f06e821a7",
        "version":"4.9.0",
        "Content-type": "application/x-www-form-urlencoded",
        "Accept": "text/plain"
    }


    requrl = "http://192.168.1.27:8080/pay/paymentByDifferentBus"
    httpClient = httplib.HTTPConnection("192.168.1.27", 8080, timeout=30)
    httpClient.request("POST", requrl, "data="+data, headers)

    response = httpClient.getresponse()
    print response.status
    print response.reason
    print response.read()
    print response.getheaders() #获取头信息
except Exception, e:
    print e
finally:
    if httpClient:
        httpClient.close()