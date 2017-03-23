<?php
namespace Application\Bugtracker;
use Application\Bugtracker\Issues;

/**
 * Basic class to control single project
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Issue extends \Brilliant\Items\BItemsItem{
	protected $collectionname='\Application\Bugtracker\Issues';
	protected $tableName='bugtracker_issues';
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
