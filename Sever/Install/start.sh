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

[INTERFACE]
IP=$IP
PORT=8889


[SOCKETSEVER]
IP=$IP
PORT=8888

" > config.conf


echo "=========================================================";
echo "install Success";

























