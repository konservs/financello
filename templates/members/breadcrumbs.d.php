<?php
defined('BEXEC')or die('No direct access!');

echo('<ol class="breadcrumb">');
foreach($this->elements as $element){
	$icon='';
	if(isset($element->class)&&(substr($element->class,0,3)=='fa-')){
		$icon='<span class="fa '.$element->class.'"></span> ';
		}
	if($element->active){
		echo('<li><a href="'.$element->url.'">'.$icon.htmlspecialchars($element->name).'</a></li>');
		}
	else{
		echo('<li class="active">'.$icon.htmlspecialchars($element->name).'</li>');
		}
	}
echo('</ol>');
