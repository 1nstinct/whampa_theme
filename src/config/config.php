<?php

$configs = array(
	'enabled' => true,
	'minified' => true,
	'theme' => 'smart-style-3'
);

$sub_configs = array();

if(file_exists(__DIR__.'/'.$configs['theme'].'.php')) $sub_configs = require_once(__DIR__.'/'.$configs['theme'].'.php');

return array_merge($configs, $sub_configs);