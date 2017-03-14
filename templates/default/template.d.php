<?php
//==============================================================
// Main template for desktop PC
//
// Author: Andrii Birev
//==============================================================
defined('BEXEC')or die('No direct access!');
use Brilliant\http\BRequest;
use Brilliant\html\BHTML;
use Brilliant\cms\BLang;
use Brilliant\cms\BBreadcrumbsGeneral;
use Application\BRouter;

$printversion=BRequest::GetInt('printversion');
$bhtml=BHTML::getInstance();
$bhtml->add_meta('viewport','width=device-width, initial-scale=0.35, maximum-scale=1, user-scalable=yes');
$brouter=BRouter::getInstance();
if((defined('GOOGLE_ANALYTICS_ID'))&&(GOOGLE_ANALYTICS_ID!='')){
	bimport('google.analytics');
	BGoogleAnalytics::Initialize(GOOGLE_ANALYTICS_ID);
	}
if((defined('DEBUG_SITENOINDEX'))&&(DEBUG_SITENOINDEX)){
	$bhtml->add_meta('robots','NOINDEX, NOFOLLOW');
	}
$bhtml->use_framework('jquery');
$bhtml->add_css('//'.BHOSTNAME_STATIC.'/css/main.css?v=1.5.4');
$bhtml->add_meta('','text/html; charset=utf-8','Content-Type');
$bhtml->add_meta('','IE=edge','X-UA-Compatible');
$bhtml->add_meta('viewport','width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no');
$bhtml->use_framework('bootstrap');
?><!DOCTYPE html>
<html<?php echo($printversion?' class="printversion"':''); ?>>
	<head>
		<?php $bhtml->out_head();?>
		<?php if($printversion): ?>
			<script>
				window.print();
			</script>
		<?php endif; ?>
	</head>
<body lang="<?php echo(BLang::$langcode_web) ?>" itemscope itemtype="http://schema.org/WebPage">
<div id="footer-pusher">
	<div id="footer-pusher">
	        <!-- TOP navigation bar -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand navbar-brand-logo" href="/"><?php echo Blang::_("SITE_FINANCELLO"); ?></a>
				</div>

				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Contact</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li class="dropdown-header">Nav header</li>
								<li><a href="#">Separated link</a></li>
								<li><a href="#">One more separated link</a></li>
							</ul>
						</li>
					</ul>
					{{position:userpanel}}
				</div><!--/.nav-collapse -->
			</div>
		</nav>

		<div id="content">{{position:content}}</div>

		<div class="push"></div>
	</div>

	<footer id="footer">
		<div class="container">
			<hr>
			<a class="logo" href="<?php echo $url_main; ?>"><span><?php echo Blang::_("SITE_FINANCELLO"); ?></span></a>
    		</div> <!-- /container -->
	</footer>
	<?php echo $bhtml->afterbody; ?>
</body></html>
