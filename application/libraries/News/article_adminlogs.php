<?php
/**
 * Sets of functions and classes to work with news articles log.
 *
 * @author Andrii Biriev
 *
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */

class BNewsArticleAdminlogs extends BItemsList{
	use BSingleton;
	protected $tablename='news_articles_adminlog';
	protected $itemclassname='BNewsArticleAdminlog';
	protected $primarykey=array('article','dt');
	/**
	 *
	 */
	public function items_filter_sql($params,&$wh,&$jn){
		parent::items_filter_sql($params,$wh,$jn);
		$db=BFactory::getDBO();
		if(!empty($params['keyword'])){
			$keyword=mb_strtolower($params['keyword'],'UTF-8');
			$wh[]='(lower(`text`) like '.$db->escape_string('%'.$keyword.'%').')';
			}
		if(!empty($params['article'])){
			$wh[]='(`article`='.((int)$params['article']).')';
			}
		return true;
		}
	}