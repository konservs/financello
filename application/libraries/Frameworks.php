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
			$this->useFramework('jquery');
			}
		if($alias=='select2-finances-currencies'){
			$this->useFramework('select2');
			}
		}
	/**
	 *
	 */
	public function frameworksProcess($html){
		foreach($this->list as $framework){
			switch($framework){
				case 'jquery': 
					$html->addJS(URL_STATIC.'assets/jquery/jquery.min.js','',JS_PRIORITY_FRAMEWORK);
					break;
				case 'bootstrap':
					$html->addJS(URL_STATIC.'assets/bootstrap/js/bootstrap.min.js','',JS_PRIORITY_FRAMEWORK2);//after jQuery
					$html->addCSS(URL_STATIC.'assets/bootstrap/css/bootstrap.min.css','',CSS_PRIORITY_FRAMEWORK);
					$html->addCSS(URL_STATIC.'assets/bootstrap/css/bootstrap-theme.min.css','',CSS_PRIORITY_FRAMEWORK2);
					break;
				case 'select2': 
					$html->addJS(URL_STATIC.'assets/select2/select2-built.js','',JS_PRIORITY_FRAMEWORK2);
					$html->addCSS(URL_STATIC.'assets/select2/select2-built.css','',CSS_PRIORITY_FRAMEWORK2);
					break;
				case 'select2-finances-currencies': 
					$html->addJS(URL_STATIC.'js/select2_filters/fin_currencies.js');
					break;
				case 'font-awesome':
					$html->addCSS(URL_STATIC.'assets/font-awesome/css/font-awesome.min.css','',CSS_PRIORITY_FRAMEWORK2);
					break;
				default:
					BLog::addtolog('Unknown framework "'.$framework.'"');
				}
			}
		}
	}
