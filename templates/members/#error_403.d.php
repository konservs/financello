<?php
/**
 * 403 error page template
 * 
 * @author Andrii Biriev
 */
defined('BEXEC')or die('No direct access!');
use Application\BRouter;
use Brilliant\CMS\BLang;
use Brilliant\HTML\BHTML;

$bhtml=BHTML::getInstance();
$bhtml->add_meta('viewport','width=device-width, initial-scale=0.35, maximum-scale=1, user-scalable=yes');
$brouter=BRouter::getInstance();
$bhtml->useFramework('bootstrap');

$bhtml->load_css(dirname(__FILE__).DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.'#error_403.d.css');
?><!DOCTYPE html>
<html>
<head>
	<title><?php echo BLang::_("403_PAGE_NOT_FOUND"); ?></title>
	<link rel=stylesheet href="<?php echo URL_STATIC.'/css/errors.css'; ?>" type="text/css" />
	<?php echo $bhtml->out_head();?>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="error-template">
					<h1>Oops!</h1>
					<h2>403 Access Denied</h2>
					<div class="error-details">Sorry, an error has occured, Requested page not found!</div>
					<div class="error-actions">
						<a href="/" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span> Take Me Home </a>
						<a href="/" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-envelope"></span> Contact Support </a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body></html>
