<?php
/**
 * Sets of functions and classes to work with routes: Get the
 * URL and convert it to MVC, load component
 * 
 * Get the MVC and convert into URL
 * 
 * @author Andrii Biriev, <a@konservs.com>
 * 
 * @copyright © Andrii Biriev, <a@konservs.com>
 */
namespace Application;
use Brilliant\cms\BLang;
use Brilliant\cms\BRouterBase;
use Brilliant\log\BLog;

class BRouter extends BRouterBase{
	protected static $starttime=0;
	protected static $instance=NULL;
	protected $components=array('content','users');
	protected $router=array();
	protected $positions=array();
	protected $rules=array();
	protected $soft_rules=array();
	protected $maincom=NULL;
	protected $langcode='';
	protected $deflang='en';
	public $templatename='default';
	public $frontendtemplate='default';
	/**
	 * Get logged user object. Helper function.
	 * 
	 * @return \BUser|NULL Logged user
	 */
	public function getLoggedUser(){
		bimport('users.general');
		$busers=BUsers::getInstance();
		return $busers->getLoggedUser();
		}
	/**
	 * Add some fixed rules - languages switch, etc.
	 */
	public function addfixedrules(){
		/*bimport('users.session');
		$session=BUsersSession::getInstanceAndStart();
		if(!empty($session)){
			bimport('users.general');
			$uid=$session->userid;
			}else{	
			$uid=NULL;
			}
		if(!empty($uid)){
			$this->rules[]=(object)array(
				'com' => 'users',
				'position' => 'userpanel',
				'segments' => array('view'=>'userpanel','uid'=>$uid),
				);
			}else{
			$this->rules[]=(object)array(
				'com' => 'users',
				'position' => 'userpanel',
				'segments' => array('view'=>'userpanel'),
				);
			}*/
		}
	/**
	 *
	 */
	public function getmainurl($lang){
		$URL_main=BHOSTNAME.'/';
		if($lang!=$this->deflang){
			$URL_main.=$lang.'/';
			}
		return $URL_main;
		}
	/**
	 *
	 */
	public function generate_contenturl($lang,$segments){
		$url_content=$this->getmainurl($lang).'content/';
		$view=isset($segments['view'])?$segments['view']:'';
		switch($view){
			case 'article':
				BLog::addtolog('[Router]: generating content article URL...');
				$artid=(int)$segments['id'];
				bimport('content.articles');
				$bnart=BNewsArticles::getInstance();
				$article=$bnart->item_get($artid);
				if(empty($article)){
					BLog::addtolog('[Router]: Could not get article with id='.$artid,LL_ERROR);
					return '';
					}
				if(empty($article->category)){
					BLog::addtolog('[Router]: The article category is empty!',LL_ERROR);
					return '';
					}
				$url=$this->generate_contenturl($lang,array('view'=>'blog','category'=>$article->category));
				$url.=$article->getalias($lang).'-'.$article->id;
				return $url;
			case 'blog':
				BLog::addtolog('[Router]: generating content blog URL...');
				$url=$url_content;
				bimport('content.categories');
				$categoryid=isset($segments['category'])?$segments['category']:0;
				if(empty($categoryid)){
					return '';
					}
				$bncats=BNewsCategories::getInstance();
				$category=$bncats->item_get($categoryid);
				if(empty($category)){
					return '';
					}
				$list=$category->getparentchain();
				if((isset($list[1]))&&($list[1]->id==1)){
					unset($list[1]);
					}
				$url=$url_content;
				foreach($list as $f){
					$url.=$f->getalias($lang).'/';
					}
				return $url;
			}
		return '';
		}
	/**
	 * Generate URL by component, language and segments
	 * in case of sucessfull parse return URL, else return false;
	 *
	 * @param string $component
	 * @param string $lang
	 * @param array $segments
	 */
	public function generateURL($component,$lang,$segments){
		if(ROUTER_DEBUG){
			BLog::addtolog('[Router]: generating URL...');
			BLog::addtolog('[Router]: $component='.$component);
			BLog::addtolog('[Router]: $lang='.$lang);
			BLog::addtolog('[Router]: $segments='.var_export($segments,true));
			}
		$URL='';
		
		switch($component){
			case 'content':
				return $this->generate_contenturl($lang,$segments);
			case 'mainpage':
				return $this->getmainurl($lang);
			}
		}
	/**
	 *
	 */
	public function generateURLmain($lang='',$useparams=true){
		if(empty($lang)){
			$lang=BLang::$langcode;
			}
		$url=$this->generateURL($this->maincom->com,$lang,$this->maincom->segments);
		if($useparams){
			bimport('http.request');
			$url.=BRequest::getGetString();
			}
		return $url;
		}
	/**
	 * Parse /content/ branch.
	 * 
	 * Language - $this->langcode
	 */
	public function parseurl_content($f_path){
		if(ROUTER_DEBUG){
			BLog::addtolog('[Router]: We are in content branch now!');
			}
		//Remove lateset empty chain.
		if(end($f_path)==''){
			array_pop($f_path);
			}
		//
		$segments=array();
		//Get page.
		if(substr(end($f_path),0,4)=='page'){
			$num=substr(end($f_path),4);
			if(is_numeric($num)){
				$segments['page']=(int)$num;
				array_pop($f_path);
				}
			}
		//content - homepage
		if(empty($f_path)){
			$segments['view']='blog';
			$segments['category']=1;
			$this->maincom=(object)array(
				'com'=>'content',
				'position'=>'content',
				'segments'=>$segments,
				);
			$this->addfixedrules();
			$this->rules[]=$this->maincom;
			$this->softmodulesget('content:category:1');
			return true;
			}
		if((count($f_path)==1)&&($f_path[0]=='archive')){
			$segments['view']='archives';
			$this->maincom=(object)array(
				'com'=>'content',
				'position'=>'content',
				'segments'=>$segments,
			);
			$this->addfixedrules();
			$this->rules[]=$this->maincom;
			//$this->softmodulesget('blogs:authors');
			$this->softmodulesget('content:home');
			return true;
			}
		//
		if((count($f_path)==2)&&($f_path[0]=='archive')&&(substr($f_path[1],0,5)=='year-')){
			$year=(int)substr($f_path[1],5);
			if(empty($year)){
				return false;
				}
			$segments['view']='archives';
			$segments['year']=$year;
			$this->maincom=(object)array(
				'com'=>'content',
				'position'=>'content',
				'segments'=>$segments,
				);
			$this->addfixedrules();
			$this->rules[]=$this->maincom;
			$this->softmodulesget('content:archive');
			return true;
			}
		//
		if((count($f_path)==2)&&($f_path[0]=='archive')&&(substr($f_path[1],0,5)=='date-')){
			//NOW datetime and URL
			$now=new DateTime();
			$nyear=(int)$now->format('Y');
			$nmonth=(int)$now->format('m');
			$nday=(int)$now->format('d');
			$url_dtnow=$this->generateURL('content',BLang::$langcode,array('view'=>'archive_date','year'=>$nyear,'month'=>$nmonth,'day'=>$nday));
			//Date of blogs start posting
			//$syear=2015;
			//$smonth=12;
			//$sday=17;
			//
			$date=substr($f_path[1],5);
			$xdate=explode('-',$date);
			if((count($xdate)!=3)||(strlen($date)!=10)){
				$this->ctype=CTYPE_REDIRECT301;
				$this->redirectURL='//'.$url_dtnow;
				return true;
				}
			$iyear=(int)$xdate[0];
			$imonth=(int)$xdate[1];
			$iday=(int)$xdate[2];
			if((empty($iyear))||(empty($iday))||(empty($imonth))){
				$this->ctype=CTYPE_REDIRECT301;
				$this->redirectURL='//'.$url_dtnow;
				return true;
				}
			$ddate=new DateTime($iyear.'-'.$imonth.'-'.$iday);
			//Chek for datetime in future.
			if(($iyear>$nyear)||(($iyear==$nyear)&&($imonth>$nmonth))||(($iyear==$nyear)&&($imonth==$nmonth)&&($iday>$nday))){
				$this->ctype=CTYPE_REDIRECT301;
				$this->redirectURL='//'.$url_dtnow;
				return true;
				}
			//Canonical URL
			$gen_url=$this->generateURL('content',BLang::$langcode,array('view'=>'archive_date','year'=>$iyear,'month'=>$imonth,'day'=>$iday));
			$cur_url=$this->host.parse_url($this->url,PHP_URL_PATH);
			if($cur_url!=$gen_url){
				$this->ctype=CTYPE_REDIRECT301;
				$this->redirectURL='//'.$gen_url;
				return;
				}
			$segments['view']='archive_date';
			$segments['year']=$iyear;
			$segments['month']=$imonth;
			$segments['day']=$iday;
			//
			$this->maincom=(object)array(
				'com'=>'content',
				'position'=>'content',
				'segments'=>$segments,
				);
			$this->addfixedrules();
			$this->rules[]=$this->maincom;
			$this->softmodulesget('content:archive');
			return true;
			}
		//content with photo
		if((count($f_path)==1)&&(($f_path[0]=='photo')||$f_path[0]=='video'||$f_path[0]=='search')){
			$segments['view']=$f_path[0];
			$this->maincom=(object)array(
				'com'=>'content',
				'position'=>'content',
				'segments'=>$segments,
				);
			$this->addfixedrules();
			$this->rules[]=$this->maincom;
			$this->softmodulesget('content:'.$f_path[0]);
			return true;
			}
		//
		if((count($f_path)==1)&&($f_path[0]=='mod_photo.json')){
			$segments['view']='mod_photo_content';
			$this->maincom=(object)array(
				'com'=>'content',
				'position'=>'content',
				'segments'=>$segments,
				);
			$this->ctype=CTYPE_JSON;
			$this->rules[]=$this->maincom;
			return true;
			}
		//Новости - модуль новостей по категории. Загрузка аяксом
		if((count($f_path)==1)&&($f_path[0]=='mod_bycategory.json')){
			$segments['view']='mod_bycategory_content';
			$this->maincom=(object)array(
				'com'=>'content',
				'position'=>'content',
				'segments'=>$segments,
				);
			$this->ctype=CTYPE_JSON;
			$this->rules[]=$this->maincom;
			return true;
			}
		//Новости - модуль новостей по тегу. Загрузка аяксом
		if((count($f_path)==1)&&($f_path[0]=='mod_bytag.json')){

			$segments['view']='mod_bytag_content';
			$this->maincom=(object)array(
				'com'=>'content',
				'position'=>'content',
				$this->ctype=CTYPE_JSON,
				'segments'=>$segments,
			);
			$this->addfixedrules();
			$this->rules[]=$this->maincom;
			$this->softmodulesget('content: home');
			return true;
		}
		//
		$suffix=end(explode('-',end($f_path)));
		//Article
		if(is_numeric($suffix)){
			BLog::addtolog('[Router]: found something like content article');
			$articleid=(int)$suffix;
			$segments=array('view'=>'article','id'=>$articleid);
			bimport('content.articles');
			$bcontentarticles=BNewsArticles::getInstance();
			$article=$bcontentarticles->item_get($articleid);
			if(empty($article)){
				BLog::addtolog('[Router]: Could not load article!',LL_ERROR);
				return false;
				}
			$gen_url=$this->generateURL('content',BLang::$langcode,$segments);
			$cur_url=$this->host.parse_url($this->url,PHP_URL_PATH);
			if($cur_url!=$gen_url){
				$this->ctype=CTYPE_REDIRECT301;
				$this->redirectURL='//'.$gen_url;
				return;
				}
			$this->contentcat=$article->category;
			$this->maincom=(object)array(
				'com'=>'content',
				'position'=>'content',
				'segments'=>$segments,
				);
			$this->addfixedrules();
			$this->rules[]=$this->maincom;
			//$this->softmodulesget('content:article:'.$article->id);
			$this->softmodulesget('content:contentcat:'.$article->category);
			return true;
			}
		//Прес-релизы. Загрузка аяксом
		if($f_path[count($f_path)-1]=='pr_content.json'){
			BLog::addtolog('[Router]: found something like random content AJAX loader.');
			//
			bimport('content.categories');
			$bcontentcat=BNewsCategories::getInstance();
			unset($f_path[count($f_path)-1]);
			$category=$bcontentcat->getitembyaliaschain($f_path,BLang::$langcode);
			if(empty($category)){
				BLog::addtolog('[Router]: Could not load content category!',LL_ERROR);
				return false;
				}
			//
			if(!empty($category->template)){
				$this->templatename=$category->template;
				}
			bimport('http.request');
			$segments['view']='pr_content';
			$segments['basecat']=$category->id;
			$segments['category']=BRequest::GetInt('category');
			$segments['limit']=BRequest::GetInt('limit');
			$this->maincom=(object)array(
				'com'=>'content',
				'position'=>'content',
				'segments'=>$segments
				);
			$this->ctype=CTYPE_JSON;
			$this->rules[]=$this->maincom;
			return true;
			}
		//
		BLog::addtolog('[Router]: found something like content category');
		bimport('content.categories');
		$bcontentcat=BNewsCategories::getInstance();
		if(end($f_path)==''){
			array_pop($f_path);
			}
		//
		$category=$bcontentcat->getitembyaliaschain($f_path,BLang::$langcode);
		if(empty($category)){
			BLog::addtolog('[Router]: Could not load content category!',LL_ERROR);
			return false;
			}
		//
		$this->contentcategory=$category->id;
		$segments['view']='blog';
		$segments['category']=$category->id;

		if(!empty($category->template)){
			$this->templatename=$category->template;
			}
		//
		$this->maincom=(object)array(
			'com'=>'content',
			'position'=>'content',
			'segments'=>$segments
			);
		$this->addfixedrules();
		$this->rules[]=$this->maincom;
		$this->softmodulesget('content:category:'.$category->id);
		return true;
		}
	/**
	 * Parse /social/ branch.
	 * 
	 * Language - $this->langcode
	 */
	public function parseurl_social($f_path){
		BLog::addtolog('[Router]: We are in social branch now!');
		//Unset the latest empty "/" in url.
		if((count($f_path))&&(empty($f_path[count($f_path)-1]))){
			BLog::addtolog('[Router]: parseurl_social() removing latest "/" character.');
			unset($f_path[count($f_path)-1]);
			}
		//
		if((count($f_path)==2)&&($f_path[0]=='auth')){
			$sn=$f_path[1];//Social Network
			$this->maincom=(object)array(
				'com'=>'social',
				'position'=>'content',
				'segments'=>array('view'=>'auth','network'=>$sn),
				);
			$this->rules[]=$this->maincom;
			return true;
			}
		//
		if((count($f_path)==2)&&($f_path[0]=='complete')){
			$sn=$f_path[1];//Social Network
			$this->maincom=(object)array(
				'com'=>'social',
				'position'=>'content',
				'segments'=>array('view'=>'complete','network'=>$sn),
				);
			$this->addfixedrules();
			$this->rules[]=$this->maincom;
			return true;
			}
		//
		if((count($f_path)==1)&&($f_path[0]=='privacy-policy')){
			$sn=$f_path[1];//Social Network
			$this->maincom=(object)array(
				'com'=>'social',
				'position'=>'content',
				'segments'=>array('view'=>'ppolicy'),
				);
			$this->rules[]=$this->maincom;
			return true;
			}

		BLog::addtolog('[Router]: parseurl_social() no rules! $f_path='.var_export($f_path,true),LL_ERROR);
		return false;
		}
	/**
	 * Parse /users/ branch.
	 * 
	 * Language - $this->langcode
	 */
	public function parseurl_users($f_path){
		BLog::addtolog('[Router]: We are in users branch now!');
		//Unset the latest empty "/" in url.
		if((count($f_path))&&(empty($f_path[count($f_path)-1]))){
			BLog::addtolog('[Router]: parseurl_users() removing latest "/" character.');
			unset($f_path[count($f_path)-1]);
			}
		//
		if((count($f_path)==1)&&(($f_path[0]=='login')||($f_path[0]=='logout'))){
			$sn=$f_path[1];//users Network
			$this->maincom=(object)array(
				'com'=>'users',
				'position'=>'content',
				'segments'=>array('view'=>$f_path[0]),
				);
			$this->rules[]=$this->maincom;
			return true;
			}
		BLog::addtolog('[Router]: parseurl_users() no rules! $f_path='.var_export($f_path,true),LL_ERROR);
		return false;
		}
	/**
	 * Parse /other/ branch.
	 *
	 * Language - $this->langcode
	 */
	public function parseurl_other($f_path){
		BLog::addtolog('[Router]: We are in other branch now!');
		if((count($f_path))&&(empty($f_path[count($f_path)-1]))){
			BLog::addtolog('[Router]: parseurl_other() removing latest "/" character.');
			unset($f_path[count($f_path)-1]);
			}
		//
		if((count($f_path)==1)&&($f_path[0]=='submitnews.json')){
			$this->maincom=(object)array(
				'com'=>'other',
				'position'=>'content',
				'segments'=>array('view'=>'submitnews'),
				);
			$this->ctype=CTYPE_JSON;
			$this->rules[]=$this->maincom;
			return true;
			}
		//
		if((count($f_path)==1)&&($f_path[0]=='submitads.json')){
			$this->maincom=(object)array(
				'com'=>'other',
				'position'=>'content',
				'segments'=>array('view'=>'submitads'),
				);
			$this->ctype=CTYPE_JSON;
			$this->rules[]=$this->maincom;
			return true;
			}
		//
		if((count($f_path)==1)&&($f_path[0]=='addticket.json')){
			$this->maincom=(object)array(
				'com'=>'other',
				'position'=>'content',
				'segments'=>array('view'=>'addticket'),
				);
			$this->ctype=CTYPE_JSON;
			$this->rules[]=$this->maincom;
			return true;
			}
		//
		if((count($f_path)==1)&&($f_path[0]=='contacts')){
			$this->maincom=(object)array(
				'com'=>'other',
				'position'=>'content',
				'segments'=>array('view'=>'contacts'),
				);
			$this->addfixedrules();
			$this->rules[]=$this->maincom;
			//$this->softmodulesget('blogs:authors');
			$this->softmodulesget('other:home');
			return true;
			}
		//
		if(empty($f_path)){
			$this->maincom=(object)array(
				'com'=>'other',
				'position'=>'content',
				'segments'=>array('view'=>'home'),
			);
			$this->addfixedrules();
			$this->rules[]=$this->maincom;
			$this->softmodulesget('other:home');
			return true;
			}
		BLog::addtolog('[Router]: parseurl_other() no rules! $f_path='.var_export($f_path,true),LL_ERROR);
		return false;
		}
	/**
	 * Parse URL and returns segments, if all is ok.
	 */
	public function parseurl($URL,$host){
		$u=parse_url($URL);
		$u_path=$u['path'];
		$u_query=$u['query'];
		$u_fragment=$u['fragment'];


		parse_str($u_query,$f_query);
		$f_path=explode('/',$u_path);
		array_shift($f_path);
		//Get subdomain type
		$exploded_host=explode('.',$host);
		if($exploded_host[0]=='www'){
			$this->ctype=CTYPE_REDIRECT301;
			$this->redirectURL='//'.BHOSTNAME.$URL;
			return;
			}
		//
		if($exploded_host[0]=='admin'){
			bimport('cms.language');
			BLang::init('ru','admin');// adminlagugages
			return $this->parse_adminurl($f_path);
			}
		//
		$this->langcode='en';
		$lang=$this->langcode;
		//bimport('cms.language');
		//BLang::init($this->langcode);

		if($f_path[0]=='switchmobile'){
			$this->maincom=(object)array(
				'com'=>'switchmobileversion',
				'position'=>'content',
				'segments'=>array('view'=>'switch')
				);
			$this->rules[]=$this->maincom;
			return true;
			}
		elseif($f_path[0]=='content'){
			array_shift($f_path);
			return $this->parseurl_content($f_path);
			}
		elseif(count($f_path)==0||(count($f_path)==1&&$f_path[0]=='')){
			$this->maincom=(object)array(
				'com'=>'content',
				'position'=>'content',
				'segments'=>array('view'=>'category','id'=>1)
				);
			$this->addfixedrules();
			$this->rules[]=$this->maincom;
			$this->softmodulesget('content:category:1');
			return true;
			}
		return false;
		}//end of ParseURL
	}
