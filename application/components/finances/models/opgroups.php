<?php
/**
 * Model to load operation groups.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

bimport('mvc.component');
bimport('mvc.model');
bimport('companies.general');
bimport('compfinances.general');

class Model_compfinances_opgroups extends BModel{
	/**
	 * Process filters & get necessary data:
	 *  - company name;
	 *  - user name;
	 *  - user access to company;
	 *  - finances categories;
	 *  - finances operations.
	 *
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
		$dtnow=new DateTime();
		$dtfrom=$dtnow->sub(new DateInterval('P3M'));//-3 monthes
		$filter=array();
		$filter['company']=$data->companyid;
		$filter['dtfrom']=$dtfrom;
		//$filter['to']=;
		//$filter['category']=;
		$bcompfin=BCompFinances::getInstance();
		$data->opgroups=$bcompfin->opgroups_get_filter($filter);
		//Success!
		$data->error=0;
		return $data;
		}
	}
