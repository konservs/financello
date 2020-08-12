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
	}
