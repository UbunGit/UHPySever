#!/usr//bin/python
# -*- coding: utf-8 -*-
# author: bipabo1l@csoio.com

#永恒之蓝病毒检查

import os
import requests
import time
import re
import commands
import threading
import Queue

list_vul_ip = []

class WyWorker(threading.Thread):
    def __init__(self, queue):
        threading.Thread.__init__(self)
        self.queue = queue

    def run(self):
        while True:
            if self.queue.empty():
                break
            try:
                ip = self.queue.get_nowait()
                if ip:
                    (status, output) = commands.getstatusoutput('nmap -p 445 --script smb-vuln-ms17-010.nse ' + ip)
                    print output
                    if 'CVE' in output:
                        list_vul_ip.append(ip)
            except Exception, e:
                break
        print "scan success"
def main():
    try:
        threads_count = 10
        queue = Queue.Queue()
        print "begin:"
        files = '445_open:' + str(int(time.time()))
        print "scaning:"
        os.system('nmap -iL ip_test.txt -p 445 --open -T4 -oX ./result/%s.txt' % files)
        print "scansuccess"
        file_name = files + '.txt'
        file = open('./result/%s' % file_name)
        f_result = file.read()
        regex = 'addr(.*)addrtype'
        list_ip = set()
        for m in re.findall(regex, f_result):
            list_ip.add(m[10:-2])
        print "445 port open mechines:"
        print list_ip
        for ip in list_ip:
            queue.put(ip)
        print queue.qsize()
        # 初始化线程组
        threads = []
        for i in xrange(threads_count):
            threads.append(WyWorker(queue))

        # 启动线程
        for t in threads:
            t.start()

        # 等待线程执行结束后，回到主线程中
        for t in threads:
            t.join()
        print list_vul_ip

    except Exception as e:
        print(e)


if __name__ == '__main__':
    main()