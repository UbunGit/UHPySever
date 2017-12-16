/*
* xiaoqy 2016/8/18
＊根据统计个数创建3d统计表
＊如果已存在则删除原来的表
*/
use SmartHomeDb;

DROP PROCEDURE  if exists p_creatFC3DStatisticsCountTable; 
DELIMITER //

CREATE PROCEDURE p_creatFC3DStatisticsCountTable(
IN  tableName text#统计的数量
)  
BEGIN 

    /*
    创建频率表
    */
    set @create_sql = CONCAT('create table if not exists ',tableName,
    '(outNO int not null primary key,#开奖期号
     outdate date not null,#开奖日期
	out_ge int(4) not null,#个位出球
	out_shi int(4) not null,#十位出球
	out_bai int(4) not null,#百位出球
	unique(outNO))');
    PREPARE createTable FROM @create_sql;
    EXECUTE createTable ; 

END;   

//  
DELIMITER ; 

#call p_creatFC3DStatisticsCountTable("TestTable");