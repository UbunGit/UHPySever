

/**
* xiaoqy 2016/8/19
*获取推荐数据
*/
use SmartHomeDb;
DROP procedure  if exists pr_getRecommendData; 
DELIMITER //

create procedure pr_getRecommendData(
IN  Probability_in int,   #统计的数量
IN  TableName_in text,
IN  RecommendTableName_in text,
IN  OutNO_in int,
IN  BeginDate int,
IN  EndDate int
)   

begin
    set @outNO = OutNO_in;
    set @beginlimit = Probability_in-1;

 #创建临时表
    drop temporary table if exists temtable;
	set @excute_sql = concat(
							"create temporary table temtable 
							select * from FC3DData_t where outNO< ",@outNO," 
                            order by outNO desc limit 0,",@beginlimit,";");
	
	PREPARE sqlStr FROM @excute_sql;
	EXECUTE sqlStr;
    
 
	drop temporary table if exists temProbabilitytable;
	set @excute_sql = concat(
							"create temporary table temProbabilitytable 
							select * from ",TableName_in," where outNO >",BeginDate," and outNO<=",EndDate,";");
	
	PREPARE sqlStr FROM @excute_sql;
	EXECUTE sqlStr;
	set @outDate = '0000-00-00';
    select outdate into @outDate from FC3DData_t where outNO = @outNO;
	if  @outDate= '0000-00-00' then
 	set @outDate = date(now());
 	end if;
    
    select count(outNO) into @allCount from temProbabilitytable;
     
	#百位0
    select count(outNO) into @countBaiZero from temtable where out_bai=0;
    set @countBaiZero=@countBaiZero+1.0;
  
    
     #百位1
	select count(outNO) into @countBaiOne from temtable where out_bai=1;
    set @countBaiOne=@countBaiOne+1.0;

   
    #百位2
	select count(outNO) into @countBaiTwo from temtable where out_bai=2;
    set @countBaiTwo=@countBaiTwo+1.0;
   
	#百位3
	select count(outNO) into @countBaiThree from temtable where out_bai=3;
    set @countBaiThree=@countBaiThree+1.0;
    
    #百位4
	select count(outNO) into @countBaiFour from temtable where out_bai=4;
    set @countBaiFour=@countBaiFour+1.0;
    
    #百位5
    select count(outNO) into @countBaiFive from temtable where out_bai=5;
    set @countBaiFive=@countBaiFive+1.0;
    
     #百位6
	select count(outNO) into @countBaiSix from temtable where out_bai=6;
    set @countBaiSix=@countBaiSix+1.0;

    #百位7
	select count(outNO) into @countBaiSeven from temtable where out_bai=7;
    set @countBaiSeven=@countBaiSeven+1.0;
    
	#百位8
	select count(outNO) into @countBaiEight from temtable where out_bai=8;
    set @countBaiEight=@countBaiEight+1.0;
    
    #百位9
	select count(outNO) into @countBaiNine from temtable where out_bai=9;
    set @countBaiNine=@countBaiNine+1.0;
    
    
    #十位0
    select count(outNO) into @countShizero from temtable where out_shi=0;
    set @countShizero=@countShizero+1.0;
    
     #十位1
	select count(outNO) into @countShiOne from temtable where out_shi=1;
    set @countShiOne=@countShiOne+1.0;
    
    #十位2
	select count(outNO) into @countShiTwo from temtable where out_shi=2;
    set @countShiTwo=@countShiTwo+1.0;
    
	#十位3
	select count(outNO) into @countShiThree from temtable where out_shi=3;
    set @countShiThree=@countShiThree+1.0;
    
    #十位4
	select count(outNO) into @countShiFour from temtable where out_shi=4;
    set @countShiFour=@countShiFour+1.0;
    
    #十位5
    select count(outNO) into @countShiFive from temtable where out_shi=5;
    set @countShiFive=@countShiFive+1.0;
    
     #十位6
	select count(outNO) into @countShiSix from temtable where out_shi=6;
    set @countShiSix=@countShiSix+1.0;
  
    #十位7
	select count(outNO) into @countShiSeven from temtable where out_shi=7;
    set @countShiSeven=@countShiSeven+1.0;
 
	#十位8
	select count(outNO) into @countShiEight from temtable where out_shi=8;
    set @countShiEight=@countShiEight+1.0;
  
    #十位9
	select count(outNO) into @countShiNine from temtable where out_shi=9;
    set @countShiNine=@countShiNine+1.0;
  
	#个位0
    select count(outNO) into @countGezero from temtable where out_ge=0;
    set @countGezero=@countGezero+1.0;
  
     #个位1
	select count(outNO) into @countGeOne from temtable where out_ge=1;
    set @countGeOne=@countGeOne+1.0;
   
    #个位2
	select count(outNO) into @countGeTwo from temtable where out_ge=2;
    set @countGeTwo=@countGeTwo+1.0;
  
	#个位3
	select count(outNO) into @countGeThree from temtable where out_ge=3;
    set @countGeThree=@countGeThree+1.0;
   
    #个位4
	select count(outNO) into @countGeFour from temtable where out_ge=4;
    set @countGeFour=@countGeFour+1.0;
 
    #个位5
    select count(outNO) into @countGeFive from temtable where out_ge=5;
    set @countGeFive=@countGeFive+1.0;
  
     #个位6
	select count(outNO) into @countGeSix from temtable where out_ge=6;
    set @countGeSix=@countGeSix+1.0;
  
    #个位7
	select count(outNO) into @countGeSeven from temtable where out_ge=7;
    set @countGeSeven=@countGeSeven+1.0;

	#个位8
	select count(outNO) into @countGeEight from temtable where out_ge=8;
    set @countGeEight=@countGeEight+1.0;
   
    #个位9
	select count(outNO) into @countGeNine from temtable where out_ge=9;
    set @countGeNine=@countGeNine+1.0;

    set @excute_sql = concat(
							"replace ",RecommendTableName_in ,
                            "  set outNO=",@outNO,
                            ", outdate='",@outDate,
							"', Bai_Zero=",@countBaiZero,
							", Bai_One=",@countBaiOne,
                            ", Bai_Two=",@countBaiTwo,
                            ", Bai_Three=",@countBaiThree,
                            ", Bai_Four=",@countBaiFour,
                            ", Bai_Five=",@countBaiFive,
                            ", Bai_Six=",@countBaiSix,
                            ", Bai_Seven=",@countBaiSeven,
                            ", Bai_Eight=",@countBaiEight,
                            ", Bai_Nine=",@countBaiNine,
                            ", Shi_Zero=",@countShiZero,
                            ", Shi_One=",@countShiOne,
                            ", Shi_Two=",@countShiTwo,
                            ", Shi_Three=",@countShiThree,
                            ", Shi_Four=",@countShiFour,
                            ", Shi_Five=",@countShiFive,
                            ", Shi_Six=",@countShiSix,
                            ", Shi_Seven=",@countShiSeven,
                            ", Shi_Eight=",@countShiEight,
                            ", Shi_Nine=",@countShiNine,
                            ", Ge_Zero=",@countGeZero,
                            ", Ge_One=",@countGeOne,
                            ", Ge_Two=",@countGeTwo,
                            ", Ge_Three=",@countGeThree,
                            ", Ge_Four=",@countGeFour,
                            ", Ge_Five=",@countGeFive,
                            ", Ge_Six=",@countgeSix,
                            ", Ge_Seven=",@countGeSeven,
                            ", Ge_Eight=",@countGeEight,
                            ", Ge_Nine=",@countGeNine,
							";");

	PREPARE sqlStr FROM @excute_sql;
	EXECUTE sqlStr;
 
	set @excute_sql = concat(
							"select * from ",RecommendTableName_in," where outNO=",@outNO,";");
	
	PREPARE sqlStr FROM @excute_sql;
	EXECUTE sqlStr;
END;   

//  
DELIMITER ;
use SmartHomeDb;

#call pr_getRecommendData( 5,'FC3Dprobability_5Table' ,'FC3DRecResult_5Table',99999999,00000000,90000000);


