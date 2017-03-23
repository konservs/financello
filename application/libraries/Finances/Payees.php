<?php
namespace Application\Finances;

/**
 * Basic class to control companies
 *
 * @method \Application\Finances\Payee itemGet(integer $id)
 * @method \Application\Finances\Payee[] itemsGet(integer[] $ids)
 * @method \Application\Finances\Payee[] itemsFilter($params)
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Payees extends \Brilliant\Items\BItemsList{
	use \Brilliant\BSingleton;
	protected $tableName='fin_payees';
	protected $itemClassName='\Application\Finances\Payee';
	}
