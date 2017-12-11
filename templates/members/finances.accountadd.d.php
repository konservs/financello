<?php
/**
 * New account 
 *
 * @author: Andrii Birev
 */
defined('BEXEC') or die('No direct access!');
use \Brilliant\CMS\BLang;
$brouter=\Application\BRouter::getInstance();
$urlAccounts = $brouter->generateURL('finances',array('view'=>'accounts','company'=>$this->company->id));
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


	<div class="row">
		<div class="col-lg-3 col-md-12 col-sm-12 opgname form-group">
			<label for="<?php echo 'fin_account_name'; ?>">Name</label>
		</div>
		<div class="col-lg-9 col-md-12 col-sm-12 opgname form-group">
			<input type="text" id="<?php echo 'fin_account_name'; ?>" class="form-control input-sm" name="name" placeholder="Account name, for example, Credit Card"/>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-3 col-md-12 col-sm-12 opgname form-group">
			<label for="<?php echo 'fincurrencieslist'; ?>">Currency</label>
		</div>
		<div class="col-lg-9 col-md-12 col-sm-12 opgname form-group">
			<select id="<?php echo 'fincurrencieslist'; ?>" class="form-control input-sm select2fincurrencieslist" name="currency" placeholder="Currency"></select>
		</div>
	</div>


	<div class="row">
		<div class="col-lg-3 col-md-12 col-sm-12 opgname form-group">
			<label for="<?php echo 'fin_account_icon'; ?>">Icon</label>
		</div>
		<div class="col-lg-9 col-md-12 col-sm-12 opgname form-group">
			<select id="<?php echo 'fin_account_icon'; ?>" class="form-control input-sm" name="icon" placeholder="Icon">
				<option value="A">Icon A</option>
				<option value="B">Icon B</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3 col-md-12 col-sm-12 opgname form-group">
			<label for="<?php echo 'fin_account_limit'; ?>">Credit Limit</label>
		</div>
		<div class="col-lg-9 col-md-12 col-sm-12 opgname form-group">
			<input type="text" id="<?php echo 'fin_account_limit'; ?>" class="form-control input-sm" name="limit" value="0"/>
		</div>
	</div>


	<div class="row">
		<div class="col-lg-3 col-md-12 col-sm-12 opgname form-group">
		</div>
		<div class="col-lg-9 col-md-12 col-sm-12 opgname form-group">
			<button class="btn btn-default" role="submit">Save</button>
			<a class="btn btn-default" href="<?php echo $urlAccounts; ?>">Cancel</a>
		</div>
	</div>


</div>
