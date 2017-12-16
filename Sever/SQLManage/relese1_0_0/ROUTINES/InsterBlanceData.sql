use SmartHomeDb;

 
SET SQL_SAFE_UPDATES=0;
delete FROM SmartHomeDb.FC3DDataBalance_t where fatherType=5; 
delete FROM SmartHomeDb.FC3DDataBalance_t where fatherType=10; 
delete FROM SmartHomeDb.FC3DDataBalance_t where fatherType=15; 
delete FROM SmartHomeDb.FC3DDataBalance_t where fatherType=20; 
delete FROM SmartHomeDb.FC3DDataBalance_t where fatherType=25; 
delete FROM SmartHomeDb.FC3DDataBalance_t where fatherType=30; 
delete FROM SmartHomeDb.FC3DDataBalance_t where fatherType=50; 
delete FROM SmartHomeDb.FC3DDataBalance_t where fatherType=100; 


SELECT count(*)/5361*(100/23)  into  @shu2 FROM SmartHomeDb.FC3Dprobability_100Table where out_ge =2;
SELECT count(*)/5361*(100/23)  into @shu3 FROM  SmartHomeDb.FC3Dprobability_100Table where out_ge =3;
SELECT count(*)/5361*(100/23)  into @shu4 FROM  SmartHomeDb.FC3Dprobability_100Table where out_ge =4;
SELECT count(*)/5361*(100/23)  into @shu5 FROM  SmartHomeDb.FC3Dprobability_100Table where out_ge =5;
SELECT count(*)/5361*(100/23)  into @shu6 FROM  SmartHomeDb.FC3Dprobability_100Table where out_ge =6;
SELECT count(*)/5361*(100/23)  into @shu7 FROM  SmartHomeDb.FC3Dprobability_100Table where out_ge =7;
SELECT count(*)/5361*(100/23)  into @shu8  FROM  SmartHomeDb.FC3Dprobability_100Table where out_ge =8;
SELECT count(*)/5361*(100/23)  into @shu9  FROM  SmartHomeDb.FC3Dprobability_100Table where out_ge =9;
SELECT count(*)/5361*(100/23)  into @shu10 FROM SmartHomeDb.FC3Dprobability_100Table where out_ge =10;
SELECT count(*)/5361*(100/23)  into @shu11 FROM SmartHomeDb.FC3Dprobability_100Table where out_ge =11;
SELECT count(*)/5361*(100/23)  into @shu12 FROM SmartHomeDb.FC3Dprobability_100Table where out_ge =12;
SELECT count(*)/5361*(100/23)  into @shu13 FROM SmartHomeDb.FC3Dprobability_100Table where out_ge =13;
SELECT count(*)/5361*(100/23)  into @shu14 FROM SmartHomeDb.FC3Dprobability_100Table where out_ge =14;
SELECT count(*)/5361*(100/23)  into @shu15 FROM SmartHomeDb.FC3Dprobability_100Table where out_ge =15;
SELECT count(*)/5361*(100/23)  into @shu16  FROM  SmartHomeDb.FC3Dprobability_100Table where out_ge =16;
SELECT count(*)/5361*(100/23)  into @shu17  FROM  SmartHomeDb.FC3Dprobability_100Table where out_ge =17;
SELECT count(*)/5361*(100/23)  into @shu18 FROM SmartHomeDb.FC3Dprobability_100Table where out_ge =18;
SELECT count(*)/5361*(100/23)  into @shu19 FROM SmartHomeDb.FC3Dprobability_100Table where out_ge =19;
SELECT count(*)/5361*(100/23)  into @shu20 FROM SmartHomeDb.FC3Dprobability_100Table where out_ge =20;
SELECT count(*)/5361*(100/23)  into @shu21 FROM SmartHomeDb.FC3Dprobability_100Table where out_ge =21;
SELECT count(*)/5361*(100/23)  into @shu22 FROM SmartHomeDb.FC3Dprobability_100Table where out_ge =22;
SELECT count(*)/5361*(100/23)  into @shu23 FROM SmartHomeDb.FC3Dprobability_100Table where out_ge =23;
SELECT count(*)/5361*(100/23)  into @shu24 FROM SmartHomeDb.FC3Dprobability_100Table where out_ge =23;

INSERT FC3DDataBalance_t values 
(100,2,@shu2),
(100,3,@shu3),
(100,4,@shu4),
(100,5,@shu5),
(100,6,@shu6),
(100,7,@shu7),
(100,8,@shu8),
(100,9,@shu9),
(100,10,@shu10),
(100,11,@shu11),
(100,12,@shu12),
(100,13,@shu13),
(100,14,@shu14),
(100,15,@shu15),
(100,16,@shu16),
(100,17,@shu17),
(100,18,@shu18),
(100,19,@shu19),
(100,20,@shu20),
(100,21,@shu21),
(100,22,@shu22),
(100,23,@shu23),
(100,24,@shu24);
 
SELECT count(*)/5361*(50/15)  into  @shu1 FROM SmartHomeDb.FC3Dprobability_50Table where out_ge =1;
SELECT count(*)/5361*(50/15)  into  @shu2 FROM SmartHomeDb.FC3Dprobability_50Table where out_ge =2;
SELECT count(*)/5361*(50/15)  into @shu3 FROM SmartHomeDb.FC3Dprobability_50Table where out_ge =3;
SELECT count(*)/5361*(50/15)  into @shu4 FROM SmartHomeDb.FC3Dprobability_50Table where out_ge =4;
SELECT count(*)/5361*(50/15)  into @shu5 FROM SmartHomeDb.FC3Dprobability_50Table where out_ge =5;
SELECT count(*)/5361*(50/15)  into @shu6 FROM SmartHomeDb.FC3Dprobability_50Table where out_ge =6;
SELECT count(*)/5361*(50/15)  into @shu7 FROM SmartHomeDb.FC3Dprobability_50Table where out_ge =7;
SELECT count(*)/5361*(50/15)  into @shu8 FROM SmartHomeDb.FC3Dprobability_50Table where out_ge =8;
SELECT count(*)/5361*(50/15)  into @shu9 FROM SmartHomeDb.FC3Dprobability_50Table where out_ge =9;
SELECT count(*)/5361*(50/15)  into @shu10 FROM SmartHomeDb.FC3Dprobability_50Table where out_ge =10;
SELECT count(*)/5361*(50/15)  into @shu11 FROM SmartHomeDb.FC3Dprobability_50Table where out_ge =11;
SELECT count(*)/5361*(50/15)  into @shu12 FROM SmartHomeDb.FC3Dprobability_50Table where out_ge =12;
SELECT count(*)/5361*(50/15)  into @shu13 FROM SmartHomeDb.FC3Dprobability_50Table where out_ge =13;
SELECT count(*)/5361*(50/15)  into @shu14 FROM SmartHomeDb.FC3Dprobability_50Table where out_ge =14;
SELECT count(*)/5361*(50/15)  into @shu15 FROM SmartHomeDb.FC3Dprobability_50Table where out_ge =15;

INSERT FC3DDataBalance_t values 
(50,1,@shu1),
(50,2,@shu2),
(50,3,@shu3),
(50,4,@shu4),
(50,5,@shu5),
(50,6,@shu6),
(50,7,@shu7),
(50,8,@shu8),
(50,9,@shu9),
(50,10,@shu10),
(50,11,@shu11),
(50,12,@shu12),
(50,13,@shu13),
(50,14,@shu14),
(50,15,@shu15);

SELECT count(*)/5381*(30/11) into  @shu1 FROM SmartHomeDb.FC3Dprobability_30Table where out_ge =1;
SELECT count(*)/5381*(30/11) into  @shu2 FROM SmartHomeDb.FC3Dprobability_30Table where out_ge =2;
SELECT count(*)/5381*(30/11)  into @shu3 FROM SmartHomeDb.FC3Dprobability_30Table where out_ge =3;
SELECT count(*)/5381*(30/11)  into @shu4 FROM SmartHomeDb.FC3Dprobability_30Table where out_ge =4;
SELECT count(*)/5381*(30/11)  into @shu5 FROM SmartHomeDb.FC3Dprobability_30Table where out_ge =5;
SELECT count(*)/5381*(30/11)  into @shu6 FROM SmartHomeDb.FC3Dprobability_30Table where out_ge =6;
SELECT count(*)/5381*(30/11)  into @shu7 FROM SmartHomeDb.FC3Dprobability_30Table where out_ge =7;
SELECT count(*)/5381*(30/11)  into @shu8 FROM SmartHomeDb.FC3Dprobability_30Table where out_ge =8;
SELECT count(*)/5381*(30/11)  into @shu9 FROM SmartHomeDb.FC3Dprobability_30Table where out_ge =9;
SELECT count(*)/5381*(30/11)  into @shu10 FROM SmartHomeDb.FC3Dprobability_30Table where out_ge =10;
SELECT count(*)/5381*(30/11)  into @shu11 FROM SmartHomeDb.FC3Dprobability_30Table where out_ge =11;

INSERT FC3DDataBalance_t values 
(30,1,@shu1),
(30,2,@shu2),
(30,3,@shu3),
(30,4,@shu4),
(30,5,@shu5),
(30,6,@shu6),
(30,7,@shu7),
(30,8,@shu8),
(30,9,@shu9),
(30,10,@shu10),
(30,11,@shu11);

SELECT count(*)/5386*(25/11) into  @shu1 FROM SmartHomeDb.FC3Dprobability_25Table where out_ge =1;
SELECT count(*)/5386*(25/11) into  @shu2 FROM SmartHomeDb.FC3Dprobability_25Table where out_ge =2;
SELECT count(*)/5386*(25/11)  into @shu3 FROM SmartHomeDb.FC3Dprobability_25Table where out_ge =3;
SELECT count(*)/5386*(25/11)  into @shu4 FROM SmartHomeDb.FC3Dprobability_25Table where out_ge =4;
SELECT count(*)/5386*(25/11)  into @shu5 FROM SmartHomeDb.FC3Dprobability_25Table where out_ge =5;
SELECT count(*)/5386*(25/11)  into @shu6 FROM SmartHomeDb.FC3Dprobability_25Table where out_ge =6;
SELECT count(*)/5386*(25/11)  into @shu7 FROM SmartHomeDb.FC3Dprobability_25Table where out_ge =7;
SELECT count(*)/5386*(25/11)  into @shu8 FROM SmartHomeDb.FC3Dprobability_25Table where out_ge =8;
SELECT count(*)/5386*(25/11)  into @shu9 FROM SmartHomeDb.FC3Dprobability_25Table where out_ge =9;
SELECT count(*)/5386*(25/11)  into @shu8 FROM SmartHomeDb.FC3Dprobability_25Table where out_ge =10;
SELECT count(*)/5386*(25/11)  into @shu9 FROM SmartHomeDb.FC3Dprobability_25Table where out_ge =11;

INSERT FC3DDataBalance_t values 
(25,1,@shu1),
(25,2,@shu2),
(25,3,@shu3),
(25,4,@shu4),
(25,5,@shu5),
(25,6,@shu6),
(25,7,@shu7),
(25,8,@shu8),
(25,9,@shu7),
(25,10,@shu8),
(25,11,@shu9);



SELECT count(*)/5391*(20/9) into  @shu1  FROM SmartHomeDb.FC3Dprobability_20Table where out_ge =1;
SELECT count(*)/5391*(20/9) into  @shu2 FROM SmartHomeDb.FC3Dprobability_20Table where out_ge =2;
SELECT count(*)/5391*(20/9)  into @shu3 FROM SmartHomeDb.FC3Dprobability_20Table where out_ge =3;
SELECT count(*)/5391*(20/9)  into @shu4 FROM SmartHomeDb.FC3Dprobability_20Table where out_ge =4;
SELECT count(*)/5391*(20/9)  into @shu5 FROM SmartHomeDb.FC3Dprobability_20Table where out_ge =5;
SELECT count(*)/5391*(20/9)  into @shu6 FROM SmartHomeDb.FC3Dprobability_20Table where out_ge =6;
SELECT count(*)/5391*(20/9)  into @shu7 FROM SmartHomeDb.FC3Dprobability_20Table where out_ge =7;
SELECT count(*)/5391*(20/9)  into @shu8 FROM SmartHomeDb.FC3Dprobability_20Table where out_ge =8;
SELECT count(*)/5391*(20/9)  into @shu9 FROM SmartHomeDb.FC3Dprobability_20Table where out_ge =9;
;

INSERT FC3DDataBalance_t values
(20,1,@shu1),
(20,2,@shu2),
(20,3,@shu3),
(20,4,@shu4),
(20,5,@shu5),
(20,6,@shu6),
(20,7,@shu7),
(20,8,@shu8),
(20,9,@shu9);

SELECT count(*)/5396*(15/8) into  @shu1  FROM SmartHomeDb.FC3Dprobability_15Table where out_ge =1;
SELECT count(*)/5396*(15/8) into  @shu2 FROM SmartHomeDb.FC3Dprobability_15Table where out_ge =2;
SELECT count(*)/5396*(15/8)  into @shu3 FROM SmartHomeDb.FC3Dprobability_15Table where out_ge =3;
SELECT count(*)/5396*(15/8)  into @shu4 FROM SmartHomeDb.FC3Dprobability_15Table where out_ge =4;
SELECT count(*)/5396*(15/8)  into @shu5 FROM SmartHomeDb.FC3Dprobability_15Table where out_ge =5;
SELECT count(*)/5396*(15/8)  into @shu6 FROM SmartHomeDb.FC3Dprobability_15Table where out_ge =6;
SELECT count(*)/5396*(15/8)  into @shu7 FROM SmartHomeDb.FC3Dprobability_15Table where out_ge =7;
SELECT count(*)/5396*(15/8)  into @shu8 FROM SmartHomeDb.FC3Dprobability_15Table where out_ge =8;

INSERT FC3DDataBalance_t values (15,1,@shu1),(15,2,@shu2),(15,3,@shu3),(15,4,@shu4),(15,5,@shu5),(15,6,@shu6),(15,7,@shu7),(15,8,@shu8);

SELECT count(*)/5401*(10/6) into  @shu1  FROM SmartHomeDb.FC3Dprobability_10Table where out_ge =1;
SELECT count(*)/5401*(10/6) into  @shu2 FROM SmartHomeDb.FC3Dprobability_10Table where out_ge =2;
SELECT count(*)/5401*(10/6)  into @shu3 FROM SmartHomeDb.FC3Dprobability_10Table where out_ge =3;
SELECT count(*)/5401*(10/6)  into @shu4 FROM SmartHomeDb.FC3Dprobability_10Table where out_ge =4;
SELECT count(*)/5401*(10/6)  into @shu5 FROM SmartHomeDb.FC3Dprobability_10Table where out_ge =5;
SELECT count(*)/5401*(10/6)  into @shu6 FROM SmartHomeDb.FC3Dprobability_10Table where out_ge =6;


INSERT FC3DDataBalance_t values 
(10,1,@shu1),
(10,2,@shu2),
(10,3,@shu3),
(10,4,@shu4),
(10,5,@shu5),
(10,6,@shu6);



SELECT count(*)/5406*(5/4) into  @shu1  FROM SmartHomeDb.FC3Dprobability_5Table where out_ge =1;
SELECT count(*)/5406*(5/4) into  @shu2 FROM SmartHomeDb.FC3Dprobability_5Table where out_ge =2;
SELECT count(*)/5406*(5/4) into @shu3 FROM SmartHomeDb.FC3Dprobability_5Table where out_ge =3;
SELECT count(*)/5406*(5/4) into @shu4 FROM SmartHomeDb.FC3Dprobability_5Table where out_ge =4;


INSERT FC3DDataBalance_t values 
(5,1,@shu1),
(5,2,@shu2),
(5,3,@shu3),
(5,4,@shu4);


