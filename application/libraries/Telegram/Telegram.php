<?php
namespace Application\Telegram;

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
		parent::__construct();
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
		$res[] = self::$flagCanViewCompany;
		$res[] = self::$flagCanEditCompany;
		$res[] = self::$flagCanViewAccounts;
		$res[] = self::$flagCanEditAccounts;
		$res[] = self::$flagCanViewCurrencies;
		$res[] = self::$flagCanEditCurrencies;
		return $res;
		}

	public function getMe() {
		$api_url = $this->apiURL.'bot'.$this->botAPIKey.'/getMe';
		}

	public function setHook() {
		$hook_url = '';

		try {
			// Create Telegram API object
			$telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
			// Set webhook
			$result = $telegram->setWebhook($hook_url);
			if ($result->isOk()) {
				echo $result->getDescription();
				}
			} catch (Longman\TelegramBot\Exception\TelegramException $e) {
			// log telegram errors
			// echo $e->getMessage();
			}
		}
	}
