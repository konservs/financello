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
