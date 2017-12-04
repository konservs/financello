<?php
/**
 * View for "news feed" module
 *
 * @author Andrii Biriev, a@konservs.com
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
defined('BEXEC') or die('No direct access!');

bimport('mvc.component');
bimport('mvc.view');

class View_news_feed extends BView{
	/**
	 * Process last-modified...
	 */
	public function processlastmod(){
		//First tab
		if(is_array($this->latest)){
			foreach($this->latest as $item){
				$this->setlastmodified($item->modified);
				}
			}
		//Second tab
		if(is_array($this->popular)){
			foreach($this->popular as $item){
				$this->setlastmodified($item->modified);
				}
			}
		//Third tab
		if(is_array($this->commentable)){
			foreach($this->commentable as $item){
				$this->setlastmodified($item->modified);
				}
			}
		//done
		return true;
		}
	/**
	 * Prepare HTML
	 */
	public function generate($data){
		$this->latest=$data->latest;
		$this->commentable=$data->commentable;
		$this->commentable_comments=$data->commentable_comments;
		$this->popular=$data->popular;
		//
		$brouter=BRouter::GetInstance();
		$this->url_allnews='//'.$brouter->generateURL('news',BLang::$langcode,array('view'=>'blog','category'=>1));
		//
		$this->processlastmod();
		$this->setcache('true',60);
		return $this->template_load();
		}
	}
