<?php
/**
 * View for operation groups.
 *
 * @author Andrii Biriev <a@konservs.com>
 * @copyright � Andrii Biriev, a@konservs.com, www.konservs.com
 */
defined('BEXEC') or die('No direct access!');

use \Brilliant\CMS\BLang;

class View_finances_opgroups extends \Brilliant\MVC\BView{
	/**
	 *
	 */
	public function generate_breadcrumbs(){
		$brouter=\Application\BRouter::getInstance();
		$this->breadcrumbs=new \Brilliant\CMS\BBreadcrumbs();
		$this->breadcrumbs->add_element($brouter->generateURL('mainpage',array()),'Financello',true,'');
		$this->breadcrumbs->add_element($brouter->generateURL('users',array('view'=>'dashboard')),'Members area',true,'fa-dashboard');
		$this->breadcrumbs->add_element($brouter->generateURL('companies',array('view'=>'mycompany','id'=>$this->company->id)),$this->company->name);
		$this->breadcrumbs->add_element('','Operations',false);
		}
	/**
	 *
	 */
	public function generate($data){
		$this->company=$data->company;
		if(empty($this->company)){
			return 'Could not load company!';
			}
		$this->opgroups=$data->opgroups;

		$this->generate_breadcrumbs();
		return $this->templateLoad();
		}
	}
