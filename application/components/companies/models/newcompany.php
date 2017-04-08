<?php
/**
 * Model of new company page.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

use \Application\Companies\Companies;

class Model_companies_newcompany extends \Brilliant\MVC\BModel{
	public function getData($segments){
		$data=new stdClass;
		return $data;
		}
	}
