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
use Brilliant\CMS\BLang;
use Brilliant\CMS\BRouterBase;
use Brilliant\Log\BLog;
use Brilliant\Users\BUsers;

class BRouter extends BRouterBase{
	use \Brilliant\BSingleton;
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
		$busers=BUsers::getInstance();
		return $busers->getLoggedUser();
		}
	/**
	 * For example, check 'mycompany-5' for 'mycompany-' and return 5.
	 *
	 * $str  - entire string
	 * $pref - preffix,
	 */
	public function checkIntSuffix($str,$pref){
		$preflen=strlen($pref);
		if(substr($str,0,$preflen)!=$pref){
			return 0;
			}
		$ints=substr($str,$preflen);
		return (int)$ints;
		}
	/**
	 * Add some fixed rules - languages switch, etc.
	 */
	public function addFixedRules(){
		$user = $this->getLoggedUser();
		if(!empty($user)){
			$this->rules[]=(object)array(
				'com' => 'users',
				'position' => 'userpanel',
				'segments' => array('view'=>'userpanel','uid'=>$user->id),
				);
			}else{
			$this->rules[]=(object)array(
				'com' => 'users',
				'position' => 'userpanel',
				'segments' => array('view'=>'userpanel'),
				);
			}
		}
	/**
	 *
	 */
	public function generateUrlContent($lang,$segments){
		$url_content='content/';
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
				$url=$this->generateUrlContent($lang,array('view'=>'blog','category'=>$article->category));
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
	 * Generate url for Users component
	 *
	 * @param $lang
	 * @param $segments
	 * @return string
	 */
	public function generateUrlUsers($lang, $segments){
		$URL_users='users/';
		$view=isset($segments['view'])?$segments['view']:'';
		if(($view=='logout')||($view=='login')||($view=='register')||($view=='register_company')) {
			return $URL_users.$view;
			}
		//Control panel
		if($view=='dashboard'){
			return 'members/';
			}
		return '';
		}
	/**
	 * Generate url for Telegram component
	 *
	 * @param $lang
	 * @param $segments
	 * @return string
	 */
	public function generateUrlTelegram($lang, $segments){
		$URL_telegram='telegram/';
		$view=isset($segments['view'])?$segments['view']:'';
		if(($view=='setwebhook')||($view=='hook')) {
			return $URL_telegram.$view;
			}
		return '';
		}
	/**
	 * Generate URL for company finances.
	 */
	public function generateUrlFinances($lang, $segments){
		$view=isset($segments['view'])?$segments['view']:'';
		$company=isset($segments['company'])?$segments['company']:'';
		//Operations groups
		if($view=='opgroups'){
			return 'members/mycompany-'.$company.'/opgroups/';
			}
		//
		if($view=='opgroupadd'){
			return 'members/mycompany-'.$company.'/opgroups/add';
			}
		//Operations group
		if($view=='opgroup'){
			if(empty($segments['id'])){
				return '';
				}
			$id=(int)$segments['id'];
			return 'members/mycompany-'.$company.'/opgroups/'.$id;
			}
		//Finances accounts
		if($view=='accounts'){
			return 'members/mycompany-'.$company.'/accounts/';
			}
		//Add new finance account
		if($view=='accountadd'){
			return 'members/mycompany-'.$company.'/accounts/add';
			}
		//Currencies filter
		if($view=='company_currencies_json'){
			return 'members/mycompany-'.$company.'/currencies.json';
			}
		return false;
		}
	/**
	 *
	 */
	public function generateUrlCompanies($lang, $segments){
		$view=isset($segments['view'])?$segments['view']:'';
		//Operations groups
		if($view=='mycompany'){
			if(empty($segments['company'])){
				return '';
				}
			$id=(int)$segments['company'];
			return 'members/mycompany-'.$id.'/';
			}
		if($view=='newcompany'){
			return 'members/newcompany';
			}
		return false;
		}
	/**
	 * Generate URL by component, language and segments
	 * in case of sucessfull parse return URL, else return false;
	 *
	 * @param string $component
	 * @param string $lang
	 * @param array $segments
	 */
	public function generateURL($component,$segments,$options=array()){
		$opt_protocol=isset($options['protocol'])?$options['protocol']:'//';
		$opt_hostname=isset($options['usehostname'])?$options['usehostname']:false;
		//forming preffix
		$pref='';
		if($opt_hostname){
			$pref=$opt_protocol.BHOSTNAME;
			}
		$pref.='/';
		$lang=isset($segments['lang'])?$segments['lang']:\Brilliant\CMS\BLang::$langcode;
		if(($lang!=='en')&&(!empty($lang))){
			$pref.=$lang.'/';
			}
		switch($component){
			case 'content':
				return $pref.$this->generateUrlContent($lang,$segments);
			case 'users':
				return $pref.$this->generateUrlUsers($lang,$segments);
			case 'telegram':
				return $pref.$this->generateUrlTelegram($lang,$segments);
			case 'companies':
				return $pref.$this->generateUrlCompanies($lang,$segments);
			case 'finances':
				return $pref.$this->generateUrlFinances($lang,$segments);
			case 'mainpage':
				return $pref.'';
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
	 * Parse /users/ branch.
	 * 
	 * Language - $this->langcode
	 */
	public function parseUrlUsers($f_path){
		BLog::addtolog('[Router]: We are in users branch now!');
		//Unset the latest empty "/" in url.
		if((count($f_path))&&(empty($f_path[count($f_path)-1]))){
			BLog::addtolog('[Router]: parseUrlUsers() removing latest "/" character.');
			unset($f_path[count($f_path)-1]);
			}
		//
		if((count($f_path)==1)&&(($f_path[0]=='login')||($f_path[0]=='logout')||($f_path[0]=='register')||($f_path[0]=='register_company'))){
			$this->maincom=(object)array(
				'com'=>'users',
				'position'=>'content',
				'segments'=>array('view'=>$f_path[0]),
				);
			$this->rules[]=$this->maincom;
			$this->addFixedRules();
			return true;
			}
		BLog::addtolog('[Router]: parseUrlUsers() no rules! $f_path='.var_export($f_path,true),LL_ERROR);
		return false;
		}
	/**
	 * Parse /telegram/ branch.
	 * 
	 * Language - $this->langcode
	 */
	public function parseUrlTelegram($f_path){
		BLog::addtolog('[Router]: We are in telegam branch now!');
		//Unset the latest empty "/" in url.
		if((count($f_path))&&(empty($f_path[count($f_path)-1]))){
			BLog::addtolog('[Router]: parseUrlTelegram() removing latest "/" character.');
			unset($f_path[count($f_path)-1]);
			}
		//
		if((count($f_path)==1)&&(($f_path[0]=='setwebhook')||($f_path[0]=='hook'))){
			$this->maincom=(object)array(
				'com'=>'telegram',
				'position'=>'content',
				'segments'=>array('view'=>$f_path[0]),
				);
			$this->rules[]=$this->maincom;
			$this->addFixedRules();
			return true;
			}
		BLog::addtolog('[Router]: parseUrlTelegram() no rules! $f_path='.var_export($f_path,true),LL_ERROR);
		return false;
		}

	/**
	 *
	 */
	public function parseUrlMembersMyCompanyPayees($companyid,$f_path){
		BLog::addtolog('[Router]: parseUrlMembersMyCompanyPayees() $f_path='.var_export($f_path,true));
		//Unset the latest empty "/" in url.
		$f_path_count=count($f_path);
		if(($f_path_count)&&(empty($f_path[$f_path_count-1]))){
			BLog::addtolog('[Router]: parseUrlMembersMyCompanyPayees() removing latest "/" character.');
			unset($f_path[$f_path_count-1]);
			}
		//Payees list.
		if(empty($f_path)){
			$this->rules[]=(object)array(
				'com' => 'finances',
				'position' => 'content',
				'segments' => array('view'=>'payees','company'=>$companyid),
				);
			return true;
			}
		//Add payee
		if($f_path[0]=='add'){
			$this->rules[]=(object)array(
				'com' => 'finances',
				'position' => 'content',
				'segments' => array('view'=>'payeeadd','company'=>$companyid),
				);
			return true;
			}
		//Delete payee
		if($f_path[0]=='delete'){
			$this->rules[]=(object)array(
				'com' => 'finances',
				'position' => 'content',
				'segments' => array('view'=>'payeedelete','company'=>$companyid),
				);
			return true;
			}
		//Payee JSON filters
		if($f_path[0]=='filter.json'){
			$this->ctype=CTYPE_JSON;
			$this->rules[]=(object)array(
				'com' => 'finances',
				'position' => 'content',
				'segments' => array('view'=>'payeesjsonfilter','company'=>$companyid),
				);
			return true;
			}
		//Edit Single Payee 
		if((is_numeric($f_path[0]))&&($f_path_count==1)){
			$opg=(int)$f_path[0];
			$this->rules[]=(object)array(
				'com' => 'finances',
				'position' => 'content',
				'segments' => array('view'=>'payee','company'=>$companyid,'id'=>$opg),
				);
			return true;
			}
		return false;
		}
	/**
	 *
	 */
	public function parseUrlMembersMyCompany($companyid,$f_path){
		BLog::addtolog('[Router]: parseUrlMembersMyCompany() $f_path='.var_export($f_path,true));
		//Unset the latest empty "/" in url.
		$f_path_count=count($f_path);
		if(($f_path_count)&&(empty($f_path[$f_path_count-1]))){
			BLog::addtolog('[Router]: parseurl_members() removing latest "/" character.');
			unset($f_path[$f_path_count-1]);
			}
		//
		if(empty($f_path)){
			$this->rules[]=(object)array(
				'com' => 'companies',
				'position' => 'content',
				'segments' => array('view'=>'mycompany','company'=>$companyid),
				);
			return true;
			}
		if($f_path[0]=='payees'){
			array_shift($f_path);
			return $this->parseUrlMembersMyCompanyPayees($companyid,$f_path);
			}
		//Currencies filter
		if(($f_path[0]=='currencies.json')&&($f_path_count==1)){
			$segments = array('view'=>'currencies_json','company'=>$companyid);
			$keyword = \Brilliant\HTTP\BRequest::getString('q');
			if($keyword){
				$segments['keyword'] = $keyword;
				}
			$this->rules[]=(object)array(
				'com' => 'companies',
				'position' => 'content',
				'segments' => $segments,
				);
			$this->ctype = CTYPE_JSON;
			return true;
			}

		//
		if(($f_path[0]=='accounts')&&($f_path_count==1)){
			$this->rules[]=(object)array(
				'com' => 'finances',
				'position' => 'content',
				'segments' => array('view'=>'accounts','company'=>$companyid),
				);
			return true;
			}
		//
		if(($f_path[0]=='accounts')&&($f_path[1]=='add')&&($f_path_count==2)){
			$this->rules[]=(object)array(
				'com' => 'finances',
				'position' => 'content',
				'segments' => array('view'=>'accountadd','company'=>$companyid),
				);
			return true;
			}
		//
		if(($f_path[0]=='currencies')&&($f_path_count==1)){
			$this->rules[]=(object)array(
				'com' => 'finances',
				'position' => 'content',
				'segments' => array('view'=>'currencies','company'=>$companyid),
				);
			return true;
			}
		//Operations groups.
		if(($f_path[0]=='opgroups')&&($f_path_count==1)){
			$this->rules[]=(object)array(
				'com' => 'finances',
				'position' => 'content',
				'segments' => array('view'=>'opgroups','company'=>$companyid),
				);
			return true;
			}
		//Single operations group.
		if(($f_path[0]=='opgroups')&&($f_path[1]=='add')){
			$opg=(int)$f_path[1];
			$this->rules[]=(object)array(
				'com' => 'finances',
				'position' => 'content',
				'segments' => array('view'=>'opgroupadd','company'=>$companyid,'id'=>$opg),
				);
			return true;
			}
		//Single operations group.
		if(($f_path[0]=='opgroups')&&(is_numeric($f_path[1]))&&($f_path_count==2)){
			$opg=(int)$f_path[1];
			$this->rules[]=(object)array(
				'com' => 'finances',
				'position' => 'content',
				'segments' => array('view'=>'opgroup','company'=>$companyid,'id'=>$opg),
				);
			return true;
			}
		return false;
		}
	/**
	 * Parse /members/ branch.
	 * 
	 * Language - $this->langcode
	 */
	public function parseUrlMembers($f_path){
		$bUsers=\Brilliant\Users\BUsers::GetInstance();
		$me=$bUsers->getLoggedUser();
		if(empty($me)){
			$this->ctype=CTYPE_REDIRECT302;
			$this->redirectURL=$this->generateUrl('users',array('view'=>'login','lang'=>BLang::$langcode),array('usehostname'=>true)).'?url='.base64_encode('//'.$this->host.$this->url);
			return true;
			}
		BLog::addtolog('[Router]: We are in members branch now!');

		$this->templatename='members';
		$this->addFixedRules();
		$this->rules[]=(object)array(
			'com' => 'menu',
			'position' => 'sidebar',
			'segments' => array('view'=>'memberssidebar'),
			);
		$this->rules[]=(object)array(
			'com' => 'menu',
			'position' => 'mainmenu',
			'segments' => array('view'=>'membersmenu'),
			);

		//Unset the latest empty "/" in url.
		if((count($f_path))&&(empty($f_path[count($f_path)-1]))){
			BLog::addtolog('[Router]: parseUrlMembers() removing latest "/" character.');
			unset($f_path[count($f_path)-1]);
			}

		if(empty($f_path)){
			$this->maincom=(object)array(
				'com' => 'users',
				'position' => 'content',
				'segments' => array('view'=>'dashboard'),
				);
			$this->rules[]=$this->maincom;
			return true;
			}
		if($f_path[0]=='newcompany'){
			$this->maincom=(object)array(
				'com' => 'companies',
				'position' => 'content',
				'segments' => array('view'=>'newcompany'),
				);
			$this->rules[]=$this->maincom;
			return true;
			}
		if($companyid=$this->checkIntSuffix($f_path[0],'mycompany-')){
			BLog::addtolog('[Router]: Found company with ID='.$companyid);
			array_shift($f_path);
			return $this->parseUrlMembersMyCompany($companyid,$f_path);
			}
		BLog::addtolog('[Router]: parseUrlMembers() $f_path='.var_export($f_path,true));
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
		//
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
			BLang::init('ru','admin');// adminlagugages
			return $this->parse_adminurl($f_path);
			}
		//Detect language
		if(($f_path[0]==='ru')||($f_path[0]==='ua')){
			$this->langcode=$f_path[0];
			array_shift($f_path);
			}else{
			$this->langcode='en';
			}
		$lang=$this->langcode;
		BLang::init($this->langcode);
		//
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
			return $this->parseUrlContent($f_path);
			}
		elseif($f_path[0]=='users'){
			array_shift($f_path);
			return $this->parseUrlUsers($f_path);
			}
		elseif($f_path[0]=='telegram'){
			array_shift($f_path);
			return $this->parseUrlTelegram($f_path);
			}
		if($f_path[0]=='members'){
			array_shift($f_path);
			return $this->parseUrlMembers($f_path);
			}

		elseif(count($f_path)==0||(count($f_path)==1&&$f_path[0]=='')){
			$this->maincom=(object)array(
				'com'=>'mainpage',
				'position'=>'content',
				'segments'=>array('view'=>'mainpage')
				);
			$this->addFixedRules();
			$this->rules[]=$this->maincom;
			$this->softmodulesget('mainpage:mainpage');
			return true;
			}
		return false;
		}//end of ParseURL
	}
