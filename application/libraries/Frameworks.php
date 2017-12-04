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
					$html->add_js('//'.BHOSTNAME_STATIC.'/assets/jquery/jquery.min.js','',JS_PRIORITY_FRAMEWORK);
					break;
				case 'bootstrap':
					$html->add_js('//'.BHOSTNAME_STATIC.'/assets/bootstrap/js/bootstrap.min.js','',JS_PRIORITY_FRAMEWORK2);//after jQuery
					$html->add_css('//'.BHOSTNAME_STATIC.'/assets/bootstrap/css/bootstrap.min.css','',CSS_PRIORITY_FRAMEWORK);
					$html->add_css('//'.BHOSTNAME_STATIC.'/assets/bootstrap/css/bootstrap-theme.min.css','',CSS_PRIORITY_FRAMEWORK2);
					break;
				case 'select2': 
					$html->add_js('//'.BHOSTNAME_STATIC.'/assets/select2/select2-built.js');
					$html->add_css('//'.BHOSTNAME_STATIC.'/assets/select2/select2-built.css');
					break;					
				case 'font-awesome':
					$html->add_css('//'.BHOSTNAME_STATIC.'/assets/font-awesome/css/font-awesome.min.css','',CSS_PRIORITY_FRAMEWORK2);
					break;
				default:
					BLog::addtolog('Unknown framework "'.$framework.'"');
				}
			}
		}
	}
