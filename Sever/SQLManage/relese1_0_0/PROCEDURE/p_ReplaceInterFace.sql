/**
* 2016.4.13 xiaoqy
* 修改或添加接口参数
*/
use SmartHomeDb;
DROP PROCEDURE  if exists p_ReplaceInterFace; 
DELIMITER //


CREATE PROCEDURE p_ReplaceInterFace(

IN  interFaceName_in text,       #接口名
IN  interFaceNameStr_in text,    #接口中文描述
IN  interFaceDescribe_in text,   #接口描述
IN  interFacepath_in text,       #接口路径
IN  interFaceBeginTime_in text,  #接口开始使用时间
IN  interFaceEndTime_in text,    #接口结束使用时间
IN  interFaceBeginVersions_in text,  #接口开始使用版本
IN  interFaceEndVersions_in text     #接口结束使用版本

)  
BEGIN 

    SELECT COUNT(interFaceName) INTO @Count 
    FROM SmartHomeInterFace_Table 
    WHERE interFaceName = interFaceName_in;
    
    IF @Count>0 THEN
    
        UPDATE SmartHomeInterFace_Table SET 
        interFaceNameStr = interFaceNameStr_in,
        interFaceDescribe = interFaceDescribe_in,
        interFacepath = interFacepath_in,
        interFaceBeginTime = interFaceBeginTime_in,
        interFaceEndTime = interFaceEndTime_in,
        interFaceBeginVersions= interFaceBeginVersions_in,
        interFaceEndVersions = interFaceEndVersions_in
        WHERE interFaceName = interFaceName_in ; 
        
	ELSE 
        INSERT SmartHomeInterFace_Table SET 
         interFaceNameStr = interFaceNameStr_in,
        interFaceDescribe = interFaceDescribe_in,
        interFacepath = interFacepath_in,
        interFaceBeginTime = interFaceBeginTime_in,
        interFaceEndTime = interFaceEndTime_in,
        interFaceBeginVersions= interFaceBeginVersions_in,
        interFaceEndVersions = interFaceEndVersions_in,
        interFaceName = interFaceName_in ; 
        
     END IF;   
    SELECT*FROM SmartHomeInterFace_Table;

END;   

//  
DELIMITER ; 

#call p_ReplaceInterFace('getInputValueList','获取接口列表','','samrtHome','','','','');



