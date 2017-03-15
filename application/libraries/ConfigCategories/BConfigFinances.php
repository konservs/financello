<?php
/**
 * Settings for payment systems & general payments settings. 
 * 
 * @author Andrii Biriev
 */
class BConfigFinances extends BConfigCategory{
	public $alias='finances';
	/**
	 * Simple constructor
	 */
	public function __construct(){
		//parent::__construct();
		$this->name=BLang::_('ADMIN_CONFIG_PAYMENT');
		}
	}
//Auto-register category
\Brilliant\Config\BConfig::getInstance()->registerCategory('BConfigFinances');
