<?php
/**
 * Template for redirects.
 *
 * @author: Andrii Birev
 */
defined('BEXEC')or die('No direct access!');
?>
<div id="redirect">
	<div class="container">
		<h2>Redirecting...</h2>
		<p><?php echo BLang::_('REDIRECT_TO')?><a href="<?php echo $this->controller->locationurl; ?>"><?php echo $this->controller->locationurl; ?></a></p>
		<p>Please, wait for <?php echo $this->controller->locationtime; ?> seconds...</p>
	</div>
</div>
