<?php
/**
 * Component to work with telegram bot.
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
defined('BEXEC') or die('No direct access!');

class Controller_telegram extends \Brilliant\MVC\BController{
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
		return($view->generate($model->getData($segments)));
		}
	}
