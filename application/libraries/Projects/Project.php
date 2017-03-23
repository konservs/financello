<?php
namespace Application\Project;
use Application\Finances\Projects;

/**
 * Basic class to control single project
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Project extends \Brilliant\Items\BItemsItem{
	protected $collectionname='\Application\Projects\Projects';
	protected $tableName='projects';
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
		$this->fieldAddRaw('name','str');
		//Created & modified
		$this->fieldAddRaw('created','dt',array('readonly'=>true));
		$this->fieldAddRaw('modified','dt',array('readonly'=>true));
		}

	public function getName(){
		return $this->name;
		}
	}
