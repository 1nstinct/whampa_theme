<?php
/**
 * @var array $config General configurations
 *
 */
$configs = array(
	'enabled' => true, // enabling package
	'minified' => false, // minify assets
	'theme' => 'smart-style-3' // define name of custom config file
);

$sub_configs = file_exists(__DIR__.'/'.$configs['theme'].'.php') ? require_once(__DIR__.'/'.$configs['theme'].'.php') : array();

return array_merge($configs, $sub_configs);