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

	<form method="POST">
		<!-- -->
		<div class="form-group">
			<label for="<?php echo 'fin_account_name'; ?>">Name</label>
			<input type="text" id="<?php echo 'fin_account_name'; ?>" class="form-control<?php echo($this->formErrors['name']?' is-invalid':''); ?>" name="name" placeholder="Account name, for example, Credit Card" value="<?php echo htmlspecialchars($this->formData['name']); ?>" />
			<?php if($this->formErrors['name']): ?>
				<div class="invalid-feedback"><?php echo htmlspecialchars($this->formErrors['name']->message); ?></div>
			<?php endif; ?>
		</div>
		<!-- -->
		<div class="form-group">
			<label for="<?php echo 'fincurrencieslist'; ?>">Currency</label>
			<select id="<?php echo 'fincurrencieslist'; ?>" class="form-control select2fincurrencieslist<?php echo($this->formErrors['currency']?' is-invalid':''); ?>" name="currency" placeholder="Currency"></select>
			<?php if($this->formErrors['currency']): ?>
				<div class="invalid-feedback"><?php echo htmlspecialchars($this->formErrors['currency']->message); ?></div>
			<?php endif; ?>
		</div>
		<!-- -->
		<div class="form-group">
			<label for="<?php echo 'fin_account_icon'; ?>">Icon</label>
			<?php $icons = \Application\Finances\Accounts::listIcons(); ?>
			<select id="<?php echo 'fin_account_icon'; ?>" class="form-control" name="icon" placeholder="Icon">
				<?php foreach($icons as $icon): ?>
					<option value="<?php echo htmlspecialchars($icon->id); ?>" data-class="<?php echo htmlspecialchars($icon->class); ?>"><?php echo htmlspecialchars($icon->name); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<!-- -->
		<div class="form-group">
			<label for="<?php echo 'fin_account_limit'; ?>">Credit Limit</label>
			<input type="text" id="<?php echo 'fin_account_limit'; ?>" class="form-control" name="limit" value="0"/>
		</div>
		<!-- -->
		<div class="form-group">
			<input type="hidden" name="do" value="save">
			<button class="btn btn-primary" type="submit">Save</button>
			<a class="btn btn-default" href="<?php echo $urlAccounts; ?>">Cancel</a>
		</div>
	</form>
</div>
