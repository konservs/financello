<?php
/**
 * Main template for 
 *
 * @author: Andrii Birev
 */
defined('BEXEC')or die('No direct access!');
use Brilliant\HTTP\BRequest;
use Brilliant\HTML\BHTML;
use Brilliant\CMS\BLang;
use Brilliant\CMS\BBreadcrumbsGeneral;
use Application\BRouter;

$bhtml=BHTML::getInstance();
//if((defined('GOOGLE_ANALYTICS_ID'))&&(GOOGLE_ANALYTICS_ID!='')){
//	bimport('google.analytics');
//	BGoogleAnalytics::Initialize(GOOGLE_ANALYTICS_ID);
//	}
//Add noindex for all pages...
$bhtml->add_meta('robots','NOINDEX, NOFOLLOW');
$bhtml->addCSS(URL_STATIC.'/css/members.css?v=1.0.2');
$bhtml->add_meta('','text/html; charset=utf-8','Content-Type');
$bhtml->add_meta('','IE=edge','X-UA-Compatible');
$bhtml->add_meta('viewport','width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no');
$bhtml->useFramework('bootstrap');
$bhtml->useFramework('jquery');
?><!DOCTYPE html>
<html>
<head>
<?php $bhtml->out_head();?>
</head>
<body lang="<?php echo(BLang::$langcode_web) ?>" itemscope itemtype="http://schema.org/WebPage">
    <main role="main" class="">
	        <!-- TOP navigation bar -->

		<nav class="navbar navbar-inverse navbar-fixed-top  navbar-expand-sm navbar-dark bg-dark">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand navbar-brand-logo" href="/"></a>
					<!-- <a class="navbar-brand" href="/"><?php echo Blang::_("SITE_MY_FINANCELLO"); ?></a> -->
				</div>

				<div id="navbar" class="navbar-collapse collapse">
					{{position:mainmenu}}
					{{position:userpanel}}
				</div><!--/.nav-collapse -->
			</div>
		</nav>

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
					{{position:sidebar}}
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<div id="content">{{position:content}}</div>
				</div>
			</div>
		</div>

    </main>
    <footer class="footer">
      <div class="container">
        <span class="text-muted">Place sticky footer content here.</span>
      </div>
    </footer>


</body>
</html>
