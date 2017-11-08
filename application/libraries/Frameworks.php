<?php
namespace Application;

use \Brilliant\Log\BLog;

class Frameworks{
	use \Brilliant\BSingleton;
	public $list = array();
	/**
	 *
	 */
	public function useFramework($alias=''){
		$this->list[$alias]=$alias;
		if($alias=='jquery-ui'){
			$this->list['jquery']='jquery';
			}
		}
	/**
	 *
	 */
	public function frameworksProcess($html){
		foreach($this->list as $framework){
			switch($framework){
				case 'jquery': 
					$html->add_js('//'.BHOSTNAME_STATIC.'/libs/jquery/2.1.3/jquery-2.1.3.min.js','',JS_PRIORITY_FRAMEWORK);
					break;
				case 'bootstrap':
					$html->add_js('//'.BHOSTNAME_STATIC.'/libs/bootstrap/3.3.4/js/bootstrap.min.js','',JS_PRIORITY_FRAMEWORK2);//after jQuery
					$html->add_css('//'.BHOSTNAME_STATIC.'/libs/bootstrap/3.3.4/css/bootstrap.min.css','',CSS_PRIORITY_FRAMEWORK);
					$html->add_css('//'.BHOSTNAME_STATIC.'/libs/bootstrap/3.3.4/css/bootstrap-theme.min.css','',CSS_PRIORITY_FRAMEWORK2);
					break;
				case 'select2': 
					$html->add_js('//'.BHOSTNAME_STATIC.'/libs/select2/select2.min.js');
					break;					
				case 'font-awesome':
					$html->add_css('//'.BHOSTNAME_STATIC.'/fonts/font-awesome/4.7.0/css/font-awesome.min.css','',CSS_PRIORITY_FRAMEWORK2);
					break;
				default:
					BLog::addtolog('Unknown framework "'.$framework.'"');
				}
			}
		}
	}
