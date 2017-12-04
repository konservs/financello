<?php
/**
 * View for blog
 *
 * @author Andrii Biriev, a@konservs.com
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
defined('BEXEC') or die('No direct access!');

bimport('mvc.component');
bimport('mvc.view');
bimport('cms.breadcrumbs');

class View_news_blog extends BView{
	/**
	 * Prepare breadcrumbs object
	 */
	public function prepare_breadcrumbs(){
		$lang=BLang::$langcode;
		$brouter=BRouter::getInstance();
		$this->breadcrumbs_add_homepage();
		}
	/**
	 * Prepare HTML
	 */
	public function generate($data){
		$this->category=$data->category;
		$this->items=$data->items;
		$this->topitems=$data->topitems;
		$this->pagination=$data->pagination;
		if(is_array($this->items)){
			foreach($this->items as $item){
				$this->setlastmodified($item->modified);
				}
			}
		$this->heading='';
		if(!empty($this->category)){
			$title=$this->category->gettitle();
			if(empty($title)){
				$title=$this->category->getname();
				}
			$this->settitle($title);
			$this->setlastmodified($this->category->modified);
			$this->addmeta('description',$this->category->getmetadesc());
			$this->addmeta('keywords',$this->category->getmetakeyw());
			//
			$this->heading=$this->category->geth1();
			if(empty($this->heading)){
				$this->heading=$this->category->getname();
				}			
			//Add canonical URL
			$canonical=array();
			$canonical['href']=$this->category->getURL(BLang::$langcode,'https://');
			$canonical['rel']='canonical';
			$this->add_link($canonical);
			//add RSS URL
			$rssurl=$this->category->getRSSURL('','https://');
			$this->add_link(array('title'=>$this->category->getname(),'type'=>'application/rss+xml','rel'=>'alternate','href'=>$rssurl));
			}
		$this->setcache('true');
		$this->prepare_breadcrumbs();
		return $this->template_load();
		}
	}
