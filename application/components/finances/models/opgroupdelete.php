<?php
/**
 * Model to load operation groups.
 *
 * @author Andrii Biriev
 * @copyright �2014 Brilliant IT corporation, www.it.brilliant.ua
 */
defined('BEXEC') or die('No direct access!');

bimport('mvc.component');
bimport('mvc.model');
bimport('http.request');
bimport('companies.general');
bimport('compfinances.general');

class Model_compfinances_opgroupedit extends BModel{
	/**
	 * Get data.
	 */
	public function get_data($segments){
		$data=new stdClass;
		$data->error=-1;
		$data->companyid=(int)$segments['company'];
		$data->groupid=(int)$segments['id'];
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
		$data->do=BRequest::getString('do');
		/*$data->saving=($data->do=='save');
		if($data->saving){
			}*/
		//Success!
		$data->error=0;
		return $data;
		}
	}
