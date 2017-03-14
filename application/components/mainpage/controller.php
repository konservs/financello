<?php
//============================================================
// Component to work with main page
//
// Author: Andrii Biriev
// Copyright © Brilliant IT corporation, www.it.brilliant.ua
//============================================================
defined('BEXEC') or die;
bimport('mvc.component');

class Controller_mainpage extends BController{
	//====================================================
	//
	//====================================================
	public function __construct(){
		parent::__construct();
		$this->componentname='mainpage';
		}
	//====================================================
	//
	//====================================================
	public function run($segments){
		switch($segments['view']){
			//Additional rules
			//case '...':
			//	$model=$this->LoadModel('...');
			//	$view=$this->LoadView('...');
			//	return($view->generate($model->get_data($segments)));
			//	break;
			default:
				$model=$this->LoadModel($segments['view']);
				if(empty($model))
					return 'Mainpage: could not load model!';
				$view=$this->LoadView($segments['view']);
				if(empty($view))
					return 'Mainpage: could not load view!';
				return($view->generate($model->get_data($segments)));
				break;
			}
		return 'Mainpage: unknown params';
		}
	}
