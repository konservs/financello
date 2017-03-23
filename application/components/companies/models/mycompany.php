<?php
/**
 * Model of MyCompany dashboard page.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

class Model_companies_mycompany extends \Brilliant\MVC\BModel{
	/**
	 *
	 */
	public function get_data($segments){
		$data=new stdClass;
		$data->error=-1;
		//
		$bCompanies=\Application\Companies\Companies::getInstance();
		$data->company=$bCompanies->itemGet($segments['id']);
		if(empty($data->company)){
			return $data;
			}
		//Success!
		$data->error=0;
		return $data;
		}
	}
