<?php
/**
 * Model of MyCompany dashboard page.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

use \Application\Companies\Companies;
use \Application\Finances\Accounts;

class Model_companies_mycompany extends \Application\Companies\CompanyModel{
	/**
	 *
	 */
	public function __construct(){
		parent::__construct();
		$this->permissionsFlagView = Companies::$flagCanViewCompany;
		$this->permissionsFlagEdit = Companies::$flagCanEditCompany;
		}
	}
