#!/bin/bash

function install()
{
#创建数据库

echo "准备创建数据库用户SmartHomeDb 并添加管理员SmartHome";

if  ! mysql -u root -p<../SQLManage/relese1_0_0/CREATETABLE/SmartHomeDb.sql
then return -1;
fi

echo "创建数据库用户SmartHomeDb 并添加管理员SmartHome ---👌";
#创建表

if  ! mysql -uSmartHome -pSmartHome <../SQLManage/relese1_0_0/CREATETABLE/CreatdFC3DTable.sql;
then return -1;
fi
echo '创建"FC3DData_t"创建存储3d彩票元数据的表 ---👌';


if  ! mysql -uSmartHome -pSmartHome <../SQLManage/relese1_0_0/ROUTINES/p_getUserInfo.sql;
then return -1;
fi
echo '查询会员信息存储过程创建 ---👌';

if  ! mysql -uSmartHome -pSmartHome <../SQLManage/relese1_0_0/PROCEDURE/p_ReplaceInterFace.sql;
then return -1;
fi
echo '修改或添加接口储过程创建 ---👌';

if  ! mysql -uSmartHome -pSmartHome <../SQLManage/relese1_0_0/PROCEDURE/p_ReplaceUserInfo.sql;
then return -1;
fi
echo '修改会员信息储过程创建 ---👌';

if  ! mysql -uSmartHome -pSmartHome <../SQLManage/relese1_0_0/PROCEDURE/p_creatFC3DOmitTable.sql;
then return -1;
fi



if  ! mysql -uSmartHome -pSmartHome <../SQLManage/relese1_0_0/PROCEDURE/p_creatFC3DRecommendTable.sql;
then return -1;
fi
echo '创建福彩3d遗漏表 ---👌';

if  ! mysql -uSmartHome -pSmartHome <../SQLManage/relese1_0_0/PROCEDURE/p_creatFC3DStatisticsCountTable.sql;
then return -1;
fi
echo '根据统计个数创建3d统计表---👌';

if  ! mysql -uSmartHome -pSmartHome <../SQLManage/relese1_0_0/PROCEDURE/p_getRecommendData.sql;
then return -1;
fi
echo '获取推荐数据---👌';

if  ! mysql -uSmartHome -pSmartHome <../SQLManage/relese1_0_0/PROCEDURE/p_insterOneOmitDataToTable.sql;
then return -1;
fi
echo '单条遗漏数据插入到遗漏表中---👌';

if  ! mysql -uSmartHome -pSmartHome <../SQLManage/relese1_0_0/PROCEDURE/p_insterOneProbabilityDataToTable.sql;
then return -1;
fi
echo '单条数据插入到统计表中---👌';

if  ! mysql -uSmartHome -pSmartHome <../SQLManage/relese1_0_0/PROCEDURE/p_insterOneZUProbabilityDataToTable.sql;
then return -1;
fi
echo '单条组选频率表录入---👌';

if  ! mysql -uSmartHome -pSmartHome <../SQLManage/relese1_0_0/PROCEDURE/p_ReplaceInterFaceParameter.sql;
then return -1;
fi
echo '修改或添加接口参数---👌'


if  ! mysql -uSmartHome -pSmartHome <../SQLManage/relese1_0_0/PROCEDURE/p_creatFC3DRecommendTable.sql;
then return -1;
fi
echo '创建福彩3d频率表---👌';

return 0;
}






