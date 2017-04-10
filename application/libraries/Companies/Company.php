<?php
/**
 * Basic class to control companies.
 *
 * @author Andrii Biriev
 */
namespace Application\Companies;

use \Application\Companies\Companies;
use \Application\Companies\CompanyUsers;
use \Brilliant\Items\BItemsItem;

class Company extends BItemsItem {
	protected $collectionName = 'Company';
	protected $tableName = 'companies';
	/**
	 * @var DateTime
	 */
	public $created;
	/**
	 * @var DateTime
	 */
	public $modified;
	/**
	 * @var string
	 */
	public $name;
	/**
	 * @var string
	 */
	public $status;
	/**
	 * @var string
	 */
	public $published;
	/**
	 * @var int
	 */
	public $director;

	/**
	 * Constructor - init fields...
	 */
	function __construct() {
		parent::__construct();
		$this->fieldAddRaw('status', 'enum', array('values' => array('O', 'C')));//Opened or closed
		$this->fieldAddRaw('published', 'enum', array('values' => array('P', 'N', 'D')));
		$this->fieldAddRaw('name', 'string');
		$this->fieldAddRaw('director', 'int');
		//Statistics (all fields are readonly)
		$this->fieldAddRaw('counter_users', 'int', array('readonly' => true));
		//Created & modified
		$this->fieldAddRaw('created', 'dt', array('readonly' => true));
		$this->fieldAddRaw('modified', 'dt', array('readonly' => true));
	}

	/**
	 * can user or not?
	 *
	 * @param $userId int
	 * @param $flag string
	 * @return bool
	 */
	public function canUser($userId, $flag) {
		if ($this->director == $userId) {
			return true;
		}
		$bCompanyUsers = CompanyUsers::getInstance();
		$companyUser = $bCompanyUsers->itemsFilterFirst(['company' => $this->id, 'user' => $userId]);
		if (empty($companyUser)) {
			return false;
		}
		return $companyUser->getAccessFlag($flag);
	}
}
