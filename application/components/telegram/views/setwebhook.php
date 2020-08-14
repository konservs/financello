<?php
/**
 * View for telegram setWebHook
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

class View_telegram_setwebhook extends \Brilliant\MVC\BView {
	/**
	 *
	 */
	public function generate($data) {
		if ($data->error == 403) {
			$this->setStatus(403);
			return $this->templateLoad('#error_403', true);
			}
		if ($data->error == 1) {
			$this->setStatus(500);
			return 'Error: #' . $data->error.'. User not authorized. Please, log in.';
			}
		elseif ($data->error != 0) {
			$this->setStatus(500);
			return 'Error: #' . $data->error;
			}
		return 'ok. Result='.$data->set_hook_result;
		}
	}
