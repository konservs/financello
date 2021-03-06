<?php
/**
 * View for companies accounts.
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

class View_finances_currencies extends \Brilliant\MVC\BView{
	/**
	 *
	 */
	public function generate_breadcrumbs(){
		$brouter=\Application\BRouter::getInstance();
		$this->breadcrumbs=new \Brilliant\CMS\BBreadcrumbs();
		$this->breadcrumbs->add_element($brouter->generateURL('mainpage',array()),'Financello',true,'');
		$this->breadcrumbs->add_element($brouter->generateURL('users',array('view'=>'dashboard')),'Members area',true,'fa-dashboard');
		$this->breadcrumbs->add_element($brouter->generateURL('companies',array('view'=>'mycompany','id'=>$this->company->id)),$this->company->name);
		$this->breadcrumbs->add_element('','Currencies',false);
		}
	/**
	 * Process the error & return the message.
	 * 
	 * 
	 */
	public function process_error(){
		switch($this->error){
			case 1:
				return 'You are not logged';
			case 2:
				return 'Could not load company! Wrong ID.';
			case 3:
				return 'You are not linked with this company.';
			case 4:
				return 'Access denied for finances operaions in this company!';
			}
		return 'Unknown error!';
		}
	/**
	 * Get HTML.
	 */
	public function generate($data){
		$this->company=$data->company;
		$this->error=$data->error;
		if($this->error>0){
			return $this->process_error();
			}
		if(empty($this->company)){
			return 'Could not load company!';
			}
		$this->currencies=$data->currencies;

		$this->generate_breadcrumbs();
		return $this->templateLoad();
		}
	}
