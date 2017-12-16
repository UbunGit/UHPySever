/**
* 2016.4.13 xiaoqy
* 修改或添加参数
*/
use SmartHomeDb;

DROP PROCEDURE  if exists p_ReplaceInterFaceParameter; 
DELIMITER //

CREATE PROCEDURE p_ReplaceInterFaceParameter(

IN  parameterName_in text,       #参数名
IN  parameterFatherName_in text, #接口名
IN  parameterDescribe_in text,   #参数描述
IN  parameterCanNil_in text,     #参数可以为空
IN  parameterEndTime_in text,    #参数结束使用时间
IN  parameterBeginVersions_in text, #参数开始版本
IN  parameterEndVersions_in text,#参数结束版本
IN  parameterType_in text,       #参数类型 text,int
IN  parameterTypeuse_in text     #参数用途（输入1001，输出1002）

)  
BEGIN 

    SELECT COUNT(parameterName) INTO @Count 
    FROM SmartHomeParameter_Table 
    WHERE parameterName = parameterName_in 
	AND parameterFatherName = parameterFatherName_in;
    
    IF @Count>0 THEN
    
        UPDATE SmartHomeParameter_Table SET 
        parameterDescribe = parameterDescribe_in,
        parameterCanNil = parameterCanNil_in,
        parameterEndTime = parameterEndTime_in,
        parameterBeginVersions = parameterBeginVersions_in,
        parameterEndVersions = parameterEndVersions_in,
        parameterType = parameterType_in,
        parameterTypeuse = parameterTypeuse_in
        WHERE parameterName = parameterName_in  
	    AND parameterFatherName = parameterFatherName_in;  
        
	ELSE 
        INSERT SmartHomeParameter_Table SET 
        parameterDescribe = parameterDescribe_in,
        parameterCanNil = parameterCanNil_in,
        parameterEndTime = parameterEndTime_in,
        parameterBeginVersions = parameterBeginVersions_in,
        parameterEndVersions = parameterEndVersions_in,
        parameterType = parameterType_in,
        parameterTypeuse = parameterTypeuse_in,
		parameterName = parameterName_in, 
	    parameterFatherName = parameterFatherName_in; 
     END IF;   
    SELECT*FROM SmartHomeParameter_Table;

END;   

//  
DELIMITER ; 

#call p_ReplaceInterFaceParameter('interFaceName','getInterFaceInfo','','','','','','','');





