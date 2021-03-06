<?php

/**
	Air Meta Library

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2011 Bandit Media
	Jermaine Maree

		@package AirMeta
		@version 1.0
**/

//! Settings
class AirMeta extends AirBase {

	protected static
		//! Theme Meta
		$meta,
		//! Nonce
		$nonce;

	/**
		Init
			@public
	**/
	static function init($meta) {
		# Process meta
		self::process_meta_config($meta);
		# Load form library
		require(AIR_PATH.'/inc/air-form.php');
		# Add meta boxes
		add_action('add_meta_boxes',__CLASS__.'::add_meta_boxes');
		# Add action to save meta
		add_action('save_post',__CLASS__.'::save_meta');
	}

	/**
		Process meta configuration
			@private
	**/
	private static function process_meta_config($meta) {
		# Sections
		self::$meta = $meta['sections'];
		unset($meta['sections']);

		# Add fields to sections
		foreach($meta as $field) {
			# Field section
			$section = $field['section'];

			# Does field section exist?
			if(isset(self::$meta[$section])) {
				self::$meta[$section]['args'][] = $field;
			}
		}
	}

	/**
		Add meta boxes
			@public
	**/
	static function add_meta_boxes() {
		foreach(self::$meta as $id=>$meta) {
			# Defaults
			$defaults = array(
				'title'		=> __('Default Title','air'),
				'callback'	=> __CLASS__.'::create_meta_boxes',
				'page'		=> 'post',
				'context'	=> 'normal',
				'priority'	=> 'high',
				'template'	=> FALSE,
				'args'		=> array()
			);
			extract(wp_parse_args($meta,$defaults));
			
			# Non-template meta box
			if(!$template) {
				add_meta_box($id,$title,$callback,$page,$context,$priority,$args);
			}
			
			# Template specific meta box
			if($template) {
				# Get post id
				if(isset($_GET['post'])) { $post_id=esc_attr($_GET['post']); }
				if(isset($_POST['post_ID'])) { $post_id=esc_attr($_POST['post_ID']); }
				
				# Get template
				if(isset($post_id)) {
					$tmpl = get_post_meta($post_id,'_wp_page_template',TRUE);
				}
				
				# Create meta box, if template matches
				if(isset($tmpl) && in_array($tmpl,$template)) {
					add_meta_box($id,$title,$callback,$page,$context,$priority,$args);
				}
			}
		}
	}

	/**
		Create meta boxes
			@return string
			@param $post object
			@param $meta array
			@public
	**/
	static function create_meta_boxes($post,$meta) {
		# Meta nonce
		if(!isset(self::$nonce)) {
			# Create nonce field
			wp_nonce_field(plugin_basename( __FILE__ ),'air-meta-nonce');
			# Prevent duplicate nonce fields
			self::$nonce = TRUE;
		}

		# Begin table
		$output = '<table class="form-table">';
		
		# Loop through fields
		foreach($meta['args'] as $field) {
			# Get field value
			if(!in_array($field['type'],array('checkbox','radio'))) {
				$field['value'] = get_post_meta($post->ID,$field['id'],TRUE);
				$field['value'] = esc_attr($field['value']);
			}

			# Defaults
			$defaults = array(
				'std'		=> '',
				'class'		=> '',
				'choices'	=> array()
			);
			$args = wp_parse_args($field,$defaults);
			
			# Begin table row
			$output .= '<tr>';
			$output .= '<th><label>'.$args['label'].'</label></th>';
			$output .= '<td>';
			
			# Create field
			switch ($args['type']) {
				# Callback
				case 'callback':
					$output .= call_user_func_array($args['callback'],array($args,$post->ID));
					break;
				# Checkbox
				case 'checkbox':
					$output .= self::field_checkbox($args,$post->ID);
					break;
				# Radio
				case 'radio':
					$output .= self::field_radio($args,$post->ID);
					break;
				# Select
				case 'select':
					$output .= self::field_select($args);
					break;
				# Text
				case 'text':
					$output .= self::field_text($args);
					break;
				# Textarea
				case 'textarea':
					$output .= self::field_textarea($args);
					break;
			}

			# End table row
			$output .= '</td></tr>';
		}

		# End table
		$output .= '</table>';
		
		# Print field
		echo $output;
	}

	/**
		Save meta
			@param $post_id string
			@public
	**/
	static function save_meta($post_id) {
		# If autosave routine, do not save
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return; }
		
		# Set nonce
		$nonce = isset($_POST['air-meta-nonce'])?$_POST['air-meta-nonce']:'';
		
		# Verify nonce
		if(!wp_verify_nonce($nonce,plugin_basename( __FILE__ ))) { return; }
		
		# Verify permission to save meta
		if ('page'==$_POST['post_type'])
			if(!current_user_can('edit_page',$post_id)) { return; }
		if ('post'==$_POST['post_type'])
			if(!current_user_can('edit_post',$post_id)) { return; }
		
		# Loop through meta fields
		foreach(self::$meta as $meta) {
			foreach($meta['args'] as $field) {
				# Non-checkbox fields
				if('checkbox'!=$field['type']) {
					# Set id
					$id = $field['id'];
					# Save post meta
					self::save_post_meta($post_id,$id);
				}
				
				# Checkbox fields
				if('checkbox'==$field['type']) {
					foreach($field['choices'] as $id=>$args) {
						# Save post meta
						self::save_post_meta($post_id,$id);
					}
				}
			}
		}
	}

	/**
		Save post meta
			@param $post_id string
			@param $id string
			@private
	**/
	private static function save_post_meta($post_id,$id) {
		# Extend allowed tags
		self::extend_allowedposttags();
		
		# Old value
		$old = get_post_meta($post_id,$id,TRUE);
		
		# New Value
		$new = isset($_POST[$id])?$_POST[$id]:FALSE;
		
		# Update data
		if(($new!==FALSE) && $new!=$old) {
			update_post_meta($post_id,$id,wp_filter_post_kses($new));
		}

		# Remove data
		if((''==$new) && $old) {
			delete_post_meta($post_id,$id,$old);
		}
	}

	/**
		Extend $allowedposttags
			@private
	**/
	private static function extend_allowedposttags() {
		global $allowedposttags;
		
		# iframe
		$allowedposttags["iframe"] = array(
			"id" => array(),
			"class" => array(),
			"title" => array(),
			"style" => array(),
			"align" => array(),
			"frameborder" => array(),
			"longdesc" => array(),
			"marginheight" => array(),
			"marginwidth" => array(),
			"name" => array(),
			"scrolling" => array(),
			"src" => array(),
			"height" => array(),
			"width" => array()
		);
		
		# object
		$allowedposttags["object"] = array(
			"height" => array(),
			"width" => array()
		);
		
		# param
		$allowedposttags["param"] = array(
			"name" => array(),
			"value" => array()
		);
		
		# embed
		$allowedposttags["embed"] = array(
			"src" => array(),
			"type" => array(),
			"allowfullscreen" => array(),
			"allowscriptaccess" => array(),
			"height" => array(),
			"width" => array()
		);
	}

	/**
		Checkbox field
			@return string
			@param $args array
			@param $post_id string
			@private
	**/
	private static function field_checkbox($args,$post_id) {
		extract($args);
		$field = '';
		foreach($choices as $key=>$label) {
			# Get value
			$value = get_post_meta($post_id,$key,TRUE);
			
			# Set attributes
			$attrs = array(
				'id'	=> $key,
				'name'	=> $key,
				'class'	=> $class
			);
			
			# Create checkbox field
			$field .= AirForm::checkbox($attrs,$value);
			$field .= ' <label for="'.$attrs['name'].'">'.$label.'</label><br />';
		}

		# Return field
		return $field;
	}

	/**
		Radio field
			@return string
			@param $args array
			@param $post_id string
			@private
	**/
	private static function field_radio($args,$post_id) {
		extract($args);
		$field = '';
		
		# Get selected value
		$selected = get_post_meta($post_id,$id,TRUE);
		
		# Set default
		if(!$selected) {
			$selected = key($choices);
		}

		# Loop through choices
		foreach($choices as $key=>$label) {
			# Set attributes
			$attrs = array(
				'name'	=> $id,
				'class'	=> $class
			);
			
			# Create radio field
			$field .= AirForm::radio($attrs,$key,$selected);
			$field .= ' <label>'.$label.'</label><br />';
		}
		
		# Return field
		return $field;
	}

	/**
		Select field
			@return string
			@param $args array
			@private
	**/
	private static function field_select($args) {
		extract($args);
		
		# Set attributes
		$attrs = array(
			'id'	=> $id,
			'name'	=> $id,
			'class'	=> $class
		);
		
		# Create select field
		$field = AirForm::select($attrs,$value,$choices);
		
		# Return field
		return $field;
	}

	/**
		Text field
			@return string
			@param $args array
			@private
	**/
	private static function field_text($args) {
		extract($args);
		
		# Set attributes
		$attrs = array(
			'id'	=> $id,
			'name'	=> $id,
			'class'	=> $class?$class:'regular-text'
		);
		
		# Create text field
		$field = AirForm::text($attrs,$value);
		
		# Return field
		return $field;
	}

	/**
		Textarea field
			@return string
			@param $args array
			@private
	**/
	private static function field_textarea($args) {
		extract($args);
		
		# Set attributes
		$attrs = array(
			'id'	=> $id,
			'name'	=> $id,
			'class'	=> $class?$class:'large-text',
			'cols'	=> isset($cols)?$cols:'50',
			'rows'	=> isset($rows)?$rows:'8'
		);
		
		# Create textarea field
		$field = '<p>'.AirForm::textarea($attrs,$value).'</p>';
		
		# Return field
		return $field;
	}

}
