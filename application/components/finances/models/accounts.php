<?php
/**
 * Model to load accounts.
 *
 * @author Andrii Biriev
 * @copyright ©2014 Brilliant IT corporation, www.it.brilliant.ua
 */
defined('BEXEC') or die('No direct access!');

bimport('mvc.component');
bimport('mvc.model');
bimport('companies.general');
bimport('compfinances.general');
bimport('users.general');

class Model_compfinances_accounts extends BModel{
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
		//TODO: finish this code & library.
		$data->can_view=true;//$data->company->canuser($data->me->id,FLAG_CAN_VIEW);
		$data->can_edit=true;//$data->company->canuser($data->me->id,FLAG_CAN_EDIT);
		//
		$bcompfin=BCompFinances::getInstance();
		$data->accounts=$bcompfin->accounts_get_company($data->companyid);
		//Success!
		$data->error=0;
		return $data;
		}
	}
