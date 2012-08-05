<?php

/**
	Login Module :: Air Framework

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Marée

		@package air_login
		@version 1.0
**/

//! air_login
class air_login extends AirBase {

	//@{ Module variables
	protected static
		//! Option Name
		$option_name = 'air-login',
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
		self::$path = AIR_PATH.'/modules/login';
		# Set URL
		self::$url = AIR_URL.'/modules/login';
		# Admin init
		add_action('admin_init',__CLASS__.'::admin_init');

		# Enable custom login page
		if(('wp-login.php'==$pagenow) && self::get_option('login-custom-enable')) {
			# Login head action
			add_action('login_head',__CLASS__.'::login_head');
			
			# Login logo URL
			if(isset(self::$option['login-logo-url']) && self::get_option('login-logo-url')) {
				add_filter('login_headerurl',__CLASS__.'::login_headerurl');
			}
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

		if(isset($_GET['section']) && ('login'==$_GET['section'])) {
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

		# Enqueue colorpicker.css
		wp_enqueue_style('air-colorpicker',AIR_URL.'/assets/colorpicker.css');
		
		# Enqueue colorpicker.js
		wp_enqueue_script('air-colorpicker',AIR_URL.'/assets/colorpicker.js',array('jquery'));
	}

	/**
		Admin settings
			@public
	**/
	static function admin_settings() {
		# Load settings
		require(self::$path.'/login-settings.php');

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

		# Enable custom login page
		$valid['login-custom-enable']=isset($input['login-custom-enable'])?'1':'0';
		# Login logo
		$valid['login-logo'] = esc_url($input['login-logo']);
		# Login logo URL
		$valid['login-logo-url'] = esc_url($input['login-logo-url']);
		# Login background color
		$valid['login-bg-color'] = esc_attr($input['login-bg-color']);
		# Login link color
		$valid['login-link-color'] = esc_attr($input['login-link-color']);
		# Login link hover color
		$valid['login-link-hover-color'] = esc_attr($input['login-link-hover-color']);
		# Login CSS
		$valid['login-css'] = esc_textarea($input['login-css']);	

		# Return validated options
		return $valid;
	}

	/**
		Login head
			@public
	**/
	static function login_head() {
		# Get options
		$logo = self::get_option('login-logo');
		$bg_color = self::get_option('login-bg-color');
		$link_color = self::get_option('login-link-color');
		$link_color_hover = self::get_option('login-link-hover-color');
		$login_css = self::get_option('login-css');

		# Build CSS
		$output = '<style type="text/css">'."\n";
		
		# Background
		if($bg_color) {
			$output .= 'html, body.login { background-color: #'.$bg_color.'!important; }'."\n";
			$output .= '.login #nav, .login #backtoblog { text-shadow: none }'."\n";
		}

		# Logo
		if($logo) {
			# Get image size
			$size = getimagesize($logo);
			# Set width and height
			$width = $size?'width:'.$size[0].'px;':'';
			$height = $size?'height:'.$size[1].'px':'';
			# Logo CSS
			$output.='.login h1 a { background:url('.$logo.') no-repeat top center; background-size:auto; '.$width.$height.' }'."\n";
		}

		# Link Color
		if($link_color) {
			$output .= '.login #nav a, .login #backtoblog a { color:#'.$link_color.'!important; }'."\n";
		}

		# Link Color Hover
		if($link_color_hover) {
			$output .= '.login #nav a:hover, .login #backtoblog a:hover { color:#'.$link_color_hover.'!important; }'."\n";
		}

		# Custom CSS
		if($login_css) {
			$output .= $login_css."\n";
		}
		$output .= '</style>'."\n";
		
		# Print CSS
		echo $output;
	}

	/**
		Login Logo URL
			@return string
			@param $url string
			@public
	**/
	static function login_headerurl($url) {
		return self::$option['login-logo-url'];
	}

}