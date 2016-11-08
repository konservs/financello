<?php
/**
 * Index file of domain/subdomain
 * 
 * @author Andrii Biriev
 * 
 * @copyright © Andrii Biriev, <a@konservs.com>
 */
error_reporting(E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );
define('BEXEC', 1);
define('BROOTPATH', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);
define('BLIBRARIESPATH', BROOTPATH.'libraries'.DIRECTORY_SEPARATOR);
$loader=require(BROOTPATH.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');
//
use Application\BRouter;
$router=new Application\BRouter();
$router->run($_SERVER['REQUEST_URI'],$_SERVER['HTTP_HOST']);
