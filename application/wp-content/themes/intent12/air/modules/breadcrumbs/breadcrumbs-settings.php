<?php

/*-------------------------------------------------------------------------- */
/* Module Settings :: Breadcrumb
/*-------------------------------------------------------------------------- */

/* Breadcrumbs : Enable
/*-------------------------------------------------------*/
$setting['sections']['breadcrumbs'] = array(
	'title'		=> 'Breadcrumbs',
	'tab'		=> 'breadcrumbs'
);

//! Enable Breadcrumbs
$setting[] = array(
	'id'		=> 'breadcrumbs-enable',
	'label'		=> 'Enable',
	'section'	=> 'breadcrumbs',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'breadcrumbs-enable' => 'Enable breadcrumbs'
	)
);

/* Breadcrumbs : Disable
/*-------------------------------------------------------*/
$setting['sections']['breadcrumbs-disable'] = array(
	'title'		=> 'Disable',
	'tab'		=> 'breadcrumbs'
);

/* Breadcrumbs : Labels
/*-------------------------------------------------------*/
$setting['sections']['breadcrumbs-label'] = array(
	'title'		=> 'Labels',
	'tab'		=> 'breadcrumbs'
);


# Static front page
if('page'===get_option('show_on_front')):
	//! Disable Breadcrumbs on front page
	$setting[] = array(
		'id'		=> 'breadcrumbs-disable-front',
		'label'		=> 'Disable on Front Page',
		'section'	=> 'breadcrumbs-disable',
		'type'		=> 'checkbox',
		'choices'	=> array(
			'breadcrumbs-disable-front' => 'Disable breadcrumbs on front page'
		)
	);

	//! Breadcrumbs front label
	$setting[] = array(
		'id'			=> 'breadcrumbs-front-text',
		'label'			=> 'Front Page',
		'section'		=> 'breadcrumbs-label',
		'type'			=> 'text',
		'placeholder'	=> get_bloginfo('name')
	);

	//! Disable Breadcrumbs on blog
	$setting[] = array(
		'id'		=> 'breadcrumbs-disable-home',
		'label'		=> 'Disable on Blog',
		'section'	=> 'breadcrumbs-disable',
		'type'		=> 'checkbox',
		'choices'	=> array(
			'breadcrumbs-disable-home' => 'Disable breadcrumbs on blog'
		)
	);

	# Get posts page title
	$page_id = get_option('page_for_posts');
	$home_label = get_the_title($page_id);

	//! Breadcrumbs blog label
	$setting[] = array(
		'id'			=> 'breadcrumbs-home-text',
		'label'			=> 'Blog',
		'section'		=> 'breadcrumbs-label',
		'type'			=> 'text',
		'placeholder'	=> $home_label
	);
endif;

# Non-static front page
if('posts'===get_option('show_on_front')):
	//! Disable Breadcrumbs on home page
	$setting[] = array(
		'id'		=> 'breadcrumbs-disable-home',
		'label'		=> 'Disable on Home Page',
		'section'	=> 'breadcrumbs-disable',
		'type'		=> 'checkbox',
		'choices'	=> array(
			'breadcrumbs-disable-home' => 'Disable breadcrumbs on home page'
		)
	);

	//! Breadcrumbs home label
	$setting[] = array(
		'id'			=> 'breadcrumbs-home-text',
		'label'			=> 'Home Page',
		'section'		=> 'breadcrumbs-label',
		'type'			=> 'text',
		'placeholder'	=> get_bloginfo('name')
	);
endif;


//! Breadcrumbs separator
$setting[] = array(
	'id'			=> 'breadcrumbs-separator',
	'label'			=> 'Separator',
	'section'		=> 'breadcrumbs',
	'type'			=> 'text',
	'class'			=> 'small-text aligncenter',
	'placeholder'	=> ':'
);

//! Disable post titles
$setting[] = array(
	'id'		=> 'breadcrumbs-disable-post-title',
	'label'		=> 'Disable Post Title',
	'section'	=> 'breadcrumbs',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'breadcrumbs-disable-post-title' => 'Disable post title'
	)
);

//! Disable Breadcrumbs on home page
$setting[] = array(
	'id'		=> 'breadcrumbs-disable-archive',
	'label'		=> 'Disable on Archives',
	'section'	=> 'breadcrumbs-disable',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'breadcrumbs-disable-archive' => 'Disable breadcrumbs on archive pages'
	)
);