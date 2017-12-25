<?php
/**
 * 配置文件获取基类
 *
 * Class Config
 */
class Config {
	/**
	 * 用于存储配置信息
	 *
	 * @var array
	 */
	protected $_confData = array();

	/**
	 * 用于读取各种配置文件
	 */
	public function load(){

	}

	/**
	 * 获取配置值
	 *
	 * @param string $key   获取配置键值
	 * @param string $cut   键值分割符
	 * @return array|bool
	 */
	public function get($key, $cut = '.') {
		$key_arr = explode($cut, $key);

		$result = $this->_confData;
		foreach ($key_arr as $val) {
			if (!isset($result[$val])) {
				return false;
			}
			$result = $result[$val];
		}
		return $result;
	}
}
// /**
//  * 设置一些全局变量
//  */
// // 请求的url
// define ( 'HTTPREQUESTURL', '192.168.1.27:8889' );
// define ( 'ERRORLOGPATH', '../../my-errors' );

/**
 * 读取ini配置文件
 *
 * Class ConfigINI
 */
class ConfigINI extends Config {
	function __construct() {

		$real ='../config';
		$this->load ($real.'/config.conf');
	}
	/**
	 * 加载ini配置文件
	 *
	 * @param string $file
	 *        	文件路径
	 * @return bool
	 */
	function load($file = NULL) {
	
		// 判断文件是否存在
		if (file_exists ( $file) == false) {
			echo 'config load error'.$file;
			return false;
		}
		$this->_confData = parse_ini_file ( $file, true );
		return true;
	}
}
?>
