<?php

/*-------------------------------------------------------------------------- */
/* Air Framework :: Shortcodes
/*-------------------------------------------------------------------------- */

/**
	Alert
**/
function air_alert_shortcode($atts,$content=NULL) {
	extract( shortcode_atts( array(
		'type'	=> 'notice',
	), $atts) );

	if(!in_array($type,array('notice','warning','success','error','info')))
		$type = 'notice';
	$output = '<div class="alert '.$type.'">'.$content.'<a class="alert-close" href="#">×</a></div>';
	return $output;
}
add_shortcode('alert','air_alert_shortcode');

/**
	Accordion
**/
function air_accordion_shortcode($atts,$content=NULL) {
	$output = '<div class="accordion">'.do_shortcode($content).'</div>';
	return $output;
}
add_shortcode('accordion','air_accordion_shortcode');

/**
	Accordion element
**/
function air_acc_shortcode($atts,$content=NULL) {
	extract( shortcode_atts( array(
		'title'	=> 'Title'
	), $atts) );

	global $air_acc_count;
	if(!$air_acc_count) { $air_acc_count = 1; }

	$output  = '<div class="title"><a href="#acc-'.$air_acc_count.'"><i class="icon"></i>'.$title.'</a></div>';
	$output .= '<div id="acc-'.$air_acc_count.'" class="inner">'.do_shortcode($content).'</div>';

	$air_acc_count++;

	return $output;
}
add_shortcode('acc','air_acc_shortcode');

/**
	Button
**/
function air_button_shortcode($atts,$content=NULL) {
	extract( shortcode_atts( array(
		'size'		=> false,
		'style'		=> false,
		'link'		=> '#',
		'target'	=> false
	), $atts) );

	# Set classes
	$classes = 'button';
	if($size) { $classes .= ' '.$size; }
	if($style) { $classes .= ' '.$style; }
	$target = $target?' target="'.$target.'"':'';

	# Button
	$output = '<p><a href="'.$link.'" class="'.$classes.'"'.$target.'>'.$content.'</a></p>';

	return $output;
}
add_shortcode('button','air_button_shortcode');

/**
	Column
**/
function air_column_shortcode($atts,$content=NULL) {
	extract( shortcode_atts( array(
		'size'	=> 'one-third',
		'last'	=> FALSE
	), $atts) );

	$lastclass=$last?' last':'';
	$output='<div class="'.strip_tags($size).$lastclass.'">'.do_shortcode($content).'</div>';
	if($last)
		$output.='<div class="clear"></div>';
	return $output;
}
add_shortcode('column','air_column_shortcode');

/**
	Dropcap
**/
function air_dropcap_shortcode($atts,$content=NULL) {
	$output = '<span class="dropcap">'.strip_tags($content).'</span>';
	return $output;
}
add_shortcode('dropcap','air_dropcap_shortcode');

/**
	Highlight
**/
function air_highlight_shortcode($atts,$content=NULL) {
	$output = '<span class="highlight">'.strip_tags($content).'</span>';
	return $output;
}
add_shortcode('highlight','air_highlight_shortcode');

/**
	HR
**/
function air_hr_shortcode($atts,$content=NULL) {
	$output = '<div class="hr"></div>';
	return $output;
}
add_shortcode('hr','air_hr_shortcode');

/**
	LI
**/
function air_li_shortcode($atts,$content=NULL) {
	$output = '<li>'.$content.'</li>';
	return $output;
}
add_shortcode('li','air_li_shortcode');

/**
	List
**/
function air_list_shortcode($atts,$content=NULL) {
	extract( shortcode_atts( array(
		'type'	=> 'arrow'
	), $atts) );

	$output  = '<ul class="list '.$type.'">';
	$output .= do_shortcode($content);
	$output .= '</ul>';

	return $output;
}
add_shortcode('list','air_list_shortcode');

/**
	Google Maps
**/
function air_googlemap_shortcode($atts,$content=NULL) {
	extract( shortcode_atts( array(
		'id'			=> 'googlemap',
		'latitude'		=> 0,
		'longitude'		=> 0,
		'maptype'		=> 'ROADMAP', // HYBRID, SATELLITE, ROADMAP, TERRAIN
		'width'			=> '425',
		'height'		=> '350',
		'scrollwheel'	=> FALSE,
		'zoom'			=> 10,
		'address'		=> NULL,
		'marker'		=> TRUE,
		'html'			=> '',
		'popup'			=> FALSE,
		'fullwidth'		=> FALSE
	), $atts) );

	global $air_gmaps_loaded;
	$output = '';

	# Google Maps API Script + jQuery plugin
	if(!$air_gmaps_loaded) {
		$output .= '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>'."\n";
		$output .= '<script type="text/javascript" src="'.get_template_directory_uri().'/js/jquery.gmap.min.js"></script>'."\n";
	}

	# Prevent duplicate loading of scripts
	$air_gmaps_loaded = TRUE;

	# Google Map Div
	if(!$fullwidth) {
		$output .= '<div id="'.$id.'" class="google-map" style="width:'.$width.'px; height:'.$height.'px"></div>'."\n";
	} else {
		$output .= '<div id="'.$id.'" class="google-map google-map-full" style="height:'.$height.'px"></div>'."\n";
	}
	

	# Google Map Standard Options
	$opts = array(
		'maptype'		=> "'".$maptype."'",
		'scrollwheel'	=> $scrollwheel?'true':'false',
		'zoom'			=> $zoom
	);

	# Latitude / Longitude
	if($latitude && $longitude) {
		$opts['latitude'] = $latitude;
		$opts['longitude'] = $longitude;
	}

	# Latitude and Longitude Marker
	if(($latitude && $longitude) && $marker) {
		# Set popup
		$popup = $popup?'true':'false';
		# Create marker
		$opts['markers'] = "[
		{
			latitude: '".$latitude."',
			longitude: '".$longitude."',
			html: '".$html."',
			popup: ".$popup.",
		}
	]";
	}

	# Address
	if($address && (!$latitude && $longitude)) { $opts['address'] = "'".$address."'"; }

	# Address Marker
	if(!($latitude || $longitude) && $address && $marker) {
		# Set popup
		$popup = $popup?'true':'false';
		# Create marker
		$opts['markers'] = "[
		{
			address: '".$address."',
			html: '".$html."',
			popup: ".$popup.",
		}
	]";
	}

	# Build Google Map Options
	$options = '';
	foreach($opts as $key=>$value) {
		$options .= "\t".$key.': '.$value.','."\n";
	}

	# Google Map Initialize
	$output .= "
<script type=\"text/javascript\">
jQuery('#".$id."').gMap({
".$options."
});
</script>
";

	return $output;
}
add_shortcode('googlemap','air_googlemap_shortcode');

/**
	Plan
**/
function air_plan_shortcode($atts,$content=NULL) {
	extract( shortcode_atts( array(
		'name'		=> 'Plan Name',
		'link'		=> '#',
		'linkname'	=> 'Sign Up',
		'price'		=> '0',
		'per'		=> false,
		'color'		=> false,
		'featured'	=> false,
	), $atts) );

	$outer_style = ($featured && $color)?' style="border: 1px solid #'.$color.'"':'';
	
	$class = $featured?'plan featured':'plan';
	$per = $per?' <span>/ '.$per.'</span>':'';
	$style = $color?' style="background:#'.$color.';"':'';
	$button = $featured?'button large light':'button';

	$output  = '<div class="'.$class.'"'.$outer_style.'>';
	$output .= '<div class="plan-head"'.$style.'>';
	$output .= '<h3>'.$name.'</h3>';
	$output .= '<div class="price">'.$price.$per.'</div>';
	$output .= '</div>'; // end .plan-head
	$output .= $content;
	$output .= '<div class="signup"><a href="'.$link.'" class="'.$button.'">'.$linkname.'</a></div>';
	$output .= '</div>'; // end .plan

	return $output;
}
add_shortcode('plan','air_plan_shortcode');

/**
	Price Table
**/
function air_price_shortcode($atts,$content=NULL) {
	extract( shortcode_atts( array(
		'col'	=> 'col-4',
	), $atts) );

	$output = '<div class="pricing-table '.$col.' fix">'."\n";
	$output .= do_shortcode($content);
	$output .= '<div class="clear"></div>';
	$output .= '</div>'."\n";

	return $output;
}
add_shortcode('price-table','air_price_shortcode');

/**
	Pullquote
**/
function air_pullquote_shortcode($atts,$content=NULL) {
	extract( shortcode_atts( array(
		'align'	=> 'left',
	), $atts) );

	if(!in_array($align,array('left','right')))
		$align = 'left';
	$output = '<span class="pullquote-'.$align.'">'.strip_tags($content).'</span>';

	return $output;
}
add_shortcode('pullquote','air_pullquote_shortcode');

/**
	Tabs container and links
**/
function air_tabs_shortcode($atts,$content=NULL) {
	extract(shortcode_atts(array(),$atts));

	# Tab count global variable
	global $air_tab_count;
	
	$output  = '<div class="tabs fix">'."\n";
	$output .= '<ul class="tabs-nav fix">'."\n";
	$count = $air_tab_count = 1;
	foreach($atts as $tab) {
		$output.='<li><a href="#tab-'.$count.'">'.$tab.'</a></li>'."\n";
		$count++;
	}
	$output .= '</ul>'."\n";
	$output .= ''."\n";
	$output .= do_shortcode($content);
	$output .= ''."\n";
	$output .= '</div>'."\n";
	
	# Remove wp auto formatting - <br /> tags
	$output = str_replace(array('<br />'),'',$output);
	
	return $output;
}
add_shortcode('tabs','air_tabs_shortcode');

/**
	Tab

**/
function air_tab_shortcode($atts,$content=NULL) {
	extract(shortcode_atts(array(),$atts));
	
	# Tab count global variable
	global $air_tab_count;

	# Tab
	$output  = '<div id="tab-'.$air_tab_count.'" class="tab"><div class="tab-content">';
	$output .= do_shortcode($content);
	$output .= '</div></div>';
	
	# Increment tab count
	$air_tab_count++;

	return $output;
}
add_shortcode('tab','air_tab_shortcode');

/**
	Toggle
**/
function air_toggle_shortcode($atts,$content=NULL) {
	extract( shortcode_atts( array(
		'title'	=>	'Title',
	), $atts) );

	$output  = '<div class="toggle">';
	$output .= '<div class="title"><i class="icon"></i>'.$title.'</div>';
	$output .= '<div class="inner"><div class="content">'.do_shortcode($content).'</div></div>';
	$output .= '</div>';
	return $output;
}
add_shortcode('toggle','air_toggle_shortcode');