<?php
namespace Application\Bugtracker;

/**
 * Basic class to control projects
 *
 * @method \Application\Bugtracker\Issue itemGet(integer $id)
 * @method \Application\Bugtracker\Issue[] itemsGet(integer[] $ids)
 * @method \Application\Bugtracker\Issue[] itemsFilter($params)
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Issues extends \Brilliant\Items\BItemsList{
	use \Brilliant\BSingleton;
	protected $tableName='bugtracker_issues';
	protected $itemClassName='\Application\Bugtracker\Issue';
	}
