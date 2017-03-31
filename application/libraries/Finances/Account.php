<?php
namespace Application\Finances;

/**
 * Basic class to control account
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Account extends \Brilliant\Items\BItemsItem{
	protected $collectionName='\Application\Finances\Accounts';
	protected $tableName='fin_accounts';
	/**
	 * Constructor - init fields...
	 */
	function __construct() {
		parent::__construct();
		$this->fieldAddRaw('company','int');
		$this->fieldAddRaw('currency','int');
		$this->fieldAddRaw('name','string');
		$this->fieldAddRaw('icon','string');
		//Statistics (all fields are readonly)
		$this->fieldAddRaw('limit','float');
		$this->fieldAddRaw('balance','float',array('readonly'=>true));
		//Created & modified
		$this->fieldAddRaw('created','dt',array('readonly'=>true));
		$this->fieldAddRaw('modified','dt',array('readonly'=>true));
		}
	/**
	 *
	 */
	public function getCurrencyCode3(){
		return '???';
		}
	}
