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

$col_left=($this->countcomponents('leftcolumn')>0);
$col_right=($this->countcomponents('rightcolumn')>0);
$clspref='';
if($col_left)
	$clspref.='l';
if($col_right)
	$clspref.='r';
$clspref.='c-';
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
	<div id="before-head">
		<div class="wrapper">
			<div class="lang">{{position:headlang}}</div>
			<div class="vers">{{position:switchversion}}</div>
			<div class="user">{{position:userpanel}}</div>
			{{position:headmenu}}
			<div class="clear"></div>
		</div>
	</div>
	<div id="head">
		<div id="headw" class="wrapperx">
			<a class="logo" href="<?php echo $url_main; ?>">HOME</a>
			<div class="clear"></div>
		</div>
	</div>
	<div id="menusbar">
	<?php if($this->countcomponents('mainmenu')>0): ?>
		<div class="redmenu">
			<div class="wrapper wrapperx">
				<div class="wrapper redwrapper">
					<div class="redmenuinner">{{position:mainmenu}}</div>
					<div class="redmenusearch">{{position:newssearch}}</div>
					<div class="redmenubutton">{{position:addbutton}}</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
	</div>

<div class="wrapperx" id="mainwrapper">
{{position:beforeall}}
<div id="position-breadcrumbs">
{{position:beforebreadcrumbs}}
<?php BBreadcrumbsGeneral::staticdraw(); ?>
<div class="clear"></div>
</div>
<?php
if($col_left){
	echo('<div class="leftcolumn '.$clspref.'leftcolumn">{{position:leftcolumn}}</div>');
	}
?>
<div class="content <?php echo($clspref); ?>content">
	{{position:beforecontent}}
	{{position:content}}
	{{position:aftercontent}}
</div>
<?php
if($col_right){
	echo('<div class="rightcolumn '.$clspref.'rightcolumn">{{position:rightcolumn}}</div>');
	}
?>
<a href="#top" id="gotop" class="pg pg-gotop"></a>
<div style="clear:both"></div>
{{position:afterall}}
</div>
<div class="push"></div>
</div>

<div id="footer">
	<?php $now = new DateTime(); ?>
	<a class="logo" href="<?php echo $url_main; ?>">
		<span class="copy">©&nbsp;2003&nbsp;&ndash; <?php echo $now->format("Y"); ?></span>
	</a>
</div>
<?php echo $bhtml->afterbody; ?>
</body></html>

