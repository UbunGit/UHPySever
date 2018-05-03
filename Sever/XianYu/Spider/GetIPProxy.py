#!/usr/bin/env python
# encoding: utf-8

from os.path import exists
from random import choice
from re import findall
from time import localtime
from traceback import print_exc
from threading import Thread

from requests import get

# 已抓取
url_kuaidaili = "http://www.kuaidaili.com/free/"
url_66ip = "http://www.66ip.cn/nmtq.php?getnum=512&isp=0&anonymoustype=0&start=&ports=&export=&ipaddress=&area=0&proxytype=2&api=66ip"
url_xicidaili = "http://www.xicidaili.com/nn/"
url_yundaili = "http://www.ip3366.net/free/"
url_proxy360 = "http://www.proxy360.cn/Region/China"
url_mimi = "http://www.mimiip.com/"
url_data5u = "http://www.data5u.com/free/index.shtml"
url_ip181 = "http://www.ip181.com/"
url_kaixindaili = "http://www.kxdaili.com/"
# 测试连接
test_url = "http://www.baidu.com"

available_ip_path = './aip.txt'
tmp_ip_path = './tip.txt'

user_agents = [
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.47 Safari/537.36",
    "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36",
    "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36",
    "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; AcooBrowser; .NET CLR 1.1.4322; .NET CLR 2.0.50727)",
    "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; Acoo Browser; SLCC1; .NET CLR 2.0.50727; Media Center PC 5.0; .NET CLR 3.0.04506)",
    "Mozilla/4.0 (compatible; MSIE 7.0; AOL 9.5; AOLBuild 4337.35; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)",
    "Mozilla/5.0 (Windows; U; MSIE 9.0; Windows NT 9.0; en-US)",
    "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Win64; x64; Trident/5.0; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 2.0.50727; Media Center PC 6.0)",
    "Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 1.0.3705; .NET CLR 1.1.4322)",
    "Mozilla/4.0 (compatible; MSIE 7.0b; Windows NT 5.2; .NET CLR 1.1.4322; .NET CLR 2.0.50727; InfoPath.2; .NET CLR 3.0.04506.30)",
    "Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN) AppleWebKit/523.15 (KHTML, like Gecko, Safari/419.3) Arora/0.3 (Change: 287 c9dfb30)",
    "Mozilla/5.0 (X11; U; Linux; en-US) AppleWebKit/527+ (KHTML, like Gecko, Safari/419.3) Arora/0.6",
    "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.2pre) Gecko/20070215 K-Ninja/2.1.1",
    "Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9) Gecko/20080705 Firefox/3.0 Kapiko/3.0",
    "Mozilla/5.0 (X11; Linux i686; U;) Gecko/20070322 Kazehakase/0.4.5",
    "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.0.8) Gecko Fedora/1.9.0.8-1.fc10 Kazehakase/0.5.6",
    "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11",
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_3) AppleWebKit/535.20 (KHTML, like Gecko) Chrome/19.0.1036.7 Safari/535.20",
    "Opera/9.80 (Macintosh; Intel Mac OS X 10.6.8; U; fr) Presto/2.9.168 Version/11.52",
    "Mozilla/5.0 (Windows; U; Windows NT 5.2) Gecko/2008070208 Firefox/3.0.1",
    "Mozilla/5.0 (Windows; U; Windows NT 5.1) Gecko/20070309 Firefox/2.0.0.3",
    "Mozilla/5.0 (Windows; U; Windows NT 5.1) Gecko/20070803 Firefox/1.5.0.12",
    "Opera/9.27 (Windows NT 5.2; U; zh-cn)",
    "Mozilla/5.0 (Windows; U; Windows NT 5.2) AppleWebKit/525.13 (KHTML, like Gecko) Version/3.1 Safari/525.13",
    "Mozilla/5.0 (iPhone; U; CPU like Mac OS X) AppleWebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/4A93 ",
    "Mozilla/5.0 (Windows; U; Windows NT 5.2) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.2.149.27 ",
    "Mozilla/5.0 (Linux; U; Android 3.2; ja-jp; F-01D Build/F0001) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13 ",
    "Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_1 like Mac OS X; ja-jp) AppleWebKit/532.9 (KHTML, like Gecko) Version/4.0.5 Mobile/8B117 Safari/6531.22.7",
    "Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_2_1 like Mac OS X; da-dk) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8C148 Safari/6533.18.5 ",
    "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_6; en-US) AppleWebKit/530.9 (KHTML, like Gecko) Chrome/ Safari/530.9 ",
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_0) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11",
    "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; 360SE)",
    "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.11 (KHTML, like Gecko) Ubuntu/11.10 Chromium/27.0.1453.93 Chrome/27.0.1453.93 Safari/537.36",
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.93 Safari/537.36",
    "Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.94 Safari/537.36"
]


def GetPageContent(tar_url):
    try:
        ua = choice(user_agents)
        url_content = get(tar_url,
                               headers={
                                   'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                                   'Accept-Encoding': 'gzip, deflate, compress',
                                   'Accept-Language': 'zh-CN,zh;q=0.8,en;q=0.6,ru;q=0.4',
                                   'Cache-Control': 'no-cache',
                                   'Connection': 'keep-alive',
                                   'Upgrade-Insecure-Requests': "1",
                                   'User-Agent': ua
                               }).text
        return url_content
    except BaseException as e:
        print_exc()
        print('\n\n\n')
        return ""

def getips():


    # 获取66ip代理
    url_content = GetPageContent(url_66ip)
    ip_list = findall("(\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}:\d{2,4}?)<br />", url_content)

    # 获取快代理
    url_content = GetPageContent(url_kuaidaili)
    tmp_ip_list = findall("IP\">(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}?)</td>\s*<td data-title=\"PORT\">(\d{2,4}?)</td>", url_content)

    for item in tmp_ip_list:
        ip_list.append("{}:{}".format(item[0], item[1]))

    # 获取xicidaili
    url_content = GetPageContent(url_xicidaili)
    tmp_ip_list = findall("<td>(\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}?)</td>\s*<td>(\d{2,4}?)</td>", url_content)

    for item in tmp_ip_list:
        ip_list.append("{}:{}".format(item[0], item[1]))

    # 获取云代理
    url_content = GetPageContent(url_yundaili)
    tmp_ip_list = findall("<td>(\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}?)</td>\s*<td>(\d{2,4}?)</td>", url_content)
    for item in tmp_ip_list:
        ip_list.append("{}:{}".format(item[0], item[1]))

    # 获取代理360
    url_content = GetPageContent(url_proxy360)
    tmp_ip_list = findall(
        ">\s*(\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}?)\s*</span>\s*.*width:50px;\">\s*(\d{2,4}?)\s*</span>", url_content)

    for item in tmp_ip_list:
        ip_list.append("{}:{}".format(item[0], item[1]))

    #获取秘密代理
    url_content = GetPageContent(url_mimi)
    tmp_ip_list = findall(r"<tr>\s+<td>[\d\.]+</td>\s+<td>\d+</td>", url_content)
    for item in tmp_ip_list:
        ip_list.append("{}:{}".format(item[0], item[1]))

    # 获取data无忧代理
    url_content = GetPageContent(url_data5u)
    tmp_ip_list = findall(r"<li>([\d\.]+)</li></span>\s+<span style=\"width: 100px;\"><li class=\".*\">(\d+)</li>", url_content)
    for item in tmp_ip_list:
        ip_list.append("{}:{}".format(item[0], item[1]))

    # 获取IP181代理
    url_content = GetPageContent(url_ip181)
    tmp_ip_list = findall(r"<tr.*>\s+<td>([\d\.]+)</td>\s+<td>([\d]+)</td>", url_content)
    for item in tmp_ip_list:
        ip_list.append("{}:{}".format(item[0], item[1]))

    # 获取开心代理
    url_content = GetPageContent(url_kaixindaili)
    tmp_ip_list = findall(r"<tr.*>\s+<td>([\d\.]+)</td>\s+<td>([\d]+)</td>", url_content)
    for item in tmp_ip_list:
        ip_list.append("{}:{}".format(item[0], item[1]))


    # 验证完，先把可用ip写入临时文件
    with open(tmp_ip_path, 'w')as fw:
        fw.write('')
    thread_list = []
    for item in ip_list:
        thread_list.append(Thread(target=vetifyip, args=(item.split(':')[0], item.split(':')[1])))
    for item in thread_list:
        item.start()
    for item in thread_list:
        item.join()


    # 将可用ip一次性复制到可用ip文件
    with open(tmp_ip_path, 'r') as fr:
        tmp_ip_content = fr.read()
    with open(available_ip_path, 'w') as fw:
        if len(tmp_ip_content)>0:
            fw.write("{}{}".format(tmp_ip_content, '\n'))
        else:
            print("没有可用的代理")


def vetifyip(ip, port):
    proxies = {"http": "http://" + ip + ":" + port}
    try:
        ua = choice(user_agents)
        url_content = get(test_url,
                                   proxies=proxies,
                                   timeout=20,
                                   headers={
                                       'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                                       'Accept-Encoding': 'gzip, deflate, compress',
                                       'Accept-Language': 'zh-CN,zh;q=0.8,en;q=0.6,ru;q=0.4',
                                       'Cache-Control': 'no-cache',
                                       'Connection': 'keep-alive',
                                       'User-Agent': ua
                                   })
        if url_content.status_code == 200:
            with open(tmp_ip_path, 'a')as fa:
                print(str(ip)+str(port)+" 验证成功")
                fa.write("{}:{}{}".format(ip, port, '\n'))
    except BaseException as e:
        print(str(ip)+str(port)+" 验证失败")
        pass


def GetIpToUse():
    with open('aip.txt', 'r') as fr:
        ip_list = fr.read().split()
        ip_send = choice(ip_list)
        dict_send = {"http": "http://" + ip_send, "https:": "https:" + ip_send}
    return dict_send


if __name__ == '__main__':
    # main for test
    getips()
    # vetifyip("123.207.150.111","8888")

