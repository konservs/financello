<?php
namespace \Application\Finances;

/**
 * Basic class to control companies
 *
 * @method \Application\Finances\Account itemGet(integer $id)
 * @method \Application\Finances\Account[] itemsGet(integer[] $ids)
 * @method \Application\Finances\Account[] itemsFilter($params)
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Accounts extends \Brilliant\Items\BItemsList{
	use \Brilliant\BSingleton;
	protected $tableName='fin_accounts';
	protected $itemClassName='\Application\Finances\Account';
	}
