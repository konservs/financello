<?php
namespace Application\Finances;

/**
 * Basic class to control companies
 *
 * @method OperationGroup item_get(integer $id)
 * @method OperationGroup[] items_get(integer[] $ids)
 * @method OperationGroup[] items_filter($params)
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class OperationGroups extends \Brilliant\Items\BItemsList{
	use \Brilliant\BSingleton;
	protected $tableName='fin_opgroups';
	protected $itemClassName='\Application\Finances\OperationGroup';
	protected $linkedTables=array(
		array('name'=>'fin_operations','extkey'=>'group','field'=>'operations')
		);
	}
