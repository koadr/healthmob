<?php

/*-------------------------------------------------------------------------- */
/* Module Settings :: Login
/*-------------------------------------------------------------------------- */

/* Login : Enable
/*-------------------------------------------------------*/
$setting['sections']['login-enable'] = array(
	'title'		=> 'Login Page',
	'tab'		=> 'login'
);

//! Enable
$setting[]=array(
	'id'		=> 'login-custom-enable',
	'label'		=> 'Enable',
	'section'	=> 'login-enable',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'login-custom-enable' => 'Enable custom login page'
	)
);

/* Login : Logo
/*-------------------------------------------------------*/
$setting['sections']['login-logo'] = array(
	'title'		=> 'Logo',
	'tab'		=> 'login'
);

//! Logo
$setting[]=array(
	'id'		=> 'login-logo',
	'label'		=> 'Logo Image',
	'section'	=> 'login-logo',
	'type'		=> 'image'
);

//! Logo URL
$setting[]=array(
	'id'		=> 'login-logo-url',
	'label'		=> 'Logo URL',
	'section'	=> 'login-logo',
	'type'		=> 'text',
	'class'		=> 'regular-text'
);

/* Login : Colors
/*-------------------------------------------------------*/
$setting['sections']['login-colors'] = array(
	'title'		=> 'Colors',
	'tab'		=> 'login'
);

//! Background Color
$setting[] = array(
	'id'		=> 'login-bg-color',
	'label'		=> 'Background Color',
	'section'	=> 'login-colors',
	'type'		=> 'colorpicker'
);

//! Link Color
$setting[] = array(
	'id'		=> 'login-link-color',
	'label'		=> 'Link Color',
	'section'	=> 'login-colors',
	'type'		=> 'colorpicker'
);

//! Link Color Hover
$setting[] = array(
	'id'		=> 'login-link-hover-color',
	'label'		=> 'Link Color Hover',
	'section'	=> 'login-colors',
	'type'		=> 'colorpicker'
);

/* Login : CSS
/*-------------------------------------------------------*/
$setting['sections']['login-css'] = array(
	'title'		=> 'CSS',
	'tab'		=> 'login'
);

//! Custom CSS
$setting[] = array(
	'id'		=> 'login-css',
	'label'		=> 'Custom CSS',
	'section'	=> 'login-css',
	'type'		=> 'textarea',
	'rows'		=> '12'
);