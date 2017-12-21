<?php
/**
 * Model to add new account page.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

use \Application\Companies\Companies;
use \Application\Companies\CompanyModel;
use \Application\Finances\Accounts;
use \Application\Finances\Account;
use \Brilliant\HTTP\BRequest;

class Model_finances_accountadd extends CompanyModel {
	/**
	 * Model_finances_accounts constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->permissionsFlagView = Companies::$flagCanViewAccounts;
		$this->permissionsFlagEdit = Companies::$flagCanEditAccounts;
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
		$do = BRequest::getString('do');
		$data->formData = [];
		if($do=='save'){
			$formOk = true;
			$data->formData['name'] = BRequest::getString('name');
			if(empty($data->formData['name'])){
				$data->formErrors['name']=(object)['message'=>'The field should not be empty!', 'field'=>'name'];
				$formOk = false;
				}
			if(!$formOk){
				return $data;
				}
			//die();
			}
		//$bAccounts = Accounts::getInstance();
		//$data->accounts = $bAccounts->itemsFilter(array('company' => $data->companyId));
		$data->error = 0;
		return $data;
	}
}
