<?php
namespace Application\Finances;

use Brilliant\Items\BItemsItem;

/**
 * Basic class to control account
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Account extends BItemsItem {
	protected $collectionName = '\Application\Finances\Accounts';
	protected $tableName = 'fin_accounts';
	/**
	 * @var int
	 */
	public $currency;
	/**
	 * @var double
	 */
	public $balance;

	/**
	 * Constructor - init fields...
	 */
	function __construct() {
		parent::__construct();
		$this->fieldAddRaw('company', 'int');
		$this->fieldAddRaw('currency', 'int');
		$this->fieldAddRaw('name', 'string');
		$this->fieldAddRaw('icon', 'string');
		//Statistics (all fields are readonly)
		$this->fieldAddRaw('limit', 'float');
		$this->fieldAddRaw('balance', 'float', array('readonly' => true));
		//Created & modified
		$this->fieldAddRaw('created', 'dt', array('readonly' => true));
		$this->fieldAddRaw('modified', 'dt', array('readonly' => true));
	}

	/**
	 * Get account currency
	 *
	 * @return Currency|null
	 */
	public function getCurrency() {
		if (empty($this->currency)) {
			return NULL;
		}
		$bCurrencies = Currencies::getInstance();
		return $bCurrencies->itemGet($this->currency);
	}

	/**
	 * Get currency ISO code
	 *
	 * @return string
	 */
	public function getCurrencyCode3() {
		$currency = $this->getCurrency();
		if (empty($currency)) {
			return '???';
		}
		return $currency->code3;
	}

	/**
	 * Format money
	 *
	 * @return string
	 */
	public function formatBalance() {
		$currency = $this->getCurrency();
		if (empty($currency)) {
			return sprintf('%2.2f', $this->balance);
		}
		return $currency->formatMoney($this->balance);
	}
}
