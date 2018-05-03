#!/usr/bin/env python
# encoding: utf-8
"""
@author: liuyw
"""
from splinter.browser import Browser
from time import sleep
import traceback
import time, sys






class damai(object):
    username = "13923497592"
    password = "Qiangyuan123"
    """网址"""

    home_url = "https://www.damai.cn/"
    login_url = "https://www.damai.cn/redirect.aspx?spm=a2o6e.home.0.0.591b48d3J30xXZ&type=login"
    firstUrl = ""




    def __init__(self):
        self.driver_name='chrome'
        self.executable_path='/usr/local/bin/chromedriver'

    def start(self):
        try:
            self.driver=Browser(driver_name=self.driver_name,executable_path=self.executable_path)
            self.driver.driver.set_window_size(800, 800)
            self.driver.visit(self.home_url)
            self.driver.cookies.add({"damai.cn_email": "13923497592"})
            self.driver.cookies.add({"damai.cn_msgCount": "0"})
            self.driver.cookies.add({"damai.cn_nickName": "%e9%ba%a6%e5%ad%90"})
            self.driver.cookies.add({"damai.cn_user": "/81Gr0X39fNCimPTL4bW1NbITkMd1DpOP/7WNLAzdHywTtqzzD77Agmh8mCoA3b1"})
            self.driver.cookies.add({"damai.cn_user_new": "%2f81Gr0X39fNCimPTL4bW1NbITkMd1DpOP%2f7WNLAzdHywTtqzzD77Agmh8mCoA3b1"})
            self.driver.cookies.add({"damai_cn_user": "/81Gr0X39fNCimPTL4bW1NbITkMd1DpOP/7WNLAzdHywTtqzzD77Agmh8mCoA3b1"})
            self.driver.cookies.add({"damai_login_QRCode": "6d42297e-0474-45a4-975d-26c64e8def1c"})
            self.driver.cookies.add({"damai.cn_email": "13923497592"})
            self.driver.cookies.add({"isg": "BMPDN8Qwnf_rv1GLjCDyMcTGUoGtkFZhK0xvjvWgHiKZtOPWfQjnyqGmKkX6FK9y"})
            self.driver.cookies.add({"x_hm_tuid": "bZmV1v2XlZKb0zVE1LJy1jwY+QX/A8BdLg3bEL11ulfLaI7JI0klBUKra4zP/i4i"})

            loginbtn = self.driver.find_by_text("登录").first
            if(loginbtn):
                self.login()

        except BaseException, ex:
            print("关闭所有由当前测试脚本打开的页面")
            self.driver.quit()

    def login(self):

        self.driver.reload()

        while True:
            if self.driver.url != self.home_url:

                sleep(1)
            else:
                break


if __name__ == '__main__':
    huoche=damai()
    huoche.start()
