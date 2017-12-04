<?php
/**
 * Sets of functions and classes to work with single forum.
 *
 * @author Andrii Biriev
 *
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */

class BNewsArticleAdminlog extends BItemsItem{
	protected $collectionname='BNewsArticleAdminlogs';
	protected $tablename='news_articles_adminlog';
	protected $primarykey=array('article','dt');
	protected $imageintro;
	protected $oldcategory;
	/**
	 * Constructor - init fields...
	 */
	function __construct() {
		parent::__construct();
		$this->fieldAddRaw('text','string');
		}
	/**
	 *
	 */
	public function dbcheckkeys(){
		if(empty($this->article)){
			return false;
			}
		if(empty($this->dt)){
			return false;
			}
		return true;		
		}
	/**
	 *
	 */
	public function dbinsert(){
		if(!$this->dbcheckkeys()){
			return false;
			}
		$db=BFactory::getDBO();
		$qr_fields=array();
		$qr_values=array();
		$this->getfieldsvalues($qr_fields,$qr_values);
		//
		$qr_fields[]='`article`';
		$qr_values[]=$this->article;
		//
		$qr_fields[]='`dt`';
		$qr_values[]=$db->escape_datetime($this->dt);
		//
		$qr='INSERT INTO `'.$this->tablename.'` ('.implode(',',$qr_fields).') VALUES ('.implode(',',$qr_values).')';
		//Running query...
		$q=$db->query($qr);
		if(empty($q)){
			return false;
			}
		$this->isnew=false;
		//Return result
		return true;
		}
	/**
	 *
	 */
	public function dbupdate(){
		if(!$this->dbcheckkeys()){
			return false;
			}
		$db=BFactory::getDBO();
		$qr_fields=array();
		$qr_values=array();
		$this->getfieldsvalues($qr_fields,$qr_values);
		//
		$qr='UPDATE `'.$this->tablename.'` SET ';
		$first=true;
		foreach($qr_fields as $i=>$field){
			$qr.=($first?'':', ').$field.'='.$qr_values[$i];
			$first=false;
			}
		$qr.=' WHERE ((`article`=(int)'.$this->article.') AND (`dt`="'.$this->dt.'"))';
		//Running query...
		$q=$db->query($qr);
		if(empty($q)){
			return false;
			}
		$this->isnew=false;
		//Return result
		return true;
		}
	}
