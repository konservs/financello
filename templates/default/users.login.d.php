<?php
/**
 * Login form template
 * 
 * @author Andrii Biriev
 */
defined('BEXEC')or die('No direct access!');
use \Brilliant\cms\BLang;
?>
<div id="users_login">
	<div class="container">
		<form class="form-signin" method="POST">
			<h1 class="form-signin-heading"><?php echo BLang::_('USERS_LOGINP_HEADER');?></h1>

			<?php if(!empty($this->error)): ?>
				<div class = "alert alert-danger block_pad">
				<?php
				switch ($this->error){
					case USERS_ERROR_NOSUCHEMAIL: echo BLang::_("USERS_ERROR_NOSUCHEMAIL"); break;
					case USERS_ERROR_NOACTIVATED: echo BLang::sprintf('USERS_ERROR_NOACTIVATED','#'); break;
					case USERS_ERROR_BANNED:	  echo BLang::_("USERS_ERROR_BANNED"); break;
					case USERS_ERROR_PASS:	  echo BLang::_("USERS_ERROR_PASS"); break;
					}
					?>
				</div>
			<?php endif; ?>

			<label for="inputEmail" class="sr-only"><?php echo BLang::_('USERS_LOGINP_EMAIL'); ?></label>
			<input type="email" name="email" id="inputEmail" class="form-control" placeholder="<?php echo BLang::_('USERS_LOGINP_EMAIL'); ?>" required autofocus value="<?php echo htmlspecialchars($this->email); ?>">

			<label for="inputPassword" class="sr-only"><?php echo BLang::_('USERS_LOGINP_PASSWORD'); ?></label>
			<input type="password" name="password" id="inputPassword" class="form-control" placeholder="<?php echo BLang::_('USERS_LOGINP_PASSWORD'); ?>" required>

			<div class="checkbox"><label><input type="checkbox" value="remember-me"> <?php echo BLang::_('USERS_LOGINP_REMEMBERME'); ?></label></div>

			<input type="hidden" name="do" value="login">
			<input type="hidden" name="token" value="7CGwwpoh1fasJbnIUVpG">

			<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo BLang::_('USERS_LOGINP_SUBMIT'); ?></button>
		</form>
	</div>
</div>
