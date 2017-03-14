<?php
/**
 * Template to add operations groups for my company.
 *
 * @author: Andrii Birev
 */
defined('BEXEC')or die('No direct access!');
$js='';
$js.='window.accounts=[]';

$js='';
$js.='window.languages={};'.PHP_EOL;
$js.='window.languages.SELECT2_PAYEE_PLACEHOLDER="Payee";';
$js.='window.urls={};'.PHP_EOL;
$js.='window.urls.select2payeefilter="/members/mycompany-1/payees/filter.json";';
//
$this->add_js('',$js);
//
$this->add_js('/static/libs/select2/select2.min.js','',JS_PRIORITY_FRAMEWORK2);
$this->add_js('/static/libs/select2/select2_locale_ru.js');
$this->add_css('/static/libs/select2/select2.css');
$this->add_css('/static/libs/select2/select2-bootstrap.css');
//
$this->load_js(dirname(__FILE__).DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'compfinances.opgroup.d.js');
$this->load_js(dirname(__FILE__).DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'select2.payees.js');
?>
<div id="compfinances_opgroupadd">
	<form role="form" method="POST" id="compfinances_opgroupadd_form">
		<div class="header">
			<div class="form-group pull-right">
				<button type="submit" form="compfinances_opgroupadd_form" class="btn btn-info"><i class="fa fa-plus"></i> Save</button>
				<a class="btn btn-danger btn-delete disabled" href="#"><i class="fa fa-trash-o"></i> Cancel</a>
			</div>
			<h1 class="page-header"><?php echo htmlspecialchars(empty($this->opgroup->name)?'New operation':$this->opgroup->name); ?></h1>
		</div>

		<?php $this->breadcrumbs->draw(); ?>

		<div class="opgheader row">
			<div class="col-sm-8 opgname form-group">
				<label class="sr-only" for="opgroup_name">Operation group name</label>
				<input type="text" id="opgroup_name" class="form-control" name="opgroup_name" placeholder="Operation group name" value="<?php echo htmlspecialchars(empty($this->opgroup->name)?'':$this->opgroup->name); ?>"/>
			</div>
			<div class="col-sm-4">
				<label class="sr-only" for="opgroup_dt">Date/Time</label>
				<input type="text" id="opgroup_dt" class="form-control" name="opgroup_dt" placeholder="Date/Time"/>
			</div>
		</div>

		<?php $this->index=0; ?>
		<div id="opgoperations">
			<?php foreach($this->opgroup->operations as $operation): ?>
				<?php $this->operation=$operation; ?>
				<?php echo $this->template_load('operation'); ?>
				<?php $this->index++; ?>
			<?php endforeach; ?>
		</div>
		<div id="opgactions">
			<button type="button" class="btn btn-default" id="opgaddbutton">Add operation</button>
			<button type="submit" form="compfinances_opgroupadd_form" class="btn btn-info"><i class="fa fa-plus"></i> Save</button>
			<a class="btn btn-danger btn-delete disabled" href="#"><i class="fa fa-trash-o"></i> Cancel</a>
		</div>
	</form>

	<?php $this->operation=NULL; ?>
	<?php echo $this->template_load('operation'); ?>
</div>
