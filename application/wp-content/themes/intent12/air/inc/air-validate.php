<?php

/**
	Validation Library :: Air Framework

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Maree

		@package AirValidate
		@version 1.0
**/

//! BanditValidate
class AirValidate extends AirBase {

	protected static
		$error = FALSE;

	/**
		Initialize
	**/
	static function init($input) {
		# Get current options
		$valid = self::$option;

		# Get section
		$section = isset($input['section'])?esc_attr($input['section']):'general';
		unset($input['section']);

		# Validate section
		if(!isset($input['reset'])) {
			switch ($section) {
				case 'general':
					$valid = self::general($input,$valid);
					break;
				case 'blog':
					$valid = self::blog($input,$valid);
					break;
				case 'seo':
					$valid = self::seo($input,$valid);
					break;
				case 'header':
					$valid = self::header($input,$valid);
					break;
				case 'sidebar':
					$valid = self::sidebar($input,$valid);
					break;
				case 'footer':
					$valid = self::footer($input,$valid);
					break;
				case 'styling':
					$valid = self::styling($input,$valid);
					break;
			}
		}

		# Reset section
		if(isset($input['reset'])) {
			switch ($section) {
				case 'general':
					$valid = self::reset_general($valid);
					break;
				case 'blog':
					$valid = self::reset_blog($valid);
					break;
				case 'seo':
					$valid = self::reset_seo($valid);
					break;
				case 'header':
					$valid = self::reset_header($valid);
					break;
				case 'sidebar':
					$valid = self::reset_sidebar($valid);
					break;
				case 'footer':
					$valid = self::reset_footer($valid);
					break;
				case 'styling':
					$valid = self::reset_styling($valid);
					break;
			}
		}

		# Return validated options
		return $valid;
	}

	/**
		General
			@return array
			@param $input array
			@param $valid array
			@private
	**/
	private static function general(array $input, $valid) {
		# Theme Style
		$valid['style'] = esc_attr($input['style']);
		# Custom Stylesheet
		$valid['custom-css'] = isset($input['custom-css'])?'1':'0';
		# Favicon
		$valid['favicon'] = esc_url($input['favicon']);
		# Feed URL
		$valid['feed-url'] = esc_url($input['feed-url']);
		# Analytics Location
		$valid['analytics-location'] = ('header'===$input['analytics-location'])?'header':'footer';
		# Analytics Script
		$valid['analytics-script'] = $input['analytics-script'];
		
		# Return validated options
		return $valid;
	}

	/**
		Blog
			@return array
			@param $input array
			@param $valid array
			@private
	**/
	private static function blog(array $input, $valid) {
		# Read More Text
		$valid['read-more'] = esc_attr($input['read-more']);
		# Read More Link
		$valid['excerpt-more-link-enable'] = isset($input['excerpt-more-link-enable'])?'1':'0';
		# Excerpt More Text
		$valid['excerpt-more'] = esc_attr($input['excerpt-more']);
		# Excerpt Length
		$valid['excerpt-length'] = absint($input['excerpt-length']);
		# Blog Format
		$valid['blog-format'] = isset($input['blog-format'])?$input['blog-format']:'0';

		# Heading
		$valid['blog-heading'] = esc_attr($input['blog-heading']);
		# Subheading
		$valid['blog-subheading'] = esc_attr($input['blog-subheading']);

		# Featured Posts Enable
		$valid['featured-enable'] = isset($input['featured-enable'])?'1':'0';
		# Fatured Posts Content
		$valid['featured-content'] = isset($input['featured-content'])?'1':'0';
		# Featured Category 1
		$valid['featured-cat-1'] = esc_attr($input['featured-cat-1']);
		# Featured Category 1 Number of Posts
		$valid['featured-cat-1-num'] = esc_attr($input['featured-cat-1-num']);
		# Featured Category 2
		$valid['featured-cat-2'] = esc_attr($input['featured-cat-2']);

		# Post Content Home
		$valid['post-content-home'] = ('1'===$input['post-content-home'])?'1':'0';
		# Post Content Archive
		$valid['post-content-archive'] = ('1'===$input['post-content-archive'])?'1':'0';
		# Post Content Search
		$valid['post-content-search'] = ('1'===$input['post-content-search'])?'1':'0';

		# Post Hide Author
		$valid['post-hide-author'] = isset($input['post-hide-author'])?'1':'0';
		# Post Hide Date
		$valid['post-hide-date'] = isset($input['post-hide-date'])?'1':'0';
		# Post Hide Categories
		$valid['post-hide-categories'] = isset($input['post-hide-categories'])?'1':'0';
		# Post Hide Tags
		$valid['post-hide-tags'] = isset($input['post-hide-tags'])?'1':'0';
		# Post Hide Format Icon
		$valid['post-hide-format-icon'] = isset($input['post-hide-format-icon'])?'1':'0';

		# Enable post author block
		$valid['post-enable-author-block'] = isset($input['post-enable-author-block'])?'1':'0';

		# Comments Form Location
		$valid['comments-form-location'] = ('top'===$input['comments-form-location'])?'top':'bottom';
		# Disable Comments Pages
		$valid['comments-pages-disable'] = isset($input['comments-pages-disable'])?'1':'0';
		# Disable Comments Posts
		$valid['comments-posts-disable'] = isset($input['comments-posts-disable'])?'1':'0';

		# Return validated options
		return $valid;
	}

	/**
		SEO
			@return array
			@param $input array
			@param $valid array
			@private
	**/
	private static function seo(array $input, $valid) {
		# Append site name to title
		$valid['seo-title-append-sitename'] = isset($input['seo-title-append-sitename'])?'1':'0';
		# Title separator
		$valid['seo-title-separator'] = esc_attr($input['seo-title-separator']);

		# Home page title
		$valid['seo-home-title'] = esc_attr($input['seo-home-title']);
		# Home page meta description
		$valid['seo-home-meta-description'] = esc_textarea($input['seo-home-meta-description']);
		# Home page meta keywords
		$valid['seo-home-meta-keywords'] = esc_attr($input['seo-home-meta-keywords']);

		# noindex
		$valid['seo-noindex-author'] = isset($input['seo-noindex-author'])?'1':'0';
		$valid['seo-noindex-category'] = isset($input['seo-noindex-category'])?'1':'0';
		$valid['seo-noindex-date'] = isset($input['seo-noindex-date'])?'1':'0';
		$valid['seo-noindex-tag'] = isset($input['seo-noindex-tag'])?'1':'0';

		# noarchive
		$valid['seo-noarchive-author'] = isset($input['seo-noarchive-author'])?'1':'0';
		$valid['seo-noarchive-category'] = isset($input['seo-noarchive-category'])?'1':'0';
		$valid['seo-noarchive-date'] = isset($input['seo-noarchive-date'])?'1':'0';
		$valid['seo-noarchive-tag'] = isset($input['seo-noarchive-tag'])?'1':'0';

		# noarchive
		$valid['seo-nofollow-author'] = isset($input['seo-nofollow-author'])?'1':'0';
		$valid['seo-nofollow-category'] = isset($input['seo-nofollow-category'])?'1':'0';
		$valid['seo-nofollow-date'] = isset($input['seo-nofollow-date'])?'1':'0';
		$valid['seo-nofollow-tag'] = isset($input['seo-nofollow-tag'])?'1':'0';

		# noodp, noydir
		$valid['seo-noodp'] = isset($input['seo-noodp'])?'1':'0';
		$valid['seo-noydir'] = isset($input['seo-noydir'])?'1':'0';

		# Return validated options
		return $valid;
	}

	/**
		Header
			@return array
			@param $input array
			@param $valid array
			@private
	**/
	private static function header(array $input, $valid) {
		# Custom Logo
		$valid['custom-logo'] = esc_url($input['custom-logo']);
		# Disable tagline
		$valid['disable-tagline'] = isset($input['disable-tagline'])?'1':'0';
		# Disable archive heading
		$valid['disable-archive-heading'] = isset($input['disable-archive-heading'])?'1':'0';
		# Disable header search field
		$valid['header-disable-search'] = isset($input['header-disable-search'])?'1':'0';

		# Return validated options
		return $valid;
	}

	/**
		Sidebar
			@return array
			@param $input array
			@param $valid array
			@private
	**/
	private static function sidebar(array $input, $valid) {
		# Enable Mobile
		$valid['sidebar-mobile-enable'] = isset($input['sidebar-mobile-enable'])?'1':'0';
		# Single
		$valid['sidebar-widget-single'] = isset($input['sidebar-widget-single'])?'1':'0';
		# Archive
		$valid['sidebar-widget-archive'] = isset($input['sidebar-widget-archive'])?'1':'0';
		# Page
		$valid['sidebar-widget-page'] = isset($input['sidebar-widget-page'])?'1':'0';
		# Search
		$valid['sidebar-widget-search'] = isset($input['sidebar-widget-search'])?'1':'0';
		# 404
		$valid['sidebar-widget-404'] = isset($input['sidebar-widget-404'])?'1':'0';

		# Return validated options
		return $valid;
	}

	/**
		Footer
			@return array
			@param $input array
			@param $valid array
			@private
	**/
	private static function footer(array $input, $valid) {
		# Footer Text
		$valid['footer-text'] = wp_kses_post($input['footer-text']);
		# Footer Widgets
		$valid['footer-widgets'] = isset($input['footer-widgets'])?'1':'0';

		# Contact Information
		$valid['footer-contact-enable'] = isset($input['footer-contact-enable'])?'1':'0';
		# Address
		$valid['footer-address'] = esc_attr($input['footer-address']);
		# Phone
		$valid['footer-phone'] = esc_attr($input['footer-phone']);
		# Email
		$valid['footer-email'] = esc_attr($input['footer-email']);

		# Return validated options
		return $valid;
	}

	/**
		Styling
			@return array
			@param $input array
			@param $valid array
			@private
	**/
	private static function styling(array $input, $valid) {
		# Advanced Stylesheet
		$valid['advanced-css'] = isset($input['advanced-css'])?'1':'0';
		
		# Theme Color
		$valid['styling-color-1'] = esc_attr($input['styling-color-1']);
		
		# Header Text Color
		$valid['styling-header-text-color'] = esc_attr($input['styling-header-text-color']);
		# Header Background Color
		$valid['styling-header-bg-color'] = esc_attr($input['styling-header-bg-color']);
		# Header Background Image
		$valid['styling-header-bg-image'] = esc_url($input['styling-header-bg-image']);
		# Header Background Image Repeat
		$valid['styling-header-bg-image-repeat'] = esc_attr($input['styling-header-bg-image-repeat']);
		
		# Subheader Background Color
		$valid['styling-subheader-bg-color'] = esc_attr($input['styling-subheader-bg-color']);
		# Subheader Background Image
		$valid['styling-subheader-bg-image'] = esc_url($input['styling-subheader-bg-image']);
		# Subheader Background Image Repeat
		$valid['styling-subheader-bg-image-repeat'] = esc_attr($input['styling-subheader-bg-image-repeat']);
		
		
		# Footer Background Color
		$valid['styling-footer-bg-color'] = esc_attr($input['styling-footer-bg-color']);
		# Footer Background Image
		$valid['styling-footer-bg-image'] = esc_url($input['styling-footer-bg-image']);
		# Footer Background Image Repeat
		$valid['styling-footer-bg-image-repeat'] = esc_attr($input['styling-footer-bg-image-repeat']);
	
		# Body Background Color
		$valid['styling-body-bg-color'] = esc_attr($input['styling-body-bg-color']);
		# Body Background Image
		$valid['styling-body-bg-image'] = esc_url($input['styling-body-bg-image']);
		# Body Background Image Repeat
		$valid['styling-body-bg-image-repeat'] = esc_attr($input['styling-body-bg-image-repeat']);
		
		# Shadows
		$valid['styling-misc-shadows-1'] = isset($input['styling-misc-shadows-1'])?'1':'0';
		$valid['styling-misc-shadows-2'] = isset($input['styling-misc-shadows-2'])?'1':'0';

		// Write Stylesheet
		if($valid['advanced-css']) {
			if(!AirTheme::write_advanced_css($valid)) {
				# Add error if cannot write to file
				add_settings_error('air-settings-errors','feather-updated',
					__('Cannot write to style-advanced.css. Please check permissions and try saving settings again.','intent'),'error');
			}
		}
		
		# Return validated options
		return $valid;
	}

	/**
		Reset General
			@private
	**/
	private static function reset_general($valid) {
		$valid['style'] = '0';
		$valid['custom-css'] = '0';
		$valid['favicon'] = '';
		$valid['feed-url'] = '';
		$valid['analytics-location'] = 'header';
		$valid['analytics-script'] = '';
		return $valid;
	}

	/**
		Reset General
			@private
	**/
	private static function reset_blog($valid) {
		$valid['read-more'] = '';
		$valid['excerpt-more-link-enable'] = '';
		$valid['excerpt-more'] = '';
		$valid['excerpt-length'] = '';
		$valid['blog-format'] = '0';
		$valid['blog-heading'] = '';
		$valid['blog-subheading'] = '';
		$valid['featured-enable'] = '0';
		$valid['featured-content'] = '0';
		$valid['featured-cat-1'] = '0';
		$valid['featured-cat-1-num'] = '1';
		$valid['featured-cat-2'] = '0';
		$valid['post-content-home'] = '1';
		$valid['post-content-archive'] = '0';
		$valid['post-content-search'] = '0';
		$valid['post-hide-author'] = '0';
		$valid['post-hide-date'] = '0';
		$valid['post-hide-categories'] = '0';
		$valid['post-hide-tags'] = '0';
		$valid['post-hide-format-icon'] = '0';
		$valid['post-enable-author-block'] = '0';
		$valid['comments-form-location'] = 'bottom';
		$valid['comments-pages-disable'] = '1';
		$valid['comments-posts-disable'] = '0';
		return $valid;
	}

	/**
		Reset
			@private
	**/
	private static function reset_seo($valid) {
		$valid['seo-title-append-sitename'] = '1';
		$valid['seo-title-separator'] = '';
		$valid['seo-home-title'] = '';
		$valid['seo-home-meta-description'] = '';
		$valid['seo-home-meta-keywords'] = '';
		$valid['seo-noindex-author'] = '1';
		$valid['seo-noindex-category'] = '0';
		$valid['seo-noindex-date'] = '1';
		$valid['seo-noindex-tag'] = '1';
		$valid['seo-noarchive-author'] = '0';
		$valid['seo-noarchive-category'] = '0';
		$valid['seo-noarchive-date'] = '0';
		$valid['seo-noarchive-tag'] = '0';
		$valid['seo-nofollow-author'] = '1';
		$valid['seo-nofollow-category'] = '0';
		$valid['seo-nofollow-date'] = '1';
		$valid['seo-nofollow-tag'] = '1';
		$valid['seo-noodp'] = '1';
		$valid['seo-noydir'] = '1';
		return $valid;
	}

	/**
		Reset
			@private
	**/
	private static function reset_header($valid) {
		$valid['custom-logo'] = '';
		$valid['disable-tagline'] = '0';
		$valid['disable-archive-heading'] = '0';
		$valid['header-disable-search'] = '0';
		return $valid;
	}

	/**
		Reset
			@private
	**/
	private static function reset_sidebar($valid) {
		$valid['sidebar-mobile-enable'] = '0';
		$valid['sidebar-widget-single'] = '0';
		$valid['sidebar-widget-archive'] = '0';
		$valid['sidebar-widget-page'] = '0';
		$valid['sidebar-widget-search'] = '0';
		$valid['sidebar-widget-404'] = '0';
		return $valid;
	}

	/**
		Reset
			@private
	**/
	private static function reset_footer($valid) {
		$valid['footer-text'] = '';
		$valid['footer-widgets'] = '0';
		$valid['footer-contact-enable'] = '0';
		$valid['footer-address'] = '';
		$valid['footer-phone'] = '';
		$valid['footer-email'] = '';
		return $valid;
	}

	/**
		Reset
			@private
	**/
	private static function reset_styling($valid) {
		$valid['advanced-css'] = '0';
		$valid['styling-color-1'] = '';
		$valid['styling-header-text-color'] = '';
		$valid['styling-header-bg-color'] = '';
		$valid['styling-header-bg-image'] = '';
		$valid['styling-header-bg-image-repeat'] = '';
		$valid['styling-subheader-bg-color'] = '';
		$valid['styling-subheader-bg-image'] = '';
		$valid['styling-subheader-bg-image-repeat'] = '';
		$valid['styling-footer-bg-color'] = '';
		$valid['styling-footer-bg-image'] = '';
		$valid['styling-footer-bg-image-repeat'] = '';
		$valid['styling-body-bg-color'] = '';
		$valid['styling-body-bg-image'] = '';
		$valid['styling-body-bg-image-repeat'] = '';
		$valid['styling-misc-shadows-1'] = '0';
		$valid['styling-misc-shadows-2'] = '0';
		return $valid;
	}

}