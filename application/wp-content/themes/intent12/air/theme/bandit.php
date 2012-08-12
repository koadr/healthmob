<?php

/**
	Template Functions

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2011 Bandit Media
	Jermaine Marée

		@package bandit
		@version 1.0
**/

//! 
class bandit extends AirBase {

	/**
		Limit Words
			@return string
			@public
	**/
	static function limit_words($str,$limit) {
		$str = strip_tags($str);
		$str = explode(" ", $str);
		return implode(" " ,array_slice($str,0,$limit));
	}

	/**
		Limit Characters
			@return string
			@public
	**/
	static function limit_characters($str,$limit) {
		if(mb_strlen($str) > $limit ) {
			$str = mb_substr($str,0,($limit - 4));
			$words = explode( ' ', $str );
			$cut = - (mb_strlen($words[count($words)-1]));
			$str = ($cut < 0)?mb_substr($str,0,$cut):$str;
			return $str.' ...';
		} else {
			return $str;
		}
	}

	/**
		Site Name
			@return string
			@param $args array
			@public
	**/
	static function get_site_name($args=array()) {
		# Default attributes
		$defaults = array(
			'id'		=> 'logo',
			'tag-home'	=> 'h1',
			'tag'		=> 'p'
		);

		# Parse arguments
		$atts = wp_parse_args($args,$defaults);

		# Set tag
		$tag = (is_front_page() || is_home())?$atts['tag-home']:$atts['tag'];

		# Text or image ?
		if(self::get_option('custom-logo')) {
			$logo = '<img src="'.self::get_option('custom-logo').'" alt="'.get_bloginfo('name').'">';
		} else {
			$logo = get_bloginfo('name');
		}

		# Build link
		$link = '<a href="'.home_url('/').'" rel="home">'.$logo.'</a>';

		# Unset attributes
		unset($atts['tag']);
		unset($atts['tag-home']);
		
		# Set site name
		$sitename = '<'.$tag.self::attributes($atts).'>'.$link.'</'.$tag.'>'."\n";

		# Return site name
		return apply_filters('bandit_site_name', $sitename);
	}
	static function site_name($args=array()) {
		echo self::get_site_name($args);
	}

	/**
		Site description
			@return string
			@param $id string
			@public
	**/
	static function get_site_desc($args=array()) {
		# Is tagline disabled ?
		if(self::get_option('disable-tagline'))
			return FALSE;
		
		# Default attributes
		$defaults = array(
			'id'		=> 'tagline',
		);

		# Parse arguments
		$atts = wp_parse_args($args,$defaults);
		
		# Set site description
		$sitedesc = '<p'.self::attributes($atts).'>'.get_bloginfo('description').'</p>';

		# Return site description
		return apply_filters('bandit_site_desc', $sitedesc);
	}
	static function site_desc($args=array()) {
		echo self::get_site_desc($args);
	}

	/**
		Are breadcrumbs enabled ?
			@public
	**/
	static function breadcrumbs_enabled() {
		# Static front page
		$static = ('page'===get_option('show_on_front'))?TRUE:FALSE;
		# Disabled
		if(air_breadcrumbs::get_option('breadcrumbs-enable'))
			$status = TRUE;
		# Disabled on front page
		if(is_front_page() && $static && air_breadcrumbs::get_option('breadcrumbs-disable-front'))
			$status = FALSE;
		# Disabled on home page
		if(is_home() && air_breadcrumbs::get_option('breadcrumbs-disable-home'))
			$status = FALSE;
		# Disabled on archive pages
		if(is_archive() && air_breadcrumbs::get_option('breadcrumbs-disable-archive'))
			$status = FALSE;
		# Disabled
		return isset($status)?$status:FALSE;
	}

	/**
		Breadcrumbs
			@public
	**/
	static function breadcrumbs() {
		echo air_breadcrumbs::display();
	}

	/**
		Page Title
			@public
	**/
	static function page_title() {
		global $post;

		$heading = get_post_meta($post->ID,'_heading',TRUE);
		$subheading = get_post_meta($post->ID,'_subheading',TRUE);
		$title = $heading?$heading:the_title();
		if($subheading) {
			$title = $title.' <span>'.$subheading.'</span>';
		}

		echo $title;
	}

	/**
		Blog Heading
			@public
	**/
	static function blog_heading() {
		global $post;

		$heading = bandit::get_option('blog-heading');
		$subheading = bandit::get_option('blog-subheading');
		$title = $heading;
		if($subheading) {
			$title = $title.' <span>'.$subheading.'</span>';
		}

		echo $title;
	}

	/**
		Page Featured Image Caption
			@public
	**/
	static function post_thumbnail_caption() {
		global $post;

		$thumbnail_id    = get_post_thumbnail_id($post->ID);
		$thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

		if ($thumbnail_image && isset($thumbnail_image[0])) {
			if($thumbnail_image[0]->post_excerpt) {
				echo '<span class="caption">'.$thumbnail_image[0]->post_excerpt.'</span>';
			}
			if($thumbnail_image[0]->post_content) {
				echo '<span class="description"><i>'.$thumbnail_image[0]->post_content.'</i></span>';
			}
		}
	}

	/**
		Archive heading
			@return string
			@public
	**/
	static function get_archive_heading() {
		// Author archive page
		if(is_author()) {
			if(get_query_var('author_name'))
				$author=get_user_by('login',get_query_var('author_name'));
			else
				$author=get_userdata(get_query_var('author'));
			$heading = __('Author:','intent').' '.$author->display_name;
		}
		// Category archive page
		if(is_category()) {
			$heading = __('Category:','intent').' '.single_cat_title('', false);
		}
		// Daily archive
		if(is_day()) {
			$heading = __('Daily:','intent').get_the_time(' F j, Y');
		}
		// Monthly archive
		if(is_month()) {
			$heading = __('Monthly:','intent').get_the_time(' F Y');
		}
		// Tag archive page
		if(is_tag()) {
			$heading = __('Tagged:','intent').' '.single_tag_title('', false);
		}
		// Yearly archive page
		if(is_year()) {
			$heading = __('Yearly:','intent').get_the_time(' Y');
		}
		return isset($heading)?$heading:'';
	}
	static function archive_heading() { echo self::get_archive_heading(); }

	/**
		Get content format
			@return string
			@public
	**/
	static function get_content_format() {
		# Defaul format
		$content = 'content';

		# Set format based on page
		if(is_home()) { $content = bandit::get_option('post-content-home')?'content':'excerpt'; }
		if(is_archive()) { $content = bandit::get_option('post-content-archive')?'content':'excerpt'; }
		if(is_search()) { $content = bandit::get_option('post-content-search')?'content':'excerpt'; }

		# Return content format
		return $content;
	}

	/**
		Check if category has parents
			@public
	**/
	static function category_has_parent($catid){
		$category = get_category($catid);
		return ($category->category_parent > 0)?TRUE:FALSE;
	}
	/**
		Get images attached to post
			@param $args array
			@public
	**/
	static function get_post_images($args=array()) {
		# Global post variable
		global $post;

		# Default attributes
		$defaults = array(
			'numberposts'		=> -1,
			'order'				=> 'ASC',
			'orderby'			=> 'menu_order',
			'post_mime_type'	=> 'image',
			'post_parent'		=>  $post->ID,
			'post_type'			=> 'attachment',
		);

		# Parse arguments
		$args = wp_parse_args($args,$defaults);

		# Return images
		return get_posts($args);
	}

	/**
		Show post navigation?
			@return boolean
			@public
	**/
	static function show_post_nav() {
		global $wp_query;
		return ($wp_query->max_num_pages > 1);
	}

	/**
		Comments enabled?
			@return boolean
			@public
	**/
	static function comments_enabled() {
		# Get option based on page
		if(is_page())
			$option = self::get_option('comments-pages-disable');
		if(is_single())
			$option = self::get_option('comments-posts-disable');

		# Return option
		return ('1'===$option)?FALSE:TRUE;
	}

	/**
		Get sidebar
			@return string
			@public
	**/
	static function get_sidebar() {
		# Default sidebar
		$sidebar = 'sidebar-main';

		# Set sidebar based on page
		if(is_404() && self::get_option('sidebar-widget-404')) { $sidebar = 'sidebar-404'; }
		if(is_archive() && self::get_option('sidebar-widget-archive')) { $sidebar = 'sidebar-archive'; }
		if(is_page() && self::get_option('sidebar-widget-page')) { $sidebar = 'sidebar-page'; }
		if(is_search() && self::get_option('sidebar-widget-search')) { $sidebar = 'sidebar-search'; }		
		if(is_single() && self::get_option('sidebar-widget-single')) { $sidebar = 'sidebar-single'; }

		# Return sidebar
		return $sidebar;
	}

	/**
		Social Media Links
			@public
	**/
	static function social_media_links($attrs = NULL) {
		# Set attributes
		$attrs = isset($attrs)?self::attributes($attrs):'';

		# Get links
		$links = air_social::get_items();
		if($links) {
			$output = '<ul'.$attrs.'>';

			# Loop through links
			foreach($links as $link) {
				$target = ('1'==$link['new-window'])?' target="_blank"':'';
				$output .= '<li><a href="'.$link['url'].'"'.$target.'><span class="icon"><img src="'.
					$link['icon'].'"></span><span class="icon-title"><i class="icon-pike"></i>'.$link['name'].'</span></a></li>';
			}
			$output .= '</ul>';

			# Print links
			echo $output;
		}
	}

	/**
		Footer text
			@public
	**/
	static function footer_text() {
		# Footer text
		$txt = self::get_option('footer-text');
		# Default text
		if(!$txt) {
			$txt = '&copy; Copyright '.date('Y').' '.get_bloginfo('site_name');
		}
		echo $txt;
	}

	/**
		Resize images dynamically using wp built in functions
		Victor Teixeira

		Example use:
 
		<?php 
		$thumb = get_post_thumbnail_id(); 
		$image = vt_resize( $thumb, '', 140, 110, true );
		?>
		<img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />

		@param int $attach_id
		@param string $img_url
		@param int $width
		@param int $height
		@param bool $crop
		@return array
	**/
	static function vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {
		// this is an attachment, so we have the ID
		if ( $attach_id ) {
			$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
			$file_path = get_attached_file( $attach_id );
		// this is not an attachment, let's use the image url
		} else if ( $img_url ) {
			$file_path = parse_url( $img_url );
			$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
			//$file_path = ltrim( $file_path['path'], '/' );
			//$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];
			$orig_size = getimagesize( $file_path );
			$image_src[0] = $img_url;
			$image_src[1] = $orig_size[0];
			$image_src[2] = $orig_size[1];
		}

		$file_info = pathinfo( $file_path );
		$extension = '.'. $file_info['extension'];

		// the image path without the extension
		$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];
		$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

		// checking if the file size is larger than the target size
		// if it is smaller or the same size, stop right here and return
		if ( $image_src[1] > $width || $image_src[2] > $height ) {
			// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
			if ( file_exists( $cropped_img_path ) ) {
				$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
				$vt_image = array (
					'url' => $cropped_img_url,
					'width' => $width,
					'height' => $height
				);
				return $vt_image;
			}
			// $crop = false
			if ( $crop == false ) {
				// calculate the size proportionaly
				$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
				$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;			
				// checking if the file already exists
				if ( file_exists( $resized_img_path ) ) {
					$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );
					$vt_image = array (
						'url' => $resized_img_url,
						'width' => $proportional_size[0],
						'height' => $proportional_size[1]
					);
					return $vt_image;
				}
			}
			// no cache files - let's finally resize it
			$new_img_path = image_resize( $file_path, $width, $height, $crop );
			$new_img_size = getimagesize( $new_img_path );
			$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );
			// resized output
			$vt_image = array (
				'url' => $new_img,
				'width' => $new_img_size[0],
				'height' => $new_img_size[1]
			);
			return $vt_image;
		}
		// default output - without resizing
		$vt_image = array (
			'url' => $image_src[0],
			'width' => $image_src[1],
			'height' => $image_src[2]
		);
		return $vt_image;
	}

	/**
		Dynamic Image Resizing
			@public
	**/
	static function dynamic_resize($attach_id=null,$img_url=null,$width,$height,$crop=false) {
		// Resize image
		$dynamic_image=self::vt_resize($attach_id,$img_url,$width,$height,$crop);
		// Get upload dir and URL
		$upload_dir=wp_upload_dir();
		$upload_url=$upload_dir['baseurl'];
		// Get image path
		$image=split($upload_url,$dynamic_image['url']);
		// Check if in DB
		global $wpdb;
		$result=$wpdb->get_row("SELECT * FROM bandit_images WHERE image_file = '$image[1]' ", ARRAY_A);
		// If no result, enter into DB
		if(!$result)
			$wpdb->insert('bandit_images',array(
					'post_id'=>$attach_id,
					'image_file'=>$image[1]
				)
			); 
		return $dynamic_image;
	}

	/**
		Get themes from Envato
			@public
	**/
	static function get_themes_from_envato() {
		# Envato details
		$envato_api_url = 'http://marketplace.envato.com/api/v3';
		$envato_api_set = '/collection:1087305.json';

		# Envato results
		$results_from_json = wp_remote_get($envato_api_url.$envato_api_set);
		$results = json_decode($results_from_json['body']);

		# Process results
		if($results->collection) {
			# Define $themes array
			$themes = array();

			# Loop through items
			foreach($results->collection as $key=>$item) {
				# Envato Item Results
				$item_results_from_json = wp_remote_get($envato_api_url.'/item:'.$item->id.'.json');
				$item_results = json_decode($item_results_from_json['body']);

				# Theme ID
				$themes[$key]['id'] = $item->id;
				# Theme Name
				$themes[$key]['name'] = $item->item;
				# Theme URL
				$themes[$key]['url'] = $item_results->item->url.'?ref=wpbandit';
				# Theme Preview
				$themes[$key]['preview'] = $item_results->item->live_preview_url;
				# Theme Rating
				$themes[$key]['rating'] = $item->rating;
			}

			# Randomize order
			shuffle($themes);
		}

		# Return themes
		return isset($themes)?$themes:FALSE;
	}

}