

/**
* xiaoqy 2016/8/19
* 单条组选频率表录入
*/
use SmartHomeDb;
DROP procedure  if exists pr_insterOneZUProbabilityDataToTable; 
DELIMITER //

create procedure pr_insterOneZUProbabilityDataToTable(
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

	select count(out_ge) into @countge1 from temtable where out_ge = @ge ;
    select count(out_ge) into @countge2 from temtable where out_shi = @ge ;
    select count(out_ge) into @countge3 from temtable where out_bai = @ge ;
    select count(out_shi) into @countshi1 from temtable where out_ge = @shi;
    select count(out_shi) into @countshi2 from temtable where out_shi = @shi;
    select count(out_shi) into @countshi3 from temtable where out_bai = @shi;
    select count(out_bai) into @countbai1 from temtable where out_ge = @bai;
    select count(out_bai) into @countbai2 from temtable where out_shi = @bai;
    select count(out_bai) into @countbai3 from temtable where out_bai = @bai;
    set @countge = @countge1+@countge2+@countge3;
    set @countshi = @countshi1+@countshi2+@countshi3;
    set @countbai = @countbai1+@countbai2+@countbai3;
	
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

-- call pr_insterOneZUProbabilityDataToTable(5,'FC3DprobabilityZU_5Table',2002010);
-- select * from FC3DprobabilityZU_5Table;
-- 
-- select count(outNO) from FC3DprobabilityZU_5Table where out_shi =1 and outNO<2002130;

