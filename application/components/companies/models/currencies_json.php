<?php
/**
 * Model of new company page.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

use \Application\Companies\Companies;
use \Application\Finances\Currencies;


class Model_companies_currencies_json extends \Brilliant\MVC\BModelJSON{
	/**
	 *
	 */
	public function getDataJson($segments, &$json){
		if(empty($segments['company'])){
			$this->error=1;
			return false;
			}
		//Setup the default values
		$json->currencies = array();
		$json->limit = 10;
		$json->offset = 0;
		//
		$params = array();
		$params['limit'] = $json->limit;
		$params['offset'] = $json->offset;
		if($segments['keyword']){
			$params['keyword'] = $segments['keyword'];
			}
		//
		$bcurr = Currencies::getInstance();
		//
		$count = $bcurr->itemsFilterCount($params);
		$json->count = $count;
		//
		$list = $bcurr->itemsFilter($params);
		foreach($list as $cur){
			$xcur = new \stdClass();
			$xcur->id = $cur->id;
			$xcur->code3 = $cur->code3;
			$xcur->name = $cur->name;
			$json->currencies[]=$xcur;
			}

		$this->error = 0;
		return true;
		}
	}
