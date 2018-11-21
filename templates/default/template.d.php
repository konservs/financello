<?php
//==============================================================
// Main template for desktop PC
//
// Author: Andrii Birev
//==============================================================
defined('BEXEC')or die('No direct access!');
use Brilliant\HTTP\BRequest;
use Brilliant\HTML\BHTML;
use Brilliant\CMS\BLang;
use Brilliant\CMS\BBreadcrumbsGeneral;
use Application\BRouter;

$printversion=BRequest::GetInt('printversion');
$bhtml=BHTML::getInstance();
$bhtml->add_meta('viewport','width=device-width, initial-scale=0.35, maximum-scale=1, user-scalable=yes');
$brouter=BRouter::getInstance();
//if((defined('GOOGLE_ANALYTICS_ID'))&&(GOOGLE_ANALYTICS_ID!='')){
//	BGoogleAnalytics::Initialize(GOOGLE_ANALYTICS_ID);
//	}
if((defined('DEBUG_SITENOINDEX'))&&(DEBUG_SITENOINDEX)){
	$bhtml->add_meta('robots','NOINDEX, NOFOLLOW');
	}
$bhtml->useFramework('jquery');
$bhtml->addCSS(URL_STATIC.'css/main.css?v=1.5.4');
$bhtml->add_meta('','text/html; charset=utf-8','Content-Type');
$bhtml->add_meta('','IE=edge','X-UA-Compatible');
$bhtml->add_meta('viewport','width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no');
$bhtml->useFramework('bootstrap');
//
$bhtml->add_link(array('rel'=>'apple-touch-icon','sizes'=>'56x56','href'=>URL_STATIC.'favicon/apple-icon-57x57.png'));
$bhtml->add_link(array('rel'=>'apple-touch-icon','sizes'=>'60x60','href'=>URL_STATIC.'favicon/apple-icon-60x60.png'));
$bhtml->add_link(array('rel'=>'apple-touch-icon','sizes'=>'72x72','href'=>URL_STATIC.'favicon/apple-icon-72x72.png'));
$bhtml->add_link(array('rel'=>'apple-touch-icon','sizes'=>'76x76','href'=>URL_STATIC.'favicon/apple-icon-76x76.png'));
$bhtml->add_link(array('rel'=>'apple-touch-icon','sizes'=>'114x114','href'=>URL_STATIC.'favicon/apple-icon-114x114.png'));
$bhtml->add_link(array('rel'=>'apple-touch-icon','sizes'=>'120x120','href'=>URL_STATIC.'favicon/apple-icon-120x120.png'));
$bhtml->add_link(array('rel'=>'apple-touch-icon','sizes'=>'144x144','href'=>URL_STATIC.'favicon/apple-icon-144x144.png'));
$bhtml->add_link(array('rel'=>'apple-touch-icon','sizes'=>'152x152','href'=>URL_STATIC.'favicon/apple-icon-152x152.png'));
$bhtml->add_link(array('rel'=>'apple-touch-icon','sizes'=>'180x180','href'=>URL_STATIC.'favicon/apple-icon-180x180.png'));
$bhtml->add_link(array('rel'=>'icon','type'=>'image/png','sizes'=>'192x192','href'=>URL_STATIC.'favicon/android-icon-192x192.png'));
$bhtml->add_link(array('rel'=>'icon','type'=>'image/png','sizes'=>'32x32','href'=>URL_STATIC.'favicon/favicon-32x32.png'));
$bhtml->add_link(array('rel'=>'icon','type'=>'image/png','sizes'=>'96x96','href'=>URL_STATIC.'favicon/favicon-96x96.png'));
$bhtml->add_link(array('rel'=>'icon','type'=>'image/png','sizes'=>'16x16','href'=>URL_STATIC.'favicon/favicon-16x16.png'));
$bhtml->add_link(array('rel'=>'manifest','href'=>URL_STATIC.'favicon/manifest.json'));
$bhtml->add_meta('msapplication-TileColor','#ffffff');
$bhtml->add_meta('msapplication-TileImage',URL_STATIC.'favicon/ms-icon-144x144.png');
$bhtml->add_meta('theme-color','#ffffff');
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
	<!-- TOP navigation bar -->
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
			<div class="container">
				<div class="navbar-header">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<a class="navbar-brand navbar-brand-logo" href="/"><?php echo Blang::_("SITE_FINANCELLO"); ?></a>
				</div>

				<div class="collapse navbar-collapse" id="navbarsExampleDefault">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active"><a class="nav-link" href="#">Home</a></li>
						<li class="nav-item"><a class="nav-link" href="#">About</a></li>
						<li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
						<li class="nav-item dropdown">
							<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
							<div class="dropdown-menu" aria-labelledby="dropdown01">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
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
