<?php

function xhp_register_library(){
  
}

function __xhp_autoload($class_name) {
  require_once('php-lib/' . $class_name . '.php');
}

spl_autoload_register('__xhp_autoload');
xhp_register_library();
