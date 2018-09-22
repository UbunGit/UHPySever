# encoding:utf-8
'''
Created on 2017年4月15日

@author: UbunGit
'''

class CustomError(Exception):

    def __init__(self,code,info = None):
        super(CustomError, self).__init__()
        self.code = code;
        self.info = info;
        self.message = self.errResponses[code];

    def __str__(self):
        return self.message +  "\tinfo:"+ str(self.info)

    errResponses = {

        #sql错误'''
        -10000: ('sql error'),
        -10001: ("会员账号不存在"),
        -10002: ("会员账号未注册或密码错误"),
        -10003: ("Member account already exists"),
        -10004: ("select data is null"),
        -10005: ("interface is has in data"),
        -10006: ('sever get map value is not key'),
        -10007: ("非法查询sql"),


        #接口错误'''
        -20000: ("sever is error"),
        -20001: ('interFace not define'),
        -20002: ('input value has nil'),
        -20003: ('interface not define'),
        -20004: ('user not login'),
        -20005: ("参数有空"),
        -20006: ("图片上传类型不正确"),
        -20007: ("用户登录环境异常"),

        #微信服务器错误'''
        -30001: ("wx 服务器异常"),
        -30002: ("wx 服务器获取数据失败"),

    }

if __name__ == '__main__':

    try:
        raise CustomError(-20000)
    except CustomError as e:
        print(e)