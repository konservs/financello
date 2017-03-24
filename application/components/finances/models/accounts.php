<?php
/**
 * Model to load accounts.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

use \Application\Companies\Companies;
use \Application\Finances\Accounts;

class Model_finances_accounts extends \Application\Companies\CompanyModel{
	public function __construct(){
		parent::__construct();
		$this->permissionsFlagView = Companies::$flagCanViewAccounts;
		$this->permissionsFlagEdit = Companies::$flagCanEditAccounts;
		}
	/**
	 *
	 */
	public function get_data($segments){
		$data=parent::get_data($segments);
		if($data->error!=0){
			return $data;
			}
		$bAccounts=Accounts::getInstance();
		$data->accounts=$bAccounts->itemsFilter(array('company'=>$data->companyId));
		$data->error=0;
		return $data;
		}
	}
