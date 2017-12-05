<?php


require_once APPPATH.'third_party/Kit-ClassLoader-master/src/autoload.php';
$loader = new Riimu\Kit\ClassLoader\ClassLoader();
$loader->addPrefixPath(APPPATH.'pre', 'Pre');
$loader->addPrefixPath(APPPATH.'models', 'Model');
$loader->addPrefixPath(APPPATH.'third_party/php-jwt-master/src/', 'Firebase\JWT');
$loader->register();

include_once BASEPATH.'core'.DIRECTORY_SEPARATOR.'Model.php';