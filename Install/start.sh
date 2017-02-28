#!/bin/bash

#
echo "=========================================================";

OS=`uname`
IO="" # store IP
case $OS in
Linux) IP=`ifconfig  | grep 'inet addr:'| grep -v '127.0.0.1' | cut -d: -f2 | awk '{ print $1}'`;;
FreeBSD|OpenBSD) IP=`ifconfig  | grep -E 'inet.[0-9]' | grep -v '127.0.0.1' | awk '{ print $2}'` ;;
SunOS) IP=`ifconfig -a | grep inet | grep -v '127.0.0.1' | awk '{ print $2} '` ;;
Darwin) IP=`ifconfig | grep 'inet.*netmask.*broadcast' | awk '{ print $2} '`;;
*) IP="Unknown";;
esac
echo "$OS"
echo "$IP"



echo "[database]
dbhost="$IP"

[interFace]
InterFaceIP=http://$IP:8889
[path]
errorLogpath="../../log/"

[URL]
root_assets=http://$IP/xiaoqy/UHPySever/assets/
root_page=http://$IP/xiaoqy/UHPySever/PHP/Page/
root_css=http://$IP/xiaoqy/UHPySever/CSS/
root_js=http://$IP/xiaoqy/UHPySever/JS/
root_image=http://$IP/xiaoqy/UHPySever/Image/" > config.conf

cd ../JS

echo "
var SocketIP='$IP';
var SocketPORD=8888;
var httpURL_interFace= 'http://$IP:8889/interface';
var httpURL_FCAnalyse= 'http://$IP:8889/FCAnalyse';
var httpURL_samrtHome= 'http://$IP:8889/samrtHome';

var image= 'http://$IP/xiaoqy/UHPySever/Image/';
var page=  'http://$IP/xiaoqy/UHPySever/PHP/Page/';
var css=   'http://$IP/xiaoqy/UHPySever/CSS/';
var js=    'http://$IP/xiaoqy/UHPySever/JS/';
" > config.js

cd ../Sever 

python <<EOF

import thread
from HttpSever import HttpSever
from HttpSever import SocketSever

# 创建两个线程
try:
thread.start_new_thread( HttpSever.star_httpSever )
thread.start_new_thread( SocketSever.startSocketSever)
except:
print "Error: unable to start thread"

while 1:
pass

EOF

echo "=========================================================";
echo "install Success";

























