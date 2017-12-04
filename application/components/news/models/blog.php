<?php
/**
 * Model for news blog.
 *
 * @author Andrii Biriev
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
defined('BEXEC') or die('No direct access!');

bimport('mvc.model');
bimport('news.articles');
bimport('cms.pagination');


class Model_news_blog extends BModel{
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
		$limit=$data->category->itemsperpage;
		$offset=$segments['page']*$limit;
		$data->offset=$segments['page']*$limit;
		if($catid==1){
			$params['catnotnull']=true;
			}
		elseif(!empty($catid)){
			$params['category']=$catid;
			}
		$params['status']='P';
		$params['orderby']='newsdt';
		$now=new DateTime();
		$params['newsdt_max']=$now;
		$params['orderdir']='desc';
		//Select first TOP article, if we are on the first page
		if($offset==0){
			$params['limit']=$data->category->toplimit;//How much TOP articles
			$params['ismain']=array('T','R');
			$data->topitems=$bnart->items_filter($params);
			if(empty($data->topitems)){
				unset($params['ismain']);
				$data->topitems=$bnart->items_filter($params);
				}
			$exclude=array();
			if(!empty($data->topitems)){
				foreach($data->topitems as $toparticle){
					$exclude[]=$toparticle->id;
					}
				}
			unset($params['ismain']);
			if(!empty($exclude)){
				$params['exclude']=$exclude;
				}
			$params['limit']=$limit;
			}else{
			$params['limit']=$limit;
			}
		$params['offset']=$offset;
		//If we have empty blog results (for example, LIFE or PR categories)
		if($limit<=0){
			$data->pagination=NULL;
			$data->items=array();
			$data->error=0;//ok
			return $data;
			}
		//
		$pg=new BPagination();
		$pg->setLimit($limit);
		$pg->type=PGTYPE_POST;
		$pg->setOffset($segments['offset']);
		$brouter=BRouter::getInstance();
		$pg->setBaseUrl('//'.$brouter->generateURL('news',BLang::$langcode,$segments));
		$segments['offset']=$offset;
		$pg->items_count=$bnart->items_filter_count($params);
		$data->items=$bnart->items_filter($params);
		if(empty($segments['page'])){
			$segments['page']=(int)($offset / $limit);
			}
		$pg->setpage($segments['page']);
		$data->pagination=$pg;

		//All done!
		$data->error=0;//ok
		return $data;
		}
	}
