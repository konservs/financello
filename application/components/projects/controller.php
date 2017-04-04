<?php
/**
 * Component to work with companies projects.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

bimport('mvc.component');

class Controller_compprojects extends BController{
	/**
	 *
	 */
	public function run($segments){
		$model=$this->LoadModel($segments['view']);
		if(empty($model)){
			return 'Companies Projects: could not load model!';
			}
		$view=$this->LoadView($segments['view']);
		if(empty($view)){
			return 'Companies Projects: could not load view!';
			}
		return($view->generate($model->getData($segments)));
		}
	}
