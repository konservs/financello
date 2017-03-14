<?php
/**
 * Users panel template
 *
 * @author: Andrii Birev
 */
defined('BEXEC')or die('No direct access!');
?>
<ul class="nav navbar-nav navbar-right">
	<?php if(empty($this->user)): ?>
		<li><a href="/login"><?php echo BLang::_('USERS_LOGIN'); ?></a></li>
		<li><a href="/register"><?php echo BLang::_('USERS_REGISTER'); ?></a></li>
	<?php else: ?>
		<li><a href="/members"><?php echo htmlspecialchars($this->user->getname(20)); ?></a></li>
		<li><a href="/logout"><?php echo BLang::_('USERS_LOGOUT'); ?></a></li>
	<?php endif; ?>
</ul>
