/*
* xiaoqy 2015/8/25
*/


#删除之前的数据库

DELETE FROM mysql.user WHERE user='SmartHome' AND host='%';
DELETE FROM mysql.user WHERE user='SmartHome' AND host='localhost';

drop database if  exists SmartHomeDb;
create database SmartHomeDb DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
use SmartHomeDb;
#创建用户名密码
FLUSH PRIVILEGES;
CREATE USER 'SmartHome'@'localhost' IDENTIFIED BY 'SmartHome';

GRANT ALL PRIVILEGES ON `SmartHomeDb`.* TO 'SmartHome'@'%' IDENTIFIED BY 'SmartHome' 
REQUIRE NONE WITH
GRANT OPTION MAX_QUERIES_PER_HOUR 0 
MAX_CONNECTIONS_PER_HOUR 0 
MAX_UPDATES_PER_HOUR 0 
MAX_USER_CONNECTIONS 0;

GRANT ALL PRIVILEGES ON `SmartHome\_%`.* TO 'SmartHome'@'%';







