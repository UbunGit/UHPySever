/**
 * 查询会员信息
 * 2016.4.15 xiaoqy
*/
use SmartHomeDb;

DROP PROCEDURE  if exists p_GetUserInfo; 
DELIMITER //
CREATE PROCEDURE p_GetUserInfo(

IN  userName_in text      #用户名
)  
BEGIN 
    select userId ,userName ,userPassWord,userTel, userLevel ,userLogState from SmartHomeUser_Table 
    where userName = userName_in or userTel = userName_in;

END; 
//  
DELIMITER ; 


#use SmartHomeDb;
#select *  from SmartHomeUser_Table 
#call p_GetUserInfo('vip123');