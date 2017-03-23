<?php
namespace Application\Projects;

/**
 * Basic class to control projects
 *
 * @method \Application\Contacts\Contact itemGet(integer $id)
 * @method \Application\Contacts\Contact[] itemsGet(integer[] $ids)
 * @method \Application\Contacts\Contact[] itemsFilter($params)
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Contacts extends \Brilliant\Items\BItemsList{
	use \Brilliant\BSingleton;
	protected $tableName='contacts';
	protected $itemClassName='\Application\Contacts\Contact';
	}
