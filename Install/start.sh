#!/bin/bash

#
echo "=========================================================";


/* 获取ip地址 */
OS=`uname`
IO="" # store IP
case $OS in
Linux) IP=`ifconfig  | grep 'inet addr:'| grep -v '127.0.0.1' | cut -d: -f2 | awk '{ print $1}'`;;
FreeBSD|OpenBSD) IP=`ifconfig  | grep -E 'inet.[0-9]' | grep -v '127.0.0.1' | awk '{ print $2}'` ;;
SunOS) IP=`ifconfig -a | grep inet | grep -v '127.0.0.1' | awk '{ print $2} '` ;;
Darwin) IP=`ifconfig | grep 'inet.*netmask.*broadcast' |head -1| awk '{ print $2} '`;;
*) IP="Unknown";;
esac
IP=${IP%
*}
echo "$OS"
echo "$IP"



echo "[database]
dbhost="$IP"

[interFace]
InterFaceIP=http://$IP:8889

[path]
errorLogpath="../../log/"

[URL]
root_assets=http://$IP/xiaoqy/UHPySever/PHP/assets/
root_page=http://$IP/xiaoqy/UHPySever/PHP/Page/
root_js=http://$IP/xiaoqy/UHPySever/PHP/JS/
root_css=http://$IP/xiaoqy/UHPySever/PHP/CSS/

root_image=http://$IP/xiaoqy/UHPySever/PHP/Image/" > config.conf

cd ../
chmod 777 log/*.*

cd PHP/JS/

echo "
var SocketIP='$IP';
var SocketPORD=8888;
var httpURL_interFace= 'http://$IP:8889/interface';
var httpURL_FCAnalyse= 'http://$IP:8889/FCAnalyse';
var httpURL_samrtHome= 'http://$IP:8889/samrtHome';

var image= '../Image/';
var page=  '../Page/';
var css=   '../CSS/';
var js=    '../JS/';
" > config.js

cd ../../

cd Sever

python setp.py

EOF

echo "=========================================================";
echo "install Success";

























