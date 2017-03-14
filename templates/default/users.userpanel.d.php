<?php
/**
 * Users panel template
 *
 * @author: Andrii Birev
 */
defined('BEXEC')or die('No direct access!');
use \Brilliant\cms\BLang;
use \Application\BRouter;
$bRouter = BRouter::getInstance();
?>
<ul class="nav navbar-nav navbar-right">
	<?php if(empty($this->user)): ?>
		<?php $urlLogin = '//'.$bRouter->generateURL('users',BLang::$langcode,array('view'=>'login')); ?>
		<?php $urlRegister = '//'.$bRouter->generateURL('users',BLang::$langcode,array('view'=>'register')); ?>
		<li><a href="<?php echo $urlLogin; ?>"><?php echo BLang::_('USERS_LOGIN'); ?></a></li>
		<li><a href="<?php echo $urlRegister; ?>"><?php echo BLang::_('USERS_REGISTER'); ?></a></li>
	<?php else: ?>
		<?php $urlLogout = '//'.$bRouter->generateURL('users',BLang::$langcode,array('view'=>'logout')); ?>
		<li><a href="<?php echo $urlLogout; ?>"><?php echo htmlspecialchars($this->user->getname(20)); ?></a></li>
		<li><a href="/logout"><?php echo BLang::_('USERS_LOGOUT'); ?></a></li>
	<?php endif; ?>
</ul>
