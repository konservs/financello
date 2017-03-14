<?php
/**
 * Model of MyCompany dashboard page.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

bimport('mvc.component');
bimport('mvc.model');
bimport('companies.general');

class Model_companies_mycompany extends BModel{
	/**
	 *
	 */
	public function get_data($segments){
		$data=new stdClass;
		$data->error=-1;
		//
		$bcompanies=BCompanies::getInstance();
		$data->company=$bcompanies->company_get($segments['id']);
		if(empty($data->company)){
			return $data;
			}
		//Success!
		$data->error=0;
		return $data;
		}
	}
