#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2016年8月28日

@author: xiaoqy
'''
from FC3DAnalyse.FC3DOmit import FC3DOmit
from FC3DAnalyse.FC3DProbability import FC3DProbability
from FC3DAnalyse.FC3DZUPribability import FC3DZUPribability
from PymysqlHandle.PymysqlHandle import PymysqlHandle
from TOOL import LogHandle
from TOOL.DownLoadFile import DownLoadFile


def reloadData():
    downLoad = DownLoadFile()
  
    savepath = downLoad.downLoadFile("http://www.17500.cn/getData/3d.TXT", "Data/3d.TXT")
    LogHandle.log(0, '下载最新FC3D数据文件到本地完成' , 'SYSROOT',0, 'getData') 
  
    pymysqlHandle = PymysqlHandle()
    pymysqlHandle.loadFC3DDataByText(savepath)
    LogHandle.log(0, '加载FC3D数据文件到sql完成' , 'SYSROOT',0, 'getData')

    fc3DOmit = FC3DOmit()
    fc3DOmit.reloadOmitData()
    LogHandle.log(0, '录入FC3D数据遗漏数据完成' , 'SYSROOT',0, 'getData')
    
    fc = FC3DProbability()
    fc.loadProbabilityData(5)
    LogHandle.log(0, '录入FC3D频率表5数据完成' , 'SYSROOT',0, 'getData')
    fc.loadProbabilityData(10)
    LogHandle.log(0, '录入FC3D频率表10数据完成' , 'SYSROOT',0, 'getData')
    fc.loadProbabilityData(15)
    LogHandle.log(0, '录入FC3D频率表15数据完成' , 'SYSROOT',0, 'getData')
    fc.loadProbabilityData(20)
    LogHandle.log(0, '录入FC3D频率表20数据完成' , 'SYSROOT',0, 'getData')
    fc.loadProbabilityData(25)
    LogHandle.log(0, '录入FC3D频率表25数据完成' , 'SYSROOT',0, 'getData')
    fc.loadProbabilityData(30)
    LogHandle.log(0, '录入FC3D频率表30数据完成' , 'SYSROOT',0, 'getData')
    fc.loadProbabilityData(50)
    LogHandle.log(0, '录入FC3D频率表50数据完成' , 'SYSROOT',0, 'getData')
    fc.loadProbabilityData(100)
    LogHandle.log(0, '录入FC3D频率表100数据完成' , 'SYSROOT',0, 'getData')
  
    
    zuf = FC3DZUPribability()
    zuf.loadProbabilityData(5)
    LogHandle.log(0, '录入组选FC3D频率表5数据完成' , 'SYSROOT',0, 'getData')
    zuf.loadProbabilityData(10)
    LogHandle.log(0, '录入组选FC3D频率表10数据完成' , 'SYSROOT',0, 'getData')
    zuf.loadProbabilityData(15)
    LogHandle.log(0, '录入组选FC3D频率表15数据完成' , 'SYSROOT',0, 'getData')
    zuf.loadProbabilityData(20)
    LogHandle.log(0, '录入组选FC3D频率表20数据完成' , 'SYSROOT',0, 'getData')
    zuf.loadProbabilityData(25)
    LogHandle.log(0, '录入组选FC3D频率表25数据完成' , 'SYSROOT',0, 'getData')
    zuf.loadProbabilityData(30)
    LogHandle.log(0, '录入组选FC3D频率表30数据完成' , 'SYSROOT',0, 'getData')
    zuf.loadProbabilityData(50)
    LogHandle.log(0, '录入组选FC3D频率表50数据完成' , 'SYSROOT',0, 'getData')
    zuf.loadProbabilityData(100)
    LogHandle.log(0, '录入组选FC3D频率表100数据完成' , 'SYSROOT',0, 'getData')

