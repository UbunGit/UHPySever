#!/usr/bin/env python
# encoding: utf-8 a = '中文'
'''
Created on 2016年3月11日

@author: xiaoqy
'''

import sys ,os
sys.path.append(os.path.dirname(os.path.dirname(__file__)))
from TOOL.CustomError import CustomError

from pymysql.err import MySQLError
from SqlHandelGlobal import SqlHabdleGlobal


class MysqlHandleGoods(object):
    '''
    添加新商品
    '''
    def addGoods(self,data):
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new record
            keystr = ''
            valuestr=''
            for item in data.keys():
                keystr = keystr+item+','
                valuestr = valuestr+'"'+data[item]+'",'
            keystr = keystr[0:-1]
            valuestr = valuestr[0:-1]
            sql = 'INSERT INTO GOODS_T ('+keystr+') VALUES ('+valuestr+')'
            cursor.execute(sql)
            connection.commit()



    def selectGoodslistBySearch(self,data):

        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            sql = 'select * from GOODS_T'
            if("searchKey" in data.keys()):
                sql = sql + 'WHERE goodsName = "'+data["searchKey"]+'"'
                data.pop("searchKey")
            cursor.execute(sql)
            goodslist = []
            for row in cursor:
                goodslist.append(row)
            return goodslist;


    '''
    修改商品信息
    '''
    def replaceGoodsInfo(self, data):

        goodsID = data["goodsID"]
        data.pop("goodsID")

        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new recors
            sql = 'UPDATE GOODS_T SET '

            for key in data.keys():


                if type(data[key]) == int or type(data[key]) == float:
                    sql = sql+key+'='+str(data[key])+','
                else:
                    sql = sql+key+'="'+data[key]+'",'

            sql = sql[0:-1]
            sql = sql+' WHERE goodsID='+str(goodsID)
            cursor.execute(sql);
            connection.commit()
            connection.close()
    '''
    添加商品详情信息
    '''
    def addGoodsDes(self,data):
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new record
            keystr = ''
            valuestr=''
            for item in data.keys():
                keystr = keystr+item+','
                valuestr = valuestr+'"'+data[item]+'",'
            keystr = keystr[0:-1]
            valuestr = valuestr[0:-1]
            sql = 'INSERT INTO GOODSDES_T ('+keystr+') VALUES ('+valuestr+')'
            cursor.execute(sql)
            connection.commit()
        '''
    修改商品详情信息
    '''
    def replaceGoodsdesInfo(self, data):

        goodsID = data["goodsID"]
        data.pop("goodsID")

        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            # Create a new recors
            sql = 'UPDATE GOODSDES_T SET '

            for key in data.keys():


                if type(data[key]) == int or type(data[key]) == float:
                    sql = sql+key+'='+str(data[key])+','
                else:
                    sql = sql+key+'="'+data[key]+'",'

            sql = sql[0:-1]
            sql = sql+' WHERE goodsID='+str(goodsID)
            cursor.execute(sql);
            connection.commit()
            connection.close()

    def selectGoosdinfoByID(self,goodsID):

        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:

            sql = 'select * from GOODS_T t1  join GOODSDES_T  t2  where t1.goodsID= %s'
            cursor.execute(sql,(goodsID))
            goodslist = []
            for row in cursor:
                goodslist.append(row)
            if(len(goodslist)==1):
                return  goodslist[0]
            else:
                return None;









