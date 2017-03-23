<?php
namespace Application\Finances;

/**
 * Basic class to control companies
 *
 * @method \Application\Finances\Category itemGet(integer $id)
 * @method \Application\Finances\Category[] itemsGet(integer[] $ids)
 * @method \Application\Finances\Category[] itemsFilter($params)
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Categories extends \Brilliant\Items\BItemsItemRTree{
	use \Brilliant\BSingleton;
	protected $tableName='fin_categories';
	protected $itemClassName='\Application\Finances\Category';
	}
