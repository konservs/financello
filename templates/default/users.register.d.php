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
$urlRegisterCompany = $bRouter->generateURL('users',array('view'=>'register_company','lang'=>BLang::$langcode));
?>
<div id="users_register">
	<div class="container">
		<h2>Registration at Financello</h2>
		<ul class="nav nav-pills">
			<li role="presentation" class="active"><a href="#">Register User</a></li>
			<li role="presentation"><a href="<?php echo $urlRegisterCompany; ?>">Register Company</a></li>
		</ul>

		<p>The Financello is in beta version now. The registration is temporary closed!</p>

	</div>
</div>
