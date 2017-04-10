<?php
namespace Application\Companies;

use \Brilliant\BSingleton;
use \Brilliant\Items\BItemsList;

/**
 * Basic class to control companies
 *
 * @method CompanyUser itemGet(integer $id)
 * @method CompanyUser itemFilterFirst($params)
 * @method CompanyUser[] itemsGet(integer[] $ids)
 * @method CompanyUser[] itemsFilter($params)
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class CompanyUsers extends BItemsList {
	use BSingleton;
	protected $tableName = 'companies_users';
	protected $itemClassName = '\Application\Companies\CompanyUser';

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
		if (!empty($params['company'])) {
			if (is_array($params['company'])) {
				$wh[] = '(`company` in (' . implode(',', $params['company']) . '))';
			} else {
				$wh[] = '(`company`=' . (int)$params['company'] . ')';
			}
		}
		if (!empty($params['user'])) {
			if (is_array($params['user'])) {
				$wh[] = '(`user` in (' . implode(',', $params['user']) . '))';
			} else {
				$wh[] = '(`user`=' . (int)$params['user'] . ')';
			}
		}
		return true;
	}

}
