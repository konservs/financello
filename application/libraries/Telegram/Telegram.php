<?php
namespace Application\Telegram;

use \Brilliant\Log\BLog;
use \Brilliant\HTTP\BRequest;

/**
 * Basic class to control telegram bot
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
class Telegram {
	use \Brilliant\BSingleton;
	protected $apiURL='https://api.telegram.org/';
	protected $itemClassName='\Application\Finances\Category';

	public $botAPIKey; #
	public $botUserName; #

	/**
	 * Constructor - init fields...
	 */
	function __construct() {
		$this->botAPIKey = TELEGRAM_API_KEY;
		$this->botUserName = TELEGRAM_BOT_USERNAME;
		}

	//Some flags
	public static $flagCanSetWebhook = 'telegramSetWebHook';
	/**
	 * Get all access flags
	 *
	 * @return string[]
	 */
	public static function getAllFlags() {
		$res = array();
		$res[] = self::$flagCanSetWebHook;
		return $res;
		}

	public function getMe() {
		$api_url = $this->apiURL.'bot'.$this->botAPIKey.'/getMe';
		}
	/**
	 * Set webhook URL
	 *
	 * @return integer
	 */
	public function setHook() {
		$hook_url = '';
		$brouter=\Application\BRouter::GetInstance();
		$hook_url=$brouter->generateURL('telegram',array('view'=>'hook'),['usehostname'=>1, 'protocol'=>'https://']);
		if(empty($hook_url)){
			BLog::addtolog('[Telegram]: Hook URL is empty!');
			return 1;
			}
		$hook_url = $protocol.$hook_url;

		BLog::addtolog('[Telegram]: Hook URL: '.$hook_url);
		try {
			// Create Telegram API object
			$telegram = new \Longman\TelegramBot\Telegram($this->botAPIKey, $this->botUserName);
			// Set webhook
			$result = $telegram->setWebhook($hook_url);
			if ($result->isOk()) {
				return 0;
				}
			return -1;
			}
		catch (\Longman\TelegramBot\Exception\TelegramException $e) {
			// log telegram errors
			BLog::addtolog('[Telegram]: SetWebHookError: '.$e->getMessage(),LL_ERROR);
			}
		}
	/**
	 * Handle hook...
	 *
	 * @return integer
	 */
	public function hook() {
		BLog::addtolog('[Telegram]: Hook URL: '.$hook_url);
		try {
			// Create Telegram API object
			$telegram = new \Longman\TelegramBot\Telegram($this->botAPIKey, $this->botUserName);
			// Set webhook
			$result = $telegram->handle();
			if (($result)&&($result->isOk())) {
				return 0;
				}
			return -1;
			}
		catch (\Longman\TelegramBot\Exception\TelegramException $e) {
			// log telegram errors
			BLog::addtolog('[Telegram]: Hook error: '.$e->getMessage(),LL_ERROR);
			}
		}
	}
