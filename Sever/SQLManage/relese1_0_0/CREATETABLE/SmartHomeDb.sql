/*
* xiaoqy 2015/8/25
*/


#删除之前的数据库
use mysql;
DELETE FROM mysql.user WHERE user='SmartHome' AND host='%';
DELETE FROM mysql.user WHERE user='SmartHome' AND host='localhost';
drop database if  exists SmartHomeDb;
FLUSH PRIVILEGES;

create database SmartHomeDb DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

use SmartHomeDb;
#创建用户名密码

CREATE USER 'SmartHome'@'localhost' IDENTIFIED BY 'SmartHome';;
CREATE USER 'SmartHome'@'%' IDENTIFIED BY 'SmartHome';;

REVOKE ALL PRIVILEGES ON *.* FROM 'SmartHome'@'%';
GRANT ALL PRIVILEGES ON *.* TO 'SmartHome'@'%';

REVOKE ALL PRIVILEGES ON *.* FROM 'SmartHome'@'localhost';
GRANT ALL PRIVILEGES ON *.* TO 'SmartHome'@'localhost';



FLUSH PRIVILEGES;







