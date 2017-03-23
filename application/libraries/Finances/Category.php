<?php
namespace Application\Finances;

/**
 * Basic class to control single finances category
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Category extends \Brilliant\Items\BItemsItem{
	protected $collectionName='\Application\Finances\Categories';
	protected $tableName='fin_categories';
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
		//Statistics (all fields are readonly)
		$this->fieldAddRaw('balance','float',array('readonly'=>true));
		//Created & modified
		$this->fieldAddRaw('created','dt',array('readonly'=>true));
		$this->fieldAddRaw('modified','dt',array('readonly'=>true));
		}

	public function getName(){
		return $this->name;
		}
	}
