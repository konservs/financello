<?php
namespace Application\Finances;

/**
 * Basic class to control single operation group
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Currency extends \Brilliant\Items\BItemsItem{
	protected $collectionname='\Application\Finances\Currencies';
	protected $tableName='fin_currencies';
	/**
	 * Constructor - init fields...
	 */
	function __construct() {
		parent::__construct();
		$this->fieldAddRaw('code3','str');
		}
	}
