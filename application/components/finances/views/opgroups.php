<?php
/**
 * View for ...
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

class View_finances_opgroups extends \Brilliant\MVC\BView{
	/**
	 *
	 */
	public function generate_breadcrumbs(){
		$brouter=BRouter::getInstance();
		$this->breadcrumbs=new BBreadcrumbs();
		$this->breadcrumbs->add_element($brouter->generateURL('mainpage',array()),'Financello',true,'');
		$this->breadcrumbs->add_element($brouter->generateURL('users',array('view'=>'dashboard')),'Members area',true,'fa-dashboard');
		$this->breadcrumbs->add_element($brouter->generateURL('companies',array('view'=>'mycompany','id'=>$this->company-id)),$this->company->name);
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
		return $this->template_load();
		}
	}
