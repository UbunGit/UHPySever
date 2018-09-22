#!/usr/bin/env python
#-*- coding:utf-8 -*-
'''
Name:w8ayScan
Author:w8ay
Copyright (c) 2017
'''

import bcrypt

def main():

    password = bcrypt.hashpw(u"123456".encode('utf-8'), bcrypt.gensalt(8))


    assword = bcrypt.hashpw(password, bcrypt.gensalt(8))

    # Hash a password for the first time, with a randomly-generated salt
    hashed = bcrypt.hashpw(password, bcrypt.gensalt(8))
    # Check that an unhashed password matches one that has previously been
    # hashed
    if bcrypt.checkpw(assword, hashed):
         print("It Matches!")
    else:
        print("It Does not Match :(")

if __name__ == '__main__':
    main()