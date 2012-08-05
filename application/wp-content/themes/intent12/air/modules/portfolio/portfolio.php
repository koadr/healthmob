<?php

/**
	Portfolio Module :: Air Framework

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Marée

		@package air_portfolio
		@version 1.0
**/

//! air_login
class air_portfolio extends AirBase {

	//@{ Module variables
	protected static
		//! Option Name
		$option_name = 'air-portfolio',
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
		self::$path = AIR_PATH.'/modules/portfolio';
		# Set URL
		self::$url = AIR_URL.'/modules/portfolio';
		# Admin init
		add_action('admin_init',__CLASS__.'::admin_init');

		# Enable Portfolio
		if(self::get_option('portfolio-enable')) {
			self::init_portfolio();
		}
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

		if(isset($_GET['section']) && ('portfolio'==$_GET['section'])) {
			# Action to create settings
			add_action('load-'.self::$hook[1],__CLASS__.'::admin_settings');
		}
	}

	/**
		Admin settings
			@public
	**/
	static function admin_settings() {
		# Load settings
		require(self::$path.'/portfolio-settings.php');

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

		# Enable portfolio
		$valid['portfolio-enable'] = isset($input['portfolio-enable'])?'1':'0';

		# Rewrite type
		if(isset($input['portfolio-rewrite-type'])) {
			$valid['portfolio-rewrite-type'] = esc_attr($input['portfolio-rewrite-type']);
		}

		# Rewrite taxonomy
		if(isset($input['portfolio-rewrite-taxonomy'])) {
			$valid['portfolio-rewrite-taxonomy'] = esc_attr($input['portfolio-rewrite-taxonomy']);
		}

		# Return validated options
		return $valid;
	}

	/**
		Enable portfolio
			@private
	**/
	private static function init_portfolio() {
		# Get rewrite slugs
		$slug_type = self::get_option('portfolio-rewrite-type');
		$slug_taxonomy = self::get_option('portfolio-rewrite-taxonomy');

		# Set rewrite args
		if(self::$vars['PERMALINKS']) {
			# Taxonomy rewrite
			if($slug_type && $slug_taxonomy) {
				$rewrite_taxonomy = array(
					'slug'		 => $slug_type.'/'.$slug_taxonomy,
					'with_front' => FALSE
				);
			}

			# Post type rewrite
			if($slug_type) {
				$rewrite_type = array(
					'slug' 		 => $slug_type,
					'with_front' => FALSE
				);
			}
		}

		# Register Taxonomy
		register_taxonomy('portfolio_category',array('portfolio'),
			array(
				'hierarchical'	=> TRUE,
				'public'		=> TRUE,
				'rewrite'		=> isset($rewrite_taxonomy)?$rewrite_taxonomy:FALSE
			)
		);

		# Register post type
		register_post_type('portfolio',
			array(
				'labels'		=> array(
					'name'					=> __('Portfolio','air'),
					'add_new'				=> _x('Add New','air'),
					'add_new_item'			=> __('Add New Item','air'),
					'edit_item'				=> __('Edit Item','air'),
					'new_item'				=> __('New Item','air'),
					'all_items'				=> __('Portfolio','air'),
					'view_item'				=> __('View Item','air'),
					'search_items'			=> __('Search Items','air'),
					'not_found'				=> __('No items found','air'),
					'not_found_in_trash'	=> __('No items found in Trash','air'), 
					'parent_item_colon'		=> '',
					'menu_name'				=> 'Portfolio'
				),
				'public'		=> TRUE,
				'has_archive'	=> FALSE,
				'supports'		=> array('title','editor','excerpt','author','thumbnail'),
				'rewrite'		=> isset($rewrite_type)?$rewrite_type:FALSE,
				'menu_position'	=> 20,
				'taxonomies'	=> array('portfolio_category')
			)
		);
	}

	/**
		Get category list
			@public

	**/
	static function get_category_list($sep=', ') {
		global $post;
		$terms = get_the_terms($post->ID,'portfolio_category');
		if($terms) {
			foreach($terms as $term) {
				$cats[] = $term->name;
			}
		}
		return implode($sep,$cats);
	}

	/**
		Get category list
			@public

	**/
	static function get_category_slugs($sep=' ') {
		global $post;
		$terms = get_the_terms($post->ID,'portfolio_category');
		if($terms) {
			foreach($terms as $term) {
				$cats[] = $term->slug;
			}
		}
		return implode($sep,$cats);
	}

	/**
		Isotope Menu
			@public
	**/
	static function isotope_menu($category=FALSE) {
		# Get terms
		if($category) {
			$terms = get_terms('portfolio_category',
				array(
					'child_of' => $category
				)
			);
		} else {
			$terms = get_terms('portfolio_category');
		}
		# Define menu
		$menu = '';
		# Loop through terms
		if($terms) {
			foreach($terms as $term) {
				$menu .= '<li><a href="#" data-filter=".'.$term->slug.'">'.$term->name.'</a></li>';
			}
		}
		# Print menu
		echo $menu;
	}

}