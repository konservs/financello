<?php
namespace Application\Projects;

/**
 * Basic class to control projects
 *
 * @method Project item_get(integer $id)
 * @method Project[] items_get(integer[] $ids)
 * @method Project[] items_filter($params)
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Projects extends \Brilliant\Items\BItemsList{
	use \Brilliant\BSingleton;
	protected $tableName='projects';
	protected $itemClassName='\Application\Finances\Project';
	}
