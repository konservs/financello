<?php
/**
 * Model of adding operation group single page.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

use \Application\Companies\Companies;
use \Application\Finances\Accounts;
use \Application\Finances\OperationGroup;
use \Brilliant\CMS\BLang;
use \Brilliant\HTTP\BRequest;

class Model_finances_opgroupadd extends \Application\Companies\CompanyModel{
	/**
	 * Model_finances_opgroupadd constructor
	 */
	public function __construct(){
		parent::__construct();
		$this->permissionsFlagView = Companies::$flagCanViewCompany;
		$this->permissionsFlagEdit = Companies::$flagCanEditCompany;
		}

	/**
	 * Get data for accounts
	 *
	 * @param $segments
	 * @return stdClass
	 */
	public function getData($segments) {
		$data = parent::getData($segments);
		if ($data->error != 0) {
			return $data;
			}
		//
		$bfa=\Application\Finances\Accounts::getInstance();
		//$data->categories=$bcf->categories_get_filter(array('company'=>$data->companyId));
		$data->accounts=$bfa->getSimpleList(array('name'),array(),'',array('company'=>$data->companyId));
		//$data->projects=$bp->projects_get_filter(array('company'=>$data->companyId));
		//
		$data->opgroup=new \Application\Finances\OperationGroup();
		$data->opgroup->operations=array();
		//$data->projects=$bp->;
		//$bp=BProjects::getInstance();
		//
		$data->do=BRequest::getString('do');
		$data->saving=($data->do=='save');
		if($data->saving){
			}
		//Success!
		$data->error=0;
		return $data;
		}
	}
