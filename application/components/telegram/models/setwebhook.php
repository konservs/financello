<?php
/**
 * Model of MyCompany dashboard page.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

use \Application\Companies\Companies;
use \Application\Finances\Accounts;
use \Application\Telegram\Telegram;

class Model_telegram_setwebhook extends \Brilliant\MVC\BModel{
	/**
	 *
	 */
	public function __construct(){
		parent::__construct();
		$this->permissionsFlagSetWebhook = Telegram::$flagCanSetWebhook;
		}
	/**
	 *
	 */
	public function getData($segments) {
		$data = new \stdClass();
		$data->error = -1;
		$data->formErrors = [];
		//Check if me is logged...
		$bUsers = BUsers::getInstance();
		$data->me = $bUsers->getLoggedUser();
		if (empty($data->me)) {
			$data->error = 1;
			return $data;
			}
		//Check if the user has access with this company.
		//$data->canView = (empty($this->permissionsFlagView)) || ($data->company->canUser($data->me->id, $this->permissionsFlagView));
		//$data->canEdit = (empty($this->permissionsFlagView)) || ($data->company->canUser($data->me->id, $this->permissionsFlagEdit));

		if ((!$data->canView) && (!$data->canEdit)) {
			$data->error = 403;
			return $data;
			}
		$data->error = 0;
		return $data;
		}
	}
