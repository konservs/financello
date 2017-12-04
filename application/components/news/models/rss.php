<?php
/**
 * Model for RSS feed
 *
 * @author Andrii Biriev
 *
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
defined('BEXEC') or die('No direct access!');

bimport('mvc.model');
bimport('news.articles');
bimport('cms.pagination');

class Model_news_rss extends BModel{
	/**
	 *
	 */
	public function get_data($segments){
		$data=new stdClass;
		$data->error=-1;
		//Get params
		$catid=(int)$segments['category'];
		if(!empty($catid)){
			$bncat=BNewsCategories::GetInstance();			
			$data->category=$bncat->item_get($catid);
			if(empty($data->category)){
				$data->error=1;
				return $data;
				}
			}
		//
		$bnart=BNewsArticles::GetInstance();
		//
		$limit=(int)$segments['limit'];
		if(($limit<1)||($limit>200)){
			$limit=10;
			}
		$offset=0;
		if($catid==1){
			$params['catnotnull']=true;
			}
		elseif(!empty($catid)){
			$params['category']=$catid;
			}
		$params['orderby']='newsdt';
		//$params['excludeflags']=array(NEWSARTICLE_FLAG_ADVERT);
		$params['allowrss']='Y';
		$params['status']='P';
		$now=new DateTime();
		$params['newsdt_max']=$now;
		$params['orderdir']='desc';
		$params['limit']=$limit;
		$params['offset']=$offset;

		//If we have empty blog results (for example, LIFE or PR categories)
		$data->items_count=$bnart->items_filter_count($params);
		$data->items=$bnart->items_filter($params);
		//All done!
		$data->error=0;//ok
		return $data;
		}
	}
