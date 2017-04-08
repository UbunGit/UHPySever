#!/bin/bash

echo "=========================================================";
echo "star install";


if [ -d "./MySQL/" ];then
echo "updata mysql";
git pull
else
echo "clone mysql";
git clone https://github.com/UbunGit/MySQL
fi


cd ./MySQL
sh ./sql_Install.sh
cd ../

sh ./updata_1.sh
echo "install  updata_1 ok";

cd ../Sever 

python <<EOF

from HttpSever import HttpSever
HttpSever.start_server(8889)

EOF
echo "=========================================================";
echo "install Success";

























