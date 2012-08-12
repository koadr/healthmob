<?php

/**
	Config Library :: Air Framework

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Marée

		@package AirConfig
		@version 1.0
**/

//! Modifies theme configuration
class AirConfig extends AirBase {

	private static
		$init = FALSE;

	/**
		Init
			@public
	**/
	static function init() {
		if(self::$init)
			return;

		self::$init = TRUE;

		# Sidebars
		self::sidebars();

		# Subfooter widgets
		self::subfooter_widgets();

		# Footer widgets
		self::footer_widgets();
	}

	/**
		Sidebars
			@private
	**/
	private static function sidebars() {
		# Single
		if(self::get_option('sidebar-widget-single')) {
			self::$config['sidebars'][] = array(
				'id'			=> 'sidebar-single',
				'name'			=> 'Sidebar: Blog Single',
				'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
				'after_widget'	=> '</li>',
				'before_title'	=> '<h3 class="widget-title"><span>',
				'after_title'	=> '</span></h3>',
			);
		}

		# Archive
		if(self::get_option('sidebar-widget-archive')) {
			self::$config['sidebars'][] = array(
				'id'			=> 'sidebar-archive',
				'name'			=> 'Sidebar: Blog Archive',
				'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
				'after_widget'	=> '</li>',
				'before_title'	=> '<h3 class="widget-title"><span>',
				'after_title'	=> '</span></h3>',
			);
		}

		# Page
		if(self::get_option('sidebar-widget-page')) {
			self::$config['sidebars'][] = array(
				'id'			=> 'sidebar-page',
				'name'			=> 'Sidebar: Page',
				'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
				'after_widget'	=> '</li>',
				'before_title'	=> '<h3 class="widget-title"><span>',
				'after_title'	=> '</span></h3>',
			);
		}

		# Search
		if(self::get_option('sidebar-widget-search')) {
			self::$config['sidebars'][] = array(
				'id'			=> 'sidebar-search',
				'name'			=> 'Sidebar: Search',
				'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
				'after_widget'	=> '</li>',
				'before_title'	=> '<h3 class="widget-title"><span>',
				'after_title'	=> '</span></h3>',
			);
		}

		# 404
		if(self::get_option('sidebar-widget-404')) {
			self::$config['sidebars'][] = array(
				'id'			=> 'sidebar-404',
				'name'			=> 'Sidebar: 404',
				'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
				'after_widget'	=> '</li>',
				'before_title'	=> '<h3 class="widget-title"><span>',
				'after_title'	=> '</span></h3>',
			);
		}
	}

	/**
		Subfooter widgets
			@private
	**/
	private static function subfooter_widgets() {
		if(self::get_option('subfooter-widgets')) {
			# Define subfooter widgets
			$subfooter_widgets = array(
					array(
						'id'			=> 'widget-subfooter-1',
						'name'			=> 'Subfooter Column 1',
						'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
						'after_widget'	=> '</li>',
						'before_title'	=> '<h3 class="widget-title"><span>',
						'after_title'	=> '</span></h3>',
					),
					array(
						'id'			=> 'widget-subfooter-2',
						'name'			=> 'Subfooter Column 2',
						'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
						'after_widget'	=> '</li>',
						'before_title'	=> '<h3 class="widget-title"><span>',
						'after_title'	=> '</span></h3>',
					),
					array(
						'id'			=> 'widget-subfooter-3',
						'name'			=> 'Subfooter Column 3',
						'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
						'after_widget'	=> '</li>',
						'before_title'	=> '<h3 class="widget-title"><span>',
						'after_title'	=> '</span></h3>',
					),
			);
			# Append subfooter widgets to sidebars configuration
			self::$config['sidebars'] = array_merge(self::$config['sidebars'],$subfooter_widgets);
		}
	}

	/**
		Footer widgets
			@private
	**/
	private static function footer_widgets() {
		if(self::get_option('footer-widgets')) {
			# Define footer widgets
			$footer_widgets = array(
				array(
					'id'			=> 'widget-footer-1',
					'name'			=> 'Footer Column 1',
					'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
					'after_widget'	=> '</li>',
					'before_title'	=> '<h3 class="widget-title"><span>',
					'after_title'	=> '</span></h3>',
				),
				array(
					'id'			=> 'widget-footer-2',
					'name'			=> 'Footer Column 2',
					'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
					'after_widget'	=> '</li>',
					'before_title'	=> '<h3 class="widget-title"><span>',
					'after_title'	=> '</span></h3>',
				),
				array(
					'id'			=> 'widget-footer-3',
					'name'			=> 'Footer Column 3',
					'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
					'after_widget'	=> '</li>',
					'before_title'	=> '<h3 class="widget-title"><span>',
					'after_title'	=> '</span></h3>',
				),
				array(
					'id'			=> 'widget-footer-4',
					'name'			=> 'Footer Column 4',
					'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
					'after_widget'	=> '</li>',
					'before_title'	=> '<h3 class="widget-title"><span>',
					'after_title'	=> '</span></h3>',
				)
			);

			# Append footer widgets to sidebars configuration
			self::$config['sidebars'] = array_merge(self::$config['sidebars'],$footer_widgets);
		}
	}

}

// Quietly initialize library
AirConfig::init();