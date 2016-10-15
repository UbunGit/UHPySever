#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年8月18日
概率分析法

@author: xiaoqy
'''
from PymysqlHandle.SqlHandelGlobal import SqlHabdleGlobal


class FC3DProbability(object):

    '''
    获取频率表名
    '''
    def getTableName(self, probability):
        return "FC3Dprobability_" + str(probability) + "Table";
     
    '''
    获取概率表表名
    '''
    def getRecommendtableName(self, beginData, endData, probability):
        return "FC3DRec_" + str(probability) + "_" + str(beginData) + "_" + str(endData) + "_Table"
    
    '''
    创建频率表
    '''
    def createTable(self, tableName):
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            
            sql = 'call p_creatFC3DStatisticsCountTable( "' + tableName + '" );'
            cursor.execute(sql)
            connection.commit()
            connection.close()
            return True;
        return False;
    
    '''
    创建概率表
    '''
    def createRecommendTable(self, tableName):
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            
            sql = 'call p_creatFC3DRecommendTable( "' + tableName + '" );'
            cursor.execute(sql)
            connection.commit()
            connection.close()
            return True;
        return False;
    
    '''
    查询最后一期数据查询
    '''
    def getLastData(self, tableName):
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor:
            sql = 'select* from ' + tableName + '  order by outNO desc limit 0,1;'
            cursor.execute(sql)
            tablerows = cursor.fetchall()
            if(len(tablerows) == 1):
                return tablerows[-1];
            else:
                return None;
        return None
    
    '''
    获取元数据相对与频率表的最小数据
    '''
    def getlastNotAnalyseFC3DData(self, lastOutON, probability):
        connection = SqlHabdleGlobal.connectionDb();
        with connection.cursor() as cursor: 
            if(lastOutON != 0):
                sql = 'select min(outNO) as lastData from FC3DData_t   where outNO>' + str(lastOutON) + ';'
            else:
                sql = 'select outNO as lastData from FC3DData_t  order by outNO limit %d,1;' % (probability - 1);
            cursor.execute(sql)
            tablerows = cursor.fetchall()
            if(len(tablerows) == 1):
                return tablerows[-1];
            else:
                return None;
        return None
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
                 
                sql = 'call pr_insterOneProbabilityDataToTable(%s,%s,%s);'
                cursor.execute(sql, (str(probability), tableName, minData["lastData"]));   
                lastData = self.getLastData(tableName)
                minData = self.getlastNotAnalyseFC3DData(lastData["outNO"], probability)
                print(lastData["outNO"]);
            
        print("===>频率：%d 频率表：%s 更新完毕" % (probability, tableName))
           
    '''
    查询出球号码
    '''
    def getOutNOData(self, outNO):
        
        connection = SqlHabdleGlobal.connectionDb()
        with connection.cursor() as cursor: 
            sql = 'select *  from FC3DData_t   where outNO=' + str(outNO) + ';'
            cursor.execute(sql)
            tablerows = cursor.fetchall()
            if(len(tablerows) == 1):
                return tablerows[-1];
            else:
                return None;
        return None
        '''
    获取推荐号码
    beginData 开始时间
    endData 结束时间
    probability 频率
    recommendOutNO 推荐出球号
    ''' 
    def getRecommend(self, beginData, endData, probability, recommendOutNO):
        maxCount = 1
        if(int(probability) == 5):
            maxCount = 2
        if(int(probability) == 10):
            maxCount = 2
        if(int(probability) == 15):
            maxCount = 2
        if(int(probability) == 20):
            maxCount = 2
        if(int(probability) == 25):
            maxCount = 2
        if(int(probability) == 30):
            maxCount = 2
        if(int(probability) == 40):
            maxCount = 2
        if(int(probability) == 50):
            maxCount = 2
        if(int(probability) == 100):
            maxCount = 4
        return self.getRecommendMax(beginData, endData, probability, recommendOutNO, maxCount)
        
        
    '''
    获取推荐号码
    beginData 开始时间
    endData 结束时间
    probability 频率
    recommendOutNO 推荐出球号
    ''' 
    def getRecommendMax(self, beginData, endData, probability, recommendOutNO, maxCount):
        
        probabilityTableName = self.getTableName(probability)
        recommendTableName = self.getRecommendtableName(beginData, endData, probability)
        ishave = SqlHabdleGlobal.isHaveTable(recommendTableName)
        if(not ishave):
            ishave = self.createRecommendTable(recommendTableName)
        if(ishave):
            connection = SqlHabdleGlobal.connectionDb();
            with connection.cursor() as cursor:
                sql = "call pr_getRecommendData( " + str(probability) + ",'" + probabilityTableName + "' ,'" + recommendTableName + "'," + str(recommendOutNO) + "," + str(beginData) + "," + str(endData) + ");"
                cursor.execute(sql)  
                tablerows = cursor.fetchall()
                outData = self.getOutNOData(recommendOutNO)
                if(len(tablerows) == 1):
                    teturnData = self.getRecommendCode(tablerows[-1], outData, probability, maxCount)
                    return teturnData
                else:
                    return None;
        else:
            print "创建概率表失败！"
            return
        
        
    '''
    计算推荐的号码
    ''' 
    def getRecommendCode(self, data, outData, probability, maxCount): 
        
        outGeNO = {
        'Ge_Zero':('0'), 'Ge_One':('1'), 'Ge_Two':('2'), 'Ge_Three':('3'), 'Ge_Four':('4'),
        'Ge_Five':('5'), 'Ge_Six':('6'), 'Ge_Seven':('7'), 'Ge_Eight':('8'), 'Ge_Nine':('9')
        }
        outShiNO = {
        'Shi_Zero':('0'), 'Shi_One':('1'), 'Shi_Two':('2'), 'Shi_Three':('3'), 'Shi_Four':('4'),
        'Shi_Five':('5'), 'Shi_Six':('6'), 'Shi_Seven':('7'), 'Shi_Eight':('8'), 'Shi_Nine':('9')
        }
        outBaiNO = {
        'Bai_Zero':('0'), 'Bai_One':('1'), 'Bai_Two':('2'), 'Bai_Three':('3'), 'Bai_Four':('4'),
        'Bai_Five':('5'), 'Bai_Six':('6'), 'Bai_Seven':('7'), 'Bai_Eight':('8'), 'Bai_Nine':('9')
        }
        retuenDic = {"geIsTrue":"False",
                      "shiIsTrue":"False",
                      "baiIsTrue":"False",
                      "geNotIsTrue":"True",
                      "shiNotIsTrue":"True",
                      "baiNotIsTrue":"True"
        }
  
        gelist = [data['Ge_Zero'], data['Ge_One'], data['Ge_Two'], data['Ge_Three'], data['Ge_Four'],
                  data['Ge_Five'], data['Ge_Six'], data['Ge_Seven'], data['Ge_Eight'], data['Ge_Nine']]
        maxGelist = self.getMaxList(gelist, maxCount)
        minGelist = self.getMinList(gelist, maxCount)
        outGeList = []
        notOutGeList = []
        for value, key in enumerate(outGeNO):
            
            if (data[key] in maxGelist):
                outGeList.append(outGeNO[key])
                if(outData != None):
                    if (outGeNO[key] == str(outData["out_ge"])):
                        retuenDic["geIsTrue"] = "True"
                else:
                    retuenDic["geIsTrue"] = "True"
            if (data[key] in minGelist):
                notOutGeList.append(outGeNO[key])
                if(outData != None):
                    if (outGeNO[key] == str(outData["out_ge"])):
                        retuenDic["geNotIsTrue"] = "False"
                else:
                    retuenDic["geNotIsTrue"] = "True"
            
                
        
        shilist = [data['Shi_Zero'], data['Shi_One'], data['Shi_Two'], data['Shi_Three'], data['Shi_Four'],
                   data['Shi_Five'], data['Shi_Six'], data['Shi_Seven'], data['Shi_Eight'], data['Shi_Nine']]
        
        maxShilist = self.getMaxList(shilist, maxCount)
        minShilist = self.getMinList(shilist, maxCount)
        outShiList = []
        notOutShiList = []

        for value, key in enumerate(outShiNO):
            
            if (data[key] in maxShilist):
                outShiList.append(outShiNO[key])
                if(outData != None):
                    if (outShiNO[key] == str(outData["out_shi"])):
                        retuenDic["shiIsTrue"] = "True"
                else:
                    retuenDic["shiIsTrue"] = "True"
                    
            if (data[key] in minShilist):
                notOutShiList.append(outShiNO[key])
                if(outData != None):
                    if (outShiNO[key] == str(outData["out_shi"])):
                        retuenDic["shiNotIsTrue"] = "False"
                else:
                    retuenDic["shiNotIsTrue"] = "True"
                
        bailist = [data['Bai_Zero'], data['Bai_One'], data['Bai_Two'], data['Bai_Three'], data['Bai_Four'],
                   data['Bai_Five'], data['Bai_Six'], data['Bai_Seven'], data['Bai_Eight'], data['Bai_Nine']]
        
        maxBailist = self.getMaxList(bailist, maxCount)
        minBailist = self.getMinList(bailist, maxCount)
        outBaiList = []
        notOutBaiList = []

        for value, key in enumerate(outBaiNO):
            
            if (data[key] in  maxBailist):
                outBaiList.append(outBaiNO[key])
                if(outData != None):
                    if (outBaiNO[key] == str(outData["out_bai"])):
                        retuenDic["baiIsTrue"] = "True"
                else:
                    retuenDic["baiIsTrue"] = "True"
            if (data[key] in  minBailist):
                notOutBaiList.append(outBaiNO[key])
                if(outData != None):
                    if (outBaiNO[key] == str(outData["out_bai"])):
                        retuenDic["baiNotIsTrue"] = "False"
                else:
                    retuenDic["baiNotIsTrue"] = "True"   
                
        retuenDic["outGeList"] = outGeList
        retuenDic["outShiList"] = outShiList
        retuenDic["outBaiList"] = outBaiList
        retuenDic["outNotGeList"] = notOutGeList
        retuenDic["outNotShiList"] = notOutShiList
        retuenDic["outNotBaiList"] = notOutBaiList
        if(outData != None):
            outData['outdate'] = str(outData['outdate'])
        else:
            outData = {}
            outData['outdate'] = '0000-00-00';
            outData['out_ge'] = "-1";
            outData['out_shi'] = "-1";
            outData['out_bai'] = "-1";
            outData['outNO'] = "-1";
        retuenDic["outData"] = outData

        return retuenDic 
    
    def getMaxList(self, listData, count):
        temList = list(set(listData))
        maxlist = []
        while(len(maxlist) != count and len(temList) != 0):
            maxlist.append(max(temList))
            temList.remove(max(temList))
        return maxlist
    
    def getMinList(self, listData, count):
        temList = list(set(listData))
        minlist = []
        while(len(minlist) != count and len(temList) != 0):
            minlist.append(min(temList))
            temList.remove(min(temList))
        return minlist

        
        
    
