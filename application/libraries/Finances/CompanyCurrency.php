<?php
namespace Application\Finances;

use Brilliant\Items\BItemsItem;
use Application\Finances\Currencies;
use Application\Finances\Currency;

/**
 * Basic class to control single operation group
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class CompanyCurrency extends BItemsItem {
	protected $collectionName = '\Application\Finances\CompanyCurrencies';
	protected $tableName = 'fin_ccurrencies';
	/**
	 * @var int
	 */
	public $company;
	/**
	 * @var int
	 */
	public $currency;

	/**
	 * Constructor - init fields...
	 */
	function __construct() {
		parent::__construct();
		$this->fieldAddRaw('company', 'int');
		$this->fieldAddRaw('currency', 'int');
		$this->fieldAddRaw('flags', 'int');
		$this->fieldAddRaw('balance', 'float');
	}

	/**
	 * Get currency object
	 *
	 * @return Currency|null
	 */
	public function getCurrency() {
		$currencyId = $this->currency;
		if (empty($currencyId)) {
			return NULL;
		}
		$bCurrencies = Currencies::getInstance();
		return $bCurrencies->itemGet($currencyId);
	}

	/**
	 * Get currency code 3
	 * @return string
	 */
	public function getCurrencyCode3() {
		$currency = $this->getCurrency();
		if (empty($currency)) {
			return '';
		}
		return $currency->code3;
	}

}
