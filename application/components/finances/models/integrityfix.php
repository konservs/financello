<?php
/**
 * Model to load accounts.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

class Model_finances_integrityfix extends \Brilliant\MVC\BModel{
	/**
	 *
	 */
	public function get_data($segments){
		$data=new stdClass;
		$data->error=-1;
		$data->companyid=(int)$segments['company'];
		//Check if me is logged...
		$busers=BUsers::getInstance();
		$data->me=$busers->getLoggedUser();
		if(empty($data->me)){
			$data->error=1;
			return $data;
			}
		//
		$bcompanies=BCompanies::getInstance();
		$data->company=$bcompanies->company_get($data->companyid);
		if(empty($data->company)){
			$data->error=2;
			return $data;
			}
		//Check if the user has access with this company.

		//SELECT `account`,sum(`amount`) from `fin_operations` WHERE ((`company`=1)) GROUP BY `account`;

		//Success!
		$data->error=0;
		return $data;
		}
	}
