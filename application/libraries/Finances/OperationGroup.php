<?php
namespace Application\Finances;
use Application\Finances\OperationGroups;

/**
 * Basic class to control single operation group
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class OperationGroup extends \Brilliant\Items\BItemsItem{
	protected $collectionname='\Application\Finances\OperationGroups';
	protected $tableName='fin_opgroups';
	/**
	 * @var DateTime
	 */
	public $created;
	/**
	 * @var DateTime
	 */
	public $modified;
	/**
	 * Constructor - init fields...
	 */
	function __construct() {
		parent::__construct();
		$this->fieldAddRaw('type','enum',array('values'=>array('C','E')));//Opened or closed
		$this->fieldAddRaw('company','int');
		$this->fieldAddRaw('name','str');
		$this->fieldAddRaw('user','int');
		//Statistics (all fields are readonly)
		$this->fieldAddRaw('counter_operations','int',array('readonly'=>true));
		//Created & modified
		$this->fieldAddRaw('created','dt',array('readonly'=>true));
		$this->fieldAddRaw('modified','dt',array('readonly'=>true));
		}

	public function getName(){
		return $this->name;
		}
	/**
	 * Get currencies
	 * If we have some currencies - separate with comas.
	 */
	public function getCurrencies($format=1){
		return array();
		}
	/**
	 *
	 */
	public function formatCurrencies(){
		return '?, ?';
		}
	/**
	 *
	 */
	public function getAccounts(){
		return array();
		}
	}
