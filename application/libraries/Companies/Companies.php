<?php
namespace Application\Companies;

use \Brilliant\BFactory;
use \Brilliant\BSingleton;
use \Brilliant\Items\BItemsList;

/**
 * Basic class to control companies
 *
 * @method Company itemGet(integer $id)
 * @method Company[] itemsGet(integer[] $ids)
 * @method Company[] itemsFilter($params)
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Companies extends BItemsList {
	use BSingleton;
	//Some flags
	public static $flagCanViewCompany = 'companyView';
	public static $flagCanEditCompany = 'companyEdit';
	public static $flagCanViewAccounts = 'accountsView';
	public static $flagCanEditAccounts = 'accountsEdit';
	public static $flagCanViewCurrencies = 'currenciesView';
	public static $flagCanEditCurrencies = 'currenciesEdit';
	//
	protected $tableName = 'companies';
	protected $itemClassName = '\Application\Companies\Company';

	/**
	 * Get all access flags
	 *
	 * @return string[]
	 */
	public static function getAllFlags() {
		$res = array();
		$res[] = self::$flagCanViewCompany;
		$res[] = self::$flagCanEditCompany;
		$res[] = self::$flagCanViewAccounts;
		$res[] = self::$flagCanEditAccounts;
		$res[] = self::$flagCanViewCurrencies;
		$res[] = self::$flagCanEditCurrencies;
		return $res;
	}

	/**
	 *
	 * @param $params
	 * @param $wh
	 * @param $jn
	 *
	 * @return bool
	 */
	public function itemsFilterSql($params, &$wh, &$jn) {
		parent::itemsFilterSql($params, $wh, $jn);
		$db = BFactory::getDBO();
		if (!empty($params['keyword'])) {
			$keyword = mb_strtolower($params['keyword'], 'UTF-8');
			$keyword = trim($keyword);
			$keyword = str_replace('�', '_', $keyword);
			$keyword = str_replace('\'', '_', $keyword);
			$languages = BLang::langlist();
			$sql = '';
			foreach ($languages as $lang) {
				$sql .= empty($sql) ? ' ' : 'OR';
				$sql .= ' (lower(`name_' . $lang . '`) like ' . $db->escape_string('%' . $keyword . '%') . ')';
			}
			$wh[] = $sql;
		}
		if (!empty($params['status'])) {
			$wh[] = '(`status` = "' . $params['status'] . '")';
		}
		if (!empty($params['published'])) {
			$wh[] = '(`published` = "' . $params['published'] . '")';
		}
		if (!empty($params['director'])) {
			if (is_array($params['director'])) {
				$wh[] = '(`director` in (' . implode(',', $params['director']) . '))';
			} else {
				$wh[] = '(`director`=' . (int)$params['director'] . ')';
			}
		}
		return true;
	}

	/**
	 *
	 */
	public function byUserId($userId) {
		return $this->itemsFilter(array('director' => $userId, 'published' => 'P'));
	}
}
