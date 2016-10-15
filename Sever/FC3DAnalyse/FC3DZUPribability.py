#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年8月30日
组选频率计算

@author: xiaoqy
'''
from FC3DProbability import FC3DProbability
from PymysqlHandle.SqlHandelGlobal import SqlHabdleGlobal


class FC3DZUPribability(FC3DProbability):
    '''
    组选频率计算
    '''
    '''
    获取组合频率表名
    '''
    def getTableName(self, probability):
        return "FC3DprobabilityZU_" + str(probability) + "Table"; 
    
    '''
    获取概率表表名
    '''
    def getRecommendtableName(self, beginData, endData, probability):
        return "FC3DRecZU_" + str(probability) + "_" + str(beginData) + "_" + str(endData) + "_Table"
    
    '''
    录入频率表数据
    '''
    def loadProbabilityData(self, probability):
        tableName = self.getTableName(probability)
        print tableName;
        ishave = SqlHabdleGlobal.isHaveTable(tableName)
        if(not ishave):
            ishave = self.createTable(tableName);
        if(ishave):
            lastData = self.getLastData(tableName)
        else:
            print "创建频率表失败！"
            return 
        
        if(lastData):
            minData = self.getlastNotAnalyseFC3DData(lastData["outNO"], probability)
        else:
            minData = self.getlastNotAnalyseFC3DData(0, probability)
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            while minData["lastData"] != None:
                 
                sql = 'call pr_insterOneZUProbabilityDataToTable(%s,%s,%s);'
                cursor.execute(sql, (str(probability), tableName, minData["lastData"]));   
                lastData = self.getLastData(tableName)
                minData = self.getlastNotAnalyseFC3DData(lastData["outNO"], probability)
                print(lastData["outNO"]);
            
        print("===>频率：%d 频率表：%s 更新完毕" % (probability, tableName))
        
