<?php
/**
 * New account 
 *
 * @author: Andrii Birev
 */
defined('BEXEC') or die('No direct access!');
use \Brilliant\CMS\BLang;
//
$js='';
$js.='window.urls={};'.PHP_EOL;
$js.='window.urls.select2currenciesfilter="/members/mycompany-1/currencies.json";';
$this->addJS('',$js);
//
$this->useFramework('select2');
$this->useFramework('select2-finances-currencies');
?>
<div id="compfinances_accountadd">
	<div class="header">
		<h1 class="page-header">New account</h1>
	</div>

	<?php $this->breadcrumbs->draw(); ?>

	<div class="panel-body row">
		<div class="col-lg-3 col-md-12 col-sm-12 opgname form-group">
			<label class="sr-only" for="<?php echo 'fincurrencieslist'; ?>">Currency</label>
			<select id="<?php echo 'fincurrencieslist'; ?>" class="form-control input-sm select2fincurrencieslist" name="currency" placeholder="Currency"></select>
		</div>
	</div>

</div>
