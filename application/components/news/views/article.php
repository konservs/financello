<?php
/**
 * View for article
 *
 * @author Andrii Biriev, a@konservs.com
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
defined('BEXEC') or die('No direct access!');

bimport('mvc.component');
bimport('mvc.view');
bimport('cms.breadcrumbs');

class View_news_article extends BView{
	/**
	 * Prepare breadcrumbs object
	 */
	public function prepare_breadcrumbs(){
		$lang=BLang::$langcode;
		$brouter=BRouter::getInstance();
		$this->breadcrumbs_add_homepage();
		//Parent categories
		/*if(!empty($this->category)){
			$cats=$this->category->getCategoryTree();
			foreach($cats as $cat){
				if($cat->id != $this->category->id){
					$this->breadcrumbs_add(
						'//'.$brouter->generateurl('news',$lang,array('view'=>'blog','id'=>$cat->id)),
						$cat->getname(),
						true);
					}
				}
			//Our category
			$this->breadcrumbs_add(
				'',
				$this->category->getname(),
				false);
			}*/
		}
	/**
	 *
	 */
	public function generateheaders(){
		$this->setlastmodified($this->article->modified);
		//Get heading (H1 tag)
		$this->heading=$this->article->geth1();
		if(empty($this->heading)){
			$this->heading=$this->article->getname();
			}
		//Get Title
		$this->title=$this->article->gettitle();
		if(empty($this->title)){
			$this->title=$this->article->getname();
			}
		$this->settitle($this->title);
		//Get META tags...
		$this->metadesc=$this->article->getmetadesc();
		if(empty($this->metadesc)){
			$this->metadesc=$this->article->getintro();
			}
		$this->addmeta('description',$this->metadesc);
		//Get META keywords
		$this->metakeyw=$this->article->getmetakeyw();
		if(empty($this->metakeyw)){
			$tags=$this->article->gettags();
			$arr=array();
			if(!empty($tags)){
				foreach($tags as $tag){
					$arr[]=$tag->getname();
					}
				}
			$this->metakeyw=implode(', ',$arr);
			}
		$this->addmeta('keywords',$this->metakeyw);
/*
			$this->setlastmodified($this->category->modified);
			$this->addmeta('keywords',$this->category->getmetakeyw($lang));
			}*/
		//Some useful links
		$brouter=BRouter::getInstance();
		$this->url_nolang='//'.$brouter->generateURL('news','ua',array('view'=>'article','id'=>$this->article->id));
		//
		$cat=$this->article->getcategory();
		$this->category_link=$cat->getURL();
		$this->category_name=$cat->getname();
		$this->canonicallink='';
		//
		if($this->article->{'active_'.BLang::$langcode}=='Y'){
			$this->canonicallink=$this->article->getURL(BLang::$langcode,'https://');
			}
		elseif($this->article->active_ua=='Y'){
			$this->canonicallink=$this->article->getURL('ua','https://');
			}
		elseif($this->article->active_ru=='Y'){
			$this->canonicallink=$this->article->getURL('ru','https://');
			}
		if(!empty($this->canonicallink)){
			$canonical=array();
			$canonical['href']=$this->canonicallink;
			$canonical['rel']='canonical';
			$this->add_link($canonical);
			}


		//
		bimport('http.useragent');
		$device=BBrowserUseragent::getDeviceSuffix();
		//
		if($device=='.d'){
			$this->articleimgsuffix=$cat->articleimgsuffix_d;
			if(empty($this->articleimgsuffix)){
				$this->articleimgsuffix='r695x430';
				}
			}else{
			$this->articleimgsuffix=$cat->articleimgsuffix_m;
			if(empty($this->articleimgsuffix)){
				$this->articleimgsuffix='r575x340';
				}
			}
		$this->articleimgwidth='';
		$this->articleimgheight='';
		//Add OpenGraph tags..
		//$protocol=(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https:" : "http:";
		$protocol='https:';
		$this->addmeta('','article','',array('property'=>'og:type'));
		$this->addmeta('',$protocol.$this->article->geturl(),'',array('property'=>'og:url'));
		$this->addmeta('',$this->title,'',array('property'=>'og:title'));
		$this->addmeta('',$this->metadesc,'',array('property'=>'og:description'));
		$this->addmeta('',$this->article->urlimagemain('r695x430','http://'),'',array('property'=>'og:image'));
		$this->addmeta('',$this->article->urlimagemain('r695x430','https://'),'',array('property'=>'og:image:secure_url'));
		$this->addmeta('','695','',array('property'=>'og:image:width'));
		$this->addmeta('','430','',array('property'=>'og:image:height'));
		//<meta property="og:image:type"       content="image/png">
		//Add Facebook tags
		$fbid=SOCIAL_FB_ID;
		if(($fbid!='')&&($fbid!='SOCIAL_FB_ID')){
			$this->addmeta('',$fbid,'',array('property'=>'fb:app_id'));
			}

		}
	/**
	 * Prepare HTML
	 */
	public function generate($data){
		$this->article=$data->article;
		$this->category=$data->category;
		$this->poll=$data->poll;
		$this->linkedarticles=$data->linkedarticles;
		if(empty($this->article)){
			return 'Could not load article!';
			}
		//
		$this->generateheaders();
		$this->prepare_breadcrumbs();
		$this->setcache('true',300);//5 minutes
		return $this->template_load();
		}
	}
