#!/usr/bin/env python
# encoding: utf-8
'''
Created on 2017年4月7日

@author: UbunGit
'''

import feedparser
import re
import json

def getwordcounts(url):
    d= feedparser.parse(url)
    print d
    wc ={}
     
    for e in d.entries:
        if 'summary' in e:
            summary = e.summary
        else:
            summary = e.description
#         print e.title +'-------'+summary +'\n'
        words = e.title +''+summary
#         words = getwords(e.title +''+summary)
        for word in words:
            wc.setdefault(word,0)
            wc[word]+=1
    print  json.dumps(wc,encoding='utf-8',ensure_ascii=False)
    print '\n end'

# def getwords(html):
#     tet = re.compile(r'<[^>]+>'.sub(''')), flags)
    
getwordcounts("http://192.168.1.27/xiaoqy/UHPySever/PHP/Page/FC3D/UpdateData.php")