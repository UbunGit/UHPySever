#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2017年4月8日
删除txt中绝对路径的文件并保存到另外的文件
@author: UbunGit
'''

#!/usr/bin/env python
# encoding: utf-8

import shutil
import os

# os.mkdir("/Users/UbunGit/Desktop/UntitledImage") 
feedlist = [line for line in file('/Users/UbunGit/Desktop/UntitledImage.txt')]

for loop in feedlist:
    loop = loop.replace('\r','').replace('\n','').replace('\t','')
    print ('The value is:'+loop)
    if os.path.isfile(loop):
        shutil.move(loop,"/Users/UbunGit/Desktop/UntitledImage")
    else:
        print "is not file"+loop
#     os.remove(loop) 
