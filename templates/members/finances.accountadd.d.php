<?php
/**
 * New account 
 *
 * @author: Andrii Birev
 */
defined('BEXEC') or die('No direct access!');
use \Brilliant\CMS\BLang;
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
			<input type="hidden" id="<?php echo 'fincurrencieslist'; ?>" class="form-control input-sm select2 fincurrencieslist" name="opgroup_name" placeholder="Currency" value="<?php //echo $this->operation->payee; ?>"/>
		</div>
	</div>

</div>
