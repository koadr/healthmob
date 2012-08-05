<?php

/**
	Breadcrumbs Module :: Air Framework

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Marée

		@package air_breadcrumbs
		@version 1.0
**/

//! air_breadcrumbs
class air_breadcrumbs extends AirBase {

	//@{ Module variables
	protected static
		//! Option Name
		$option_name = 'air-breadcrumbs',
		//! Option
		$option,
		//! URL
		$url,
		//! Path
		$path;
	//@}

	/**
		Initialize module
			@public
	**/
	static function init() {
		global $pagenow;
		# Get Option
		self::$option = get_option(self::$option_name);
		# Set default option
		if(self::$option == FALSE) { update_option(self::$option_name,''); }
		# Set Path
		self::$path = AIR_PATH.'/modules/breadcrumbs';
		# Set URL
		self::$url = AIR_URL.'/modules/breadcrumbs';
		# Admin init
		add_action('admin_init',__CLASS__.'::admin_init');
	}

	/**
		Get module option
			@return mixed
			@param $key string
			@public
	**/
	static function get_option($key) {
		return isset(self::$option[$key])?self::$option[$key]:FALSE;
	}

	/**
		Admin init
			@public
	**/
	static function admin_init() {
		# Register settings
		register_setting(self::$option_name.'-settings',self::$option_name,__CLASS__.'::validate_settings');

		if(isset($_GET['section']) && ('breadcrumbs'==$_GET['section'])) {
			# Enqueue admin styles and scripts
			add_action('admin_enqueue_scripts',__CLASS__.'::admin_styles_and_scripts');

			# Action to create settings
			add_action('load-'.self::$hook[1],__CLASS__.'::admin_settings');
		}
	}

	/**
		Admin styles and scripts
			@public
	**/
	static function admin_styles_and_scripts($hook) {
		# Only load on theme admin pages
		if(!in_array($hook,self::$hook))
			return;
	}

	/**
		Admin settings
			@public
	**/
	static function admin_settings() {
		# Load settings
		require(self::$path.'/breadcrumbs-settings.php');

		# Create settings
		AirSettings::init(self::$option_name,$setting);
	}

	/**
		Get variable
			@public
	**/
	static function get_var($name=NULL) {
		return isset(self::$$name)?self::$$name:FALSE;
	}

	/**
		Validate settings
			@public
	**/
	static function validate_settings($input) {
		# Get current options
		$valid = get_option(self::$option_name);

		# Enable breadcrumbs
		$valid['breadcrumbs-enable'] = isset($input['breadcrumbs-enable'])?'1':'0';

		# Disable breadcrumbs front page
		$valid['breadcrumbs-disable-front'] = isset($input['breadcrumbs-disable-front'])?'1':'0';
		# Breadcrumbs front page text
		if(isset($input['breadcrumbs-front-text'])) {
			$valid['breadcrumbs-front-text'] = esc_attr($input['breadcrumbs-front-text']);
		}

		# Disable breadcrumbs home page
		$valid['breadcrumbs-disable-home'] = isset($input['breadcrumbs-disable-home'])?'1':'0';
		# Breadcrumbs home page text
		if(isset($input['breadcrumbs-home-text'])) {
			$valid['breadcrumbs-home-text'] = esc_attr($input['breadcrumbs-home-text']);
		}
		
		# Breadcrumbs separator
		if(isset($input['breadcrumbs-separator'])) {
			$valid['breadcrumbs-separator'] = esc_attr($input['breadcrumbs-separator']);
		}
		# Disable breadcrumbs post title
		$valid['breadcrumbs-disable-post-title'] = isset($input['breadcrumbs-disable-post-title'])?'1':'0';

		# Disable on archive pages
		$valid['breadcrumbs-disable-archive'] = isset($input['breadcrumbs-disable-archive'])?'1':'0';

		# Return validated options
		return $valid;
	}

	/**
		Display breadcrumbs
			@public
	**/
	static function display() {
		# Global post variable
		global $post;

		# Static front page
		$static = ('page'===get_option('show_on_front'))?TRUE:FALSE;

		# Set before and after tags
		$before = '<span><i>';
		$after = '</i></span>';

		# Separator
		$sep = self::get_option('breadcrumbs-separator');
		if(!$sep) { $sep = ':' ;}

		# Start breadcrumb
		$output  = '<ul id="breadcrumbs" class="fix">';
		$output .= '<li class="first"><a class="home" href="'.home_url().'">Home</a></li>';

		# Front Page
		if(is_front_page() && $static) {
			# Get breadcrumbs front text option
			$front_text = self::get_option('breadcrumbs-front-text');
			# Set breadcrumbs front text to site name
			if(!$front_text) { $front_text = get_bloginfo('name'); }
			# Front label
			$output .= '<li>'.$before.$front_text.$after.'</li>';
		} elseif(is_front_page()) {
			# Get breadcrumbs home text option
			$front_text = self::get_option('breadcrumbs-home-text');
			# Set breadcrumbs home text to site name
			if(!$front_text) { $front_text = get_bloginfo('name'); }
			# Home label
			$output .= '<li>'.$before.$front_text.$after.'</li>';
		}

		# Home Page (blog when static front page is set)
		if(is_home() && $static) {
			# Get breadcrumbs home text option
			$home_text = self::get_option('breadcrumbs-home-text');
			# Set breadcrumbs home text to page name
			if(!$home_text) {
				$page_id = get_option('page_for_posts');
				$home_text = get_the_title($page_id);
			}
			# Home label
			$output .= '<li>'.$before.$home_text.$after.'</li>';
		}

		# 404
		if(is_404()) {
			$output .= '<li>'.$before .'Error 404'.$after.'</li>';
		}

		# Author
		if(is_author()) {
			global $author;
			$userdata = get_userdata($author);
			$output .= '<li>'.$before.'Author'.$sep.' '.$userdata->display_name.$after.'</li>';
		}

		# Category
		if(is_category()) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$cat = $cat_obj->term_id;
			$cat = get_category($cat);
			if ($cat->parent != 0) {
				$parent_cat = get_category($cat->parent);
				$output .= '<li>'.get_category_parents($parent_cat, TRUE, '</li><li>');
			}
			$output .= '<li>'.$before.'Category'.$sep.' '.single_cat_title('',FALSE).$after.'</li>';
		}

		# Day
		if(is_day()) {
			$output .= '<li><a href="'.get_year_link(get_the_time('Y')).'">'.get_the_time('Y').'</a></li>';
			$output .= '<li><a href="'.get_month_link(get_the_time('Y'),get_the_time('m')).'">'.
				get_the_time('F').'</a></li>';
			$output .= '<li>'.$before.get_the_time('d').$after.'</li>';
		}

		# Month
		if(is_month()) {
			$output .= '<li><a href="'.get_year_link(get_the_time('Y')).'">'.get_the_time('Y').'</a></li>';
			$output .= '<li>'.$before.get_the_time('F').$after.'</li>';
 		}

 		# Page (no parent)
 		if (is_page() && !$post->post_parent && !is_front_page()) {
 			$output .= '<li>'.$before.get_the_title().$after.'</li>';
 		}

 		# Page (with parents)
 		if (is_page() && $post->post_parent && !is_front_page()) {
 			$parent_id  = $post->post_parent;

 			# Loop through pages
 			$crumbs = array();
			while($parent_id) {
				$page = get_page($parent_id);
				$crumbs[] = '<li><a href="'.get_permalink($page->ID).'">'.get_the_title($page->ID).'</a></li>';
				$parent_id  = $page->post_parent;
			}

			# Reverse $crumbs array
			$crumbs = array_reverse($crumbs);

			# Add crumbs to output
			foreach($crumbs as $crumb) { $output .= $crumb; }

			$output .= '<li>'.$before.get_the_title().$after.'</li>';
		}

		# Single
		if (is_single() && !is_attachment()) {
			# Are post titles disable ?
			$disable_post_title = self::get_option('breadcrumbs-disable-post-title');
			$class = $disable_post_title?' class="last"':'';
				
			if('post'==get_post_type()) {
				# Get first post category
				$cat = get_the_category();
				$cat_id = $cat[0]->term_id;

				# Does category have parents?
				if($cat[0]->category_parent > 0) {
					# Get categories
					$cats = substr(get_category_parents($cat_id,TRUE,'|'),0,-1);

					# Turn string of categories into array
					$cats = explode('|',$cats);

					# Remove last category from array
					$last_cat = array_pop($cats);

					# Add categories to output
					foreach($cats as $cat) {
						$output .= '<li>'.$cat.'<li>';
					}

					# Last category
					$output .= '<li'.$class.'>'.$last_cat.'</li>';
				} else {
					$output .= '<li'.$class.'>'.get_category_parents($cat_id, TRUE, '</li><li>');
				}

				# Are post titles enabled ?
				if(!$disable_post_title) {
					$output .= '<li>'.$before.get_the_title().$after.'</li>';
				}
			} else {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				//echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
				//if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
				# Are post titles enabled ?
				if(!$disable_post_title) {
					$output .= '<li>'.$before.get_the_title().$after.'</li>';
				}
			}
		}

 		# Search
		if(is_search()) {
			$output .=  '<li>'.$before.'Search Results'.$after.'</li>';
		}

		# Tagged
		if(is_tag()) {
			$output .= '<li>'.$before.'Tagged'.$sep.' '.single_tag_title('',FALSE).$after.'</li>';
		}
		
		# Year
		if(is_year()) {
			$output .= '<li>'.$before.get_the_time('Y').$after.'</li>';
		}

		# End breadcrumb
		$output .= '</ul>';

		# Return breadcrumb
		return $output;
	}

}