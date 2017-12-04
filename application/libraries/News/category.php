<?php
/**
 * Sets of functions and classes to work with single news category.
 *
 * @author Andrii Biriev
 *
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */

class BNewsCategory extends BItemsItemTree{
	protected $collectionname='BNewsCategories';
	protected $tablename='news_categories';
	/**
	 * Constructor - init fields...
	 */
	function __construct() {
		parent::__construct();
		$this->fieldAddRaw('ordering','int');
		$this->fieldAddRaw('status','enum',array('P','N','D'));
		$this->fieldAddRaw('name','string',array('multilang'=>true));
		$this->fieldAddRaw('alias','string',array('multilang'=>true,'alias'=>array('name')));
		$this->fieldAddRaw('description','string',array('multilang'=>true));
		$this->fieldAddRaw('h1','string',array('multilang'=>true));
		$this->fieldAddRaw('title','string',array('multilang'=>true));
		$this->fieldAddRaw('metadesc','string',array('multilang'=>true));
		$this->fieldAddRaw('metakeyw','string',array('multilang'=>true));
		$this->fieldAddRaw('template','string',array());
		$this->fieldAddRaw('articleimgsuffix_d','string',array());
		$this->fieldAddRaw('articleimgsuffix_m','string',array());
		$this->fieldAddRaw('allowcomments','enum',array('Y','N'));
		$this->fieldAddRaw('toplimit','int');
		$this->fieldAddRaw('itemsperpage','int');
		$this->fieldAddRaw('necessaryfields','string');
		//Statistics (all fields are readonly)
		$this->fieldAddRaw('articles','int',array('readonly'=>true));
		//Created & modified
		$this->fieldAddRaw('created','dt',array('readonly'=>true));
		$this->fieldAddRaw('modified','dt',array('readonly'=>true));
		}
	/**
	 *
	 */
	public function updatecache(){
		parent::updatecache();
		$bcache=BFactory::getCache();
		if(empty($bcache)){
			return false;
			}
		$brouter=BRouter::GetInstance();
		$languages=BLang::langlist();
		$parentids=$this->getparentchain_ids();
		foreach($parentids as $catid){
			BLog::addtolog('Clearing cache for category "'.$catid.'"');
			foreach($languages as $lng){
				$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.d',array('view'=>'blog','category'=>$catid)));
				$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.m',array('view'=>'blog','category'=>$catid)));
				for($pagenum=0; $pagenum<5; $pagenum++){
					$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.d',array('view'=>'blog','category'=>$catid,'page'=>$pagenum)));
					$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.m',array('view'=>'blog','category'=>$catid,'page'=>$pagenum)));
					}
				}
			}
		//news_categories:itemid:1
		return true;
		}
	/**
	 * Update status in news category
	 *
	 * @param $value
	 * @return bool
	 */
	public function update_category_status($value){
		$db=BFactory::getDBO();
		if(empty($db)){
			return false;
		}
		$qr='UPDATE `'.$this->tablename.'` SET `status` = "'.$value.'" WHERE `'.$this->primarykey.'` = '.$this->{$this->primarykey}.' ';
		$q=$db->Query($qr);
		if(empty($q)){
			return false;
		}
		$this->updatecache();
		return true;
	}
	/**
	 * Get news category name...
	 */
	public function getname($lang=''){
		return $this->getlangvar('name',$lang);
		}
	/**
	 * Get news category alias
	 */
	public function getalias($lang=''){
		return $this->getlangvar('alias',$lang);
		}
	/**
	 * Get news category H1 SEO heading
	 */
	public function geth1($lang=''){
		return $this->getlangvar('h1',$lang);
		}
	/**
	 * Get news category title
	 */
	public function gettitle($lang=''){
		return $this->getlangvar('title',$lang);
		}
	/**
	 * Get news category desctiption
	 */
	public function getdescription($lang=''){
		return $this->getlangvar('description',$lang);
		}
	/**
	 * Get news category intro text
	 */
	public function getintro($lang=''){
		return $this->getlangvar('intro',$lang);
		}
	/**
	 * Get news category META description
	 */
	public function getmetadesc($lang=''){
		return $this->getlangvar('metadesc',$lang);
		}
	/**
	 * Get news category META keywords
	 */
	public function getmetakeyw($lang=''){
		return $this->getlangvar('metakeyw',$lang);
		}
	/**
	 * Get last post
	 */	
	public function getlastpost($lang=''){
		return NULL;
		}
	/**
	 * Get topics count by language
	 */	
	public function gettopicscount($lang=''){
		if(empty($lang)){
			bimport('cms.language');
			$lang=BLang::$langcode;
			}
		$name='topics_'.$lang;
		$count=isset($this->$name)?$this->$name:0;
		return $count;
		}
	/**
	 * Get posts count by language
	 */	
	public function getpostscount($lang=''){
		if(empty($lang)){
			bimport('cms.language');
			$lang=BLang::$langcode;
			}
		$name='posts_'.$lang;
		$count=isset($this->$name)?$this->$name:0;
		return $count;
		}

	/**
	 *
	 */
	public function getnamelevel($pref='|-',$start='   ',$lang=''){
		$name='';
		for ($i=1; $i<=$this->level; $i++) {
			$name.=$pref;
			}
		if($this->level!=0){
			$name.=$start;
			}
		$name.=$this->getname($lang);
		return $name;
		}
	/**
	 * Get URL.
	 *
	 * @param $lang
	 * @return string
	 */
	public function getURL($lang='',$protocol='//'){
		$lang=$this->detectlang($lang);
		$brouter=BRouter::GetInstance();
		$url=$protocol.$brouter->generateURL('news',$lang,array('view'=>'blog','category'=>$this->id));
		return $url;
		}
	/**
	 * Get URL.
	 *
	 * @param $lang
	 * @return string
	 */
	public function getRSSURL($lang='',$protocol='//'){
		$lang=$this->detectlang($lang);
		$brouter=BRouter::GetInstance();
		$url=$protocol.$brouter->generateURL('news',$lang,array('view'=>'rss','category'=>$this->id));
		return $url;
		}
	/**
	 * Get all subcategories IDS.
	 *
	 * Result - array of IDS (5,7,2,3,1)
	 */
	public function getsubcatsids(){
		$bnc=BNewsCategories::getInstance();
		$children=$bnc->items_filter_ids(array('parenttree_lft'=>$this->lft,'parenttree_rgt'=>$this->rgt));
		return $children;
		}
	/**
	 *
	 */
	public function getChainList($delimiter, $lang=''){
		$parentchain=$this->getparentchain();
		$result = '';
		foreach($parentchain as $cat){
			$result.=(empty($result)?'':$delimiter);
			$result.=$cat->getname($lang);
			}
		return $result;
		}
	/**
	 * Get all subcategories.
	 */
	public function getsubcats(){
		$bnc=BNewsCategories::getInstance();
		$children=$bnc->items_filter(array('parenttree_lft'=>$this->lft,'parenttree_rgt'=>$this->rgt));
		return $children;
		}
	/**
	 * Get all subcategories.
	 */
	public function getosubcats(){
		$bnc=BNewsCategories::getInstance();
		$children=$bnc->items_filter(array('parent'=>$this->id,'status'=>'P'));
		return $children;
		}
	/**
	 * Get all subcategories.
	 */
	public function getbrothercats(){
		if(empty($this->parent)){
			return array();
			}
		$bnc=BNewsCategories::getInstance();
		$children=$bnc->items_filter(array('parent'=>$this->parent,'status'=>'P'));
		return $children;
		}
	/**
	 * Get articles in the category.
	 */
	public function getarticles($limit,$params=array()){
		bimport('news.articles');
		$bna=BNewsArticles::getInstance();
		$params['category']=$this->id;
		$params['status']="P";
		$params['orderby']='newsdt';
		$params['orderdir']='desc';
		$params['limit']=$limit;
		$articles=$bna->items_filter($params);
		//var_dump($params);
		//var_dump($articles); die();
		return $articles;
		}

	/**
	 * @param $str
	 * @return bool
	 * 
	 */
	public function nfchecked($str){
		if(empty($str)){
			return false;
			}
		$str=mb_strtolower($str,'utf-8');
		$checked=false;
		$array_fields=explode(',',$this->necessaryfields);
		foreach($array_fields as $field){
			if((trim($field))===$str) {
				$checked=true;
				}
			}
		return $checked;
		}
	}
