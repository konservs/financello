<?php
namespace Application\Finances;

/**
 * Basic class to control companies
 *
 * @method Company item_get(integer $id)
 * @method Company[] items_get(integer[] $ids)
 * @method Company[] items_filter($params)
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Accounts extends \Brilliant\Items\BItemsList{
	use \Brilliant\BSingleton;
	protected $tableName='fin_accounts';
	protected $itemClassName='\Application\Finances\Account';

	}