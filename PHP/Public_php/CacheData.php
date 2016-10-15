<?php


class CacheData {
	/**
	 * $dir : 缓存文件存放目录
	 * $lifetime : 缓存文件有效期,单位为秒
	 * $cacheid : 缓存文件路径,包含文件名
	 * $ext : 缓存文件扩展名(可以不用),这里使用是为了查看文件方便
	 */
	private $dir;
	private $lifetime;
	private $cacheid;
	private $ext;
    
    
    
	/**
	 * 析构函数,检查缓存目录是否有效,默认赋值
	 */
	function __construct($dir='./Cache/',$lifetime=1800) {
		if ($this->dir_($dir)) {
			$this->dir = $dir;
			$this->lifetime = $lifetime;
			$this->ext = '.dat';
		}
	}
	/**
	 * 检查缓存是否有效
	 */
	private function isvalid($key) {
        
		if (!file_exists($this->getcacheid($key))){
			echo ('');
			$err = new myException ( "文件不存在", - 10001 );
			$err->__errorlog ();
			return false;
		}
		if (!(@$mtime = filemtime($this->getcacheid($key)))){
			
			$err = new myException ( "文件时间不存在", - 10001 );
			$err->__errorlog ();
			return false;
		}
		if (mktime() - $mtime > $this->lifetime){

			$err = new myException ( "文件已失效", - 10001 );
			$err->__errorlog ();
			return false;
		}
		return true;
	}
	/**
	 * 写入缓存
	 * $mode == 0 , 以浏览器缓存的方式取得页面内容
	 * $mode == 1 , 以直接赋值(通过$content参数接收)的方式取得页面内容
	 * $mode == 2 , 以本地读取(fopen ile_get_contents)的方式取得页面内容(似乎这种方式没什么必要)
	 */
	public function cache($key,$content) {
		
		$fileName = $this->getcacheid($key);
		$data = serialize($content);
		
		$fp = fopen($fileName,'wb');
		if (!$fp || (fwrite($fp, $data)==-1)){
			echo ('<p>Errpr. 缓存文件失败!请检查目录');
		}else {
            __log(new myException("文件缓存成功"));
		}
	}
	/**
	 * 加载缓存
	 * exit() 载入缓存后终止原页面程序的执行,缓存无效则运行原页面程序生成缓存
	 * ob_start() 开启浏览器缓存用于在页面结尾处取得页面内容
	 */
	public function cached($key) {
		
		if (!$this->isvalid($key)) {
			echo "<span style='display:none;'>This is Cache.</span> ";
		}
		else {
			$fileName = $this->getcacheid($key);
			$data = file_get_contents($fileName);
			return unserialize($data);
		}
	}
	/**
	 * 清除缓存
	 */
	public function clean() {
		try {
			unlink($this->cacheid);
		}
		catch (Exception $e) {
			$this->error('清除缓存文件失败!请检查目录权限!');
		}
	}
	/**
	 * 取得缓存文件路径
	 */
	private function getcacheid($key) {
		return $this->dir.md5($key).$this->ext;
	}
	/**
	 * 检查目录是否存在或是否可创建
	 */
	private function dir_($dir) {
		if (is_dir($dir)) return true;
		try {
			mkdir($dir,0777);
		}
		catch (Exception $e) {
		
			$err = new myException ( "所设定缓存目录不存在并且创建失败!请检查目录权限! ", - 10001 );
			$err->__errorlog ();
			return false;
		}
		return true;
	}
	/**
	 * 取得当前页面完整url
	 */
	private function geturl() {
		$url = '';
		if (isset($_SERVER['REQUEST_URI'])) {
			$url = $_SERVER['REQUEST_URI'];
		}
		else {
			$url = $_SERVER['Php_SELF'];
			$url .= empty($_SERVER['QUERY_STRING'])?'':'?'.$_SERVER['QUERY_STRING'];
		}
		return $url;
	}

}


?>