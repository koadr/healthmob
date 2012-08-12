<?php

/**
	Air Framework

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Maree

		@package Air
		@version 1.0
**/

class AirBase {

	//@{ Framework details
	const
		TEXT_Name = 'Air Framework',
		TEXT_Version = '1.0';
	//@}
		
	//@{ Global variables
	protected static
		//! Global variables
		$vars,
		//! Theme configuration
		$config,
		//! Admin menu slug
		$menu_slug,
		//! Theme option name
		$option_name,
		//! Theme options
		$option,
		//! Admin page hook
		$hook;
	//@}

	/**
		Compiles an array of HTML attributes into an attribute string
			@return string
			@param $attrs array
			@protected
	**/
	static function attributes(array $attrs) {
		if(!empty($attrs)) {
			$result = '';
			foreach($attrs as $key=>$val)
				$result .= ' '.$key.'="'.$val.'"';
			return $result;
		}
	}

	/**
		Get theme option
			@return mixed
			@param $key string
			@public
	**/
	static function get_option($key) {
		return isset(self::$option[$key])?self::$option[$key]:FALSE;
	}

	/**
		Get configuration option
			@param $key string
			@protected
	**/
	protected static function get_config($key) {
		return isset(self::$config[$key])?self::$config[$key]:FALSE;
	}

}

class Air extends AirBase {

	/**
		Initialize framework
			@public
	**/
	static function init() {
		# Check if framework has been initialized
		if(defined('AIR_PATH'))
			return;

		# Define constants
		define('AIR_PATH',get_template_directory().'/air');
		define('AIR_URL',get_template_directory_uri().'/air');

		# Global $pagenow variable
		global $pagenow;
		# Permalinks
		$permalinks = get_option('permalink_structure');

		# Hydrate framework variables
		self::$vars = array(
			# Global $pagenow variable
			'PAGENOW' => $pagenow,
			# Permalinks
			'PERMALINKS' => ($permalinks && ($permalinks != ''))?TRUE:FALSE,
		);

		# Load theme configuration
		global $airconfig;
		self::$config = $airconfig;
		unset($airconfig);

		# Set option name
		self::$option_name = self::get_config('theme_options')?self::$config['theme_options']:'air-options';

		# Load theme options
		if(self::get_config('theme_options')) {
			self::$option = get_option(self::$config['theme_options']);
		}

		# Load configuration library
		if(is_file(AIR_PATH.'/inc/air-config.php')) {
			require(AIR_PATH.'/inc/air-config.php');
		}

		# Load theme library
		if(is_file(AIR_PATH.'/air-theme.php')) {
			require(AIR_PATH.'/air-theme.php');
		}

		# Admin
		if(is_admin()) {
			# Admin init
			add_action('admin_init',__CLASS__.'::admin_init');
			# Admin menu
			add_action('admin_menu',__CLASS__.'::admin_menu');
			# Admin notices
			add_action('admin_notices',__CLASS__.'::admin_notices');
		}

		# Initialize modules
		self::modules_init();

		# Custom fields
		if(is_admin()) { self::custom_fields(); }
		
		# Set content width
		global $content_width;
		if(!isset($content_width) && isset(self::$config['content_width'])) {
			$content_width = self::get_config('content_width');
		}

		# Register nav menus
		self::register_nav_menus();
		
		# Register sidebars
		self::register_sidebars();

		# Load theme's translated strings
		add_action('after_setup_theme',__CLASS__.'::text_domain');

		# Theme features
		add_action('after_setup_theme',__CLASS__.'::theme_features');

		# Register scripts
		add_action('wp_enqueue_scripts',__CLASS__.'::register_scripts');

		# Head and footer actions
		add_action('wp_head',__CLASS__.'::wp_head');
		add_action('wp_footer',__CLASS__.'::wp_footer');

		# Theme initialization
		if(method_exists('AirTheme','init')) {
			AirTheme::init();
		}

		# Filters
		if(is_file(AIR_PATH.'/inc/air-filters.php')) {
			require(AIR_PATH.'/inc/air-filters.php');
		}

		# Shortcodes
		if(is_file(AIR_PATH.'/inc/air-shortcodes.php')) {
			require(AIR_PATH.'/inc/air-shortcodes.php');
		}

		# Custom Functions
		if(is_file(get_template_directory().'/functions-custom.php')) {
			require(get_template_directory().'/functions-custom.php');
		}
	}

	/**
		Admin init
			@public
	**/
	static function admin_init() {
		# Set page hooks
		self::$hook = array();
		self::$hook[] = get_plugin_page_hook('theme-options','admin.php');
		self::$hook[] = get_plugin_page_hook('theme-modules','admin.php');
		self::$hook[] = get_plugin_page_hook('wpbandit-themes','admin.php');

		# Load validation library
		require(AIR_PATH.'/inc/air-validate.php');

		# Register settings
		register_setting('air-settings',self::$option_name,'AirValidate::init');

		# Enqueue admin styles and scripts
		add_action('admin_enqueue_scripts',__CLASS__.'::admin_styles_and_scripts');
		add_action('admin_enqueue_scripts',__CLASS__.'::admin_post_formats_script');

		# Action to create settings
		add_action('load-'.self::$hook[0],__CLASS__.'::admin_settings');
		add_action('load-'.self::$hook[1],__CLASS__.'::admin_module_settings');
	}

	/**
		Admin styles and scripts
			@public
	**/
	static function admin_styles_and_scripts($hook) {
		# Only load on theme admin pages
		if(!in_array($hook,self::$hook))
			return;

		# Set assets URL
		$url = AIR_URL.'/assets';

		# Set dependencies
		$css_dep = array('thickbox');
		$js_dep = array('media-upload','thickbox','jquery');

		# If design section, add colorpicker css/js
		if(isset($_GET['section']) && ('styling' === esc_attr($_GET['section']))) {
			# Register colorpicker.css
			wp_register_style('air-colorpicker',$url.'/colorpicker.css');
			# Add colorpicker.css to air.css dependencies
			$css_dep[] = 'air-colorpicker';
			# Register colorpicker.js
			wp_register_script('air-colorpicker',$url.'/colorpicker.js',array('jquery'));
			# Add colorpicker.js to air.js dependencies
			$js_dep[] = 'air-colorpicker';
		}

		# If help section, add thickbox support
		if(isset($_GET['section']) && ('help' === esc_attr($_GET['section']))) {
			add_thickbox();
		}

		# Enqueue stylesheet
		wp_enqueue_style('air',$url.'/air.css',$css_dep,'0.1');

		# Enqueue script
		wp_enqueue_script('air',$url.'/air.js',$js_dep,'0.1');
	}

	/**
		Admin notices
			@public
	**/
	static function admin_notices() {
		# Display settings erros
		settings_errors('air-settings-errors');
	}

	/**
		Post formats script
			@public
	**/
	static function admin_post_formats_script($hook) {
		# Only load on posts, pages
		if(!in_array($hook,array('post.php','post-new.php')))
			return;
		# Source
		$src = AIR_URL.'/assets/air-post-formats.js';
		# Dependencies
		$deps = array('jquery');
		# Enqueue script
		wp_enqueue_script('air-post-formats',$src,$deps,'0.1');
	}

	/**
		Admin menu
			@public
	**/
	static function admin_menu() {
		# Set page and menu title
		$title = isset(self::$config['theme_name'])?self::$config['theme_name']:'Air Framework';
		$icon_url = AIR_URL.'/assets/img/wpbandit.png';

		# Create top-level menu
		add_menu_page($title,$title,'manage_options','theme-options',__CLASS__.'::admin_page',$icon_url);

		# Create sub menu pages
		add_submenu_page('theme-options','Theme Options','Theme Options',
			'manage_options','theme-options',__CLASS__.'::admin_page');
		add_submenu_page('theme-options','Theme Modules','Theme Modules',
			'manage_options','theme-modules',__CLASS__.'::admin_page');
		add_submenu_page('theme-options','WPBandit Themes','WPBandit Themes',
			'manage_options','wpbandit-themes',__CLASS__.'::admin_page');
	}

	/**
		Admin options page
			@public
	**/
	static function admin_page() {
		# Get page
		$page = esc_attr($_GET['page']);

		# Set section
		if('theme-options' === $page) {
			$section = isset($_GET['section'])?esc_attr($_GET['section']):'general';
		} else {
			$section = isset($_GET['section'])?esc_attr($_GET['section']):'social';
		}

		# Load options page
		require(AIR_PATH.'/gui/air-'.$page.'-page.php');
	}

	/**
		Admin settings
			@public
	**/
	static function admin_settings() {
		# Load settings library
		require(AIR_PATH.'/inc/air-settings.php');

		# Load settings
		require(AIR_PATH.'/config/air-config-settings.php');

		# Create settings
		AirSettings::init(self::$option_name,$setting);
	}

	/**
		Admin module settings
			@public
	**/
	static function admin_module_settings() {
		# Load settings library
		require(AIR_PATH.'/inc/air-settings.php');
	}

	/**
		Print theme admin menu
			@public
	**/
	static function print_theme_admin_menu() {
		# Get page
		$page = esc_attr($_GET['page']);

		$menu = self::get_config($page.'-menu');
		if($menu) {
			# Set current section
			$current = isset($_GET['section'])?esc_attr($_GET['section']):key($menu);

			# Build menu
			$output = '';
			foreach($menu as $key=>$value) {
				# Set menu item url
				$url = admin_url('/admin.php?page='.$page.'&section='.$key);

				# Set current class ?
				$output .= ($current === $key)?'<li class="current">':'<li>'; 

				# Create menu item
				$output .= '<a href="'.$url.'"><i class="air-icon air-icon-'.$key.'"></i>'.$value.'</a></li>';
			}

			# Print menu
			echo $output;
		}
	}

	/**
		Custom fields
			@private
	**/
	private static function custom_fields() {
		# Pages to apply custom fields
		$pages = array('post.php','post-new.php');

		# Check page
		if(in_array(self::$vars['PAGENOW'],$pages)) {
			# Load meta library
			require(AIR_PATH.'/inc/air-meta.php');

			# Load custom fields
			require(AIR_PATH.'/config/air-meta-settings.php');

			# Create fields
			AirMeta::init($meta);
		}
	}

	/**
		Modules init
			@private
	**/
	private static function modules_init() {
		$modules = self::get_config('theme-modules-menu');
		if($modules) {
			foreach ($modules as $key=>$value) {
				$module = AIR_PATH.'/modules/'.$key.'/'.$key.'.php';
				if(is_file($module)) {
					require($module);
					call_user_func(array('air_'.$key,'init'));
				}
			}
		}
	}

	/**
		Register nav menus
			@private
	**/
	private static function register_nav_menus() {
		$menus = self::get_config('nav_menus');
		if($menus) {
			register_nav_menus($menus);
		}
	}

	/**
		Register sidebars
			@private
	**/
	private static function register_sidebars() {
		$sidebars = self::get_config('sidebars');
		if($sidebars) {
			foreach($sidebars as $sidebar) {
				# Single Sidebar
				if(!isset($sidebar['count'])) {
					register_sidebar($sidebar);
				}

				# Multiple Sidebars
				if(isset($sidebar['count'])) {
					$count = $sidebar['count'];
					unset($sidebar['count']);
					register_sidebars($count,$sidebar);
				}
			}
		}
	}

	/**
		Text domain
			@public
	**/
	static function text_domain() {
		$domain = self::get_config('text_domain');
		if($domain) {
			load_theme_textdomain($domain,get_template_directory().'/languages');
		}
	}

	/**
		Theme features
			@public
	**/
	static function theme_features() {
		$features = self::get_config('theme_features');
		if($features) {
			foreach($features as $key=>$value) {
				if($value && is_bool($value)) {
					add_theme_support($key);
				} elseif($value && is_array($value)) {
					add_theme_support($key,$value);
				}
			}

			# Add image sizes
			$image_sizes = self::get_config('image_sizes');
			if(isset($features['post-thumbnails']) && $image_sizes) {
				foreach($image_sizes as $size) {
					if(!isset($size['crop'])) { $size['crop'] = FALSE; }
					extract($size);
					add_image_size($name,$width,$height,$crop);
				}
			}
		}
	}

	/**
		Register scripts
			@public
	**/
	static function register_scripts() {
		$scripts = self::get_config('javascript');
		if($scripts) {
			# Script Defaults
			$defaults = array(
				'deps'		=> FALSE,
				'ver'		=> '1.0',
				'footer'	=> FALSE
			);

			# Loop through scripts and register
			foreach($scripts as $script) {
				# Parse script and merge with $defaults
				$args = wp_parse_args($script,$defaults);
				extract($args);
				# Register script
				wp_register_script($handle,$src,$deps,$ver,$footer);
			}
		}
	}

	/**
		WP Head
			@public
	**/
	static function wp_head() {
		# Style
		$style = self::get_option('style');
		if($style)
			echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/styles/'.$style.'">'."\n";
		
		# Advanced CSS
		if(self::get_option('advanced-css'))
			echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/style-advanced.css">'."\n";	
		
		# Custom CSS
		if(self::get_option('custom-css'))
			echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/style-custom.css">'."\n";

		# Favicon
		if(self::get_option('favicon'))
			echo '<link rel="shortcut icon" href="'.self::$option['favicon'].'">'."\n";

		if(!class_exists('All_in_One_SEO_Pack')) {
			# SEO Home Page Meta
			if(is_front_page()) {
				# Meta description
				if(self::get_option('seo-home-meta-description')) {
					echo '<meta name="description" content="'.self::get_option('seo-home-meta-description').'">'."\n";
				}

				# Meta keywords
				if(self::get_option('seo-home-meta-keywords')) {
					echo '<meta name="keywords" content="'.self::get_option('seo-home-meta-keywords').'">'."\n";
				}
			}

			# SEO Default Robot Attributes
			$seo_robot_atts = array(
				'name'		=> 'robots',
				'content'	=> array()
			);

			# SEO - Author
			if(is_author()) {
				# noindex, noarchive, nofollow
				$noindex = self::get_option('seo-noindex-author');
				$noarchive = self::get_option('seo-noarchive-author');
				$nofollow = self::get_option('seo-nofollow-author');
				if($noindex) { $seo_robot_atts['content'][] = 'noindex'; }
				if($noarchive) { $seo_robot_atts['content'][] = 'noarchive'; }
				if($nofollow) { $seo_robot_atts['content'][] = 'nofollow'; }
			}

			# SEO - Category
			if(is_category()) {
				# noindex, noarchive, nofollow
				$noindex = self::get_option('seo-noindex-category');
				$noarchive = self::get_option('seo-noarchive-category');
				$nofollow = self::get_option('seo-nofollow-category');
				if($noindex) { $seo_robot_atts['content'][] = 'noindex'; }
				if($noarchive) { $seo_robot_atts['content'][] = 'noarchive'; }
				if($nofollow) { $seo_robot_atts['content'][] = 'nofollow'; }
			}

			# SEO - Date
			if(is_date()) {
				# noindex, noarchive, nofollow
				$noindex = self::get_option('seo-noindex-date');
				$noarchive = self::get_option('seo-noarchive-date');
				$nofollow = self::get_option('seo-nofollow-date');
				if($noindex) { $seo_robot_atts['content'][] = 'noindex'; }
				if($noarchive) { $seo_robot_atts['content'][] = 'noarchive'; }
				if($nofollow) { $seo_robot_atts['content'][] = 'nofollow'; }
			}

			# SEO - Tags
			if(is_tag()) {
				# noindex, noarchive, nofollow
				$noindex = self::get_option('seo-noindex-tag');
				$noarchive = self::get_option('seo-noarchive-tag');
				$nofollow = self::get_option('seo-nofollow-tag');
				if($noindex) { $seo_robot_atts['content'][] = 'noindex'; }
				if($noarchive) { $seo_robot_atts['content'][] = 'noarchive'; }
				if($nofollow) { $seo_robot_atts['content'][] = 'nofollow'; }
			}

			# SEO - noodp, noydir
			$noodp = self::get_option('seo-noodp');
			$noydir = self::get_option('seo-noydir');
			if($noodp) { $seo_robot_atts['content'][] = 'noodp'; }
			if($noydir) { $seo_robot_atts['content'][] = 'noydir'; }

			# SEO Robot Meta Tags
			if($seo_robot_atts['content']) {
				$seo_robot_atts['content'] = implode(',',$seo_robot_atts['content']);
				echo '<meta'.self::attributes($seo_robot_atts).'>'."\n";
			}
		}

		# Analytics script
		if(self::get_option('analytics-script')) {
			if('header'===self::get_option('analytics-location')) {
				echo self::$option['analytics-script']."\n";
			}
		}
	}

	/**
		WP Footer
			@public
	**/
	static function wp_footer() {
		# Analytics script
		if(self::get_option('analytics-script')) {
			if('footer'===self::get_option('analytics-location')) {
				echo self::$option['analytics-script']."\n";
			}
		}
	}

	/**
		Theme styles
			@public
	**/
	static function get_theme_styles() {
		# Styles directory
		$styles_dir = get_template_directory().'/styles';

		# Default style
		$default = array('0'=>'Default');

		# Loop through styles
		if(is_dir($styles_dir) && $handle=opendir($styles_dir)) {
			while(false !== ($file=readdir($handle))) {
				if($file != "." && $file != ".." && is_file($styles_dir.'/'.$file)) {
					$tmp = new \SplFileObject($styles_dir.'/'.$file);
					$tmp->seek(1);
					$name = substr(esc_html($tmp->current()),7);
					$styles[$file]=$name;
				}
			}
			closedir($handle);

			# Combine arrays
			if($styles) {
				asort($styles);
				$styles = $default+$styles;
			}
		}
		return isset($styles)?$styles:$default;
	}

}

// Quietly initialize framework
Air::init();