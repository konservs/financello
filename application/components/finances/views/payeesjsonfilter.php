<?php
/**
 * View for ...
 *
 * @author Andrii Biriev
 */
defined('BEXEC') or die('No direct access!');

bimport('mvc.component');
bimport('mvc.view');
bimport('cms.breadcrumbs');

class View_compfinances_payeesjsonfilter extends BView{
	/**
	 *
	 */
	public function generate($data){
		return json_encode($data->json);
		}
	}
