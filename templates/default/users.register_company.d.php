<?php
/**
 * Register form template
 * 
 * @author Andrii Biriev
 */
defined('BEXEC')or die('No direct access!');
use Application\BRouter;
use Brilliant\CMS\BLang;
$bRouter = BRouter::getInstance();
$urlRegister = $bRouter->generateURL('users',array('view'=>'register','lang'=>BLang::$langcode));
?>
<div id="users_register">
	<div class="container">
		<h2>Company Registration</h2>
		<ul class="nav nav-pills">
			<li role="presentation"><a href="<?php echo $urlRegister; ?>">Register User</a></li>
			<li role="presentation" class="active"><a href="#>">Register Company</a></li>
		</ul>

		<p>The Financello is in beta version now. The registration is temporary closed!</p>

	</div>
</div>
