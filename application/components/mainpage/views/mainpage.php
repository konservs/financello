<?php
defined('BEXEC') or die('No direct access!');
use \Brilliant\cms\BLang;

class View_mainpage_mainpage extends \Brilliant\mvc\BView{
	/**
	 *
	 */
	public function generate($data = NULL){
		$lang=BLang::$langcode;
		//Set headers
		$this->settitle(BLang::_('COM_MAINPAGE_TITLE'));
		$this->addmeta('description',COM_MAINPAGE_METADESC_UA);
		$this->addmeta('keywords',COM_MAINPAGE_METAKEYW_UA);
		//Vkontakte & OpenGraph
		//Better to use schema.org, because it's not conflicted with w3c validator
		//$this->addmeta('vk:title',COM_MAINPAGE_TITLE_UA);
		//$this->addmeta('og:title',COM_MAINPAGE_TITLE_UA);
		//$this->addmeta('vk:description',COM_MAINPAGE_METADESC_UA);
		//$this->addmeta('og:description',COM_MAINPAGE_METADESC_UA);
		//Vkontakte & OpenGraph image
		//Better to use schema.org, because it's not conflicted with w3c validator
		//$this->addmeta('vk:image',COM_MAINPAGE_METAIMG);
		//$this->addmeta('og:image',COM_MAINPAGE_METAIMG);

		//no html for mainpage!
		$this->setcache(true,3600);//Cache for 1 hour
		return $this->templateLoad();
		}
	}
