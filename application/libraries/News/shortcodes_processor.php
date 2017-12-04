<?php
/**
 * Content processing...
 */

/**
 *
 */
function shortcode_imgblockhorizontal_func($atts,$content=''){
	//Detect user device
	bimport('http.useragent');
	$device=BBrowserUseragent::getDeviceSuffix();
	//Remove all tags. Leave only IMG tags...
	$content=strip_tags($content,'<img>');
	//
	$doc=new DOMDocument('1.0', 'UTF-8');
	$doc->loadHTML('<?xml encoding="UTF-8">' . $content);
	$doc->encoding = 'UTF-8';
	$images=$doc->getElementsByTagName('img');

	$html='<div class="newsgallery newsgallery-horizontal"><div class="bigphotos">';
	$i=0; $j=0;
	foreach($images as $image){
		$j++;//Watchdog
		$src=$image->getAttribute('src');
		$alt=$image->getAttribute('alt');
		$title=$image->getAttribute('title');
		if(empty($title)){
			$title=$alt;
			}
		$src_path=parse_url($src,PHP_URL_PATH);
		$src_arr=explode('.',$src_path);
		//<image path>.<suffix>.<ext>
		if(count($src_arr)<3){
			if($j>10){
				return '<div class="alert alert-error">Error parsing HTML!</div>';
				}
			continue;
			}

		if($device=='.d'){
			//Desktop version.
			if($i<1){
				$src_arr[count($src_arr)-2]='r455x345';
				}else{
				$src_arr[count($src_arr)-2]='r220x162';
				}
			}
		else{
			//Mobile version...
			$src_arr[count($src_arr)-2]='w285';
			}
		$src_path=implode('.',$src_arr);
		$src='//'.BHOSTNAME_MEDIA.$src_path;


		//Increase counter.
		$i++;
		//
		$class='image';
		$class.=' image-'.$i;
		$class.=($i<1)?' image-big':' image-small';
		//
		$html.='<div class="'.$class.'"><div class="wr">';
		$html.='<img src="'.$src.'" alt="'.htmlspecialchars($alt).'" title="'.htmlspecialchars($title).'"/>';
		$html.='</div></div>';

		//
		if($i==1){
			$html.='</div><div class="smallphotos">';
			}
		if($i>5)break;
		}
	$html.='</div>';
	$html.='<div class="clear"></div>';
	$html.='</div>';
	return $html;
	}
/**
 *
 */
function shortcode_imgblock3_func($atts,$content=''){
	//Detect user device
	bimport('http.useragent');
	$device=BBrowserUseragent::getDeviceSuffix();
	//Remove all tags. Leave only IMG tags...
	$content=strip_tags($content,'<img>');
	//
	$doc=new DOMDocument('1.0', 'UTF-8');
	$doc->loadHTML('<?xml encoding="UTF-8">' . $content);
	$doc->encoding = 'UTF-8';
	$images=$doc->getElementsByTagName('img');

	$html='<div class="newsgallery newsgallery-3">';
	$i=0; $j=0;
	foreach($images as $image){
		$j++;//Watchdog
		$src=$image->getAttribute('src');
		$alt=$image->getAttribute('alt');
		$title=$image->getAttribute('title');
		if(empty($title)){
			$title=$alt;
			}
		$src_path=parse_url($src,PHP_URL_PATH);
		$src_arr=explode('.',$src_path);
		//<image path>.<suffix>.<ext>
		if(count($src_arr)<3){
			if($j>10){
				return '<div class="alert alert-error">Error parsing HTML!</div>';
				}
			continue;
			}

		if($device=='.d'){
			//Desktop version.
			$src_arr[count($src_arr)-2]='w225';
			}else{
			//Mobile version...
			$src_arr[count($src_arr)-2]='w285';
			}
		$src_path=implode('.',$src_arr);
		$src='//'.BHOSTNAME_MEDIA.$src_path;
		//Increase counter.
		$i++;
		//
		$class='image';
		$class.=' image-'.$i;
		//
		$html.='<div class="'.$class.'"><div class="wr">';
		$html.='<img src="'.$src.'" alt="'.htmlspecialchars($alt).'" title="'.htmlspecialchars($title).'"/>';
		$html.='</div></div>';
		if($i>3)break;
		}
	$html.='<div class="clear"></div>';
	$html.='</div>';
	return $html;
	}
/**
 *
 */
function shortcode_imgblock2_func($atts,$content=''){
	//Detect user device
	bimport('http.useragent');
	$device=BBrowserUseragent::getDeviceSuffix();
	//Remove all tags. Leave only IMG tags...
	$content=strip_tags($content,'<img>');
	//
	$doc=new DOMDocument('1.0', 'UTF-8');
	$doc->loadHTML('<?xml encoding="UTF-8">' . $content);
	$doc->encoding = 'UTF-8';
	$images=$doc->getElementsByTagName('img');

	$html='<div class="newsgallery newsgallery-2">';
	$i=0; $j=0;
	foreach($images as $image){
		$j++;//Watchdog
		$src=$image->getAttribute('src');
		$alt=$image->getAttribute('alt');
		$title=$image->getAttribute('title');
		if(empty($title)){
			$title=$alt;
			}
		$src_path=parse_url($src,PHP_URL_PATH);
		$src_arr=explode('.',$src_path);
		//<image path>.<suffix>.<ext>
		if(count($src_arr)<3){
			if($j>10){
				return '<div class="alert alert-error">Error parsing HTML!</div>';
				}
			continue;
			}

		if($device=='.d'){
			//Desktop version.
			$src_arr[count($src_arr)-2]='w342';
			}else{
			//Mobile version...
			$src_arr[count($src_arr)-2]='w285';
			}
		$src_path=implode('.',$src_arr);
		$src='//'.BHOSTNAME_MEDIA.$src_path;
		//Increase counter.
		$i++;
		//
		$class='image';
		$class.=' image-'.$i;
		//
		$html.='<div class="'.$class.'"><div class="wr">';
		$html.='<img src="'.$src.'" alt="'.htmlspecialchars($alt).'" title="'.htmlspecialchars($title).'"/>';
		$html.='</div></div>';
		if($i>2)break;
		}
	$html.='<div class="clear"></div>';
	$html.='</div>';
	return $html;
	}
/**
 *
 */
function shortcode_imgblockvertical_func($atts,$content=''){

	}
/**
 *
 */
function shortcode_quote_func($atts,$content=''){
	$content=strip_tags($content);
	$html='<blockquote>';
	if(!empty($atts['title'])){
		$html.='<h2 class="title">'.htmlspecialchars($atts['title']).'</h2>';
		}
	$html.=htmlspecialchars($content);
	if(!empty($atts['footer'])){
		$html.='&nbsp;<i class="footer">'.htmlspecialchars($atts['footer']).'</i>';
		}
	$html.='</blockquote>';
	return $html;
	}

/**
 * [button class="" type="primary" size="default" url="https://konservs.com"]Записки Консерваторов[/button]
 */
function shortcode_button_func($atts,$content=''){
	$content=strip_tags($content);
	//Process classes...
	$classes=array();
	$classes[]='button';
	if(!empty($atts['size'])){
		$classes[]='button-size-'.strtolower($atts['size']);
		}
	if(!empty($atts['type'])){
		$classes[]='button-type-'.strtolower($atts['type']);
		}
	if(!empty($atts['class'])){
		$classes[]=$atts['class'];
		}
	$href='';
	if(!empty($atts['url'])){
		$href=$atts['url'];
		}
	if(!empty($href)){
		$html='<a class="'.implode(' ',$classes).'" href="'.$href.'">';
		$html.=htmlspecialchars($content);
		$html.='</a>';
		}else{
		$html='<span class="'.implode(' ',$classes).'" href="'.$href.'">';
		$html.=htmlspecialchars($content);
		$html.='</span>';
		}
	return $html;
	}

/**
 * [clearfix /]
 */
function shortcode_clearfix_func($atts,$content=''){
	$html='<div class="clear"></div>';
	return $html;
	}


/**
 * [currentdate format="D M j Y"]
 */
function shortcode_currentdate_func($atts,$content=''){
	bimport('cms.datetime');
	$format=isset($atts['format'])?$atts['format']:'d.m.Y';
	$now=new BDateTime();

	$html='<span class="currentdate">';
	switch($format){
		case 'pretty':
			//$html.=htmlspecialchars($now->prettydatetime());
			$html.=htmlspecialchars($now->prettydate());
			break;
		default:
			$html.=htmlspecialchars($now->format($format));
			break;
		}
	$html.='</span>';
	return $html;
	}
/**
 * [br]
 */
function shortcode_br_func($atts,$content=''){
	return '<br/>';
	}

/**
 * [br]
 */
function shortcode_googlemap_func($atts,$content=''){
	$address=isset($atts['addr'])?$atts['addr']:'';
	$randnum=rand(100000,999999);
	$randid='googlemap-'.$randnum;
	bimport('http.useragent');
	$device=BBrowserUseragent::getDeviceSuffix();

	if($device=='.d'){
		$width='695px';
		$height='390px';
		}else{
		$width='100%';
		$height='200px';
		}

	$html='<div id="'.$randid.'" style="width: '.$width.'; height: '.$height.';"></div>';
	$html.=
		'<script>'.PHP_EOL.
		'	var map;'.PHP_EOL.
		'	var address = "'.htmlspecialchars($address).'";'.PHP_EOL.
		'	function initMap_'.$randnum.'() {'.PHP_EOL.
		'		var geocoder = new google.maps.Geocoder();'.PHP_EOL.
		'		map = new google.maps.Map(document.getElementById(\''.$randid.'\'), {'.PHP_EOL.
		'			center: {lat: -34.397, lng: 150.644},'.PHP_EOL.
		'			zoom: 16'.PHP_EOL.
		'			});'.PHP_EOL.
		'		geocoder.geocode({\'address\': address}, function(results, status) {'.PHP_EOL.
		'         if (status === google.maps.GeocoderStatus.OK) {'.PHP_EOL.
		'           map.setCenter(results[0].geometry.location);'.PHP_EOL.
		'           var marker = new google.maps.Marker({'.PHP_EOL.
		'             map: map,'.PHP_EOL.
		'             position: results[0].geometry.location'.PHP_EOL.
		'           });'.PHP_EOL.
		'         } else {'.PHP_EOL.
		'           alert(\'Geocode was not successful for the following reason: \' + status);'.PHP_EOL.
		'         }'.PHP_EOL.
		'       });'.PHP_EOL.
		'      }'.PHP_EOL.
		'</script>';
	$html.='<script src="https://maps.googleapis.com/maps/api/js?key='.GOOGLEAPI_MAPS_KEY.'&callback=initMap_'.$randnum.'" async defer></script>';
	return $html;
	}

/**
 *
 */
function shortcode_panel_func($atts,$content=''){
	$content=strip_tags($content);
	$type='default';
	if(!empty($atts['type'])){
		$type=$atts['type'];
		}
	$html='<div class="panel panel-'.$type.'">';
	if(!empty($atts['header'])){
		$html.='<div class="panel-heading">'.htmlspecialchars($atts['header']).'</div>';
		}
	$html.='<div class="panel-body">'.htmlspecialchars($content).'</div>';
	if(!empty($atts['footer'])){
		$html.='<div class="panel-footer">'.htmlspecialchars($atts['footer']).'</div>';
		}
	$html.='</div>';
	return $html;
	}


/**
 * [module component="news" view="main" heading="Главные новости" heading_ua="Головні новини" /]
 */
function shortcode_module_func($atts,$content=''){
	$content=strip_tags($content);
	if(empty($atts['component'])){
		return '';
		}
	$component=$atts['component'];
	unset($atts['component']);
	//
	$segments=array();
	foreach($atts as $k=>$att){
		$segments[$k]=$att;
		}
	//
	bimport('router');
	$brouter=BRouter::GetInstance();
	$controller=$brouter->component_load($component);
	if(empty($controller)){
		return '';
		}
	$controller->templatename=$brouter->templatename;
	//Running component...
	$output=$controller->run($segments);
	//$c->status=$controller->status;
	//$c->title=$controller->title;
	//$c->meta=$controller->meta;
	//$c->link=$controller->link;
	//$c->js=$controller->js;
	//$c->style=$controller->style;
	//$c->frameworks=$controller->frameworks;
	//$c->breadcrumbs=$controller->breadcrumbs;
	//$c->modified=empty($controller->modified)?NULL:$controller->modified->format('Y-m-d H:i:s');
	//$c->cachecontrol=$controller->cachecontrol;
	//$c->cachetime=$controller->cachetime;
	//$c->locationurl=$controller->locationurl;
	//$c->locationtime=$controller->locationtime;
	return $output;
	}

/**
 * Шорткод 17. Блок сообщения (message)
 * [message title="TITLE" type="info" block="false" showclose="true" class=""]CONTENT[/message]
 */
function shortcode_message_func($atts,$content=''){
	$content=strip_tags($content);
	//Process classes...
	$classes=array();
	$classes[]='message';
	if(!empty($atts['type'])){
		$classes[]='message-type-'.strtolower($atts['type']);
		}
	if(!empty($atts['class'])){
		$classes[]=$atts['class'];
		}
	$html='<div class="'.implode(' ',$classes).'">';
	if((!empty($atts['showclose']))&&(strtolower($atts['showclose'])=='true')){
		$html.='<a href="#" class="close">x</a>';
		}
	if(!empty($atts['title'])){
		$html.='<h3 class="message-heading">'.htmlspecialchars($atts['title']).'</h3>';
		}
	$html.=htmlspecialchars($content);
	$html.='</div>';
	return $html;
	}


/**
 *
 */
function shortcode_dropdown_func($atts,$content=''){
	$content=strip_tags($content);
	$title='Untitled';
	if(!empty($atts['title'])){
		$title=$atts['title'];
		}
	$html='<div class="dropdown">';
	$html.='<div class="title"><span>'.htmlspecialchars($title).'</span><span class="arrow"></span></div>';
	$html.='<div class="items">'.do_shortcode($content).'</div>';
	$html.='</div>';
	return $html;
	}
/**
 *
 */
function shortcode_drop_item_func($atts,$content=''){
	$content=strip_tags($content);

	$url='#';
	if(!empty($atts['url'])){
		$url=$atts['url'];
		}
	$target='';
	if(!empty($atts['target'])){
		$target=$atts['target'];
		}
	$html='<a class="drop_item" href="'.$url.'" target="'.$target.'">'.htmlspecialchars($content).'</a>';
	return $html;
	}

/**
 *
 *[progress type="" striped="true" active="true" class="" height="20px" value="47" /]
 */
function shortcode_progress_func($atts,$content=''){
	$rate='';
	if(!empty($atts['value'])){
		$rate=$atts['value'];
		}
	$classes=array();
	$classes[]='progress-bar';
	if(!empty($atts['type'])){
		$classes[]='progress-bar-'.strtolower($atts['type']);
		}
	if($atts['striped']==true){
		$classes[]='progress-bar-striped';
		}
	if($atts['active']==true){
		$classes[]='active';
		}
	if(!empty($atts['class'])){
		$classes[]=$atts['class'];
		}
	$html='<div class="progress">';
		$html.='<div class="'.implode(' ',$classes).'" role="progressbar" aria-valuenow="'.$rate.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$rate.'%">';
			$html.='<span class="sr-only" >'.$rate.'%</span>';
		$html.='</div>';
	$html.='</div>';
	return $html;
}

/**
 *
 */
function shortcode_spacer_func($atts,$content=''){
	$height='';
	if(!empty($atts['height'])){
		$height=$atts['height'];
		}
	$html='<div style="height: '.$height.'px;"></div>';
	return $html;
}

/**
 *
 */
function shortcode_icon_func($atts,$content=''){
	$color='';
	if(!empty($atts['color'])){
		$color=$atts['color'];
		}
	$size='';
	if(!empty($atts['size'])){
		$size=$atts['size'];
		}
	$name='';
	if(!empty($atts['name'])){
		$name=$atts['name'];
		}
	$class=array();
	if(!empty($atts['class'])){
		$class[]=$atts['class'];
		}
	$html='';
	switch ($atts['type']){
		case 'awesome';
			$html.=' <link rel="stylesheet" href="//'.BHOSTNAME_STATIC.'/fonts/font-awesome/css/font-awesome.css" />';
			$style='style="color: '.$color.'; font-size: '.$size.'px;"';
			$class[]='fa fa-'.$name;
			$html.='<i class="'.implode(' ',$class).'" '.$style.' name="'.$name.'" aria-hidden="true"></i>';
		break;
		case 'poglyad':
			$style='style="color: '.$color.'; font_size='.$size.'px;"';
			$class[]='pg pg-'.$name;
			$html.='<i class="'.implode(' ',$class).'" '.$style.' name="'.$name.'"></i>';
		break;
	}
	return $html;
}
/**
 * 
 */
function shortcode_well_func($atts,$content=''){
	$content=strip_tags($content);
	$class='';
	if(!empty($atts['class'])){
		$class=$atts['class'];
		}
	$style='';
	if(!empty($atts['size'])){
		$style='style="font-size: '.$atts['size'].'px;"';
		}
	$html='<div class="'.$class.'" '.$style.'>'.htmlspecialchars($content).'</div>';
	return $html;
}

/**
 *
 */
function shortcode_banner_func($atts,$content=''){
	$id='';
	if(!empty($atts['id'])){
		$id=$atts['id'];
		}
	$align='';
	if(!empty($atts['align'])){
		$align=$atts['align'];
		}
	bimport('htmlblocks.general');
	$bhb=BHTMLBlocks::getInstance();
	$block=$bhb->blocks_get_block((int)$id);
	if(empty($block)){
		return false;
		}
	$html='<div style="text-align: '.$align.'">'.$block->gethtml().'</div>';
	return $html;
}
/**
 * 
 */
function shortcode_googlefont_func($atts,$content=''){
	$content=strip_tags($content);
	$html='<link href="https://fonts.googleapis.com/css?family='.urlencode($atts['font']).'" rel="stylesheet" type="text/css">';
	$style=array();
	// font-family
	if(!empty($atts['font'])){
		$style[]='font-family: '.$atts['font'].';';
		}
	// font-size
	if(!empty($atts['size'])){
		$style[]='font-size: '.$atts['size'].'px;';
		}
	// color
	if(!empty($atts['color'])){
		$style[]='color: '.$atts['color'].';';
		}
	//	font-weight
	if(!empty($atts['weight'])){
		$style[]='font-weight: '.$atts['weight'].';';
		}
	// align
	if(!empty($atts['align'])){
		$style[]='text-align: '.$atts['align'].';';
		}
	// margin
	if(!empty($atts['margin'])){
		$style[]='margin; '.$atts['margin'].';';
		}
	$html.='<span style="'.implode(' ',$style).'">'.htmlspecialchars($content).'</span>';
	return $html;
}
/**
 * @param $atts
 * @param string $content
 * @return string
 */
function shortcode_dropcap_func($atts,$content=''){
	$content=strip_tags($content);
	$class='';
	if(!empty($atts['class'])){
		$class='class="'.$atts['class'].'"';
		}
	$style=array();
	if(!empty($atts['color'])){
		$style[]='color: '.$atts['color'].';';
		}
	if(!empty($atts['background'])){
		$style[]='background: '.$atts['background'].';';
		}
	$html='<span '.$class.' style="'.implode(' ',$style).'">'.htmlspecialchars($content).'</span>';
	return $html;
}
/**
 * 
 */
function shortcode_divider_func($atts,$content=''){
	$class='';
	if(!empty($atts['class'])){
		$class=$atts['class'];
		}
	$style='';
	if(!empty($atts['margin'])){
		$style='margin: '.$atts['margin'].';';
		}
	$html='<div class="'.$class.'" style="'.$style.'"></div>';
	return $html;
}
/**
 *
 */
function shortcode_list_func($atts,$content=''){
	$content=strip_tags($content);
	$style=array();
	if(!empty($atts['type'])){
		$style[]='list-style-type: '.$atts['type'].';';;
		}
	if(!empty($atts['color'])){
		$style[]='color: '.$atts['color'].'';
		}
	$class='';
	if(!empty($atts['class'])){
		$class=$atts['class'];
	}
	$html='<ul style="'.implode(' ',$style).'" class="'.$class.'">'.do_shortcode($content).'</ul>';
	return $html;
}
/**
 * @param $atts
 * @param string $content
 * @return string
 */
function shortcode_list_item_func($atts,$content=''){
	$content=strip_tags($content);
	$html='<li class="list_item">'.htmlspecialchars($content).'</li>';
	return $html;
}
/**
 *
 */
function shortcode_testimonial_func($atts,$content=''){
	$position='';
	if(!empty($atts['position'])){
		$position=$atts['position'];
		}
	$author='';
	if(!empty($atts['author'])){
		$author=$atts['author'];
		}
	//Background color
	$colorb='';
	if(!empty($atts['colorb'])){
		$colorb=$atts['colorb'];
		}
	//Text color
	$colort='';
	if(!empty($atts['colort'])){
		$colort=$atts['colort'];
		}
	$photo='';
	if(!empty($atts['avatar'])){
		$photo=$atts['avatar'];
		if((strlen($photo)>2)&&(substr($photo,0,7)!='http://')&&(substr($photo,0,8)!='https://')&&(substr($photo,0,4)!='//')){
			bimport('images.single');
			$img = new BImage();
			$img->url = $photo;
			$photo = $img->geturl('r150x150');
			}
		}
	//
	if(empty($photo)){
		$html = '<!doctype html><html><head></head><body>'.$content.'</body></html>';
		$doc = new DOMDocument();
		$doc->loadHTML($html);
		$tags = $doc->getElementsByTagName('img');
		foreach ($tags as $tag) {
			$src = $tag->getAttribute('src');
			$src = str_replace('.w600.jpg','.r150x150.jpg',$src);
			$src = str_replace('.w600.png','.r150x150.png',$src);
			$src = str_replace('.w800.jpg','.r150x150.jpg',$src);
			$src = str_replace('.w800.png','.r150x150.png',$src);
			$photo = $src;
			}
		}
	$style='';
	if($colort){
		$style.='color: '.$colort.';';
		}
	if($colorb){
		$style.='background-color: '.$colorb.';';
		}

	$content = strip_tags($content);
        $content = trim($content);
        $content = nl2br($content);

	$html='<div class="testimonial-block"'.(empty($style)?'':'style="'.$style.'"').'>';
		if($photo!=''){
			$html.='<div class="testimonial-block-avatar">';
				$html.='<img src="'.$photo.'" alt="'.$author.'&nbsp;'.$position.'">';
			$html.='</div>';
			}

		$html.='<div class="testimonial-block-text">'.$content.'</div>';
		$html.='<div class="testimonial-block-info">';
			$html.='<span class="testimonial-block-info-author">'.$author.',</span>&nbsp;';
			$html.='<span class="testimonial-block-info-position">'.$position.'</span>';
		$html.='</div>';
	$html.='</div>';
	return $html;
}
/**
 * 
 */
function shortcode_tooltip_func($atts,$content=''){
	$content=strip_tags($content);
	$html='<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';
	$html.='<script type="text/javascript">$(document).ready(function(){ $(\'[data-toggle="tooltip"]\').tooltip(); });</script>';
	$title='';
	if(!empty($atts['title'])){
		$title=$atts['title'];
	}
	$position='';
	if(!empty($atts['position'])){
		$position=$atts['position'];
		}
	$html.='<span data-toggle="tooltip" data-placement="'.$position.'" title="'.$title.'">'.htmlspecialchars($content).'</span>';
	return $html;
}
/**
 *
 */
function shortcode_modal_func($atts,$content=''){
	$content=strip_tags($content);
	$title='';
	if(!empty($atts['title'])) { $title=$atts['title']; }
	$header='';
	if(!empty($atts['header'])) { $header=strip_tags($atts['header']); }
	$footer='';
	if(!empty($atts['footer'])) { $footer=strip_tags($atts['footer']); }
	$id='';
	if(!empty($atts['id'])){
		$id=$atts['id'];
		}
	$class='';
	if(!empty($atts['class'])){
		$class=$atts['class'];
	}
	$html='<script type="text/javascript">'.
			'$(document).ready(function(){ '.
				'$(".btn-shortcode").click(function(e){  e.preventDefault(); $(\'#ShortcodeModal\').modal().open();  });'.
				'$("#ShortcodeModal .shortcode-close").click(function(){ $("#ShortcodeModal").modal().close(); });'.
			'});'.
			'</script>';

	$html.='<button type="button" class="btn-shortcode '.$class.'">'.$title.'</button>';
	$html.='<div id="ShortcodeModal" class="shortcode-modal" style="display: none;">'.
    			'<div class="shortcode-wrapper">'.
					'<div class="shortcode-header">'.
						'<h2>'.$header.'</h2>'.
					'</div>'.
					'<span class="shortcode-close">X</span>'.
      				'<div class="shortcode-content">'.htmlspecialchars($content).'</div>'.
					'<div class="shortcode-footer">'.$footer.'</div>'.
    			'</div>'.
  			'</div>';
	return $html;
}
/**
 *
 */
function shortcode_social_func($atts,$content=''){
	$mode='';
	if(!empty($atts['mode'])){
		$mode=$atts['mode'];
		}
	$html='<div class="social-shortcode">';
	switch ($mode){
		case 'vk_like':
			$html.='<script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>';
			$html.='<script type="text/javascript">VK.init({apiId: '.SOCIAL_VK_ID.', onlyWidgets: true});</script>';
			$html.='<script type="text/javascript">VK.Widgets.Like("vk_like", {type: "button", height: 24});</script>';
			$html.='<div id="vk_like"></div>';
		break;
		case 'facebook_like':
			$html.='<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.6";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, \'script\', \'facebook-jssdk\'));</script>';
			$html.='<div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>';
		break;
		case 'twitter_sweet':
			$html.='<a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=Hello%20world">Tweet</a>';
		break;
	}
	$html.='</div>';
	return $html;
}
/**
 * @param $atts
 * @param string $content
 * @return string
 */
function shortcode_video_func($atts,$content=''){
	$ratio=(!empty($atts['ratio'])?trim($atts['ratio']):'');
	$id=!empty($atts['id'])?$atts['id']:'';
	bimport('http.useragent');
	$device=BBrowserUseragent::getDeviceSuffix();
	if($device=='.d'){
		if($ratio=='4:3'){
			$width='695px';
			$height='520px';
		}elseif($ratio=='16:9'){
			$width='300px';
			$height='225px';
		}
	}else{
		if($ratio=='4:3'){
			$width='100%';
			$height='330px';
		}elseif($ratio=='16:9'){
			$width='100%';
			$height='170px';
		}
	}
	$type=(!empty($atts['url'])?$atts['url']:'');
	switch ($type){
		case 'youtube':
			$html='<iframe width="'.$width.'" height="'.$height.'" src="https://www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe>';
		break;
		case 'vk':
			$html='<iframe src="//vk.com/video_ext.php?oid=-45960892&id=456241630&hash=997222f1504c621b&hd=2" width="'.$width.'" height="'.$height.'"  frameborder="0"></iframe>';
		break;
		case 'vimeo':
			$html='<iframe src="//player.vimeo.com/video/'.$id.'" width="'.$width.'" height="'.$height.'"  frameborder="0"></iframe>';
		break;
		case 'facebook':
			$html='<iframe src="http://www.facebook.com/video/embed?video_id='.$id.'" width="'.$width.'" height="'.$height.'"  frameborder="0"></iframe>';
		break;
		case 'instagram':
			$html='<iframe src="//player.vimeo.com/video/29474908" width="'.$width.'" height="'.$height.'"  frameborder="0"></iframe>';
		break;
		default:
			$html='<iframe width="'.$width.'" height="'.$height.'" src="https://www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe>';
	}
	return $html;
}
/**
 * @param $atts
 * @param string $content
 * @return string
 */
function shortcode_columns_func($atts,$content=''){
	$content=strip_tags($content);
	$html='<div  class="row">'.do_shortcode($content).'</div>';
	return $html;
}
/**
 * 
 */
function shortcode_column_func($atts,$content=''){
	$content=strip_tags($content);
	$class=(!empty($atts['class'])?$atts['class']:'');
	$tag=(!empty($atts['tag'])?$atts['tag']:'');
	$html='<div  class="col-'.$tag.'-4 '.$class.'">'.do_shortcode($content).'</div>';
	return $html;
}
/**
 *
 */
function shortcode_collapse_func($atts,$content=''){
	$content=strip_tags($content);
	$class=(!empty($atts['class'])?$atts['class']:'');
	$html='<div  class="collapse '.$class.'">'.do_shortcode($content).'</div>';
	return $html;
}
/**
 *
 */
function shortcode_collapse_item_func($atts,$content=''){
	$content=strip_tags($content);
	$title=(!empty($atts['title'])?$atts['title']:'');
	$html='<div class="collapse-heading">'.$title.'</div>';
	$html.='<div  class="collapse-text">'.do_shortcode($content).'</div>';
	return $html;
}
/**
 * @param $atts
 * @param string $content
 * @return string
 */
function shortcode_tabs_func($atts,$content=''){
	$content=strip_tags($content);
	$class=(!empty($atts['class'])?$atts['class']:'');
	$width='';
	if(!empty($atts['width'])){
		$width='width: '.$atts['width'].'px';
		}
	$html=PHP_EOL.'<div  class="tabs '.$class.'">'.PHP_EOL;
	$html.=' <ul class="tabs-nav">'.PHP_EOL;
	$content2=str_replace('[tab','[tab_label',$content);
	$content2=str_replace('[/tab','[/tab_label',$content2);
	$html.=do_shortcode($content2);
	$html.=' </ul><div class="clear"></div> '.PHP_EOL;
	$html.=do_shortcode($content);
	$html.='</div>'.PHP_EOL;
	return $html;
	}
function shortcode_tab_label_func($atts,$content=''){
	$title=(!empty($atts['title'])?$atts['title']:'');
	$html='<li><a href="#">'.htmlspecialchars($title).'</a></li>'.PHP_EOL;
	return $html;
	}
function shortcode_tab_func($atts,$content=''){
	$content=strip_tags($content);
	$html='<div class="tabs-content">'.htmlspecialchars($content).'</div>'.PHP_EOL;
	return $html;
	}
/**
 * @param $atts
 * @param string $content
 * @return string
 */
function shortcode_pricing_func($atts,$content=''){
	$content=strip_tags($content);
	$html='<div class="pricing">'.do_shortcode($content).'<div class="clear"></div></div>';
	return $html;
	}
function shortcode_plan_func($atts,$content=''){
	$content=strip_tags($content);
	$title=(!empty($atts['title'])?$atts['title']:'');
	$price=(!empty($atts['price'])?$atts['price']:'');
	$period=(!empty($atts['per'])?$atts['per']:'');
	$link=(!empty($atts['button_link'])?$atts['button_link']:'');
	$html='<div class="plan">';
		$html.='<div class="plan-title">'.$title.'</div>';
		$html.='<div class="plan-price">'.$price.'&nbsp;грн.</div>';
		$html.='<div class="plan-period">'.$period.'&nbsp;місяць.</div>';
		$html.='<div class="plan-content">'.do_shortcode($content).'</div>';
		$html.='<div class="plan-footer"><a href="'.$link.'">&nbsp;Купити.</a></div>';
	$html.='</div>';
	return $html;
	}
function shortcode_planrow_func($atts,$content=''){
	$content=strip_tags($content);
	$html='<p>'.htmlspecialchars($content).'</p>';
	return $html;
	}
/**
 *
 */
function shortcode_oprettycode_func($atts,$content=''){
	$content=str_replace("\n",'',$content);
	$content=str_replace("\r",'',$content);
	//$content=preg_replace('/\<br(\s*)?\/?\>/i', "\n", $content);
	$content=str_replace('</p>',PHP_EOL,$content);
	$content=preg_replace('#<p(.*?)>(.*?)#', '$2', $content);
	//$content=htmlspecialchars($content);

	$lng=(!empty($atts['lang'])?$atts['lang']:'');
	bimport('geshi.geshi');
	$geshi=new GeSHi($content ,$lng);
	$geshi->set_header_type(GESHI_HEADER_PRE_VALID);
	$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
	$html='<div class="oprettycode">'.$geshi->parse_code().'</div>';
	return $html;
}


function shortcode_carousel_func_mob($atts,$content=''){
	bimport('images.single');
	$content=strip_tags($content,'<img>');
	$doc=new DOMDocument('1.0', 'UTF-8');
	$doc->loadHTML('<?xml encoding="UTF-8">' . $content);
	$doc->encoding = 'UTF-8';
	$images=$doc->getElementsByTagName('img');
	//
	$html='<div class="article-photos">';
	$i=0; $j=0;
	foreach($images as $image){
		$j++;//Watchdog
		$src=$image->getAttribute('src');
		$alt=$image->getAttribute('alt');
		$src_path=parse_url($src,PHP_URL_PATH);
		$src_arr=explode('.',$src_path);
		//<image path>.<suffix>.<ext>
		if(count($src_arr)<3){
			if($j>100){
				return '<div class="alert alert-error">Error parsing HTML!</div>';
				}
			continue;
			}
		unset($src_arr[count($src_arr)-2]);//='h430';
		$src_path=implode('.',$src_arr);
		$img=new BImage();
		$img->url=$src_path;
		//
		$html.='<div class="article-photos-item">';
		$html.=$img->drawimg(array('1x'=>'w300','2x'=>'w600','3x'=>'w900'),$alt);
		$html.='</div>';

		}
	$html.='<div class="clear"></div>';
	$html.='</div>';
	return $html;


	$html.='</div>';
	return $html;
	}
function shortcode_carousel_func_desktop($atts,$content=''){
	$content=strip_tags($content,'<img>');
	$doc=new DOMDocument('1.0', 'UTF-8');
	$doc->loadHTML('<?xml encoding="UTF-8">' . $content);
	$doc->encoding = 'UTF-8';
	$images=$doc->getElementsByTagName('img');
	//
	$html.='<div class="carousel" data-allowfullscreen="true" data-nav="thumbs" data-keyboard="true" data-hash="true" data-loop="true" data-auto="false">';
	$i=0; $j=0;
	foreach($images as $image){
		$j++;//Watchdog
		$src=$image->getAttribute('src');
		$alt=$image->getAttribute('alt');
		$title=$image->getAttribute('title');
		if(empty($title)){
			$title=$alt;
			}
		$src_path=parse_url($src,PHP_URL_PATH);
		$src_arr=explode('.',$src_path);
		//<image path>.<suffix>.<ext>
		if(count($src_arr)<3){
			if($j>100){
				return '<div class="alert alert-error">Error parsing HTML!</div>';
				}
			continue;
			}
		$src_arr[count($src_arr)-2]='w695';
		$src_path=implode('.',$src_arr);
		$src='//'.BHOSTNAME_MEDIA.$src_path;

		$src_arr[count($src_arr)-2]='r130x75';
		$src_path_thumb=implode('.',$src_arr);
		$src_thumb='//'.BHOSTNAME_MEDIA.$src_path;

		$src_arr[count($src_arr)-2]='w1900';
		$src_path_thumb=implode('.',$src_arr);
		$src_full='//'.BHOSTNAME_MEDIA.$src_path;
		//
		$html.='<a href="'.$src.'" data-full="'.$src_full.'">';
		$html.='<img src="'.$src_thumb.'" alt="'.htmlspecialchars($alt).'">';
		$html.='</a>';
		}
	$html.='<div class="clear"></div>';
	$html.='</div>';
	return $html;
	}



function shortcode_carousel_func($atts,$content=''){
	bimport('http.useragent');
	$device=BBrowserUseragent::getDeviceSuffix();
	if($device=='.m'){
		return shortcode_carousel_func_mob($atts,$content);
		}
	return shortcode_carousel_func_desktop($atts,$content);
	}


add_shortcode('imgblockhorizontal','shortcode_imgblockhorizontal_func');
add_shortcode('imgblock3','shortcode_imgblock3_func');
add_shortcode('imgblock2','shortcode_imgblock2_func');
add_shortcode('imgblockvertical','shortcode_imgblockvertical_func');
add_shortcode('quote','shortcode_quote_func');
add_shortcode('button','shortcode_button_func');
add_shortcode('clearfix','shortcode_clearfix_func');
add_shortcode('panel','shortcode_panel_func');
add_shortcode('currentdate','shortcode_currentdate_func');
add_shortcode('br','shortcode_br_func');
add_shortcode('module','shortcode_module_func');
add_shortcode('googlemap','shortcode_googlemap_func');
add_shortcode('message','shortcode_message_func');
add_shortcode('drop_item','shortcode_drop_item_func');
add_shortcode('dropdown','shortcode_dropdown_func');
add_shortcode('progress','shortcode_progress_func');
add_shortcode('spacer','shortcode_spacer_func');
add_shortcode('icon','shortcode_icon_func');
add_shortcode('well','shortcode_well_func');
add_shortcode('banner','shortcode_banner_func');
add_shortcode('googlefont','shortcode_googlefont_func');
add_shortcode('dropcap','shortcode_dropcap_func');
add_shortcode('divider','shortcode_divider_func');
add_shortcode('list_item','shortcode_list_item_func');
add_shortcode('list','shortcode_list_func');
add_shortcode('testimonial','shortcode_testimonial_func');
add_shortcode('tooltip','shortcode_tooltip_func');
add_shortcode('modal','shortcode_modal_func');
add_shortcode('social','shortcode_social_func');
add_shortcode('video','shortcode_video_func');
add_shortcode('columns','shortcode_columns_func');
add_shortcode('column','shortcode_column_func');
add_shortcode('collapse','shortcode_collapse_func');
add_shortcode('collapse_item','shortcode_collapse_item_func');
add_shortcode('tabs','shortcode_tabs_func');
add_shortcode('tab','shortcode_tab_func');
add_shortcode('tab_label','shortcode_tab_label_func');
add_shortcode('pricing','shortcode_pricing_func');
add_shortcode('plan','shortcode_plan_func');
add_shortcode('planrow','shortcode_planrow_func');
add_shortcode('oprettycode','shortcode_oprettycode_func');
add_shortcode('carousel','shortcode_carousel_func');
add_shortcode('imgblockvertical','shortcode_imgblockvertical_func');

