<?php
/**
 * Template for "My company" page.
 *
 * @author: Andrii Birev
 */
defined('BEXEC')or die('No direct access!');
?>
<div id="companies_mycompany">
	<div class="header">
		<div class="form-group pull-right">
			<a class="btn btn-info" href="#"><i class="fa fa-plus"></i> Test1</a>
			<a class="btn btn-danger btn-delete disabled" href="#"><i class="fa fa-trash-o"></i> Test2</a>
		</div>

		<h1 class="page-header"><?php echo htmlspecialchars($this->company->name); ?></h1>
	</div>
	<?php $this->breadcrumbs->draw(); ?>
</div>
