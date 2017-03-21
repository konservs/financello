<?php
/**
 * Users dashboard page
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
defined('BEXEC') or die('No direct access!');

class Model_users_dashboard extends \Brilliant\MVC\BModel{
	/**
	 * Model - get data
	 */
	public function get_data($segments){
		$data=new stdClass;
		$busers=\Brilliant\Users\BUsers::getInstance();
		$data->me=$busers->getLoggedUser();
		if(empty($data->me)){
			return $data;
			}
		return $data;
		}
	}
