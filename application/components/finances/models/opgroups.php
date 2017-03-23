<?php
/**
 * Model to load operation groups.
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
defined('BEXEC') or die('No direct access!');

class Model_finances_opgroups extends \Brilliant\MVC\BModel{
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
		$busers=\Brilliant\Users\BUsers::getInstance();
		$data->me=$busers->getLoggedUser();
		if(empty($data->me)){
			$data->error=1;
			return $data;
			}
		//
		$bcompanies=\Application\Companies\Companies::getInstance();
		$data->company=$bcompanies->itemGet($data->companyid);
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
		$bOperationGroups=\Application\Finances\OperationGroups::getInstance();
		$data->opgroups=$bOperationGroups->itemsFilter($filter);
		//Success!
		$data->error=0;
		return $data;
		}
	}
