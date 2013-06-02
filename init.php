<?php

class XHP_Loader{

	private $classMap = array();
	private static $instance = null;

	private function __construct(){
		$this->registerMap();
		include_once('php-lib/init.php');
	}

	private function registerMap(){
		$this->classMap['ci'] = 'codeigniter.php';
		$this->classMap['ui'] = 'common.php';
	}

	static function instance(){
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
		return static::$instance;
	}

	public function getClassMap(){
		return $this->classMap;
	}

	static function load($class){
		$loader = XHP_Loader::instance();
		$frag = explode('__', $class);

		if(strstr($frag[0], "xhp_") != false){
			$prefix = explode('_', $frag[0])[1];
			$map = $loader->getClassMap();
			if(isset($map[$prefix])){
				include_once('php-lib/' . $loader->getClassMap()[$prefix]);
			}
		}
	}
}

function __xhp_autoload($class_name) {
	XHP_Loader::load($class_name);
}

spl_autoload_register('__xhp_autoload');
