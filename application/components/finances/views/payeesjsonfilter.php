<?php
/**
 * View for ...
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

class View_finances_payeesjsonfilter extends \Brilliant\MVC\BView{
	/**
	 *
	 */
	public function generate($data){
		return json_encode($data->json);
		}
	}
