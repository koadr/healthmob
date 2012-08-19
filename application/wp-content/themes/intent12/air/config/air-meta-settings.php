<?php

 $meta = array();

/*---------------------------------------------------------------------------*
 * Custom Fields :: Post Formats
 *---------------------------------------------------------------------------*/

/* Post Format : Audio
/*-------------------------------------------------------*/
$meta['sections']['format-audio'] = array(
	'title'		=> 'Audio',
);

//! Audio MP3 URL
$meta[] = array(
	'id'		=> '_audio_mp3_url',
	'label'		=> 'Audio URL (MP3)',
	'section'	=> 'format-audio',
	'type'		=> 'text',
	'class'		=> 'large-text'
);

//! Audio OGG URL
$meta[] = array(
	'id'		=> '_audio_ogg_url',
	'label'		=> 'Audio URL (OGG)',
	'section'	=> 'format-audio',
	'type'		=> 'text',
	'class'		=> 'large-text'
);

/* Post Format : Chat
/*-------------------------------------------------------*/
$meta['sections']['format-chat'] = array(
	'title'		=> 'Chat',
);

//! Status
$meta[] = array(
	'id'		=> '_chat',
	'label'		=> 'Text',
	'section'	=> 'format-chat',
	'type'		=> 'textarea',
	'rows'		=> '8'
);


/* Post Format : Link
/*-------------------------------------------------------*/
$meta['sections']['format-link'] = array(
	'title'		=> 'Link',
);

//! Link Title
$meta[] = array(
	'id'		=> '_link_title',
	'label'		=> 'Link Title',
	'section'	=> 'format-link',
	'type'		=> 'text',
	'class'		=> 'large-text'
);

//! Link URL
$meta[] = array(
	'id'		=> '_link_url',
	'label'		=> 'Link URL',
	'section'	=> 'format-link',
	'type'		=> 'text',
	'class'		=> 'large-text'
);


/* Post Format : Quote
/*-------------------------------------------------------*/
$meta['sections']['format-quote'] = array(
	'title'		=> 'Quote',
);

//! Quote
$meta[] = array(
	'id'		=> '_quote',
	'label'		=> 'Quote',
	'section'	=> 'format-quote',
	'type'		=> 'textarea',
	'rows'		=> '4'
);

//! Quote Author
$meta[] = array(
	'id'		=> '_quote_author',
	'label'		=> 'Quote Author',
	'section'	=> 'format-quote',
	'type'		=> 'text',
	'class'		=> 'large-text'
);


/* Post Format : Video
/*-------------------------------------------------------*/
$meta['sections']['format-video'] = array(
	'title'		=> 'Video',
);

$meta[] = array(
	'id'		=> '_video_url',
	'label'		=> 'Video URL (Recommended)',
	'section'	=> 'format-video',
	'type'		=> 'text',
	'class'		=> 'large-text'
);

$meta[] = array(
	'id'		=> '_video_embed_code',
	'label'		=> 'Video Embed Code',
	'section'	=> 'format-video',
	'type'		=> 'textarea',
	'rows'		=> '6'
);

/*---------------------------------------------------------------------------*
 * Custom Fields :: Pages
 *---------------------------------------------------------------------------*/

/* Headings
/*---------------------------------------------------------------------------*/
$meta['sections']['page-headings'] = array(
	'title'		=> 'Headings',
	'page'		=> 'page',
);

//! Heading
$meta[] = array(
	'id'		=> '_heading',
	'label'		=> 'Heading',
	'section'	=> 'page-headings',
	'type'		=> 'text'
);

//! Subheading
$meta[] = array(
	'id'		=> '_subheading',
	'label'		=> 'Subheading',
	'section'	=> 'page-headings',
	'type'		=> 'text'
);

/*---------------------------------------------------------------------------*
 * Custom Fields :: Front Page Template
 *---------------------------------------------------------------------------*/


/* Front : Slider
/*---------------------------------------------------------------------------*/

$meta['sections']['front-slider'] = array(
	'title'		=> 'Slider',
	'page'		=> 'page',
	'template'	=> array('template-front.php')
);

//! Enable
$meta[] = array(
	'id'		=> '_front_slider_enable',
	'label'		=> 'Enable',
	'section'	=> 'front-slider',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'_front_slider_enable'	=> 'Display slider + headings'
	)
);

//! Layout
$meta[] = array(
	'id'		=> '_front_slider_layout',
	'label'		=> 'Layout',
	'section'	=> 'front-slider',
	'type'		=> 'select',
	'choices'	=> array(
		'_front-slider-1'	=> 'Slider 1',
		'_front-slider-2'	=> 'Slider 2',
		'_front-slider-3'	=> 'Slider 3',
		'_front-slider-4'	=> 'Slider 4',
	)
);


// Is portfolio enabled ?
if(air_portfolio::get_option('portfolio-enable')):

	/* Front : Portfolio
	/*---------------------------------------------------------------------------*/

	$meta['sections']['front-portfolio'] = array(
		'title'		=> 'Portfolio',
		'page'		=> 'page',
		'template'	=> array('template-front.php')
	);

	//! Enable
	$meta[] = array(
		'id'		=> '_front_portfolio_enable',
		'label'		=> 'Enable',
		'section'	=> 'front-portfolio',
		'type'		=> 'checkbox',
		'choices'	=> array(
			'_front_portfolio_enable'	=> 'Display portfolio entries'
		)
	);

	//! Layout
	$meta[] = array(
		'id'		=> '_front_portfolio_layout',
		'label'		=> 'Layout',
		'section'	=> 'front-portfolio',
		'type'		=> 'select',
		'choices'	=> array(
			'_front-portfolio-1'	=> 'Layout 1',
			'_front-portfolio-2'	=> 'Layout 2',
			'_front-portfolio-3'	=> 'Layout 3',
			'_front-portfolio-4'	=> 'Layout 4',
		)
	);

	//! Category
	$meta[] = array(
		'id'		=> '_front_portfolio_category',
		'label'		=> 'Category',
		'section'	=> 'front-portfolio',
		'type'		=> 'select',
		'choices'	=> AirTheme::portfolio_meta_category_dropdown()
	);

	//! Heading
	$meta[] = array(
		'id'		=> '_front_portfolio_heading',
		'label'		=> 'Heading',
		'section'	=> 'front-portfolio',
		'type'		=> 'text',
		'class'		=> 'large-text'
	);

	//! Content
	$meta[] = array(
		'id'		=> '_front_portfolio_content',
		'label'		=> 'Content',
		'section'	=> 'front-portfolio',
		'type'		=> 'textarea',
		'rows'		=> 4
	);

endif; // end portfolio enabled check


/* Front : Blog
/*---------------------------------------------------------------------------*/

$meta['sections']['front-blog'] = array(
	'title'		=> 'Blog',
	'page'		=> 'page',
	'template'	=> array('template-front.php')
);

//! Enable
$meta[] = array(
	'id'		=> '_front_blog_enable',
	'label'		=> 'Enable',
	'section'	=> 'front-blog',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'_front_blog_enable'	=> 'Display blog posts'
	)
);

//! Layout
$meta[] = array(
	'id'		=> '_front_blog_layout',
	'label'		=> 'Layout',
	'section'	=> 'front-blog',
	'type'		=> 'select',
	'choices'	=> array(
		'_front-blog-1'	=> 'Layout 1',
		'_front-blog-2'	=> 'Layout 2',
		'_front-blog-3'	=> 'Layout 3',
		'_front-blog-4'	=> 'Layout 4',
	)
);

/*  Category
$meta[] = array(
	'id'		=> '_front_blog_category',
	'label'		=> 'Category',
	'section'	=> 'front-blog',
	'type'		=> 'select',
	'callback'	=> 'AirTheme::admin_category_dropdown'
);*/

//! Format
$meta[] = array(
	'id'		=> '_front_blog_format',
	'label'		=> 'Format',
	'section'	=> 'front-blog',
	'type'		=> 'radio',
	'choices'	=> array(
		'0' => 'Default',
		'1' => 'Display post thumbnails',
		'2' => 'Display post formats'
	)
);

//! Excerpt length
$meta[] = array(
	'id'		=> '_front_blog_excerpt_length',
	'label'		=> 'Excerpt Length',
	'section'	=> 'front-blog',
	'type'		=> 'text',
	'class'		=> 'small-text'
);

//! Heading
$meta[] = array(
	'id'		=> '_front_blog_heading',
	'label'		=> 'Heading',
	'section'	=> 'front-blog',
	'type'		=> 'text',
	'class'		=> 'large-text'
);

//! Content
$meta[] = array(
	'id'		=> '_front_blog_content',
	'label'		=> 'Content',
	'section'	=> 'front-blog',
	'type'		=> 'textarea',
	'rows'		=> 4
);


/*---------------------------------------------------------------------------*
 * Custom Fields :: Portfolio
 *---------------------------------------------------------------------------*/

// Is portfolio enabled ?
if(air_portfolio::get_option('portfolio-enable')):

/* Portfolio
/*-------------------------------------------------------*/
$meta['sections']['portfolio'] = array(
	'title'		=> 'Portfolio',
	'page'		=> 'page',
	'template'	=> array('template-portfolio.php')	
);

//! Category
$meta[] = array(
	'id'		=> '_portfolio_category',
	'label'		=> 'Category',
	'section'	=> 'portfolio',
	'type'		=> 'select',
	'choices'	=> AirTheme::portfolio_meta_category_dropdown()
);

//! Layout
$meta[] = array(
	'id'		=> '_portfolio_layout',
	'label'		=> 'Layout',
	'section'	=> 'portfolio',
	'type'		=> 'select',
	'choices'	=> array(
		'one-fourth'	=> 'One Fourth',
		'one-third'		=> 'One Third',
		'one-half'		=> 'One Half'
	)
);

//! Order
$meta[] = array(
	'id'		=> '_portfolio_order',
	'label'		=> 'Order',
	'section'	=> 'portfolio',
	'type'		=> 'select',
	'choices'	=> array(
		'DESC'	=> 'Descending',
		'ASC'	=> 'Ascending'
	)
);

//! Orderby
$meta[] = array(
	'id'		=> '_portfolio_orderby',
	'label'		=> 'Orderby',
	'section'	=> 'portfolio',
	'type'		=> 'select',
	'choices'	=> array(
		'date'	=> 'Date',
		'title'	=> 'Title',
		'rand'	=> 'Random'
	)
);

//! Lightbox
$meta[] = array(
	'id'		=> '_portfolio_lightbox',
	'label'		=> 'Lightbox',
	'section'	=> 'portfolio',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'_portfolio_lightbox' => 'Enable lightbox',
		'_portfolio_lightbox_gallery' => 'Show lightbox images as gallery'
	)
);

//! Disable
$meta[] = array(
	'id'		=> '_portfolio_disable',
	'label'		=> 'Disable',
	'section'	=> 'portfolio',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'_portfolio_disable_switcher'	=> 'Disable size switcher',
		'_portfolio_disable_categories'	=> 'Disable category menu'
	)
);

/* Portfolio Single : Headings
/*---------------------------------------------------------------------------*/
$meta['sections']['portfolio-headings'] = array(
	'title'		=> 'Headings',
	'page'		=> 'portfolio',
);

//! Heading
$meta[] = array(
	'id'		=> '_heading',
	'label'		=> 'Heading',
	'section'	=> 'portfolio-headings',
	'type'		=> 'text'
);

//! Subheading
$meta[] = array(
	'id'		=> '_subheading',
	'label'		=> 'Subheading',
	'section'	=> 'portfolio-headings',
	'type'		=> 'text'
);

/* Portfolio Single : Template
/*-------------------------------------------------------*/
$meta['sections']['portfolio-template'] = array(
	'title'		=> 'Portfolio Template',
	'page'		=> 'portfolio',
);

//! Template
$meta[] = array(
	'id'		=> '_portfolio_template',
	'label'		=> 'Template',
	'section'	=> 'portfolio-template',
	'type'		=> 'select',
	'choices'	=> array(
		'left'	=> 'Left',
		'right'	=> 'Right'
	)
);

//! Video Template
$meta[] = array(
	'id'		=> '_portfolio_video',
	'label'		=> 'Video Template',
	'section'	=> 'portfolio-template',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'_portfolio_video' => 'Enable Video Template'
	)
);

/* Portfolio Single : Custom Link
/*---------------------------------------------------------------------------*/
$meta['sections']['portfolio-custom-link'] = array(
	'title'		=> 'Custom Link',
	'page'		=> 'portfolio',
);

//! Heading
$meta[] = array(
	'id'		=> '_link',
	'label'		=> 'URL',
	'section'	=> 'portfolio-custom-link',
	'type'		=> 'text',
	'class'		=> 'large-text'
);

/* Portfolio Single : Video
/*---------------------------------------------------------------------------*/

$meta['sections']['portfolio-video'] = array(
	'title'		=> 'Portfolio Video',
	'page'		=> 'portfolio'
);

//! Video URL
$meta[] = array(
	'id'		=> '_portfolio_video_url',
	'label'		=> 'Video URL (Recommended)',
	'section'	=> 'portfolio-video',
	'type'		=> 'text',
	'class'		=> 'large-text'
);

//! Video Embed Code
$meta[] = array(
	'id'		=> '_portfolio_video_embed_code',
	'label'		=> 'Video Embed Code',
	'section'	=> 'portfolio-video',
	'type'		=> 'textarea',
	'rows'		=> '5'
);

endif; // end portfolio enabled check