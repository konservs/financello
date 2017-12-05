<?php
/**
 * Model of new company page.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

use \Application\Companies\Companies;

class Model_companies_currencies_json extends \Brilliant\MVC\BModelJSON{
	/**
	 *
	 */
	public function getDataJson($segments, &$json){
		$json->test = 1;
		if(empty($segments['company'])){
			$this->error=1;
			return false;
			}

		$this->error = 0;
		return true;
		}
	}
