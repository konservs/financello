<?php
/**
 * Tempalte to view currencies list for my company
 *
 * @author: Andrii Birev
 */
defined('BEXEC')or die('No direct access!');
?>
<div id="compfinances_currencies">
	<div class="header">
		<div class="form-group pull-right">
			<a class="btn btn-info" href="#"><i class="fa fa-plus"></i> Test1</a>
			<a class="btn btn-danger btn-delete disabled" href="#"><i class="fa fa-trash-o"></i> Test2</a>
		</div>

		<h1 class="page-header">Currencies of company "<?php echo htmlspecialchars($this->company->name); ?>"</h1>
	</div>

	<?php $this->breadcrumbs->draw(); ?>


	<?php if(!empty($this->currencies)): ?>
		<div class="panel panel-default">
			<div class="panel-heading">Currencies</div>
			<table class="table table-striped">
				<tr>
					<th width="*">Currency</th>
					<th width="1">ID</th>
				</tr>
				<?php foreach($this->currencies as $currency): ?>
					<tr>
						<td><?php echo htmlspecialchars($currency->getCurrencyCode3()); ?></td>
						<td><?php echo $currency->id; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	<?php else: ?>
		Could not load currencies!
	<?php endif; ?>
</div>
