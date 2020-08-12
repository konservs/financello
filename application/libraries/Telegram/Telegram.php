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

	public $botAPIKey; #1305627909:AAEZNdNdIizP9y4PNIwGPYJwGKCC0SRyrLo/getMe';
	public $botUserName; #

	public function getMe() {
		$api_url = $apiURL.'bot'.$this->botAPIKey.'/getMe'
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
			}
		catch (Longman\TelegramBot\Exception\TelegramException $e) {
			// log telegram errors
			// echo $e->getMessage();
			}
		}
	}
