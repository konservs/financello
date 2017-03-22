<?php
/**
 * Component to work with companies finances.
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
defined('BEXEC') or die('No direct access!');

class Controller_finances extends \Brilliant\MVC\BController{
	/**
	 *
	 */
	public function run($segments){
		switch($segments['view']){
			case 'opgroupadd':
				$model=$this->LoadModel('opgroupadd');
				if(empty($model)){
					return 'Companies Finances: could not load model!';
					}
				$view=$this->LoadView('opgroup');
				if(empty($view)){
					return 'Companies Finances: could not load view "'.$segments['view'].'"!';
					}
				return($view->generate($model->get_data($segments)));
				break;
			default:
				$model=$this->LoadModel($segments['view']);
				if(empty($model)){
					return 'Companies Finances: could not load model!';
					}
				$view=$this->LoadView($segments['view']);
				if(empty($view)){
					return 'Companies Finances: could not load view "'.$segments['view'].'"!';
					}
				return($view->generate($model->get_data($segments)));
				break;
			}
		return 'Companies Finances: unknown params';
		}
	}
