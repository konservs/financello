<?php
/**
 * Model to load payees.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

class Model_finances_payeesjsonfilter extends BModel{
	/**
	 * Process filters & get necessary data:
	 */
	public function getData($segments){
		$data=new stdClass;
		$data->error=-1;
		$data->json=new stdClass;
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
		//Get data...
		$data->json->q=BRequest::getString('q');
		$data->json->limit=BRequest::getInt('page_limit',0);
		//
		$cf=BCompFinances::getInstance();
		$filter=array('name'=>$data->json->q,'company'=>$data->companyid);
		$data->json->items=$cf->payee_get_filter($filter,$data->json->limit,0);
		//Success!
		$data->error=0;
		return $data;
		}
	}
