#!/usr/bin/env python
# encoding: utf-8
'''
    Created on 2017年5月15日
    
    @author: UbunGit
    '''
import os
import commands
import threading
import json

imageTypes = ('png','jpg','gif')
fileTypes = ('m','xib')
threads = []
imageenddic = {}
class searchThreads(threading.Thread):
    """Threaded Url Grab"""
    def __init__(self,imagedic,imageTypes,dirPath):
        threading.Thread.__init__(self)
        self.imagedic = imagedic
        self.dirPath = dirPath
        self.imageTypes = imageTypes
    
    
    def run(self):
        imagelist = self.imagedic[self.imageTypes]
        if len(imagelist)>0 and imagelist[0]!='':
            
            for imagefile in imagelist:
                imageusedic = {}
                filename = os.path.basename(imagefile)
                filename = os.path.splitext(filename)[0]
                filename = filename.replace("@2x","")
                filename = filename.replace("@3x","")
                hasImagearr =gethasImagedic(filename,self.dirPath)
                imageusedic["uselist"]=hasImagearr
                imageenddic[filename] = imageusedic


##
# 获取项目中不同后缀的文件列表
#
def getfileList(dirPath,filetype):
    
    comstr = "find \""+dirPath+"\" -name *."+str(filetype)
    state,result= commands.getstatusoutput(comstr)
    if state == 0:
        return result.split("\n")
    else:
        print result



def searchImage(imagedic,dirPath):
    
    for imageType in imagedic.keys():
        t = searchThreads(imagedic,imageType,dirPath)
        threads.append(t)
        t.start()
    for t in threads:
        t.join()
    return json.dumps(imageenddic)

##
# 查找包含图片名的文件
#
def gethasImagedic(imagename,dirPath):
    
    hasarr =[]
    for temtype in fileTypes:
        imagestr = getImageUsestr(imagename,temtype)
        comstr = ' find  \''+dirPath+'\' -type f -name \'*.'+temtype+'\' -print0 | xargs -0 grep -ri \''+imagestr+'\''
        
        state,result= commands.getstatusoutput(comstr)
        if state == 0:
            hasarr.append(result.split("\n"))
        else:
            print comstr
            print 'state:'+str(state)
            print 'result:'+result
    return hasarr

#
##
# 根据文件类型返回对应使用图片的字符串
#
def getImageUsestr(imageName,fileType):
    temstr = ''
    if fileType == 'm' or fileType == 'mm':
        temstr = '@\"'+imageName
    if fileType == 'swift':
        temstr = 'named:\"(\\'+imageName+'+)\"'
    if fileType == 'xib':
        temstr = 'image name=\"(\\'+imageName+'+)\"'
    return temstr

def getpathTree(dirfile):
    comstr = 'find \''+ dirfile +'\' \( -name ".svn" \) -prune -o -type dir'
    state,result= commands.getstatusoutput(comstr)
    if state == 0:
        patharr= result.split("\n")
        pathlist = {}
        for path in patharr:
            path = path.replace(dirfile,".")
            paths= path.split("/")
            rootkey = ''
            for path in paths:
                if rootkey=='':
                    rootkey = path
                else:
                    if rootkey in pathlist.keys():
                        temlist = pathlist[rootkey]
                        temlist.append(path)
                        pathlist[rootkey]=temlist
                    else:
                        temlist = []
                        temlist.append(path)
                        pathlist[rootkey]=temlist
                    rootkey =path
        return  json.dumps(pathlist)
    else:
        print result



def main():
    
    dirfile = '/Users/UbunGit/SVN/Sanweidu(overseas)/HLTddpay'
    dirPath= os.path.dirname(dirfile)
#    imagedic = {}
#    for imageType in imageTypes:
#        temlist =getfileList(dirPath,imageType);
#        imagedic[imageType] = temlist;
#    
#    jsonstr = searchImage(imagedic,dirPath)
#    useimagfile = "./useimag.json"
#    with open(useimagfile,"w") as f:
#        f.write(jsonstr)

    jsonstr =getpathTree(dirPath)
    useimagfile = "./path.json"
    with open(useimagfile,"w") as f:
        f.write(jsonstr)





if __name__ == '__main__':
    main()


