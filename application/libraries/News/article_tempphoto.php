<?php
/**
 * Sets of functions and classes to work with temporary photos.
 *
 * @author Andrii Biriev
 *
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */

class BNewsArticleTempphoto extends BItemsItem{
	protected $collectionname='BNewsArticleTempphotos';
	protected $tablename='news_tempphotos';
	protected $primarykey='id';
	/**
	 * Constructor - init fields...
	 */
	function __construct() {
		parent::__construct();
		$this->fieldAddRaw('tmpfolder','string');
		$this->fieldAddRaw('adminuser','int');
		$this->fieldAddRaw('url','string');
		$this->fieldAddRaw('alt','string');
		$this->fieldAddRaw('filename','string');
		$this->fieldAddRaw('filesize','int');
		//
		$this->fieldAddRaw('created','dt',array('readonly'=>true));
		$this->fieldAddRaw('ordering','int',array('readonly'=>true));
		}
	/**
	 *
	 */
	public function getURL($param){
		$ph=new BImage();
		$ph->url=$this->url;
		return $ph->geturl($param);
		}
	}
