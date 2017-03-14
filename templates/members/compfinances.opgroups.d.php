<?php
/**
 * Template to view operations groups.
 *
 * @author: Andrii Birev
 */
defined('BEXEC')or die('No direct access!');
$brouter=BRouter::getInstance();
?>
<div id="compfinances_opgroups">
	<div class="header">
		<div class="form-group pull-right">
			<a class="btn btn-info" href="<?php echo $brouter->generateUrl('compfinances',array('view'=>'opgroupadd','lang'=>BLang::$langcode,'company'=>$this->company->id)); ?>"><i class="fa fa-plus"></i> Add operation</a>
			<!-- <a class="btn btn-danger btn-delete disabled" data-toggle="modal" data-target="#confirmDelete"><i class="fa fa-trash-o"></i> Delete</a> -->
		</div>

		<h1 class="page-header">Operations of company "<?php echo htmlspecialchars($this->company->name); ?>"</h1>
	</div>

	<?php $this->breadcrumbs->draw(); ?>


	<!--<div class="filter">
		<select>
			<option>aa</option>
		</select>
	</div>-->

	<?php if(!empty($this->opgroups)): ?>
		<div class="panel panel-default">
			<div class="panel-heading">Operation groups</div>
			<table class="table table-striped">
				<tr>
					<th width="150">Date/Time</th><!-- Date Time -->
					<th width="*">Payee</th><!-- Group name or -->
					<th width="100">Operations</th><!-- count of operations -->
					<th width="100">Currency</th>
					<th width="100">Account</th>
					<th width="150">Actions</th>
					<th width="1">ID</th>
				</tr>
				<?php foreach($this->opgroups as $opgroup): ?>
					<tr>
						<?php $opurl=$brouter->generateUrl('compfinances',array('view'=>'opgroup','lang'=>BLang::$langcode,'company'=>$this->company->id,'id'=>$opgroup->id)); ?>
						<td><a href="<?php echo $opurl; ?>"><?php echo $opgroup->created->prettydatetime(); ?></a></td>
						<td><a href="<?php echo $opurl; ?>"><?php echo htmlspecialchars($opgroup->getname()); ?></a></td>
						<td><?php echo $opgroup->operationscount; ?></td>
						<td><?php echo $opgroup->formatCurrencies(); ?></td>
						<td><?php $accounts=$opgroup->getAccounts(); ?>
							<?php foreach($accounts as $acc): ?>
								<a href="#"><?php echo $acc->getname(); ?></a>
							<?php endforeach; ?>
						</td>
						<td>
							<div class="btn-group btn-group-xs" role="group" aria-label="...">
								<a type="button" class="btn btn-default" href=""><?php echo BLang::_('COMPFINANCES_OPGROUP_EDITBTN'); ?></a>
								<a type="button" class="btn btn-default" href=""><?php echo BLang::_('COMPFINANCES_OPGROUP_DELETEBTN'); ?></a>
							</div>
						</td>
						<td><?php echo $opgroup->id; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	<?php else: ?>
		Could not load operation groups!
	<?php endif; ?>
</div>
