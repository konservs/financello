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

class Model_telegram_hook extends \Brilliant\MVC\BModel{
	/**
	 *
	 */
	public function getData($segments) {
		$data = new \stdClass();
		$data->error = -1;
		$tg = \Application\Telegram\Telegram::getInstance();
		$data->error = $tg->hook();
		return $data;
		}
	}
