<?php

/*-------------------------------------------------------------------------- */
/* Module Settings :: Portfolio
/*-------------------------------------------------------------------------- */

/* Portfolio : Enable
/*-------------------------------------------------------*/
$setting['sections']['portfolio'] = array(
	'title'		=> 'Portfolio',
	'tab'		=> 'portfolio'
);

//! Enable
$setting[]=array(
	'id'		=> 'portfolio-enable',
	'label'		=> 'Enable',
	'section'	=> 'portfolio',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'portfolio-enable' => 'Enable portfolio'
	)
);

# Are permalinks enabled ?
if(air_portfolio::$vars['PERMALINKS']):

	/* Portfolio : Rewrite Slugs
	/*-------------------------------------------------------*/
	$setting['sections']['portfolio-rewrite'] = array(
		'title'		=> 'Rewrite Slugs',
		'tab'		=> 'portfolio'
	);

	//! Post Type
	$setting[] = array(
		'id'		=> 'portfolio-rewrite-type',
		'label'		=> 'Post Type',
		'section'	=> 'portfolio-rewrite',
		'type'		=> 'text',
		'class'		=> 'medium-text'
	);

	//! Taxonomy
	$setting[] = array(
		'id'		=> 'portfolio-rewrite-taxonomy',
		'label'		=> 'Category',
		'section'	=> 'portfolio-rewrite',
		'type'		=> 'text',
		'class'		=> 'medium-text'
	);

endif;