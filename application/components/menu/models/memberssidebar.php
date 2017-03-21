<?php
/**
 * Members main menu. Generating by companies list and some other data.
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
defined('BEXEC') or die('No direct access!');

class Model_menu_memberssidebar extends \Brilliant\MVC\BModel{
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
		$data->companies=array();//$data->me->getcompanies();
		return $data;
		}
	}
