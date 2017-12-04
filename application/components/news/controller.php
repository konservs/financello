<?php
/**
 * Component to work with news
 * 
 * @author Andrii Biriev
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
defined('BEXEC') or die('No direct access!');

bimport('mvc.component');

class Controller_news extends BController{
	/**
	 *
	 */
	public function run($segments){
		switch($segments['view']){
			//Additional rules
			default:
				$model=$this->LoadModel($segments['view']);
				if(empty($model)){
					return 'News: could not load model!';
					}
				$view=$this->LoadView($segments['view']);
				if(empty($view)){
					return 'News: could not load view!';
					}
				return($view->generate($model->get_data($segments)));
				break;
			}
		return 'News: unknown params';
		}
	}
