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

		<ul class="nav nav-pills register-nav">
			<li role="presentation"><a href="<?php echo $urlRegister; ?>">Register User</a></li>
			<li role="presentation" class="active"><a href="#>">Register Company</a></li>
		</ul>


		<form class="form-register" method="POST" autocomplete="off">
			<div class="alert alert-info">You are registering a new user and company. After signup, will be owner.<br/>If you already have an account&nbsp;&ndash; please login and create company from user dashboard.</div>

			<div class="form-field form-register-field">
				<label for="inputName" class="sr-only">Name</label>
				<input type="text" name="name" id="inputName" class="form-control" placeholder="Your name" required="" autofocus="" value="" autocomplete="off">
			</div>

			<div class="form-field form-register-field">
				<label for="inputEmail" class="sr-only">Email address</label>
				<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required="" value="" autocomplete="off">
			</div>

			<div class="form-field form-register-field">
				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="" value="" autocomplete="off">
			</div>

			<hr/>

			<div class="form-field form-register-field">
				<label for="inputCompanyName" class="sr-only">Company Name</label>
				<input type="text" name="companyname" id="inputCompanyName" class="form-control" placeholder="Company Name" required="" autofocus="" value="" autocomplete="off">
			</div>

			<div class="form-field form-register-field">
				<label for="inputCurrencies" class="sr-only">Currencies</label>
				<input type="hidden" name="currencies" id="inputCurrencies" class="select2 form-control" placeholder="Currencies" required="" autofocus="" value="" autocomplete="off">
			</div>



			<input type="hidden" name="do" value="register">
			<button class="btn btn-lg btn-primary btn-block" type="submit">Create new user</button>
		</form>

	</div>
</div>
