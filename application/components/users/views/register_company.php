<?php
/**
 * Users dashboard page
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright © Andrii Biriev, a@konservs.com, www.konservs.com
 */
defined('BEXEC') or die('No direct access!');

use \Brilliant\CMS\BLang;
use \Brilliant\CMS\BBreadcrumbs;

class View_users_register_company extends \Brilliant\MVC\BView{
	/**
	 *
	 */
	public function generate_breadcrumbs(){
		$bRouter=\Application\BRouter::getInstance();
		$this->breadcrumbs=new BBreadcrumbs();
		$this->breadcrumbs->add_element($bRouter->generateURL('mainpage',array()),'Financello',true,'');
		$this->breadcrumbs->add_element('','Company registration',false,'fa-dashboard');
		}
	/**
	 *
	 */
	public function generate($data){
		$this->companies=$data->companies;
		$this->settitle(BLang::_('USERS_REGISTER_COMPANY_TITLE'));
		$this->addmeta('description',BLang::_('USERS_DASHBOARD_METADESC'));
		$this->generate_breadcrumbs();
		return $this->templateLoad();
		}
	}
