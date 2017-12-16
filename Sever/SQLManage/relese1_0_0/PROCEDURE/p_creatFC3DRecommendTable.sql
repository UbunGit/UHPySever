/*
* xiaoqy 2016/8/18
＊
＊如果已存在则删除原来的表
*/
use SmartHomeDb;

DROP PROCEDURE  if exists p_creatFC3DRecommendTable; 
DELIMITER //

CREATE PROCEDURE p_creatFC3DRecommendTable(
IN  tableName text#统计的数量
)  
BEGIN 

    /*
    创建频率表
    */
    set @create_sql = CONCAT('create table if not exists ',tableName,
    '(outNO int not null primary key,#开奖期号
     outdate date not null,#开奖日期
	Bai_Zero float(4) not null,
    Bai_One float(4) not null,
    Bai_Two float(4) not null,
    Bai_Three float(4) not null,
    Bai_Four float(4) not null,
    Bai_Five float(4) not null,
    Bai_Six float(4) not null,
    Bai_Seven float(4) not null,
	Bai_Eight float(4) not null,
	Bai_Nine float(4) not null,
    Shi_Zero float(4) not null,
    Shi_One float(4) not null,
    Shi_Two float(4) not null,
    Shi_Three float(4) not null,
    Shi_Four float(4) not null,
    Shi_Five float(4) not null,
    Shi_Six float(4) not null,
    Shi_Seven float(4) not null,
	Shi_Eight float(4) not null,
	Shi_Nine float(4) not null,
	Ge_Zero float(4) not null,
    Ge_One float(4) not null,
    Ge_Two float(4) not null,
    Ge_Three float(4) not null,
    Ge_Four float(4) not null,
    Ge_Five float(4) not null,
    Ge_Six float(4) not null,
    Ge_Seven float(4) not null,
	Ge_Eight float(4) not null,
	Ge_Nine float(4) not null,
	unique(outNO))');
    PREPARE createTable FROM @create_sql;
    EXECUTE createTable ; 

END;   

//  
DELIMITER ; 

#call p_creatFC3DRecommendTable("testTable");

