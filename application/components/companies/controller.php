<?php
/**
 * Component to work with companies.
 *
 * @author Andrii Biriev
 * @copyright © 2014 Brilliant IT corporation, www.it.brilliant.ua
 */
defined('BEXEC') or die('No direct access!');

bimport('mvc.component');

class Controller_companies extends BController{
	/**
	 *
	 */
	public function run($segments){
		$model=$this->LoadModel($segments['view']);
		if(empty($model)){
			return 'Companies: could not load model!';
			}
		$view=$this->LoadView($segments['view']);
		if(empty($view)){
			return 'Companies: could not load view "'.$segments['view'].'"!';
			}
		return($view->generate($model->get_data($segments)));
		}
	}
