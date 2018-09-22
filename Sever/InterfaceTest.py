#!/usr/bin/env python
# coding=utf-8

import unittest
import time,rsa,requests,json
from PyString import PythonString


class MyTestCase(unittest.TestCase):

    def test_something(self):

        # self.assertEqual(self.login(), True)
        self.assertEqual(self.wxLogin(), True)

    def login(self):
        # # # 生成密钥
        # (cpubkey, cprivkey) = rsa.newkeys(1024)
        #
        #
        # # 保存密钥
        # with open('cpublic.pem','w+') as f:
        #     f.write(cpubkey.save_pkcs1().decode())
        #
        # with open('cprivate.pem','w+') as f:
        #     f.write(cprivkey.save_pkcs1().decode())

        with open('cpublic.pem','r') as f:
            cpubkey = f.read()
            # cpubkey = rsa.PublicKey.load_pkcs1(f.read().encode())

        with open('cprivate.pem','r') as f:

            cprivate = rsa.PrivateKey.load_pkcs1(f.read().encode())



        with open('public.pem','r') as f:

            pubkey = rsa.PublicKey.load_pkcs1(f.read().encode())

        url = '192.168.1.27:8888'
        data =  {'userName': 'admin', 'inefaceMode': 'login', 'passWord': u'123456'}
        datajson = PythonString.jsonUnPase(data)
        '''签名'''
        signdata = rsa.sign(datajson, cprivate, 'SHA-1')
        '''加密'''
        encryptdata= rsa.encrypt(datajson,pubkey)

        headers = {'userID':'66',
                   'sign':signdata}


        #'key': pubkey
        r = requests.post(url='http://192.168.1.27:8889',headers=headers,data=encryptdata)
        return True

    def wxLogin(self):
        url = 'http://192.168.1.27:8889/WXInterface'
        data =  {'inefaceMode': 'wxLogin', 'js_code':"123456"}
        r = requests.post(url,PythonString.jsonUnPase(data))
        if(r.status_code == 200):
             return True
        else:
            return False









if __name__ == '__main__':

    unittest.main()



















