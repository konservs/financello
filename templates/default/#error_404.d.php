<?php
/**
 * 404 error page template
 * 
 * @author Andrii Biriev
 */
defined('BEXEC')or die('No direct access!');
use Brilliant\cms\BLang;
?><!DOCTYPE html>
<html>
<head>
	<title><?php echo BLang::_("404_PAGE_NOT_FOUND"); ?></title>
	<link rel=stylesheet href="<?php echo '//'.BHOSTNAME_STATIC.'/css/errors.css'; ?>" type="text/css" />
</head>

<body>
	<div class="NotFound">
		<h1>404</h1>
	</div>
</body>
</html>
