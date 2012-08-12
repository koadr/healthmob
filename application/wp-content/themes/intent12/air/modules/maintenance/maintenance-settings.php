<?php

/*-------------------------------------------------------------------------- */
/* Module Settings :: Maintenance
/*-------------------------------------------------------------------------- */

/* Maintenance Mode : Enable
/*-------------------------------------------------------*/
$setting['sections']['maintenance-mode'] = array(
	'title'		=> 'Maintenance Mode',
	'tab'		=> 'maintenance'
);

//! Enable
$setting[]=array(
	'id'		=> 'maintenance-mode',
	'label'		=> 'Enable',
	'section'	=> 'maintenance-mode',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'maintenance-mode' => 'Enable maintenance mode'
	)
);

//! Access Role
$setting[]=array(
	'id'		=> 'maintenance-role',
	'label'		=> 'Access Role',
	'section'	=> 'maintenance-mode',
	'type'		=> 'select',
	'choices'	=> array(
		'administrator' => 'Administrator',
		'editor'		=> 'Editor',
		'author'		=> 'Author',
		'contributor'	=> 'Contributor'
	)
);