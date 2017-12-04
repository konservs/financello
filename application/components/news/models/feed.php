<?php
/**
 * Model for...
 *
 * @author Andrii Biriev
 *
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
defined('BEXEC') or die('No direct access!');

bimport('mvc.model');
bimport('news.articles');
bimport('disqus.disqusapi');
bimport('comments.groups');

class Model_news_feed extends BModel{
	/**
	 *
	 */
	public function get_data($segments){
		$data=new stdClass;
		$data->error=-1;
		//Get params
		$bna=BNewsArticles::GetInstance();
		//
		$params=array();
		$params['limit']=30;
		$params['status']='P';
		$params['orderby']='newsdt';
		$now=new DateTime();
		$params['newsdt_max']=$now;
		$params['orderdir']='desc';
		$data->latest=$bna->items_filter($params);
		if(empty($data->latest)){
			$data->latest=array();
			}
		//
		$params=array();
		$params['limit']=30;
		$params['status']='P';
		$params['orderby']='hits';
		$now=new DateTime();
		$params['newsdt_max']=$now;
		//
		$monthbefore=new DateTime();
		$monthbefore->sub(new DateInterval('P14D'));
		$params['newsdt_min']=$monthbefore;
		$params['orderdir']='desc';
		$data->popular=$bna->items_filter($params);
		//
		$from=new DateTime();
		$from->sub(new DateInterval('P14D'));
		$bCommentsGroups = BCommentsGroups::getInstance();
		$params=array();
		$params['itemcom']=array('news','blogs');
		$params['itemdate_from']=$from;
		$params['orderby']='comments_published';
		$params['orderdir']='DESC';
		$params['limit']=50;
		$data->commentable=$bCommentsGroups->items_filter($params);
		//All done!
		$data->error=0;//ok
		return $data;
		}
	}
