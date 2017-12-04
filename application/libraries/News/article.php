<?php
/**
 * Sets of functions and classes to work with single forum.
 *
 * @author Andrii Biriev
 *
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */

define('NEWSARTICLE_FLAG_PHOTO',1);
define('NEWSARTICLE_FLAG_VIDEO',2);
define('NEWSARTICLE_FLAG_ADVERT',4);
define('NEWSARTICLE_FLAG_EXCLUSIVE',8);
define('NEWSARTICLE_FLAG_INFOGRAPH',16);
define('NEWSARTICLE_FLAG_MAP',32);
define('NEWSARTICLE_FLAG_POLL',64);
define('NEWSARTICLE_FLAG_PHOTOREPORT',128);
define('NEWSARTICLE_FLAG_VIDEOREPORT',256);
define('NEWSARTICLE_FLAG_THUNDER',512);

class BNewsArticle extends BItemsItem{
	protected $collectionname='BNewsArticles';
	protected $tablename='news_articles';
	protected $imageintro;
	protected $oldcategory;
	protected $jsneeed;
	/**
	 * @var DateTime
	 */
	public $newsdt;
	/**
	 * Constructor - init fields...
	 */
	function __construct() {
		parent::__construct();
		$this->fieldAddRaw('status','enum',array('values'=>array('P','N','D','U')));
		$this->fieldAddRaw('ismain','enum',array('values'=>array('Y','N','T')));
		$this->fieldAddRaw('location_photogalery','enum',array('values'=>array('I','S','E'))); //Instead,Start,End
		$this->fieldAddRaw('allowcomments','enum',array('values'=>array('Y','N')));
		$this->fieldAddRaw('allowrss','enum',array('values'=>array('Y','N')));
		$this->fieldAddRaw('category','item',array('class'=>'BNewsCategory'));
		$this->fieldAddRaw('flags','int',array());
		$this->fieldAddRaw('importance','int');
		$this->fieldAddRaw('poolid','item',array('class'=>'BPollsPoll'));
		$this->fieldAddRaw('adminauthor','item',array('class'=>'BAdminUser'));
		$this->fieldAddRaw('linkedarticles','string');
		$this->fieldAddRaw('videoreport','string');
		$this->fieldAddRaw('name','string',array('multilang'=>true));
		$this->fieldAddRaw('active','enum',array('multilang'=>true,'values'=>array('Y','N')));
		$this->fieldAddRaw('alias','string',array('multilang'=>true,'alias'=>array('name')));
		$this->fieldAddRaw('title','string',array('multilang'=>true));
		$this->fieldAddRaw('intro','string',array('multilang'=>true));
		$this->fieldAddRaw('text','string',array('multilang'=>true));
		$this->fieldAddRaw('title','string',array('multilang'=>true));
		$this->fieldAddRaw('metadesc','string',array('multilang'=>true));
		$this->fieldAddRaw('metakeyw','string',array('multilang'=>true));
		$this->fieldAddRaw('after','string',array('multilang'=>true));
		$this->fieldAddRaw('data','json');
		$this->fieldAddRaw('images','json');//Entry image
		$this->fieldAddRaw('newsdt','dt');
		$this->fieldAddRaw('unpublishdt','dt');
		//Statistics (all fields are readonly)
		$this->fieldAddRaw('hits','int',array('readonly'=>true));
		$this->fieldAddRaw('comments','int',array('readonly'=>true));
		$this->fieldAddRaw('comments_lastcheck','dt',array('readonly'=>true));
		//Created & modified
		$this->fieldAddRaw('created','dt',array('readonly'=>true));
		$this->fieldAddRaw('modified','dt',array('readonly'=>true));
		}
	/**
	 *
	 */
	public function load($obj){
		parent::load($obj);
		$this->isnew=false;
		$this->oldcategory=(int)$obj['category'];
		$this->photos=array();
		if(!empty($obj['photos'])){
			foreach($obj['photos'] as $photo){
				$photoid=(int)$photo['id'];
				$photox=new stdClass();
				$photox->id=$photoid;
				$photox->alt=$photo['alt'];
				$photox->alt_ru=$photo['alt_ru'];
				$photox->ordering=(int)$photo['ordering'];
				$photox->isnew=false;
				$photox->image=new BImage();
				$photox->image->url=$photo['url'];
				$this->photos[]=$photox;
				}
			$n=count($this->photos);
			for($i=0; $i<$n; $i++){
				$m=$i;
				for($j=$i+1; $j<$n; $j++){
					if($this->photos[$j]->ordering<$this->photos[$m]->ordering){
						$m=$j;
						}
					}
				if($m!=$i){
					$t=$this->photos[$i];
					$this->photos[$i]=$this->photos[$m];
					$this->photos[$m]=$t;
					}
				}
			}
		$this->tags=array();
		if(!empty($obj['tags'])){
			foreach($obj['tags'] as $tag){
				$tagid=(int)$tag['tag'];
				$tagx=new stdClass();
				$tagx->tag=$tagid;
				$tagx->articleid=(int)$tag['itmid'];
				$tagx->type=$tag['itmtype'];
				$tagx->date=new DateTime($tag['itemdate']);
				$tagx->itemstatus=$tag['itemstatus'];
				$this->tags[]=$tagx;
				}
			}
		return true;
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
		foreach($languages as $lng){
			//
			$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.d',array('view'=>'article','id'=>$this->id)));
			$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.m',array('view'=>'article','id'=>$this->id)));
			//
			if($this->category>0){
				$category=$this->getcategory();
				$cats=$category->getparentchain_ids();
				foreach($cats as $c){
					$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.d',array('view'=>'blog','category'=>$c)));
					$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.m',array('view'=>'blog','category'=>$c)));
					}
				//
				//$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.d',array('view'=>'blog','category'=>$this->category)));
				//$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.m',array('view'=>'blog','category'=>$this->category)));
				}
			//
			if(($oldcategory>0)&&($oldcategory!=$this->category)){
				$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.d',array('view'=>'blog','category'=>$oldcategory)));
				$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.m',array('view'=>'blog','category'=>$oldcategory)));
				}
			//Clear news feed.
			$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.d',array('view'=>'feed')));
			$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.m',array('view'=>'feed')));
			//Top news
			$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.d',array('view'=>'top')));
			$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.m',array('view'=>'top')));
			//Main news
			$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.d',array('view'=>'main')));
			$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.m',array('view'=>'main')));
			//
			$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.d',array('view'=>'photo')));
			$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.m',array('view'=>'photo')));
			//RSS feed
			$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.d',array('view'=>'rss')));
			$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.m',array('view'=>'rss')));
			$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.t',array('view'=>'rss')));
			$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.d',array('view'=>'rss_yandex')));
			$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.m',array('view'=>'rss_yandex')));
			$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.t',array('view'=>'rss_yandex')));

			if(($this->flags & NEWSARTICLE_FLAG_PHOTOREPORT)>0){
				$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.d',array('view'=>'mod_photo','style'=>'footer')));
				$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.m',array('view'=>'mod_photo','style'=>'footer')));
				//
				$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.d',array('view'=>'mod_photo','style'=>'sidebar')));
				$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.m',array('view'=>'mod_photo','style'=>'sidebar')));
				//
				$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.d',array('view'=>'mod_photo','style'=>'main')));
				$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.m',array('view'=>'mod_photo','style'=>'main')));
				//
				$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.d',array('view'=>'mod_photo')));
				$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.m',array('view'=>'mod_photo')));
				}
			//
			$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.d',array('view'=>'video')));
			$bcache->delete($brouter->getUrlCahceKey('news',$lng,'.m',array('view'=>'video')));
			}
		return true;
		}
	/**
	 *
	 * @return array|bool
	 */
	public function tags(){
		if(empty($this->tags)){
			return false;
			}
		bimport('tags.tags');
		$btags=BTagsTags::getInstance();
		$ids=array();
		foreach($this->tags as $t){
			$ids[]=$t->tag;
			}
		$ttags=$btags->items_get($ids);
		return $ttags;
		}
	/**
	 *
	 */
	public function dbinsert_photos(){
		if(empty($this->photos)){
			return true;
			}
		if(!$db=BFactory::getDBO()){
			return false;
			}
		$values=array();
		foreach($this->photos as $ph){
			$values[]='('.
			    $this->{$this->primarykey}.','.
			    $db->escape_string($ph->image->url).','.
			    $db->escape_string($ph->alt).','.
			    $db->escape_string($ph->alt_ru).')';
			}
		$qr='INSERT INTO `news_photos` (`article`,`url`,`alt`,`alt_ru`) VALUES '.implode(',',$values);
		$q=$db->query($qr);
		if(empty($q)){
			return false;
			}
		return true;
		}
	/**
	 *
	 */
	public function dbinsert_tags(){
		$db=BFactory::getDBO();
		if(empty($db)){
			return false;
			}
		$qrd='DELETE FROM `tags_links` WHERE (itmid='.($this->{$this->primarykey}).' && `itmtype` = "N")';
		$qd=$db->query($qrd);
		if(empty($qd)){
			return false;
			}
		$values=array();
		if(!empty($this->tags)){
			foreach($this->tags as $ph){
				$values[]='("N",'.$this->{$this->primarykey}.','.$ph->tag.',"'.$ph->date->format('Y-m-d H:i:s').'","'.$ph->itemstatus.'")';
				}
			}
		if(!empty($values)){
			$qri='INSERT INTO `tags_links` (itmtype,itmid,tag,itemdate,itemstatus) VALUES '.implode(',',$values);
			$qi=$db->query($qri);
			if(empty($qi)){
				return false;
				}
			}
		return true;
		}
	/**
	 *
	 */
	public function dbinsert(){
		BLog::addtolog('[News.Article]: Inserting data...');
		if(!$db=BFactory::getDBO()){
			return false;
			}
		//Forming query...
		$this->modified=new DateTime();
		if(empty($this->created)){
			$this->created=new DateTime();
			}
		$qr=$this->dbinsertquery();
		//Running query...
		if(!$db->start_transaction()){
			return false;
			}
		$q=$db->query($qr);
		if(empty($q)){
			$db->rollback();
			return false;
			}
		$this->{$this->primarykey}=$db->insert_id();
		if(!$this->dbinsert_photos()){
			$db->rollback();
			return false;
			}
		if(!$this->dbinsert_tags()){
			$db->rollback();
			return false;
			}
		$db->commit();
		//Updating cache...
		$this->updatecache();
		$this->isnew=false;
		//Return result
		return true;
		}
	/**
	 *
	 */
	public function dbupdate_photos(){
		/*if(!$db=BFactory::getDBO()){
			return false;
			}
		$qr='DELETE FROM `news_photos` WHERE (article='.($this->{$this->primarykey}).')';
		$q=$db->query($qr);
		if(empty($q)){
			return false;
			}
		return $this->dbinsert_photos();*/
		return true;
		}
	/**
	 *
	 */
	public function dbupdate_tags(){

		}
	/**
	 *  Run Update query in the database & reload cache
	 *
	 * returns true if OK and false if not
	 */
	public function dbupdate(){
		BLog::addtolog('[News.Article]: Updating data...');
		if(empty($this->id)){
			return false;
			}
		if(!$db=BFactory::getDBO()){
			return false;
			}
		//
		$this->modified=new DateTime();
		//Get query
		$qr=$this->dbupdatequery();
		//Running query...
		if(!$db->start_transaction()){
			return false;
			}
		$q=$db->query($qr);
		if(empty($q)){
			$db->rollback();
			return false;
			}
		if(!$this->dbupdate_photos()){
			$db->rollback();
			return false;
			}
		if(!$this->dbinsert_tags()){
			$db->rollback();
			return false;
			}
		$db->commit();
		//Updating cache...
		$this->updatecache();
		$this->isnew=false;
		//Return result
		return true;
		}

	/** Get tags for article;
	 *
	 * @return array|bool
	 */
	public function gettags(){
		bimport('tags.tags');
		$btags=BTagsTags::getInstance();
		$ttags=array();
		if(!empty($this->tags)){
			foreach($this->tags as $t){
				$tadid=(int)$t->tag;
				$ttags[]=$tadid;
			}
		}
		$tags=$btags->items_get($ttags);
		return $tags;
	}
	/** Change status in article
	 *
	 * @param $value
	 * @return bool
	 */
	public function update_article_status($value){
		$db=BFactory::getDBO();
		if(empty($db)){
			return false;
		}
		$qr='UPDATE `'.$this->tablename.'` SET `status` = "'.$value.'" WHERE `'.$this->primarykey.'` = '.$this->{$this->primarykey}.'';
		$q=$db->Query($qr);
		if(empty($q)){
			return false;
			}
		return true;
		}
	/**
	 *
	 */
	public function getactivelang($lang=''){
		//Detect active language.
		if(empty($lang)){
			bimport('cms.language');
			$lang=BLang::$langcode;
			}
		$active=$this->{'active_'.$lang};
		if(($active!='Y')&&($active!=1)){
			$lang='';
			$languages=BLang::langlist();
			foreach($languages as $lng){
				$active2=$this->{'active_'.$lng};
				if(($active2=='Y')||($active2==1)){
					$lang=$lng;
					break;
					}
				}
			}
		return $lang;
		}
	/**
	 *
	 */
	public function getlangvar_active($varname,$lang=''){
		$lang=$this->getactivelang($lang);
		if(empty($lang)){
			return '';
			}
		//
		$name=$varname.'_'.$lang;

		//var_dump($name); var_dump($lang); die('b');

		$result=isset($this->$name)?$this->$name:'';
		if(empty($result)){
			$languages=BLang::langlist();
			foreach($languages as $lng){
				$name=$varname.'_'.$lng;
				$result=$this->$name;
				if(!empty($result)){
					break;
					}
				}
			}
		return $result;
		}

	/**
	 * Get article name...
	 */
	public function getname($lang=''){
		return $this->getlangvar_active('name',$lang);
		}
	/**
	 * Get forum alias
	 */
	public function getalias($lang=''){
		return $this->getlangvar_active('alias',$lang);
		}
	/**
	 * Get forum H1 SEO heading
	 */
	public function geth1($lang=''){
		return $this->getlangvar_active('h1',$lang);
		}
	/**
	 * Get forum title
	 */
	public function gettitle($lang=''){
		return $this->getlangvar_active('title',$lang);
		}
	/**
	 * Get forum desctiption
	 */
	public function gettext($lang=''){
		return $this->getlangvar_active('text',$lang);
		}
	/**
	 *
	 */
	public function gettext_processed($lang=''){
		//Detect user device
		bimport('http.useragent');
		$device=BBrowserUseragent::getDeviceSuffix();
		//Get plain article HTML.
		$articletext=$this->gettext($lang);
		//Load DOM document
		$doc=new DOMDocument('1.0', 'UTF-8');
		$doc->loadHTML('<?xml encoding="UTF-8"><div>' . $articletext.'</div>'); //DIV is the wrapper to remove DOMDocument wrapper
		$doc->encoding = 'UTF-8';
		//Create images wrapper div
		$new_div = $doc->createElement('div');
		$new_div->setAttribute('class','imgwrapper');
		//Process iframes
		$iframes=$doc->getElementsByTagName('iframe');
		if($device=='.d'){
			$nwidth=695;
			}else{
			$nwidth=285;
			}
		foreach($iframes as $iframe){
			$width=$iframe->getAttribute('width');
			$height=$iframe->getAttribute('height');
			$src=$iframe->getAttribute('src');
			$host = parse_url($src,PHP_URL_HOST);
			$host_names = explode(".", $host);
			$bottom_host_name = '';
			$resize = true;
			if(count($host_names)>=2){
				$bottom_host_name = $host_names[count($host_names)-2] . "." . $host_names[count($host_names)-1];
				}
			if($bottom_host_name=='soundcloud.com'){
				$resize = false;
				}

			//
			if($resize){
				if($width<$nwidth){
					$proport=(float)$height/(float)$width;
					if(($proport<0.3)||($proport>5)){
						$proport=0.75;
						}
					$width=$nwidth;
					$height=round((float)$nwidth * $proport);
					//Replace necessary tags
					$iframe->setAttribute('width', $width);
					$iframe->setAttribute('height',$height);
					}
				}
			if(substr($src,0,26)=='http://www.slideshare.net/'){
				$src=str_replace('http://','https://',$src);
				$iframe->setAttribute('src', $src);
				}
			}
		//Process single links...
		$k=0;
		$links=$doc->getElementsByTagName('a');
		foreach($links as $link){
			$href=$link->getAttribute('href');
			$needset=false;
			if($needset){
				$link->setAttribute('href',$href);
				}
			$k++;
			}
		//Process single images...
		$i=0;
		$images=$doc->getElementsByTagName('img');
		$alt_default=$this->getname();
		foreach($images as $image){
			//
			$src=$image->getAttribute('src');
			$alt=$image->getAttribute('alt');
			$title=$image->getAttribute('title');

			$externalimage=false;
			if(substr($src,0,10)=='data:image'){
				$externalimage=true;
				}
			//
			if((substr($src,0,7)=='http://')||(substr($src,0,8)=='https://')||(substr($src,0,2)=='//')){
				$pi=parse_url($src);
				if($pi['host']!=BHOSTNAME_MEDIA){
					$externalimage=true;
					}
				//var_dump($src); var_dump($pi); die();
				}
			//
			if(empty($alt)){
				$alt=$alt_default;
				}
			if(empty($title)){
				$title=$alt_default;
				}

			if(!$externalimage){
				$src_path=parse_url($src,PHP_URL_PATH);
				$src_arr=explode('.',$src_path);
				//Add necessary width.
				if($src_arr[count($src_arr)-2]!='g'){
					//If not original size..
					if($device=='.d'){
						$src_arr[count($src_arr)-2]='w800';
						}else{
						$src_arr[count($src_arr)-2]='w285';
						}
					$image->removeAttribute('width');
					$image->removeAttribute('height');
					}
				//Generate SRC attribute
				$src_path=implode('.',$src_arr);
				$src='//'.BHOSTNAME_MEDIA.$src_path;
				}
			//Replace necessary tags
			$image->setAttribute('src', $src);
			$image->setAttribute('alt', $alt);
			$image->setAttribute('title', $title);
			//Add wrapper - Clone our created div
			$new_div_clone = $new_div->cloneNode();
			//Add wrapper - Replace image with this wrapper div
			$image->parentNode->replaceChild($new_div_clone,$image);
			//Add wrapper - Append this image to wrapper div
			$new_div_clone->appendChild($image);
			}

		//Save DOM document
		//$articletext=$doc->saveHTML();
		$articletext=substr($doc->saveHTML($doc->getElementsByTagName('div')->item(0)), 5, -6);
		//Process shortcodes...
		bimport('news.shortcodes_processor');
		$articletext=do_shortcode($articletext);
		//
		$this->jsneeed=array();
		if(strpos($articletext,'<div class="carousel"')!==false){
			$this->jsneeed['carousel']='carousel';
			}
		//
		return $articletext;
		}
	/**
	 *
	 */
	public function getjsneeed(){
		return $this->jsneeed;
		}
	/**
	 * Get forum intro text
	 */
	public function getintro($lang=''){
		return $this->getlangvar_active('intro',$lang);
		}
	/**
	 * Get forum META description
	 */
	public function getmetadesc($lang=''){
		return $this->getlangvar_active('metadesc',$lang);
		}
	/**
	 * Get forum META keywords
	 */
	public function getmetakeyw($lang=''){
		return $this->getlangvar_active('metakeyw',$lang);
		}
	/**
	 * Get last post
	 */
	public function getlastpost($lang=''){
		if(empty($lang)){
			bimport('cms.language');
			$lang=BLang::$langcode;
			}
		$name='lastpost_'.$lang;
		$postid=isset($this->$name)?$this->$name:0;
		if(empty($postid)){
			return NULL;
			}
		bimport('forum.posts');
		$bforumposts=BForumPosts::getInstance();
		$post=$bforumposts->item_get($postid);
		return $post;
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
	 * @return mixed
	 */
	public function getcategory(){
		bimport('news.categories');
		$bcats=BNewsCategories::getInstance();
		$category=$bcats->item_get((int)$this->category);
		return $category;
		}

	/**
	 * @return null
	 */
	public function getadminuser(){
		bimport('adminusers.general');
		$busers=BAdminUsers::getInstance();
		$user=$busers->get_single_user((int)$this->adminauthor);
		return $user;
	}
	/**
	 * Get source name...
	 */
	public function getsource(){
		bimport('cms.language');
		$lang=BLang::$langcode;
		if(empty($lang)){
			return ' ';
			}
		$name=$this->data->{'source_'.$lang};
		return $name;
	}
	/**
	 * Get source name...
	 */
	public function getsourceUrl(){
		bimport('cms.language');
		$lang=BLang::$langcode;
		$link=$this->data->{'source_link_'.$lang};
		return $link;
	}
	/**
	 * @param $value
	 * @return bool
	 */
	public function settags($value) {
		if(is_string($value)){
			$tagsa=explode(',',$value);
			}
		else{
			$tagsa=$value;
			}
		$tagsids=array();
		bimport('tags.tags');
		$btags=BTagsTags::getInstance();
		foreach($tagsa as $taga){
			if(substr($taga,0,3)=='tx-'){
				$tagname=substr($taga,3);
				$tagids=$btags->items_filter(array('tname'=>$tagname));
				$firstid=reset($tagids);
				if(!empty($firstid)){
					$tagsids[$firstid]=$firstid;
					continue;
					}
				$newtag=new BTagsTag();
				$newtag->setname($tagname,'ru');
				$newtag->setname($tagname,'ua');
				$newtag->setalias(BLang::generatealias($tagname),'ru');
				$newtag->setalias(BLang::generatealias($tagname),'ua');
				$newtag->savetodb();
				$tagid=$newtag->id;
				$tagsids[$tagid]=new stdClass();
				$tagsids[$tagid]->tag=$tagid;
				$tagsids[$tagid]->articleid=$this->{$this->primarykey};
				$tagsids[$tagid]->type='N';
				$tagsids[$tagid]->date=$this->newsdt;
				$tagsids[$tagid]->itemstatus=$this->status;
				}
			elseif(substr($taga,0,3)=='id-'){
				$tagid=(int)substr($taga,3);
				//$tagsids[$tagid]=$tagid;
				$tagsids[$tagid]=new stdClass();
				$tagsids[$tagid]->tag=$tagid;
				$tagsids[$tagid]->articleid=$this->{$this->primarykey};
				$tagsids[$tagid]->type='N';
				$tagsids[$tagid]->date=$this->newsdt;
				$tagsids[$tagid]->itemstatus=$this->status;
				}
			else{
				continue;
				}
			}
		$this->tags=$tagsids;
		return true;
		}
	/**
	 * Get URL.
	 *
	 * @param $lang
	 * @return string
	 */
	public function getURL($lang='',$protocol='//'){
		if(empty($this->id)){
			return '';
			}
		$lang=$this->detectlang($lang);
		$brouter=BRouter::GetInstance();
		$url=$protocol.$brouter->generateURL('news',$lang,array('view'=>'article','id'=>$this->id));
		return $url;
		}
	/**
	 *
	 */
	public function getPrettyDateTime(){
		return '-';
		}
	/**
	 *
	 */
	public function countcomments(){
		bimport('comments.groups');
		return BCommentsGroups::getCommentsCount('news',$this->id);
		}
	/**
	 *
	 */
	public function getimageintro(){
		if(!empty($this->imageintro)){
			return $this->imageintro;
			}
		bimport('images.single');
		$this->imageintro=new BImage();
		//
		$imageurl='';
		if(isset($this->images->introimage)){
			$imageurl=$this->images->introimage->url;
			}
		//
		if((empty($imageurl))&&(isset($this->images->mainimage))){
			$imageurl=$this->images->mainimage->url;
			}
		//Last chanse
		if(empty($imageurl)){
			$imageurl='/news/article/empty/empty.png';
			}
		//
		$this->imageintro->url=$imageurl;
		return $this->imageintro;
		}
	/**
	 *
	 */
	public function drawimageintro($size,$id=''){
		bimport('images.general');
		$defimg=new BImage();
		$defimg->url='news/empty/logo.png';
		//
		$image=$this->getimageintro();
		if(empty($image)){
			return $defimg->url->drawimg($size,$this->getname(),$id);
			}
		return $image->drawimg($size,$this->getname(),$id);
		}
	/**
	 *
	 */
	public function drawimagemain($size,$id=''){
		bimport('images.general');
		if((empty($this->images->mainimage))||(empty($this->images->mainimage->url))){
			$defimg=new BImage();
			$defimg->url='news/article/empty/empty.png';
			return $defimg->drawimg($size,$this->getname(),$id);
			}
		$image=new BImage();
		$image->url=$this->images->mainimage->url;
		$imghtml=$image->drawimg($size,$this->getname(),$id);
		return $imghtml;
		}
	/**
	 *
	 */
	public function urlimagemain($size,$protocol='//'){
		bimport('images.general');
		if((empty($this->images->mainimage))||(empty($this->images->mainimage->url))){
			$defimg=new BImage();
			$defimg->url='news/article/empty/empty.png';
			return $defimg->geturl($size,$protocol);
			}
		$image=new BImage();
		$image->url=$this->images->mainimage->url;
		$imgurl=$image->geturl($size,$protocol);
		return $imgurl;
		}
	/**
	 * Create media folder
	 * /news/article/<year>/<month>/<day>/<article id>/
	 *
	 */
	public function createmediadir(){
		$newsdir=$this->getmediadir();
		if(empty($newsdir)){
			return false;
			}
		if(!is_dir($newsdir)){
			mkdir($newsdir,0777, true);
			}
		return true;
		}
	/**
	 * Get media folder
	 * /news/article/<year>/<month>/<day>/<article id>/
	 */
	public function getmediadir(){
		if(empty($this->created)){
			return false;
			}
		if(empty($this->id)){
			return false;
			}
		$DS=DIRECTORY_SEPARATOR;
		$newsdir=MEDIA_PATH_ORIGINAL.$DS.'news'.$DS.'article'.$DS;
		$newsdir.=$this->created->format('Y').$DS;
		$newsdir.=$this->created->format('m').$DS;
		$newsdir.=$this->created->format('d').$DS;
		$newsdir.=$this->id;
		return $newsdir;
		}
	/**
	 * Get media path
	 * /news/article/<year>/<month>/<day>/<article id>/
	 */
	public function getmediapath(){
		if(empty($this->created)){
			return false;
			}
		if(empty($this->id)){
			return false;
			}
		$newspath='/news/article/';
		$newspath.=$this->created->format('Y').'/';
		$newspath.=$this->created->format('m').'/';
		$newspath.=$this->created->format('d').'/';
		$newspath.=$this->id;
		return $newspath;
		}
	/**
	 *
	 */
	public function getarchivelink(){
		if(empty($this->newsdt)){
			return '';
			}
		$year=(int)$this->newsdt->format('Y');
		$month=(int)$this->newsdt->format('m');
		$day=(int)$this->newsdt->format('d');
		//Generate URL
		$brouter=BRouter::GetInstance();
		$url_date=$brouter->generateURL('news',BLang::$langcode,array('view'=>'archive_date','year'=>$year,'month'=>$month,'day'=>$day));
		return '//'.$url_date;
		}
	/**
	 *
	 */
	public function gettextdate(){
		if(empty($this->newsdt)){
			return '';
			}
		$now=new DateTime();
		$now_y=(int)$now->format('Y');
		//
		$ths_y=(int)$this->newsdt->format('Y');
		$ths_m=(int)$this->newsdt->format('m');
		$ths_d=(int)$this->newsdt->format('d');
		//
		$result=$ths_d;
		$result.=' '.BLang::_('MONTH_GENITIVE'.$ths_m);
		if($now_y!=$ths_y){
			$result.=' '.$ths_y;//01 січня 2018
			}
		return $result;
		}
	/**
	 *
	 */
	public function addadminlog($text){
		bimport('news.article_adminlog');
		$baal=new BNewsArticleAdminlog();
		$baal->article=$this->id;
		$baal->dt=new DateTime();
		$baal->text=$text;
		return $baal->savetodb();
		}
	/**
	 *
	 */
	public function nfchecked($str){
		$category=$this->getcategory();
		if(empty($category)){
			return false;
			}
		return $category->nfchecked($str);
		}
	/**
	 *
	 */
	public function getPhotoAlt($id, $lang = ''){
		$lang=$this->detectlang($lang);
		//$lang=$this->getactivelang($lang);
		if(empty($lang)){
			return '';
			}
		if(empty($this->photos[$id])){
			return '';
			}
		$photo = $this->photos[$id];
		if(($lang=='ru')&&(!empty($photo->alt_ru))){
			return $photo->alt_ru;
			}
		return $photo->alt;
		}
	/**
	 *
	 */
	public function getMainPhotoAuthorName($lang=''){
		$lang=$this->detectlang($lang);
		$mjson=$this->images;
		if($lang=='ru'){
			$authorName = $mjson->mainimage->author_ru;
			}
		if(empty($authorName)){
			$authorName = $mjson->mainimage->author;
			}
		return $authorName;
		}
	/**
	 *
	 */
	public function getMainPhotoAuthorUrl($lang=''){
		$lang=$this->detectlang($lang);
		$mjson=$this->images;
		if($lang=='ru'){
			$authorUrl = $mjson->mainimage->author_url_ru;
			}
		if(empty($authorUrl)){
			$authorUrl = $mjson->mainimage->author_url;
			}
		return $authorUrl;
		}
	/**
	 *
	 */
	public function getMainPhotoAuthorHTML($params=array(),$lang=''){
		bimport('html.general');
		$authorName = $this->getMainPhotoAuthorName($lang);
		$authorUrl = $this->getMainPhotoAuthorUrl($lang);
		if(!empty($authorName)){
			if(!empty($authorUrl)){
				$params['href'] = $authorUrl;
				$res = '<div>'.BHTML::htmlTag('a',$params,$authorName).'</div>';
				} else {
				$res = '<div>'.BHTML::htmlTag('span',$params,$authorName).'</div>';
				}
			} else {
			if(!empty($authorUrl)){
				$res = '<div>'.BHTML::htmlTag('a',$params,$authorName).'</div>';
				}
			}
		return $res;
		}

	/**
	 *
	 */
	public function getMainPhotoTitle($lang=''){
		$lang=$this->detectlang($lang);
		$mjson=$this->images;
		if($lang=='ru'){
			$imageTitle = $mjson->mainimage->alt_ru;
			}
		if(empty($imageTitle)){
			$imageTitle = $mjson->mainimage->alt;
			}
		return $imageTitle;
		}
	}
