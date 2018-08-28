<?php
/**
 * Template for single operation in group.
 *
 * @author: Andrii Birev
 */
defined('BEXEC')or die('No direct access!');
use \Brilliant\CMS\BLang;

$fields=array();
if(empty($this->operation)){
	$fields['amount']=0;
	$fields['peritem']='';
	}
else{
	$fields['amount']=$this->operation->amountformat();
	$fields['peritem']=$this->operation->peritem;
	}
$idpref='operation-'.$this->index.'-';
?>
<div id="opgroupexample" class="panel panel-default opgoperation"<?php echo(empty($this->operation)?' style="display: none;"':''); ?>>
	<div class="panel-heading">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h3 class="panel-title">Operation</h3>
   	</div>
	<div class="panel-body row">
		<div class="col-lg-3 col-md-12 col-sm-12 opgname form-group">
			<label class="sr-only" for="<?php echo $idpref.'payee'; ?>">Payee</label>
			<input type="hidden" id="<?php echo $idpref.'payee'; ?>" class="form-control input-sm select2 payees" name="opgroup_name" placeholder="Payee" value="<?php echo $this->operation->payee; ?>"/>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-4 opgname form-group">
			<label class="sr-only" for="opgroup_name">Account</label>
			<select type="text" id="opgroup_name" class="form-control input-sm" name="opgroup_account" placeholder="Account">
				<option value=""><?php echo BLang::_('COMPFINANCES_ACCOUNT_PLEASESELECT'); ?></option>
				<?php foreach($this->accounts as $acc): ?>
					<option value="<?php echo $acc->id; ?>"<?php echo($this->operation->account==$acc->id?' selected':''); ?>><?php echo htmlspecialchars($acc->name); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-4 opgname form-group">
			<label class="sr-only" for="opgroup_name">Category</label>
			<select type="text" id="opgroup_name" class="form-control input-sm" name="opgroup_category" placeholder="Category">
				<option value=""><?php echo BLang::_('COMPFINANCES_CATEGORY_PLEASESELECT'); ?></option>
				<?php foreach($this->categories as $cat): ?>
					<option value="<?php echo $cat->id; ?>"<?php echo($this->operation->category==$cat->id?' selected':''); ?>><?php echo htmlspecialchars($cat->getnamelevel()); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-4 opgname form-group">
			<label class="sr-only" for="opgroup_name">Project</label>
			<select type="text" id="opgroup_name" class="form-control input-sm" name="opgroup_project" placeholder="Project">
				<option value=""><?php echo BLang::_('PROJECTS_PROJECT_PLEASESELECT'); ?></option>
				<?php foreach($this->projects as $project): ?>
					<option value="<?php echo $project->id; ?>"><?php echo htmlspecialchars($project->getnamelevel()); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 opgname form-group">
			<label class="sr-only" for="opgroup_name">Per item</label>
			<div class="input-group">
				<div class="input-group-btn">
					<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-minus"></span>&nbsp;<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="#">+</a></li>
						<li><a href="#">-</a></li>
					</ul>
				</div><!-- /btn-group -->
				<input type="text" id="opgroup_name" class="form-control input-sm" name="opgroup_name" placeholder="Per item" value="<?php echo $fields['peritem']; ?>"/>
				<span class="input-group-addon">грн.</span>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 opgname form-group">
			<div class="input-group">
				<label class="sr-only" for="opgroup_name">Items</label>
				<input type="text" id="opgroup_name" class="form-control input-sm" name="opgroup_name" placeholder="Items" value="<?php echo(empty($this->operation)?1:$this->operation->items); ?>"/>
				<div class="input-group-btn">
					<button type="button" class="btn btn-default btn-sm input-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">шт.<span class="caret"></span></button>
					<ul class="dropdown-menu dropdown-menu-right" role="menu">
						<li><a href="#">шт.</a></li>
						<li><a href="#">кг.</a></li>
						<li class="divider"></li>
						<li><a href="#">м</a></li>
						<li><a href="#">м<sup>2</sup></a></li>
						<li><a href="#">м<sup>3</sup></a></li>
					</ul>
				</div><!-- /btn-group -->
			</div><!-- /input-group -->
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 opgname form-group">
			<label class="sr-only" for="opgroup_name">Amount</label>
			<input type="text" id="opgroup_name" class="form-control input-sm" name="opgroup_name" placeholder="Amount"/>
		</div>
	</div><!-- /panel-body -->
</div><!-- /opgoperation -->
