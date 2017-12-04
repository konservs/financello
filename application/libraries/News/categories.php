<?php
/**
 * Sets of functions and classes to work with news categories.
 *
 * @author Andrii Biriev
 *
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */

class BNewsCategories extends BItemsTree{
	use BSingleton;
	protected $tablename='news_categories';
	protected $itemclassname='BNewsCategory';

	/**
	 *
	 */
	public function items_filter_sql($params,&$wh,&$jn){
		parent::items_filter_sql($params,$wh,$jn);
		$db=BFactory::getDBO();
		if(!empty($params['keyword'])){
			$keyword=mb_strtolower($params['keyword'],'UTF-8');
			$keyword=trim($keyword);
			$keyword=str_replace('’','_',$keyword);
			$keyword=str_replace('\'','_',$keyword);
			$languages=BLang::langlist();
			$sql='';
			foreach($languages as $lang){
				$sql.=empty($sql)?' ':'OR';
				$sql.=' (lower(`name_'.$lang.'`) like '.$db->escape_string('%'.$keyword.'%').')';
				}
			$wh[]=$sql;
			}
		if(!empty($params['ids'])){
			$wh[]='(`id` in ('.implode(',',$params['ids']).'))';
			}
		if(!empty($params['status'])){
			$wh[]='(`status` = "'.$params['status'].'")';
			}
		}
	}