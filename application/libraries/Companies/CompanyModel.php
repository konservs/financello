<?php
/**
 * Company pages. Check.
 *
 * @author Andrii Biriev
 */
namespace Application\Companies;

use Application\Companies\Companies;
use Brilliant\Users\BUsers;
use Brilliant\MVC\BModel;

class CompanyModel extends BModel {
	protected $permissionsFlagView;
	protected $permissionsFlagEdit;

	/**
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->permissionsFlagView = 0;
		$this->permissionsFlagEdit = 0;
	}

	/**
	 *
	 */
	public function getData($segments) {
		$data = new \stdClass();
		$data->error = -1;
		$data->formErrors = [];
		$data->companyId = (int)$segments['company'];
		//Check if me is logged...
		$bUsers = BUsers::getInstance();
		$data->me = $bUsers->getLoggedUser();
		if (empty($data->me)) {
			$data->error = 1;
			return $data;
		}
		//
		$bCompanies = Companies::getInstance();
		$data->company = $bCompanies->itemGet($data->companyId);
		if (empty($data->company)) {
			$data->error = 2;
			return $data;
		}
		//Check if the user has access with this company.
		$data->canView = (empty($this->permissionsFlagView)) || ($data->company->canUser($data->me->id, $this->permissionsFlagView));
		$data->canEdit = (empty($this->permissionsFlagView)) || ($data->company->canUser($data->me->id, $this->permissionsFlagEdit));

		if ((!$data->canView) && (!$data->canEdit)) {
			$data->error = 403;
			return $data;
		}
		$data->error = 0;
		return $data;
	}
}
