<?php
/**
 * View for members main menu.
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
defined('BEXEC') or die('No direct access!');

class View_menu_membersmenu extends \Brilliant\MVC\BView{
	/**
	 *
	 */
	public function generate($data){
		$this->me=$data->me;
		if(empty($this->me)){
			return 'Could not load user!';
			}
		$this->companies=$data->companies;
		return $this->templateLoad();
		}
	}
