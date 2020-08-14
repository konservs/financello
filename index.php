<?php
/**
 * Index file of domain/subdomain
 * 
 * @author Andrii Biriev, <a@konservs.com>
 * 
 * @copyright © Andrii Biriev, <a@konservs.com>
 */
error_reporting(E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );
define('BEXEC', 1);
define('BROOTPATH', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);
define('BFRAMEWORKPATH', BROOTPATH.'vendor'.DIRECTORY_SEPARATOR.'konservs'.DIRECTORY_SEPARATOR.'brilliant.framework'.DIRECTORY_SEPARATOR);
define('BAPPLICATIONPATH', BROOTPATH.'application'.DIRECTORY_SEPARATOR);
//
define('BCOMPONENTSAPPLICATIONPATH', BAPPLICATIONPATH.'components'.DIRECTORY_SEPARATOR);
define('BCOMPONENTSFRAMEWORKPATH', BFRAMEWORKPATH.'components'.DIRECTORY_SEPARATOR);
define('BLIBRARIESAPPLICATIONPATH',  BAPPLICATIONPATH.'libraries'.DIRECTORY_SEPARATOR);
define('BLIBRARIESFRAMEWORKPATH',  BFRAMEWORKPATH.'libraries'.DIRECTORY_SEPARATOR);
//Other paths
define('BTEMPLATESPATH',  BROOTPATH.'templates'.DIRECTORY_SEPARATOR);
define('BLANGUAGESPATH',  BROOTPATH.'languages'.DIRECTORY_SEPARATOR);
//Load configuration file
$fn_config=BROOTPATH.'config'.DIRECTORY_SEPARATOR.'config.php';
if(!file_exists($fn_config)){
	die('Could not load config file! Please, copy config.default.php as config.php in config folder.');
	}
include($fn_config);
//Initialize router
$loader=require(BROOTPATH.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');
//
use Application\BRouter;
$router=Application\BRouter::getInstance();
if(DEBUG_MODE){
	$router->htmllogger=new \Brilliant\Log\BLoggerHTML();
	\Brilliant\log\BLog::RegisterLogger($router->htmllogger);
	}
$router->run($_SERVER['REQUEST_URI'],$_SERVER['HTTP_HOST']);
