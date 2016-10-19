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

[URL]
root_css=http://$IP/xiaoqy/UHPySever/CSS/
root_js=http://$IP/xiaoqy/UHPySever/JS/
root_image=http://$IP/xiaoqy/UHPySever/Image/" > config.conf

cd ../Sever 

python <<EOF

from HttpSever import HttpSever
HttpSever.start_server(8889)

EOF
echo "=========================================================";
echo "install Success";

























