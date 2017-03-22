<?php
/**
 * Model to load accounts.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

class Model_finances_accounts extends \Brilliant\MVC\BModel{
	/**
	 *
	 */
	public function get_data($segments){
		$data=new stdClass;
		$data->error=-1;
		$data->companyid=(int)$segments['company'];
		//Check if me is logged...
		$bUsers=\Brilliant\Users\BUsers::getInstance();
		$data->me=$bUsers->getLoggedUser();
		if(empty($data->me)){
			$data->error=1;
			return $data;
			}
		//
		$bCompanies=\Application\Companies\Companies::getInstance();
		$data->company=$bCompanies->itemGet($data->companyid);
		if(empty($data->company)){
			$data->error=2;
			return $data;
			}
		//Check if the user has access with this company.
		//TODO: finish this code & library.
		$data->can_view=true;//$data->company->canuser($data->me->id,FLAG_CAN_VIEW);
		$data->can_edit=true;//$data->company->canuser($data->me->id,FLAG_CAN_EDIT);
		//
		$bcompfin=\Application\Finances\Accounts::getInstance();
		$data->accounts=array();//$bcompfin->accounts_get_company($data->companyid);
		//Success!
		$data->error=0;
		return $data;
		}
	}
