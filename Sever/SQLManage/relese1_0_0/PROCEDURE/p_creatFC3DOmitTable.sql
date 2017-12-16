/*
* xiaoqy 2016/8/29
* 创建福彩3d遗漏表
* 如果已存在则删除原来的表
*/
USE SmartHomeDb;

DROP PROCEDURE  if exists p_creatFC3DOmitTable;

DELIMITER //

CREATE PROCEDURE p_creatFC3DOmitTable(
    IN  tableName text#统计的数量
)
BEGIN

        /*
        创建频率表
        */

        set @drop_sql =concat('drop table if exists ',tableName);
        PREPARE dropTable FROM @drop_sql;
        EXECUTE dropTable;

        set @create_sql = CONCAT('create table if not exists ',tableName,
                                 '(outNO int not null primary key,#开奖期号
                                 outdate DATE not null,
                                 outdata text not null,
                               Bai_Zero int(3) not null,
                                 Bai_One int(3) not null,
                                 Bai_Two int(3) not null,
                                 Bai_Three int(3) not null,
                                 Bai_Four int(3) not null,
                                 Bai_Five int(3) not null,
                                 Bai_Six int(3) not null,
                                 Bai_Seven int(3) not null,
                               Bai_Eight int(3) not null,
                               Bai_Nine int(3) not null,
                                 Shi_Zero int(3) not null,
                                 Shi_One int(3) not null,
                                 Shi_Two int(3) not null,
                                 Shi_Three int(3) not null,
                                 Shi_Four int(3) not null,
                                 Shi_Five int(3) not null,
                                 Shi_Six  int(3) not null,
                                 Shi_Seven int(3) not null,
                               Shi_Eight int(3) not null,
                               Shi_Nine int(3) not null,
                               Ge_Zero int(3) not null,
                                 Ge_One int(3) not null,
                                 Ge_Two int(3) not null,
                                 Ge_Three int(3) not null,
                                 Ge_Four int(3) not null,
                                 Ge_Five int(3) not null,
                                 Ge_Six int(3) not null,
                                 Ge_Seven int(3) not null,
                               Ge_Eight int(3) not null,
                               Ge_Nine int(3) not null,
                               unique(outNO))');

        PREPARE createTable FROM @create_sql;
        EXECUTE createTable ;

END;

//
DELIMITER ;
/*
select 'p---创建福彩3d遗漏表,如果已存在则删除原来的表end';
#call p_creatFC3DOmitTable("TestTable");
*/


