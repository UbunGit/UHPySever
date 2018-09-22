#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年3月8日

@author: xiaoqy
'''


import sys ,os
from PymysqlHandle.MysqlHandleGoods import MysqlHandleGoods
from TOOL import LogHandle
from TOOL.CustomError import CustomError



class Shoping(object):

    mysqlHandleGoods = MysqlHandleGoods()

    def interfaceMethodo(self, data, metho, userID):

        mname = 'do_' + metho
        if not hasattr(self, mname):
            raise CustomError(-20001)
        method = getattr(self, mname)
        return method(data)

    def do_updataGoods(self, data):

        if(data  == None): raise CustomError(-20005)
        self.mysqlHandleGoods.addGoods(data)

    def do_getgoodsInfoByID(self,data):

        if "goodsID" not in data.keys(): raise CustomError(-20005,"goodsID")
        return self.mysqlHandleGoods.selectGoosdinfoByID(data["goodsID"])

    def do_getgoodsList(self,data):
        if data == None: raise CustomError(-20005,"parm")
        return self.mysqlHandleGoods.selectGoodslistBySearch(data)

    '''修改商品信息'''
    def do_replaceGoodsInfo(self,data):
        self.mysqlHandleGoods.replaceGoodsInfo(data)
