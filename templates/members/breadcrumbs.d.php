<?php
/**
 * Breadcrumbs - list
 * 
 * @author Andrii Biriev
 */
defined('BEXEC')or die('No direct access!');

echo('<nav aria-label="breadcrumb">');
echo('<ol class="breadcrumb">');
foreach($this->elements as $element){
	$icon='';
	if(isset($element->class)&&(substr($element->class,0,3)=='fa-')){
		$icon='<span class="fa '.$element->class.'"></span> ';
		}
	if($element->active){
		echo('<li class="breadcrumb-item"><a href="'.$element->url.'">'.$icon.htmlspecialchars($element->name).'</a></li>');
		}
	else{
		echo('<li class="breadcrumb-item active" aria-current="page">'.$icon.htmlspecialchars($element->name).'</li>');
		}
	}
echo('</ol></nav>');
