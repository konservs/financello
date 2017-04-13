<?php
/**
 * Dashboard template.
 *
 * @author: Andrii Birev
 */
defined('BEXEC')or die('No direct access!');
use \Brilliant\CMS\BLang;
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
				<div>
					<a href="<?php echo $bRouter->generateURL('companies',array('view'=>'mycompany','lang'=>BLang::$langcode,'company'=>$company->id)); ?>"><?php echo htmlspecialchars($company->name); ?></a>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="alert alert-info">Please, <a href="<?php echo $urlNewCompany; ?>">create company</a>!</div>
		<?php endif; ?>
	</div>
</div>
