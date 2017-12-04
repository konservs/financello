<?php
/**
 * Sets of functions and classes to work with temp photos.
 *
 * @author Andrii Biriev
 *
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */

bimport('cms.language');
bimport('cms.singleton');
bimport('news.article_tempphoto');
bimport('items.general');
bimport('items.list');

class BNewsArticleTempphotos extends BItemsList{
	use BSingleton;
	protected $tablename='news_tempphotos';
	protected $itemclassname='BNewsArticleTempphoto';
	protected $primarykey='id';
	/**
	 *
	 */
	public function items_filter_sql($params,&$wh,&$jn){
		parent::items_filter_sql($params,$wh,$jn);
		$db=BFactory::getDBO();
		if(!empty($params['tmpfolder'])){
			$wh[]='(`tmpfolder`='.$db->escape_string($params['tmpfolder']).')';
			}
		if(!empty($params['adminuser'])){
			$wh[]='(`adminuser`='.((int)$params['adminuser']).')';
			}
		return true;
		}
	}
