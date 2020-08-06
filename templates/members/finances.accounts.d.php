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
	<div class="header d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2 page-header"><?php echo BLang::html('COMPFINANCES_ACCOUNTS_HEADER',['companyname'=>$this->company->name]); ?></h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2 form-group">
				<a class="btn btn-info" href="<?php echo $urlNewAccount; ?>"><i class="fa fa-plus"></i>&nbsp;<?php echo BLang::_('COMPFINANCES_ACCOUNTS_ADDBTN'); ?></a>
				<a class="btn btn-danger btn-delete disabled" href="#"><i class="fa fa-trash-o"></i>&nbsp;<?php echo BLang::_('COMPFINANCES_ACCOUNTS_DELBTN'); ?></a>
			</div>
		</div>
	</div>


<!--
<div class="">

            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                This week
              </button>
            </div>
          </div>
-->



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
							<?php
							$btn_add=$bRouter->generateUrl(
								'finances',
								array('view'=>'opgroupadd', 'company'=>$this->company->id, 'lang'=>BLang::$langcode)).
								'?account='.$account->id.'&template=add'.'&return='.$current_url;
							$btn_mov=$bRouter->generateUrl(
								'finances',
								array('view'=>'opgroupadd', 'company'=>$this->company->id, 'lang'=>BLang::$langcode)).
								'?account='.$account->id.'&template=move'.'&return='.$current_url; ?>
							<div class="btn-group btn-group-xs" role="group" aria-label="...">
								<a href="<?php echo $btn_add; ?>" type="button" class="btn btn-sm btn-info">Add</a>
								<a href="<?php echo $btn_mov; ?>" type="button" class="btn btn-sm btn-info">Move</a>
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
