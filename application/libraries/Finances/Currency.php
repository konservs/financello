<?php
namespace Application\Finances;

use Brilliant\Items\BItemsItem;

/**
 * Basic class to control single operation group
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Currency extends BItemsItem {
	protected $collectionName = '\Application\Finances\Currencies';
	protected $tableName = 'fin_currencies';
	/**
	 * @var string
	 */
	public $code3;

	/**
	 * Constructor - init fields...
	 */
	function __construct() {
		parent::__construct();
		$this->fieldAddRaw('code3', 'str');
	}
}
