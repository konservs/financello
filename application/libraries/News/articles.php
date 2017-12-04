<?php
/**
 * Sets of functions and classes to work with news articles.
 *
 * @author Andrii Biriev
 *
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */

/**
 * Class BNewsArticles
 *
 * @method BNewsArticle item_get(integer $id)
 * @method BNewsArticle[] items_get(integer[] $ids)
 * @method BNewsArticle[] items_filter($params)
 */
class BNewsArticles extends BItemsList{
	use BSingleton;
	protected $tablename='news_articles';
	protected $searchtablename='poglyad_news_articles';
	protected $itemclassname='BNewsArticle';
	protected $hitskey='hits';
	protected $hits_daily_table='news_articles_hits';
	protected $linkedtables=array(
		array('name'=>'tags_links','filter'=>'(itmtype="N")','extkey'=>'itmid','field'=>'tags'),
		array('name'=>'news_photos','extkey'=>'article','field'=>'photos')
		);
	protected $cachetime=300;
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
		if(!empty($params['status'])){
			$wh[]='(`status` = "'.$params['status'].'")';
			}
		if(!empty($params['allowrss'])){
			$wh[]='(`allowrss` = '.$db->escape_string($params['allowrss']).')';
			}
		if((!empty($params['istop']))&&(is_array($params['istop']))){
			$str='';
			foreach($params["istop"] as $itm){
				$str.=(empty($str)?'':',').'"'.$itm.'"';
				}
			$wh[]='(`ismain` in ('.$str.'))';
			}

		if(!empty($params['category']) && is_numeric($params['category'])){
			$wh[]='(`category` = '.$params['category'].')';
			}
		if(!empty($params['uniq_id'])){
			$wh[]='(`uniq_id`='.$db->escape_string($params['uniq_id']).')';
			}
		if(!empty($params['date_from'])){
			$date_from=new BDateTime($params['date_from']);
			$date_to=new BDateTime($params['date_to']);
			$wh[]='(DATE(`newsdt`) BETWEEN '.$db->escape_string($date_from->format('Y-m-d')).' AND '.$db->escape_string($date_to->format('Y-m-d')).')';
			}
		if(!empty($params['adminauthor'])){
			$wh[]='(`adminauthor` = '.$params['adminauthor'].')';
			}
		if(!empty($params['ids'])){
			$wh[]='(`id` in ('.implode(',',$params['ids']).'))';
			}
		if(isset($params['catnotnull'])){
			$wh[]='(`category` is not NULL)';
			}

		if(isset($params['cats']) && is_array($params['cats'])){
			$wh[]='(`category` in ('.implode(',', $params['cats']).'))';
			}

		if(!empty($params['ismain'])){
			if(is_array($params['ismain'])){
				$vals=array();
				foreach($params['ismain'] as $v){
					$vals[]=$db->escape_string($v);
					}
				$wh[]='(`ismain` in ('.implode(',',$vals).'))';
				}else{
				$wh[]='(`ismain` = "'.$params['ismain'].'")';
				}
			}
		if(!empty($params['idpoglyad'])){
			if(is_array($params['idpoglyad'])){
				$wh[]='(`idpoglyad` in ('.implode(',',$params['idpoglyad']).'))';
				}else{
				$wh[]='(`idpoglyad`='.(int)$params['idpoglyad'].')';
				}
			}
		if(!empty($params['weblogpoglyad'])){
			$wh[]='(`weblogpoglyad`='.(int)$params['weblogpoglyad'].')';
			}
		if(!empty($params['aliaspoglyad'])){
			$wh[]='(`aliaspoglyad`='.$db->escape_string($params['aliaspoglyad']).')';
			}
		if(!empty($params['date'])){
			$date=new DateTime($params['date']);
			$wh[]='(DATE(`newsdt`)='.$db->escape_string($date->format('Y-m-d')).')';
			}
		if(!empty($params['flags'])){
			$mask=0;
			foreach($params['flags'] as $flag){
				$mask |=$flag;
				}
			$wh[]='((`flags` & '.$mask.')>0)';
			}

		if(!empty($params['excludeflags'])){
			$mask=0;
			foreach($params['excludeflags'] as $flag){
				$mask |=$flag;
				}
			$wh[]='((`flags` & '.$mask.')=0)';
			}
		if(!empty($params['month'])){
			$date = new DateTime();
			$date->modify($params['month']);
			$wh[]=' (`newsdt` > '.$db->escape_string($date->format('Y-m-d')).')';
			}
		if(!empty($params['newsdt_max'])){
			$wh[]='(`newsdt`<'.$db->escape_string($params['newsdt_max']->format('Y-m-d H:i:s')).')';
			}
		if(!empty($params['newsdt_min'])){
			$wh[]='(`newsdt`>'.$db->escape_string($params['newsdt_min']->format('Y-m-d H:i:s')).')';
			}
		}

	/**
	 * @param $params
	 * @param $wh
	 * @return bool|void
	 */
	public function search_sql($params,&$wh){
		parent::search_sql($params,$wh);
		if(!empty($params['category'])){
			$category=BNewsCategories::getInstance();
			$cat=$category->item_get((int)$params['category']);
			$subcats=$cat->getsubcatsids();
			$catids=implode(',',$subcats);
			$wh[]='(category in ('.$catids.'))';
			}
		if(!empty($params['date_from'])){
			$date_from=new DateTime($params['date_from']);
			$date_to=new DateTime($params['date_to']);
			$wh[]='(newsdt_ts>='.$date_from->getTimestamp().')';
			$wh[]='(newsdt_ts<='.$date_to->getTimestamp().')';
			}
		}

	/**
	 * @param $value
	 * @param $ids
	 * @return bool
	 */
	public function update_item_tree($value, $ids){
		$db=BFactory::getDBO();
		if(empty($db)){
			return false;
		}
		$qr='UPDATE `'.$this->tablename.'` set `category` = '.$value.' WHERE category in ('.implode(',', $ids).') ';
		$q=$db->Query($qr);
		if(empty($q)){
			return false;
		}
		return true;
	}
	}