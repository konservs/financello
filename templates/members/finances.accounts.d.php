<?php
/**
 * Template to view accounts list for my company
 *
 * @author: Andrii Birev
 */
defined('BEXEC') or die('No direct access!');
use \Brilliant\CMS\BLang;

$bRouter=\Application\BRouter::getInstance();
$urlNewAccount=$bRouter->generateUrl('finances',array('view'=>'accountadd', 'company'=>$this->company->id, 'lang'=>BLang::$langcode));
?>
<div id="compfinances_accounts">
	<div class="header">
		<div class="form-group pull-right">
			<a class="btn btn-info" href="<?php echo $urlNewAccount; ?>"><i class="fa fa-plus"></i>&nbsp;<?php echo BLang::_('COMPFINANCES_ACCOUNTS_ADDBTN'); ?></a>
			<a class="btn btn-danger btn-delete disabled" href="#"><i class="fa fa-trash-o"></i>&nbsp;<?php echo BLang::_('COMPFINANCES_ACCOUNTS_DELBTN'); ?></a>
		</div>
		<h1 class="page-header"><?php echo BLang::html('COMPFINANCES_ACCOUNTS_HEADER',['companyname'=>$this->company->name]); ?></h1>
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
		<div class="alert alert-warning"><?php echo BLang::__('COMPFINANCES_ACCOUNTS_EMPTYMESSAGE',['companyname'=>$this->company->name, 'addurl'=>$urlNewAccount]); ?></div>
	<?php endif; ?>
</div>
