<?php
/**
 * Left menu template
 *
 * @author: Andrii Birev
 */
defined('BEXEC')or die('No direct access!');
?>

<ul class="nav nav-sidebar">
	<?php foreach($this->companies as $company): ?>
		<li><a href="<?php echo('/members/mycompany-'.$company->id.'/'); ?>"><?php echo htmlspecialchars($company->name); ?></a></li>
		<li><a href="<?php echo('/members/mycompany-'.$company->id.'/accounts/'); ?>">&gt;&gt;&nbsp;<?php echo BLang::_('COMPANIES_MYCOMP_ACCOUTNS'); ?></a></li>
		<li><a href="<?php echo('/members/mycompany-'.$company->id.'/opgroups/'); ?>">&gt;&gt;&nbsp;<?php echo BLang::_('COMPANIES_MYCOMP_OPGROUPS'); ?></a></li>

		<li><a href="<?php echo('/members/mycompany-'.$company->id.'/projects/'); ?>">&gt;&gt;&nbsp;<?php echo BLang::_('COMPANIES_MYCOMP_PROJECTS'); ?></a></li>

		<!--<li><a href="<?php echo('/members/mycompany-'.$company->id.'/opgroups/'); ?>"><?php echo BLang::_('COMPANIES_MYCOMP_OPGROUPS'); ?></a></li>-->
		<li class="divider"><hr/></li>
	<?php endforeach; ?>
	<li><a href="#">Add company</a></li>
</ul>
