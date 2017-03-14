<?php
/**
 * View for ..
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

bimport('mvc.component');
bimport('mvc.view');
bimport('cms.breadcrumbs');

class View_compfinances_opgroup extends BView{
	/**
	 *
	 */
	public function generate_breadcrumbs(){
		$brouter=BRouter::getInstance();
		$this->breadcrumbs=new BBreadcrumbs();
		$this->breadcrumbs->add_element($brouter->generateURL('mainpage',array()),'Financello',true,'');
		$this->breadcrumbs->add_element($brouter->generateURL('users',array('view'=>'dashboard')),'Members area',true,'fa-dashboard');
		$this->breadcrumbs->add_element($brouter->generateURL('companies',array('view'=>'mycompany','id'=>$this->company-id)),$this->company->name);
		$this->breadcrumbs->add_element($brouter->generateURL('compfinances',array('view'=>'opgroups','company'=>$this->company-id)),'Operations');
		if(empty($this->opgroup->id)){
			$this->breadcrumbs->add_element('','Adding operation group',false);
			}
		else{
			$this->breadcrumbs->add_element('',$this->opgroup->getname(),false);
			}
		}
	/**
	 *
	 */
	public function generate($data){
		$this->company=$data->company;
		if(empty($this->company)){
			return 'Could not load company!';
			}
		$this->opgroup=$data->opgroup;
		if(empty($this->opgroup)){
			return 'Could not load operation group!';
			}
		//Fill some data...
		$this->categories=$data->categories;
		$this->accounts=$data->accounts;
		$this->projects=$data->projects;
		//
		$this->generate_breadcrumbs();
		return $this->template_load();
		}
	}
