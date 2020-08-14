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
		$bUsers = \Brilliant\Users\BUsers::getInstance();
		$data->me = $bUsers->getLoggedUser();
		if (empty($data->me)) {
			$data->error = 1;
			return $data;
			}
		//Check if the user has access with this company.
		$data->canSet = ($data->me->id==1);//(empty($this->permissionsFlagSetWebhook)) || ($data->me->can($this->permissionsFlagSetWebhook));
		if (!$data->canSet) {
			$data->error = 403;
			return $data;
			}
		$tg = \Application\Telegram\Telegram::getInstance();
		$r = $tg->setHook();
		$data->set_hook_result = $r;

		$data->error = 0;
		return $data;
		}
	}
