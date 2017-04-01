<?php
/**
 * Dashboard template.
 *
 * @author: Andrii Birev
 */
defined('BEXEC')or die('No direct access!');
?>
<div id="users_dashboard">
	<div class="header">
		<div class="form-group pull-right">
			<a class="btn btn-info" href="#"><i class="fa fa-plus"></i> Test1</a>
			<a class="btn btn-danger btn-delete disabled" href="#"><i class="fa fa-trash-o"></i> Test2</a>
		</div>

		<h1 class="page-header">Dashboard</h1>
	</div>

	<?php $this->breadcrumbs->draw(); ?>

	<div>
		<?php if(!empty($this->companies)): ?>
			<?php foreach($this->companies as $company): ?>
				<div>
					<div><?php echo htmlspecialchars($company->name); ?></div>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="alert alert-info">Please, create company!</div>
		<?php endif; ?>
	</div>
</div>
