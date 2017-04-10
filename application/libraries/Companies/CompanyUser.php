<?php
/**
 * Basic class to control companies.
 *
 * @author Andrii Biriev
 */
namespace Application\Companies;

use \Application\Companies\CompanyUsers;
use \Brilliant\Items\BItemsItem;

class CompanyUser extends BItemsItem {
	protected $collectionName = '\Application\Companies\CompanyUsers';
	protected $tableName = 'companies_users';
	/**
	 * @var int
	 */
	public $user;
	/**
	 * @var int
	 */
	public $company;
	/**
	 * @var array
	 */
	public $access;

	/**
	 * Constructor - init fields...
	 */
	function __construct() {
		parent::__construct();
		$this->fieldAddRaw('user', 'int');
		$this->fieldAddRaw('company', 'int');
		$this->fieldAddRaw('access', 'json');
	}

	/**
	 * Can user do something or not?
	 * @param $flag string
	 * @return bool
	 */
	public function getAccessFlag($flag) {
		if (!is_array($this->access)) {
			return false;
		}
		if (!isset($this->access[$flag])) {
			return false;
		}
		return $this->access[$flag];
	}

	/**
	 * Add flag
	 *
	 * @param $flag string
	 * @param $value
	 * @return bool
	 */
	public function setAccessFlag($flag, $value) {
		if (!is_array($this->access)) {
			$this->access = array();
		}
		$this->access[$flag] = $value;
		return true;
	}
}
