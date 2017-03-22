<?php
/**
 * Basic class to control companies.
 *
 * @author Andrii Biriev
 */
namespace Application\Companies;

/**
 * Class Companies
 *
 * @method Company item_get(integer $id)
 * @method Company[] items_get(integer[] $ids)
 * @method Company[] items_filter($params)
 */
class Companies extends \Brilliant\Items\BItemsList{
	use \Brilliant\BSingleton;
	protected $tableName='companies';
	protected $itemClassName='\Application\Companies\Company';

	/**
	 *
	 */
	public function itemsFilterSql($params,&$wh,&$jn){
		parent::itemsFilterSql($params,$wh,$jn);
		$db=\Brilliant\BFactory::getDBO();
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
		if(!empty($params['status'])){
			$wh[]='(`status` = "'.$params['status'].'")';
			}
		if(!empty($params['published'])){
			$wh[]='(`published` = "'.$params['published'].'")';
			}
		if(!empty($params['director'])){
			if(is_array($params['director'])){
				$wh[]='(`director` in ('.implode(',',$params['director']).'))';
				}else{
				$wh[]='(`director`='.(int)$params['director'].')';
				}
			}
		}
	/**
	 *
	 */
	public function byUserId($userId){
		return $this->itemsFilter(array('director'=>$userId,'published'=>'P'));
		}
	}
