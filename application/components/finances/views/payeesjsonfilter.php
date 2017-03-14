<?php
/**
 * View for ...
 *
 * @author Andrii Biriev
 * @copyright ©2014 Brilliant IT corporation, www.it.brilliant.ua
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
