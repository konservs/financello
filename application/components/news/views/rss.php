<?php
/**
 * View for RSS category feed
 *
 * @author Andrii Biriev, a@konservs.com
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
defined('BEXEC') or die('No direct access!');

bimport('mvc.component');
bimport('mvc.view');
bimport('images.single');

class View_news_rss extends BView{
	/**
	 * Process last-modified...
	 */
	public function processlastmod(){
		if(is_array($this->items)){
			foreach($this->items as $item){
				$this->setlastmodified($item->modified);
				}
			}
		return true;
		}
	/**
	 * Prepare XML
	 */
	public function generate($data){
		if($data->error>0){
			return 'Error '.$data->error;
			}
		$this->category=$data->category;
		$this->items=$data->items;
		//
		$this->processlastmod();
		$this->setcache('true',300);
		//
		$rss='';
		$rss.='<?xml version="1.0" encoding="UTF-8"?><rss version="2.0">'.PHP_EOL;
		$rss.='<channel>'.PHP_EOL;
		if(!empty($this->category)){
			$rss.='<title>'.htmlspecialchars($this->category->getname()).'</title>'.PHP_EOL;
			$rss.='<link>'.htmlspecialchars($this->category->getURL('','https://')).'</link>'.PHP_EOL;
			$rss.='<description>'.htmlspecialchars($this->category->getmetadesc()).'</description>'.PHP_EOL;
			} else {
			}
		$now=new DateTime();
		$rss.='<lastBuildDate>'.$now->format('r').'</lastBuildDate>'.PHP_EOL;
		//
		if(is_array($this->items)){
			foreach($this->items as $item){
				$rss.='<item>'.PHP_EOL;
				$rss.='	<title>'.htmlspecialchars($item->getname()).'</title>'.PHP_EOL;
				$rss.='	<link>'.htmlspecialchars($item->getURL('','https://')).'</link>'.PHP_EOL;
				$descr=$item->getmetadesc();
				if(empty($descr)){
					$descr=$item->getintro();
					}
				$rss.='	<description>'.htmlspecialchars($descr).'</description>'.PHP_EOL;
				//RFC 2822
				$rss.='	<pubDate>'.$item->newsdt->format('r').'</pubDate>'.PHP_EOL;
				$rss.='</item>'.PHP_EOL;
				}
			}
		//
		$rss.='</channel>'.PHP_EOL;
		$rss.='</rss>'.PHP_EOL;
		//
		return $rss;
		}
	}
