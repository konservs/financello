<?php
/**
 * Model to load accounts.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

use Application\Companies\Companies;
use Application\Companies\CompanyModel;
use Application\Finances\Accounts;

class Model_finances_accounts extends CompanyModel {
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
		$bAccounts = Accounts::getInstance();
		$data->accounts = $bAccounts->itemsFilter(array('company' => $data->companyId));
		$data->error = 0;
		return $data;
	}
}
