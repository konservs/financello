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

		<ul class="nav nav-pills register-nav">
			<li role="presentation" class="active"><a href="#">Register User</a></li>
			<li role="presentation"><a href="<?php echo $urlRegisterCompany; ?>">Register Company</a></li>
		</ul>

		<form class="form-register" method="POST" autocomplete="off">
			<div class="alert alert-info">You are registering as a single user. After signup, you could accept invites from other companies or create own.</div>

			<?php foreach($this->errors as $error): ?>
				<div class="alert alert-danger"><?php echo $error; ?></div>
			<?php endforeach; ?>

			<div class="form-field form-register-field">
				<label for="inputName" class="sr-only">Name</label>
				<input type="text" name="name" id="inputName" class="form-control" placeholder="Your name" required="" autofocus="" value="<?php echo $this->name; ?>" autocomplete="off">
			</div>


			<div class="form-field form-register-field">
				<label for="inputEmail" class="sr-only">Email address</label>
				<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required="" value="<?php echo $this->email; ?>" autocomplete="off">
			</div>

			<div class="form-field form-register-field">
				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="" value="<?php echo $this->password; ?>" autocomplete="off">
			</div>

			<input type="hidden" name="do" value="register">
			<button class="btn btn-lg btn-primary btn-block" type="submit">Create new user</button>
		</form>

	</div>
</div>
