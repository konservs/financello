<?php
/**
 * Component to work with companies finances.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

bimport('mvc.component');

class Controller_compfinances extends BController{
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
