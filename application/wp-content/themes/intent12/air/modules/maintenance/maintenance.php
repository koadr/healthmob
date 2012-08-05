<?php

/**
	Maintenance Module :: Air Framework

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Marée

		@package air_maintenance
		@version 1.0
**/

//! air_login
class air_maintenance extends AirBase {

	//@{ Module variables
	protected static
		//! Option Name
		$option_name = 'air-maintenance',
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
		self::$path = AIR_PATH.'/modules/maintenance';
		# Set URL
		self::$url = AIR_URL.'/modules/maintenance';
		# Admin init
		add_action('admin_init',__CLASS__.'::admin_init');

		# Enable maintenance mode
		if(self::get_option('maintenance-mode')) {
			self::enable_maintenance_mode();
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

		if(isset($_GET['section']) && ('maintenance'==$_GET['section'])) {
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
		require(self::$path.'/maintenance-settings.php');

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
		$valid['maintenance-mode'] = isset($input['maintenance-mode'])?'1':'0';

		# Maintenance mode access role
		$roles = array('administrator','editor','author','contributor');
		$valid['maintenance-role'] = in_array($input['maintenance-role'],$roles)?$input['maintenance-role']:'administrator';

		# Return validated options
		return $valid;
	}

	/**
		Enable maintenance mode
			@public
	**/
	static function enable_maintenance_mode() {
		# Set access role
		$role = self::get_option('maintenance-role');
		if(!$role) { $role = 'administrator'; }

		if(!current_user_can($role)) {
			# Exclude login,register pages
			$exclude = array('wp-login.php','wp-register.php');

			# Verify we are not trying to register or login
			if(!in_array(self::$vars['PAGENOW'],$exclude)) {
				$uri = esc_attr($_SERVER['REQUEST_URI']);
				
				# Get URL based on permalinks
				if(self::$vars['PERMALINKS']) {
					$url = substr($uri,-12);
					$redirect_url = home_url().'/_maintenance';
				} else {
					$url = isset($_REQUEST['p'])?esc_attr($_REQUEST['p']):'';
					$redirect_url = home_url().'/?p=_maintenance';
				}
				$in_admin = strstr($uri,'wp-admin');
				
				# Redirect if not maintenance URL
				if(('_maintenance'!=$url) && !$in_admin) {
					header('Location: '.$redirect_url,TRUE,307);
					exit;
				}
				
				# Load maintenance template
				if(!$in_admin) {
					require(self::$path.'/maintenance-template.php');
					exit(1);	
				}
			}
		}
	}

}