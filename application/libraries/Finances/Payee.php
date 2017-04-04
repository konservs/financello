<?php
namespace Application\Finances;

/**
 * Basic class to control single Payee
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Payee extends \Brilliant\Items\BItemsItem{
	protected $collectionname='\Application\Finances\Payees';
	protected $tableName='fin_payees';
	/**
	 * Constructor - init fields...
	 */
	function __construct() {
		parent::__construct();
		$this->fieldAddRaw('company','int');
		$this->fieldAddRaw('name','str');
		$this->fieldAddRaw('lastcategory','int');
		}
	}
