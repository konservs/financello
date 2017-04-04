<?php
/**
 * Tempalte to view accounts list for my company
 *
 * @author: Andrii Birev
 */
defined('BEXEC') or die('No direct access!');
?>
<div id="compfinances_accounts">
	<div class="header">
		<div class="form-group pull-right">
			<a class="btn btn-info" href="#"><i class="fa fa-plus"></i> Test1</a>
			<a class="btn btn-danger btn-delete disabled" href="#"><i class="fa fa-trash-o"></i> Test2</a>
		</div>

		<h1 class="page-header">Accounts of company "<?php echo htmlspecialchars($this->company->name); ?>"</h1>
	</div>

	<?php $this->breadcrumbs->draw(); ?>


	<?php if (!empty($this->accounts)): ?>
		<div class="panel panel-default">
			<div class="panel-heading">Finance accounts</div>
			<table class="table table-striped">
				<tr>
					<th width="*">Account</th>
					<th width="100">Balance</th>
					<th width="100">Currency</th>
					<th width="150">Actions</th>
					<th width="1">ID</th>
				</tr>
				<?php foreach ($this->accounts as $account): ?>
					<tr>
						<td><?php echo htmlspecialchars($account->name); ?></td>
						<td><?php echo htmlspecialchars($account->formatBalance()); ?></td>
						<td><?php echo htmlspecialchars($account->getCurrencyCode3()); ?></td>
						<td>
							<div class="btn-group btn-group-xs" role="group" aria-label="...">
								<a type="button" class="btn btn-default">Add</a>
								<a type="button" class="btn btn-default">Move</a>
							</div>
						</td>
						<td><?php echo $account->id; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	<?php else: ?>
		Could not load accounts!
	<?php endif; ?>
</div>
