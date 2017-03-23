<?php
namespace Application\Finances;

/**
 * Basic class to control companies
 *
 * @method \Application\Finances\Currency itemGet(integer $id)
 * @method \Application\Finances\Currency[] itemsGet(integer[] $ids)
 * @method \Application\Finances\Currency[] itemsFilter($params)
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Currencies extends \Brilliant\Items\BItemsList{
	use \Brilliant\BSingleton;
	protected $tableName='fin_currencies';
	protected $itemClassName='\Application\Finances\Currency';
	}
