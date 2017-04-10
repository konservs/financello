<?php
/**
 * View for mycompany dashboard page
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

class View_companies_mycompany extends \Brilliant\MVC\BView {
	/**
	 *
	 */
	public function generate_breadcrumbs() {
		$brouter = \Application\BRouter::getInstance();
		$this->breadcrumbs = new \Brilliant\CMS\BBreadcrumbs();
		$this->breadcrumbs->add_element($brouter->generateURL('mainpage', array()), 'Financello', true, '');
		$this->breadcrumbs->add_element($brouter->generateURL('users', array('view' => 'dashboard')), 'Members area', true, 'fa-dashboard');
		$this->breadcrumbs->add_element('', $this->company->name, false);
	}

	/**
	 *
	 */
	public function generate($data) {
		if ($data->error == 403) {
			$this->setStatus(403);
			return $this->templateLoad('#error_403', true);
		}
		if ($data->error != 0) {
			$this->setStatus(500);
			return 'Error: #' . $data->error;
		}

		$this->company = $data->company;
		if (empty($this->company)) {
			return 'Could not load company';
		}
		$this->generate_breadcrumbs();
		return $this->templateLoad();
	}
}
