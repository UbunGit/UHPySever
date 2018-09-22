#!/usr/bin/env python
# encoding: utf-8
import requests,random,string,time
from TOOL.CustomError import CustomError
from PyString import PythonString
from PymysqlHandle.PymysqlHandle import PymysqlHandle

class WXInterface(object):
    '''
    接口文档相关的查询
    '''
    def upAndDownMethodo(self, data, metho, userID):


        mname = 'do_' + metho
        if not hasattr(self, mname):
            returnDic = {"infoCode":-20001}
            print "interFaceMetho=" + mname;
            return returnDic
        method = getattr(self, mname)
        return method(data,userID)

    '''微信登录获取session'''

    def do_wxLogin(self,data, userID):

        if "js_code" not in data.keys():
            raise CustomError(-20005,"js_code")
        if "nickName" not in data.keys():
            raise CustomError(-20005,"nickName")

        parm =  {'appid': 'wx2d3eaf4304b22f25', 'secret': '456d14753450c85718b290fa187bc369', 'js_code': data["js_code"] , 'grant_type' : 'authorization_code'}
        r = requests.post('https://api.weixin.qq.com/sns/jscode2session',parm)
        if r.status_code == 200:
            wxresult = PythonString.jsonPase(r.text)
            if 'errcode' not in wxresult.keys():

                pymysqlHandle = PymysqlHandle()
                result = pymysqlHandle.selectUserInfoBykey("wxOpenid",wxresult["openid"])
                data = {'wxOpenid':wxresult['openid'],
                        'userName':data["nickName"],
                        'userID':result["userID"],
                        'headImage':data["headImg"]}
                if result == None:
                    pymysqlHandle.insetUser(data)
                    result = pymysqlHandle.selectUserInfoBykey("wxOpenid",wxresult["openid"])
                else:
                    pymysqlHandle.replaceUserInfo(data,result["userID"])

                userID = result["userID"]
                '''创建section'''

                section = pymysqlHandle.getSection(result["userID"])

                if section != None:
                    nowtime = time.time()
                    if nowtime - section["createtime"] > 24*3600:
                        pymysqlHandle.deleteSection(result["userID"])
                        section = None

                if section == None:
                    '''创建section'''
                    salt = ''.join(random.sample(string.ascii_letters + string.digits, 32))
                    createtime = time.time()
                    userID = result["userID"]

                    data = {
                        'userID':userID,
                        'validityPeriod':24,
                        'createtime':createtime,
                        'session':salt,
                            }
                    pymysqlHandle.insterSection(data)
                    result["session"] = salt
                    return result

            else:
                raise CustomError(-30002)
        else:
            raise CustomError(-30001)






