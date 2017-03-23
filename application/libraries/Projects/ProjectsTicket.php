<?php
namespace Application\Projects;
use Application\ProjectsTickets;

/**
 * Basic class to control single project
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class ProjectsTicket extends \Brilliant\Items\BItemsItem{
	protected $collectionname='\Application\Projects\ProjectsTickets';
	protected $tableName='projects_tickets';
	/**
	 * @var DateTime
	 */
	public $created;
	/**
	 * @var DateTime
	 */
	public $modified;
	/**
	 * Constructor - init fields...
	 */
	function __construct() {
		parent::__construct();
		$this->fieldAddRaw('company','int');
		$this->fieldAddRaw('project','int');
		$this->fieldAddRaw('name','str');
		//Created & modified
		$this->fieldAddRaw('created','dt',array('readonly'=>true));
		$this->fieldAddRaw('modified','dt',array('readonly'=>true));
		}

	public function getName(){
		return $this->name;
		}
	}
