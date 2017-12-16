

/**
* xiaoqy 2016/8/19
*单条数据插入到统计表中
*/
use SmartHomeDb;

DROP procedure  if exists pr_insterOneProbabilityDataToTable; 
DELIMITER //

create procedure pr_insterOneProbabilityDataToTable(
IN  probability_in int,   #统计的数量
IN  TableName_in text,
IN  outNO_in int
)   

begin
    set @outNO = outNO_in;
    set @beginlimit = probability_in-1;
	if @outNO = 0 then 
	
        set @excute_sql = concat("select outNO into @outNO from FC3DData_t order by outNO  limit ",@beginlimit,",1;");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
		
    end if;

 
 #创建临时表
    drop temporary table if exists temtable;
	set @excute_sql = concat(
							"create temporary table temtable 
							select * from FC3DData_t where outNO<= ",@outNO," 
                            order by outNO desc limit 0,",probability_in,";");
	
	PREPARE sqlStr FROM @excute_sql;
	EXECUTE sqlStr;
 
	select count(*) into @temCount from  temtable;
    if @temCount=probability_in then
   
	select out_ge ,out_shi, out_bai,outdate into @ge,@shi,@bai,@outDate  from temtable where outNO = @outNO;

	select count(out_ge) into @countge from temtable where out_ge = @ge;
    select count(out_shi) into @countshi from temtable where out_shi = @shi;
    select count(out_bai) into @countbai from temtable where out_bai = @bai;
	
    set @excute_sql = concat(
							"replace ",TableName_in ,
                             " set  outNO= ",@outNO,
                             ", outDate= '",@outDate,
							 "',out_ge= ",@countge,
                             ", out_shi= ",@countshi,
                             ", out_bai= ",@countbai,
                             ";");
  
	PREPARE sqlStr FROM @excute_sql;
	EXECUTE sqlStr;
    end if;
END;   

//  
DELIMITER ; 

#call pr_insterOneProbabilityDataToTable(5,'FC3Dprobability_5Table',2002010);
#select max(outNO) from FC3Dprobability_5Table;

