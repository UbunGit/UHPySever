#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年8月28日
根据遗漏值分析

@author: xiaoqy
'''
from err import MyError
from PymysqlHandle.SqlHandelGlobal import SqlHabdleGlobal


class FC3DOmit(object):
    '''
    根据遗漏值分析
    '''
    
    #获取保存遗漏表的表名
    def getOmitTableName(self):
        return "FC3DOmitData_table"
    
    #创建表
    def createTable(self,tableName):
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            
            sql = 'call p_creatFC3DOmitTable( "'+tableName+'" );'
            cursor.execute(sql)
            connection.commit()
            connection.close()
            return True;
        return False;
      
    #获取已有表中的最后一条数据
    def getLastOmitDatd(self,tableName):
        
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            sql = 'select* from '+tableName+'  order by outNO desc limit 0,1;'
            cursor.execute(sql)
            tablerows = cursor.fetchall()
            if( len(tablerows)==1):
                return tablerows[-1];
            else:
                return None;
        return None
        '''
    获取元数据相对与频率表的最小数据
    '''
    def getlastNotAnalyseFC3DData(self,lastOutON):
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor: 
            if(lastOutON!=0):
                sql = 'select min(outNO) as lastData from FC3DData_t   where outNO>'+str(lastOutON)+';'
            else:
                sql = 'select outNO as lastData from FC3DData_t  order by outNO limit 0,1;';
            cursor.execute(sql)
            tablerows = cursor.fetchall()
            if( len(tablerows)==1):
                return tablerows[-1];
            else:
                return None;
        return None    
    
    #加载遗漏表数据
    def reloadOmitData(self):
        tableName = self.getOmitTableName()
        #查看表是否存在，不存在就创建
        if(not SqlHabdleGlobal.isHaveTable(tableName)):
            if(not self.createTable(tableName)):
                raise MyError('创建表'+tableName+"失败")
                return;
        lastData = self.getLastOmitDatd(tableName)
        
        if(lastData):
            minData = self.getlastNotAnalyseFC3DData(lastData["outNO"])
        else:
            minData = self.getlastNotAnalyseFC3DData(0)
            
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            while minData["lastData"]!=None:
                 
                sql = 'call pr_insterOneOmitDataToTable(%s,%s);'
                cursor.execute(sql, (tableName,minData["lastData"]));   
                lastData = self.getLastOmitDatd(tableName)
                minData = self.getlastNotAnalyseFC3DData(lastData["outNO"])
                print("计算遗漏值:"+str(lastData["outNO"]));
            
        
        