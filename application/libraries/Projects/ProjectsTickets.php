<?php
namespace Application\Projects;

/**
 * Basic class to control projects
 *
 * @method ProjectsTicket item_get(integer $id)
 * @method ProjectsTicket[] items_get(integer[] $ids)
 * @method ProjectsTicket[] items_filter($params)
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class ProjectsTickets extends \Brilliant\Items\BItemsList{
	use \Brilliant\BSingleton;
	protected $tableName='projects_tickets';
	protected $itemClassName='\Application\Finances\ProjectsTicket';
	}
