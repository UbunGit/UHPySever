<?php
    
    class myException extends Exception
    {
        
        
        function __toString()
        {
            $messageStr = $this->getMessage();
            $str =	" \r\n* ".date("Y-m-d H:i:s",time())." \r\n* ".'errorCode : '.$this->getCode()." \r\n* ".'message   : '.$messageStr." \r\n* ".'IN: '.$this->getFile()." \r\n* ".'ON LINE   : '.$this->getLine()." \r\n ";
            return $str;
        }
        
        function __toText(){
        	
            $str = $this->__toString();
            return $str;
        }
        
        function __errorlog(){
        	$config= new ConfigINI();
        	$errorLogpath=$config->get('path.errorLogpath');
            if($this->dir_($errorLogpath)){
                $str = $this->__toString();
                error_log($str, 3, $errorLogpath."C_error.log");
            }
        }
        
        /**
         * 检查目录是否存在或是否可创建
         */
        private function dir_($dir) {
        	if(!file_exists($dir)){
        		if (!mkdir($dir, 777, true)) {//0777
        			die('Failed to create folders...'.$dir);
        		}
        	}
            return true;
        }
    }
    
    ?>