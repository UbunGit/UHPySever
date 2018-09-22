# encoding:utf-8
'''
Created on 2018年7月3日

@author: UbunGit
'''
from TOOL import mod_config

class WriteFile(object):

    def test(self):

        print(mod_config.getPathConfig('/Users/ubungit/Git/UHPySever/Sever',"DATAPATH", "DATAPATH"))
        return True;

    def addLog(self,txt):

        import time;
        now = time.time()
        year, month, day, hh, mm, ss, x, y, z = time.localtime(now)
        fileName = "%04d-%02d-%02d" % (
            year,month,day)

        logpath = "/Users/ubungit/Git/UHPySever/Sever"+mod_config.getPathConfig('/Users/ubungit/Git/UHPySever/Sever',"DATAPATH", "DATAPATH")+"/log/"+fileName+".log"

        with open(logpath,"a") as f:
            f.write(txt+"\n")
            f.close()

