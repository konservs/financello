<?php
/**
 * Dashboard template.
 *
 * @author: Andrii Birev
 */
defined('BEXEC')or die('No direct access!');
use \Brilliant\CMS\BLang;
$this->useFramework('font-awesome');
$bRouter=\Application\BRouter::getInstance();
$urlNewCompany=$bRouter->generateUrl('companies',array('view'=>'newcompany','lang'=>BLang::$langcode));
?>
<div id="users_dashboard">
	<div class="header">
		<div class="form-group pull-right">
			<a class="btn btn-info" href="<?php echo $urlNewCompany; ?>"><i class="fa fa-plus"></i> Create Company</a>
			<a class="btn btn-danger btn-delete disabled" href="#"><i class="fa fa-trash-o"></i> Test2</a>
		</div>

		<h1 class="page-header">Dashboard</h1>
	</div>

	<?php $this->breadcrumbs->draw(); ?>

	<div>
		<?php if(!empty($this->companies)): ?>
			<?php foreach($this->companies as $company): ?>
				<?php $this->company = $company; ?>
				<?php echo $this->templateLoad('company'); ?>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="alert alert-info">Please, <a href="<?php echo $urlNewCompany; ?>">create company</a>!</div>
		<?php endif; ?>
	</div>

	<div>
		<h3>Financello dashboard</h3>
		<p>Welcome to financello system! If you don't have.</p>
	</div>
</div>
