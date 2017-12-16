

/**
* xiaoqy 2016/8/19
* 单条遗漏数据插入到遗漏表中
*/
use SmartHomeDb;

DROP procedure  if exists pr_insterOneOmitDataToTable; 
DELIMITER //

create procedure pr_insterOneOmitDataToTable(

IN  TableName_in text,
IN  outNO_in int
)   

begin

    select outDate ,out_bai,out_shi,out_ge into @outdate, @outbai,@outshi,@outge from  FC3DData_t where outNO= outNO_in;

    #查询要查询的出球编号对应上次出0的最大编号@maxNO
    set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_ge=0");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;
	set @excute_sql = concat("select count(outNO) into @Ge_Zero
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
    
	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_ge=1 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;
	set @excute_sql = concat("select count(outNO) into @Ge_One
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
    
	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_ge=2 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;
	set @excute_sql = concat("select count(outNO) into @Ge_Two
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
    
	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_ge=3 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;
	set @excute_sql = concat("select count(outNO) into @Ge_Three
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO> @maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_ge=4 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;        
	set @excute_sql = concat("select count(outNO) into @Ge_Four
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_ge=5 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;        
	set @excute_sql = concat("select count(outNO) into @Ge_Five
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_ge=6 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;        
	set @excute_sql = concat("select count(outNO) into @Ge_Six
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_ge=7 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;        
	set @excute_sql = concat("select count(outNO) into @Ge_Seven
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_ge=8 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;        
	set @excute_sql = concat("select count(outNO) into @Ge_Eight
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_ge=9 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;
	set @excute_sql = concat("select count(outNO) into @Ge_Nine
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_shi=0 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;
	set @excute_sql = concat("select count(outNO) into @Shi_Zero
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_shi=1 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;
	set @excute_sql = concat("select count(outNO) into @Shi_One
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_shi=2 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;
	set @excute_sql = concat("select count(outNO) into @Shi_Two
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_shi=3 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;        
	set @excute_sql = concat("select count(outNO) into @Shi_Three
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_shi=4 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;        
	set @excute_sql = concat("select count(outNO) into @Shi_Four
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
    
	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_shi=5 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;
	set @excute_sql = concat("select count(outNO) into @Shi_Five
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_shi=6 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;        
	set @excute_sql = concat("select count(outNO) into @Shi_Six
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_shi=7 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;        
	set @excute_sql = concat("select count(outNO) into @Shi_Seven
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
	
	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_shi=8 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;
	set @excute_sql = concat("select count(outNO) into @Shi_Eight
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_shi=9 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;
	set @excute_sql = concat("select count(outNO) into @Shi_Nine
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_bai=0 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;
	set @excute_sql = concat("select count(outNO) into @Bai_Zero
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_bai=1 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;
	set @excute_sql = concat("select count(outNO) into @Bai_One
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_bai=2 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;        
	set @excute_sql = concat("select count(outNO) into @Bai_Two
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_bai=3 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;
	set @excute_sql = concat("select count(outNO) into @Bai_Three
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_bai=4 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;
	set @excute_sql = concat("select count(outNO) into @Bai_Four
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_bai=5 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;
	set @excute_sql = concat("select count(outNO) into @Bai_Five
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_bai=6 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;
	set @excute_sql = concat("select count(outNO) into @Bai_Six
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_bai=7 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;
	set @excute_sql = concat("select count(outNO) into @Bai_Seven
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_bai=8 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;        
	set @excute_sql = concat("select count(outNO) into @Bai_Eight
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

	set @excute_sql = concat("select max(outNO) into @maxNO from FC3DData_t where  outNO<='",outNO_in ,"' and out_bai=9 ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
        
	if  @maxNO is null then
		set @excute_sql = concat("select min(outNO) into @maxNO from FC3DData_t  ");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;
       
	end if;  
	set @excute_sql = concat("select count(outNO) into @Bai_Nine
								from FC3DData_t 
								where outNO<='",outNO_in ,"'and outNO>@maxNO");
        PREPARE sqlStr FROM @excute_sql;
        EXECUTE sqlStr;

    set @outdata = concat(@outbai,@outshi,@outge);
    set @excute_sql = concat(
							"replace ",
              TableName_in ,
              " set  outNO= ",
              outNO_in,
              ",outdate= '",
              @outdate,
              "',outdata= '",
              @outdata,
							 "' ,Bai_Zero= ",@Bai_Zero,
                             ", Bai_One= ",@Bai_One,
                             ", Bai_Two= ",@Bai_Two,
							 ",Bai_Three= ",@Bai_Three,
                             ", Bai_Four= ",@Bai_Four,
                             ", Bai_Five= ",@Bai_Five,
							 ",Bai_Six= ",@Bai_Six,
                             ", Bai_Seven= ",@Bai_Seven,
                             ", Bai_Eight= ",@Bai_Eight,
							 ",Bai_Nine= ",@Bai_Nine,
                             ", Shi_Zero= ",@Shi_Zero,
                             ", Shi_One= ",@Shi_One,
							 ",Shi_Two= ",@Shi_Two,
                             ", Shi_Three= ",@Shi_Three,
                             ", Shi_Four= ",@Shi_Four,
							 ",Shi_Five= ",@Shi_Five,
                             ", Shi_Six= ",@Shi_Six,
                             ", Shi_Seven= ",@Shi_Seven,
							 ",Shi_Eight= ",@Shi_Eight,
                             ", Shi_Nine= ",@Shi_Nine,
                             ", Ge_Zero= ",@Ge_Zero,
							 ",Ge_One= ",@Ge_One,
                             ", Ge_Two= ",@Ge_Two,
                             ", Ge_Three= ",@Ge_Three,
							 ",Ge_Four= ",@Ge_Four,
                             ", Ge_Five= ",@Ge_Five,
                             ", Ge_Six= ",@Ge_Six,
							 ",Ge_Seven= ",@Ge_Seven,
                             ", Ge_Eight= ",@Ge_Eight,
                             ", Ge_Nine= ",@Ge_Nine,
                             ";");

	PREPARE sqlStr FROM @excute_sql;

	EXECUTE sqlStr;
        
	

END;   

//
DELIMITER ;


-- use SmartHomeDb;
-- select outDate  from  FC3DData_t where outNO= 2002098;
-- call pr_insterOneOmitDataToTable("FC3DOmitData_table",2002098);
-- select * from  FC3DOmitData_table where outNO = 2002098;

