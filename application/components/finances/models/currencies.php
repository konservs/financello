<?php
/**
 * Model to load accounts.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

use \Application\Companies\Companies;
use \Application\Finances\CompanyCurrencies;

class Model_finances_currencies extends \Application\Companies\CompanyModel{
	/**
	 * Model_finances_currencies constructor.
	 */
	public function __construct(){
		parent::__construct();
		$this->permissionsFlagView = Companies::$flagCanViewCurrencies;
		$this->permissionsFlagEdit = Companies::$flagCanEditCurrencies;
		}

	/**
	 * Get data (currencies list)
	 *
	 * @param $segments
	 * @return stdClass
	 */
	public function getData($segments){
		$data=parent::getData($segments);
		if($data->error!=0){
			return $data;
			}
		$bCompanyCurrencies=CompanyCurrencies::getInstance();
		$data->currencies=$bCompanyCurrencies->itemsFilter(array('company'=>$data->companyId));
		$data->error=0;
		return $data;
		}
	}
