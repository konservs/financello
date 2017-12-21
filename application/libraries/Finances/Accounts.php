<?php
namespace Application\Finances;

use Brilliant\BFactory;
use Brilliant\BSingleton;
use Brilliant\Items\BItemsList;

/**
 * Basic class to control companies
 *
 * @method Account itemGet(integer $id)
 * @method Account[] itemsGet(integer[] $ids)
 * @method Account[] itemsFilter($params)
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Accounts extends BItemsList {
	use BSingleton;
	protected $tableName = 'fin_accounts';
	protected $itemClassName = '\Application\Finances\Account';
	/**
	 * 
	 */
	public static function listIcons(){
		$list=[];
		$list[]=(object)['id'=>'cash', 'name'=>'Cash', 'class'=>'fa fa-cash'];
		$list[]=(object)['id'=>'сс-mastercard', 'name'=>'Mastercard', 'class'=>'fa fa-cc-mastercard'];
		$list[]=(object)['id'=>'сс-visa', 'name'=>'Visa', 'class'=>'fa fa-cc-visa'];
		$list[]=(object)['id'=>'paypal', 'name'=>'Paypal', 'class'=>'fa fa-paypal'];
		$list[]=(object)['id'=>'credit-card', 'name'=>'Credit Card', 'class'=>'fa fa-credit-card'];
		$list[]=(object)['id'=>'bitcoin', 'name'=>'Bitcoin', 'class'=>'fa fa-bitcoin'];
		return $list;
		}
	/**
	 * Items filter SQL - where, JOINs, etc
	 *
	 * @param $params
	 * @param $wh
	 * @param $jn
	 * @return bool
	 */
	public function itemsFilterSql($params, &$wh, &$jn) {
		parent::itemsFilterSql($params, $wh, $jn);
		$db = BFactory::getDBO();
		if (!empty($params['keyword'])) {
			$keyword = mb_strtolower($params['keyword'], 'UTF-8');
			$keyword = trim($keyword);
			$keyword = str_replace('’', '_', $keyword);
			$keyword = str_replace('\'', '_', $keyword);
			$wh[] = '(lower(`name`) like ' . $db->escapeString('%' . $keyword . '%') . ')';
		}
		if (!empty($params['company'])) {
			$wh[] = '(`company` = ' . (int)$params['company'] . ')';
		}
		return true;
	}
}
