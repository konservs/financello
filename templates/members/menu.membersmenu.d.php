<?php
/**
 * Main menu f users page
 *
 * @author: Andrii Birev
 */
defined('BEXEC')or die('No direct access!');
$this->companiescount=$this->companies;
$brouter=\Application\BRouter::getInstance();
?>
<ul class="nav navbar-nav">
	<li class="active"><a href="#">Your Financello</a></li>
	<li><a href="#">Account</a></li>
	<?php if($this->companiescount>1): ?>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My Companies <span class="caret"></span></a>
			<?php $i=0; ?>
			<ul class="dropdown-menu" role="menu">
			<?php foreach($this->companies as $company): ?>
				<?php if($i>0): ?>
				<li class="divider"></li>
				<?php endif; ?>
					<li class="dropdown-header"><?php echo htmlspecialchars($company->name); ?></li>
					<li><a href="<?php echo $brouter->generateURL('compfinances',array('view'=>'opgroups','company'=>$company->id)); ?>"><?php echo BLang::_('COMPANIES_MYCOMP_OPGROUPS'); ?></a></li>
					<li><a href="<?php echo $brouter->generateURL('compfinances',array('view'=>'accounts','company'=>$company->id)); ?>"><?php echo BLang::_('COMPANIES_MYCOMP_ACCOUTNS'); ?></a></li>
					<!-- <li><a href="#">Another action</a></li>-->
					<!-- <li><a href="#">Something else here</a></li>-->
				<?php $i++; ?>
			<?php endforeach; ?>
			</ul>
		</li>
	<?php elseif($this->companiescount==1): ?>
		<?php foreach($this->companies as $company): ?>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo htmlspecialchars($company->name); ?> <span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="<?php echo $brouter->generateURL('compfinances',array('view'=>'opgroups','company'=>$company->id)); ?>"><?php echo BLang::_('COMPANIES_MYCOMP_OPGROUPS'); ?></a></li>
				<li><a href="<?php echo $brouter->generateURL('compfinances',array('view'=>'accounts','company'=>$company->id)); ?>"><?php echo BLang::_('COMPANIES_MYCOMP_ACCOUTNS'); ?></a></li>
			</ul>
		</li>
		<?php endforeach; ?>
	<?php else: ?>
		<li><a href="#">Add company</a></li>
	<?php endif; ?>

	<li><a href="#">Support center</a></li>
</ul>
