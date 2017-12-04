<?php
/**
 * View for...
 *
 * @author Andrii Biriev
 *
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
defined('BEXEC') or die('No direct access!');

bimport('mvc.model');
bimport('news.articles');
bimport('polls.polls');
bimport('news.categories');
bimport('log.general');

class Model_news_article extends BModel{
	/**
	 * @param $limit
	 * @param $nid
	 * @param $tids
	 * @return array|bool
	 */
	protected function getLinkedarticles($limit,$excludeids,$tids){
		$db=BFactory::getDBO();
		if(empty($db)){
			return false;
			}
		//
		$exclude=array();
		if(is_array($excludeids)){
			$exclude=$excludeids;
			}else{
			$exclude[]=$excludeids;
			}
		//
		$qr='SELECT `itmtype`,`itmid`, count(`tag`) as `cnt`, `itemdate` FROM `tags_links`  
			WHERE ((`itmtype`=\'N\') AND (`tag` in ('.implode(',',$tids).')) AND (`itmid` NOT IN ('.implode(',',$exclude).')))
 			GROUP BY `itmid`
 			ORDER BY `cnt` DESC, `itemdate` DESC
 			LIMIT '.$limit.'';
		$q=$db->Query($qr);
		$ids=array();
		while($l=$db->fetch($q)){
			$id=(int)$l['itmid'];
			$ids[]=$id;
		}
		return $ids;
	}

	/**
	 *
	 */
	public function get_data($segments){
		$data=new stdClass;
		$data->error=-1;
		//Get params
		$articleid=(int)$segments['id'];
		if(empty($articleid)){
			$data->error=1;
			return $data;
			}
		$bna=BNewsArticles::GetInstance();
		$data->article=$bna->item_get($articleid);
		if(empty($data->article)){
			$data->error=1;
			return $data;
			}
		//Poll
		if($data->article->poolid){
			$bpolls=BPollsPolls::getInstance();
			$data->poll=$bpolls->item_get((int)$data->article->poolid);
			}
		
		//Get tag ids for this article
		$tagsids=array();
		foreach($data->article->tags as $tag){
			$tid=(int)$tag->tag;
			$tagsids[]=$tid;
			}
		//Linked articles
		$data->linkedarticles=array();
		$limitlinkedarticles=LIMIT_LINKED_ARTICLES;
		if(!is_numeric($limitlinkedarticles)){
			$limitlinkedarticles=4;
			}
		//
		if(!empty($data->article->linkedarticles)){
			$idsx=explode(',',$data->article->linkedarticles);
			$ids=array();
			foreach($idsx as $idx){
				$id=(int)trim($idx);
				$ids[]=$id;
				}
			$countitmid=count($ids);
			$params=array();
			$params['status']="P";
			$params['orderby']='newsdt';
			$params['orderdir']=' DESC';
			BLog::addtolog('[com_news.article] Linked articles count='.$countitmid.' limit='.$limitlinkedarticles.'.');
			if($countitmid>=$limitlinkedarticles){
				BLog::addtolog('[com_news.article] loading '.$limitlinkedarticles.' articles...');
				$params['ids']=$ids;
				$params['limit']=$limitlinkedarticles;
				$data->linkedarticles=$bna->items_filter($params);
				}else{
				$l=$limitlinkedarticles-$countitmid;
				BLog::addtolog('[com_news.article] Need to find '.$l.' more articles...');
				//
				$params['ids']=$ids;
				$articles=$bna->items_filter($params);
				//
				$exclude=$ids;
				$exclude[]=$data->article->id;
				$linkedarticles=$this->getLinkedarticles($l,$exclude,$tagsids);
				$articles2=$bna->items_get($linkedarticles);
				//
				$data->linkedarticles=array_merge($articles2,$articles);
				}
			}else{
			BLog::addtolog('[com_news.article] Linked articles are empty. Trying to get linked articles by tags...');
			$params=array();
			$params['status']="P";
			$params['orderby']='newsdt';
			$params['orderdir']=' DESC';
			$l=(int)$limitlinkedarticles;
			$linkedarticles=$this->getLinkedarticles($l,$data->article->id,$tagsids);
			$data->linkedarticles=$bna->items_get($linkedarticles);
			}
		//All done!
		$data->error=0;//ok
		return $data;
		}
	}
