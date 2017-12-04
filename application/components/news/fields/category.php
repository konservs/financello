<?php
/**
 * Field to select news category
 *
 * @author Andrii Biriev, a@konservs.com
 *
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
defined('BEXEC') or die('No direct access!');
bimport('mvc.component');
bimport('mvc.field');
bimport('mvc.field.list');
bimport('news.categories');

class BControllerField_news_category extends BControllerField_list{
	/**
	 * Load necessary data.
	 */
	public function prepare(){
		$this->items=array();
		//If we can select empty category
		if($this->params['allownocat']){
			$this->items['*']='Без категории';
			}
		$bnc=BNewsCategories::getInstance();
		$cattree=$bnc->getsimpletree(array('level'),array('name'));
		//Process ROOT items...
		foreach($cattree as $ri){
			$this->items[$ri->id]=str_repeat(' -> ',($ri->level-1)).$ri->name;
			}
		}//end of prepare()
	}
