<?php

/*-------------------------------------------------------------------------- */
/* Theme Settings :: General
/*-------------------------------------------------------------------------- */

/* General : Theme Styles
/*---------------------------------------------------------*/

$setting['sections']['style'] = array(
	'title'		=> 'Theme Style',
	'tab'		=> 'general'
);

//! Theme Styles
$setting[] = array(
	'id'		=> 'style',
	'label'		=> 'Name',
	'section'	=> 'style',
	'type'		=> 'select',
	'choices'	=> Air::get_theme_styles()
);

/* General : Custom Stylesheet
/*-------------------------------------------------------*/

$setting['sections']['custom-css'] = array(
	'title'		=> 'Custom Stylesheet',
	'tab'		=> 'general'
);

//! Enable
$setting[] = array(
	'id'		=> 'custom-css',
	'label'		=> 'Enable',
	'section'	=> 'custom-css',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'custom-css' => 'Enable custom stylesheet [ <strong>style-custom.css</strong> ]',
	)
);

/* General : Favicon
/*-------------------------------------------------------*/

$setting['sections']['favicon'] = array(
	'title'		=> 'Favicon',
	'tab'		=> 'general'
);

//! Logo URL
$setting[] = array(
	'id'		=> 'favicon',
	'label'		=> 'Favicon',
	'section'	=> 'favicon',
	'type'		=> 'image'
);

/* General : RSS Feed
/*-------------------------------------------------------*/

$setting['sections']['rss-feed'] = array(
	'title'		=> 'RSS Feed',
	'tab'		=> 'general'
);

//! Feed URL
$setting[] = array(
	'id'		=> 'feed-url',
	'label'		=> 'Feed URL',
	'section'	=> 'rss-feed',
	'type'		=> 'text',
	'class'		=> 'regular-text'
);

/* General : Analytics Script
/*-------------------------------------------------------*/

$setting['sections']['analytics'] = array(
	'title'		=> 'Analytics Script',
	'tab'		=> 'general'
);

//! Script Location
$setting[] = array(
	'id'		=> 'analytics-location',
	'label'		=> 'Script Location',
	'section'	=> 'analytics',
	'type'		=> 'radio',
	'choices'	=> array(
		'header' => 'Header',
		'footer' => 'Footer'
	),
	'vertical'	=> FALSE
);

//! Script
$setting[] = array(
	'id'		=> 'analytics-script',
	'label'		=> 'Analytics Script',
	'section'	=> 'analytics',
	'type'		=> 'textarea',
	'rows'		=> '4'
);


/*-------------------------------------------------------------------------- */
/* Theme Settings :: SEO
/*-------------------------------------------------------------------------- */

/* SEO: Title
/*-------------------------------------------------------*/
$setting['sections']['seo-title'] = array(
	'title'		=> 'Title',
	'tab'		=> 'seo'
);

//! Append site name to title
$setting[] = array(
	'id'		=> 'seo-title-append-sitename',
	'label'		=> 'Site Name',
	'section'	=> 'seo-title',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'seo-title-append-sitename' => 'Append site name to title'
	),
);

//! Title separator
$setting[] = array(
	'id'			=> 'seo-title-separator',
	'label'			=> 'Separator',
	'section'		=> 'seo-title',
	'type'			=> 'text',
	'class'			=> 'small-text aligncenter',
	'placeholder'	=> '|'
);

/* SEO: Home Page
/*-------------------------------------------------------*/
$setting['sections']['seo-home'] = array(
	'title'		=> 'Home Page',
	'tab'		=> 'seo'
);

//! Home page title
$setting[] = array(
	'id'		=> 'seo-home-title',
	'label'		=> 'Title',
	'section'	=> 'seo-home',
	'type'		=> 'text',
	'class'		=> 'large-text'
);

//! Home page meta description
$setting[] = array(
	'id'		=> 'seo-home-meta-description',
	'label'		=> 'Meta Description',
	'section'	=> 'seo-home',
	'type'		=> 'textarea',
	'rows'		=> 3,
);

//! Home page meta keywords
$setting[] = array(
	'id'		=> 'seo-home-meta-keywords',
	'label'		=> 'Meta Keywords',
	'section'	=> 'seo-home',
	'type'		=> 'text',
	'class'		=> 'large-text',
);

/* SEO: Robot Meta Tags
/*-------------------------------------------------------*/
$setting['sections']['seo-robot-meta-tags'] = array(
	'title'		=> 'Robot Meta Tags',
	'tab'		=> 'seo'
);

//! noindex
$setting[] = array(
	'id'		=> 'seo-noindex',
	'label'		=> '<code>noindex</code>',
	'section'	=> 'seo-robot-meta-tags',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'seo-noindex-author'	=> 'Add <code>noindex</code> to author pages',
		'seo-noindex-category'	=> 'Add <code>noindex</code> to category pages',
		'seo-noindex-date'		=> 'Add <code>noindex</code> to date-based pages',
		'seo-noindex-tag'		=> 'Add <code>noindex</code> to tag pages'
	),
);

//! noarchive
$setting[] = array(
	'id'		=> 'seo-noarchive',
	'label'		=> '<code>noarchive</code>',
	'section'	=> 'seo-robot-meta-tags',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'seo-noarchive-author'	=> 'Add <code>noarchive</code> to author pages',
		'seo-noarchive-category'	=> 'Add <code>noarchive</code> to category pages',
		'seo-noarchive-date'		=> 'Add <code>noarchive</code> to date-based pages',
		'seo-noarchive-tag'		=> 'Add <code>noarchive</code> to tag pages'
	),
);

//! nofollow
$setting[] = array(
	'id'		=> 'seo-nofollow',
	'label'		=> '<code>nofollow</code>',
	'section'	=> 'seo-robot-meta-tags',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'seo-nofollow-author'	=> 'Add <code>nofollow</code> to author pages',
		'seo-nofollow-category'	=> 'Add <code>nofollow</code> to category pages',
		'seo-nofollow-date'		=> 'Add <code>nofollow</code> to date-based pages',
		'seo-nofollow-tag'		=> 'Add <code>nofollow</code> to tag pages'
	),
);

//! noodp, noydir
$setting[] = array(
	'id'		=> 'seo-directory-tags',
	'label'		=> '<code>noodp,noydir</code>',
	'section'	=> 'seo-robot-meta-tags',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'seo-noodp' => 'Add <code>noodp</code> to your site',
		'seo-noydir' => 'Add <code>noydir</code> to your site'

	)
);


/*-------------------------------------------------------------------------- */
/* Theme Settings :: Header
/*-------------------------------------------------------------------------- */

/* Header : Custom Logo
/*-------------------------------------------------------*/

$setting['sections']['custom-logo'] = array(
	'title'		=> 'Custom Logo',
	'tab'		=> 'header'
);

//! Logo URL
$setting[] = array(
	'id'		=> 'custom-logo',
	'label'		=> 'Logo URL',
	'section'	=> 'custom-logo',
	'type'		=> 'image'
);

/* Header : Tagline
/*-------------------------------------------------------*/
$setting['sections']['header-tagline'] = array(
	'title'		=> 'Tagline',
	'tab'		=> 'header'
);

//! Disable Tagline
$setting[] = array(
	'id'		=> 'disable-tagline',
	'label'		=> 'Disable',
	'section'	=> 'header-tagline',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'disable-tagline' => 'Disable tagline (site description)'
	)
);

/* Header : Search
/*-------------------------------------------------------*/
$setting['sections']['header-search'] = array(
	'title'		=> 'Search Field',
	'tab'		=> 'header'
);

//! Disable search field
$setting[] = array(
	'id'		=> 'header-disable-search',
	'label'		=> 'Disable',
	'section'	=> 'header-search',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'header-disable-search' => 'Disable search field'
	)
);

/* Header : Archive Heading
/*-------------------------------------------------------*/
$setting['sections']['header-archives'] = array(
	'title'		=> 'Archive Heading',
	'tab'		=> 'header'
);

//! Disable Tagline
$setting[] = array(
	'id'		=> 'disable-archive-heading',
	'label'		=> 'Disable',
	'section'	=> 'header-archives',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'disable-archive-heading' => 'Disable archive heading'
	)
);


/*-------------------------------------------------------------------------- */
/* Theme Settings :: Blog
/*-------------------------------------------------------------------------- */

/* Blog : General
/*-------------------------------------------------------*/
$setting['sections']['blog-general'] = array(
	'title'		=> 'General',
	'tab'		=> 'blog'
);

//! Read More
$setting[] = array(
	'id'			=> 'read-more',
	'label'			=> 'Read More Text',
	'section'		=> 'blog-general',
	'type'			=> 'text',
	'placeholder'	=> '(more...)'
);

//! Excerpt Read More Link
$setting[] = array(
	'id'		=> 'excerpt-more-link-enable',
	'label'		=> 'Read More Link',
	'section'	=> 'blog-general',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'excerpt-more-link-enable' => 'Enable read more link on excerpts'
	)
);

//! Excerpt More
$setting[] = array(
	'id'			=> 'excerpt-more',
	'label'			=> 'Excerpt Ending',
	'section'		=> 'blog-general',
	'type'			=> 'text',
	'class'			=> 'medium-text',
	'placeholder'	=> '[...]'
);

//! Excerpt Length
$setting[] = array(
	'id'			=> 'excerpt-length',
	'label'			=> 'Excerpt Length <small>(words)</small>',
	'section'		=> 'blog-general',
	'type'			=> 'text',
	'class'			=> 'small-text',
	'placeholder'	=> '55'
);

//! Blog Format
$setting[] = array(
	'id'		=> 'blog-format',
	'label'		=> 'Blog Format',
	'section'	=> 'blog-general',
	'type'		=> 'radio',
	'choices'	=> array(
		'0' => 'Default',
		'1' => 'Display post thumbnails',
		'2' => 'Display post formats'
	)
);

/* Blog : Heading
/*-------------------------------------------------------*/
$setting['sections']['blog-heading'] = array(
	'title'		=> 'Heading',
	'tab'		=> 'blog'
);

//! Heading
$setting[] = array(
	'id'			=> 'blog-heading',
	'label'			=> 'Heading',
	'section'		=> 'blog-heading',
	'type'			=> 'text',
	'placeholder'	=> ''
);

//! Subheading
$setting[] = array(
	'id'			=> 'blog-subheading',
	'label'			=> 'Subheading',
	'section'		=> 'blog-heading',
	'type'			=> 'text',
	'placeholder'	=> ''
);

/* Blog : Featured Posts
/*-------------------------------------------------------*/
$setting['sections']['blog-featured'] = array(
	'title'		=> 'Featured Posts',
	'tab'		=> 'blog'
);

//! Enabled Featured Posts
$setting[] = array(
	'id'		=> 'featured-enable',
	'label'		=> 'Enable',
	'section'	=> 'blog-featured',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'featured-enable' 	=> 'Enable featured posts',
		'featured-content'	=> 'Include featured posts in content area <small>(not recommended)</small>'
	)
);

//! Category 1
$setting[] = array(
	'id'		=> 'featured-cat-1',
	'label'		=> 'Category 1',
	'section'	=> 'blog-featured',
	'callback'	=> 'AirTheme::admin_category_dropdown'
);

//! Number of Featured Posts
$setting[] = array(
	'id'		=> 'featured-cat-1-num',
	'label'		=> '# of Posts <small>(Category 1)</small>',
	'section'	=> 'blog-featured',
	'type'		=> 'select',
	'choices'	=> array_diff(range(0,10),array('0'))
);

//! Category 2
$setting[] = array(
	'id'		=> 'featured-cat-2',
	'label'		=> 'Category 2',
	'section'	=> 'blog-featured',
	'callback'	=> 'AirTheme::admin_category_dropdown'
);

/* Blog : Post Content
/*-------------------------------------------------------*/
$setting['sections']['post-content'] = array(
	'title'		=> 'Post Content',
	'tab'		=> 'blog'
);

//! Home
$setting[] = array(
	'id'		=> 'post-content-home',
	'label'		=> 'Home',
	'section'	=> 'post-content',
	'type'		=> 'radio',
	'choices'	=> array(
		'0' => 'Excerpt',
		'1' => 'Full Post',
	),
	'vertical'	=> FALSE
);

//! Archive
$setting[] = array(
	'id'		=> 'post-content-archive',
	'label'		=> 'Archive',
	'section'	=> 'post-content',
	'type'		=> 'radio',
	'choices'	=> array(
		'0' => 'Excerpt',
		'1' => 'Full Post <small>(not recommended)</small>',
	),
	'vertical'	=> FALSE
);

//! Search
$setting[] = array(
	'id'		=> 'post-content-search',
	'label'		=> 'Search',
	'section'	=> 'post-content',
	'type'		=> 'radio',
	'choices'	=> array(
		'0' => 'Excerpt',
		'1' => 'Full Post <small>(not recommended)</small>',
	),
	'vertical'	=> FALSE
);

/* Blog : Post Details
/*-------------------------------------------------------*/
$setting['sections']['post-details'] = array(
	'title'		=> 'Post Details',
	'tab'		=> 'blog'
);

//! Hide Post Details
$setting[] = array(
	'id'		=> 'post-hide-fields',
	'label'		=> 'Hide Post Details',
	'section'	=> 'post-details',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'post-hide-author'		=> 'Hide post author',
		'post-hide-date'		=> 'Hide post date',
		'post-hide-categories'	=> 'Hide post categories',
		'post-hide-tags'		=> 'Hide post tags',
		'post-hide-format-icon'	=> 'Hide post format icon',
	)
);

/* Blog : Author Block
/*-------------------------------------------------------*/
$setting['sections']['post-author-block'] = array(
	'title'		=> 'Author Block',
	'tab'		=> 'blog'
);

//! Enable
$setting[] = array(
	'id'		=> 'post-enable-author-block',
	'label'		=> 'Enable',
	'section'	=> 'post-author-block',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'post-enable-author-block' => 'Enable author block'
	)
);
		
/* Blog : Comments
/*-------------------------------------------------------*/
$setting['sections']['comments'] = array(
	'title'		=> 'Comments',
	'tab'		=> 'blog'
);

//! Comments Form Location
$setting[] = array(
	'id'		=> 'comments-form-location',
	'label'		=> 'Comments Form Location',
	'section'	=> 'comments',
	'type'		=> 'radio',
	'choices'	=> array(
		'top'		=> 'Display above comments',
		'bottom'	=> 'Display below comments',
	)
);

//! Disable Comments
$setting[] = array(
	'id'		=> 'disable-comments',
	'label'		=> 'Disable Comments',
	'section'	=> 'comments',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'comments-pages-disable' => 'Disable comments on pages',
		'comments-posts-disable' => 'Disable comments on posts'
	)
);


/*-------------------------------------------------------------------------- */
/* Theme Settings :: Footer
/*-------------------------------------------------------------------------- */

/* Footer : Footer Widgets
/*-------------------------------------------------------*/
$setting['sections']['footer-widgets'] = array(
	'title'		=> 'Footer Widgets',
	'tab'		=> 'footer'
);

//! Footer Widgets
$setting[] = array(
	'id'		=> 'footer-widgets',
	'label'		=> 'Enable',
	'section'	=> 'footer-widgets',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'footer-widgets' 	=> 'Enable footer widgets'
	)
);

/* Footer : Footer Text
/*-------------------------------------------------------*/
$setting['sections']['footer-text'] = array(
	'title'		=> 'Footer Text',
	'tab'		=> 'footer'
);

//! Text
$setting[] = array(
	'id'		=> 'footer-text',
	'label'		=> 'Text',
	'section'	=> 'footer-text',
	'type'		=> 'textarea',
	'rows'		=> '2',
	'cols'		=> '10'
);

/* Footer : Contact Information
/*-------------------------------------------------------*/
$setting['sections']['footer-contact'] = array(
	'title'		=> 'Contact Information',
	'tab'		=> 'footer'
);

//! Footer Widgets
$setting[] = array(
	'id'		=> 'footer-contact-enable',
	'label'		=> 'Enable',
	'section'	=> 'footer-contact',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'footer-contact-enable' 	=> 'Display contact information in footer'
	)
);

//! Footer Address
$setting[] = array(
	'id'			=> 'footer-address',
	'label'			=> 'Address',
	'section'		=> 'footer-contact',
	'type'			=> 'text'
);

//! Footer Phone
$setting[] = array(
	'id'			=> 'footer-phone',
	'label'			=> 'Phone',
	'section'		=> 'footer-contact',
	'type'			=> 'text'
);

//! Footer Email
$setting[] = array(
	'id'			=> 'footer-email',
	'label'			=> 'Email',
	'section'		=> 'footer-contact',
	'type'			=> 'text'
);



/*-------------------------------------------------------------------------- */
/* Theme Settings :: Sidebar
/*-------------------------------------------------------------------------- */

/* Sidebar : Mobile Layout
/*-------------------------------------------------------*/
$setting['sections']['sidebar-mobile'] = array(
	'title'		=> 'Mobile Sidebar',
	'tab'		=> 'sidebar'
);

//! Enable
$setting[] = array(
	'id'		=> 'sidebar-mobile-enable',
	'label'		=> 'Enable',
	'section'	=> 'sidebar-mobile',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'sidebar-mobile-enable' => 'Show sidebar content on mobile layouts'
	)
);

/* Sidebar : Widgets
/*-------------------------------------------------------*/
$setting['sections']['sidebar-widgets'] = array(
	'title'		=> 'Separate Widget Areas',
	'tab'		=> 'sidebar'
);

$setting[] = array(
	'id'		=> 'post-hide-fields',
	'label'		=> 'Enable',
	'section'	=> 'sidebar-widgets',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'sidebar-widget-single'	=> 'Blog Single',
		'sidebar-widget-archive'=> 'Blog Archive',
		'sidebar-widget-page'	=> 'Page',
		'sidebar-widget-search'	=> 'Search',
		'sidebar-widget-404'	=> '404',
	)
);

/*-------------------------------------------------------------------------- */
/* Theme Settings :: Styling
/*-------------------------------------------------------------------------- */

$setting['sections']['advanced-css'] = array(
	'title'		=> 'Advanced Styling',
	'tab'		=> 'styling'
);

//! Enable
$setting[] = array(
	'id'		=> 'advanced-css',
	'label'		=> 'Enable',
	'section'	=> 'advanced-css',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'advanced-css' => 'Enable styling options <small>(style-advanced.css)</small>'
	)
);

/* Styling : Theme Color
/*-------------------------------------------------------*/
$setting['sections']['styling-color'] = array(
	'title'		=> 'Theme Color',
	'tab'		=> 'styling'
);

//! Color
$setting[] = array(
	'id'			=> 'styling-color-1',
	'label'			=> 'Color',
	'section'		=> 'styling-color',
	'type'			=> 'colorpicker',
	'placeholder'	=> '00a8e8'
);

/* Styling : Header
/*-------------------------------------------------------*/
$setting['sections']['styling-header'] = array(
	'title'		=> 'Header',
	'tab'		=> 'styling'
);

//! Header Text Color
$setting[] = array(
	'id'			=> 'styling-header-text-color',
	'label'			=> 'Text Color',
	'section'		=> 'styling-header',
	'type'			=> 'colorpicker',
	'placeholder'	=> ''
);

//! Header BG Color
$setting[] = array(
	'id'			=> 'styling-header-bg-color',
	'label'			=> 'Background Color',
	'section'		=> 'styling-header',
	'type'			=> 'colorpicker',
	'placeholder'	=> 'ffffff'
);

//! Header BG Image
$setting[] = array(
	'id'		=> 'styling-header-bg-image',
	'label'		=> 'Background Image',
	'section'	=> 'styling-header',
	'type'		=> 'image'
);

//! Header BG Image Repeat
$setting[] = array(
	'id'		=> 'styling-header-bg-image-repeat',
	'label'		=> 'Background Image Repeat',
	'section'	=> 'styling-header',
	'type'		=> 'select',
	'choices'	=> array(
		'repeat'	=> 'repeat',
		'no-repeat' => 'no-repeat',
		'repeat-x'	=> 'repeat-x',
		'repeat-y'	=> 'repeat-y'
	)
);

/* Styling : Subheader
/*-------------------------------------------------------*/
$setting['sections']['styling-subheader'] = array(
	'title'		=> 'Subheader',
	'tab'		=> 'styling'
);

//! Subheader BG Color
$setting[] = array(
	'id'			=> 'styling-subheader-bg-color',
	'label'			=> 'Background Color',
	'section'		=> 'styling-subheader',
	'type'			=> 'colorpicker',
	'placeholder'	=> '333333'
);

//! Subheader BG Image
$setting[] = array(
	'id'		=> 'styling-subheader-bg-image',
	'label'		=> 'Background Image',
	'section'	=> 'styling-subheader',
	'type'		=> 'image'
);

//! Subheader BG Image Repeat
$setting[] = array(
	'id'		=> 'styling-subheader-bg-image-repeat',
	'label'		=> 'Background Image Repeat',
	'section'	=> 'styling-subheader',
	'type'		=> 'select',
	'choices'	=> array(
		'repeat'	=> 'repeat',
		'no-repeat' => 'no-repeat',
		'repeat-x'	=> 'repeat-x',
		'repeat-y'	=> 'repeat-y'
	)
);

/* Styling : Body
/*-------------------------------------------------------*/
$setting['sections']['styling-body'] = array(
	'title'		=> 'Body',
	'tab'		=> 'styling'
);

//! Body BG Color
$setting[] = array(
	'id'			=> 'styling-body-bg-color',
	'label'			=> 'Background Color',
	'section'		=> 'styling-body',
	'type'			=> 'colorpicker',
	'placeholder'	=> 'fcfcfc'
);

//! Body BG Image
$setting[] = array(
	'id'		=> 'styling-body-bg-image',
	'label'		=> 'Background Image',
	'section'	=> 'styling-body',
	'type'		=> 'image'
);

//! Body BG Image Repeat
$setting[] = array(
	'id'		=> 'styling-body-bg-image-repeat',
	'label'		=> 'Background Image Repeat',
	'section'	=> 'styling-body',
	'type'		=> 'select',
	'choices'	=> array(
		'repeat'	=> 'repeat',
		'no-repeat' => 'no-repeat',
		'repeat-x'	=> 'repeat-x',
		'repeat-y'	=> 'repeat-y'
	)
);

/* Styling : Footer
/*-------------------------------------------------------*/
$setting['sections']['styling-footer'] = array(
	'title'		=> 'Footer',
	'tab'		=> 'styling'
);

//! Footer BG Color
$setting[] = array(
	'id'			=> 'styling-footer-bg-color',
	'label'			=> 'Background Color',
	'section'		=> 'styling-footer',
	'type'			=> 'colorpicker',
	'placeholder'	=> '222222'
);

//! Footer BG Image
$setting[] = array(
	'id'		=> 'styling-footer-bg-image',
	'label'		=> 'Background Image',
	'section'	=> 'styling-footer',
	'type'		=> 'image'
);

//! Footer BG Image Repeat
$setting[] = array(
	'id'		=> 'styling-footer-bg-image-repeat',
	'label'		=> 'Background Image Repeat',
	'section'	=> 'styling-footer',
	'type'		=> 'select',
	'choices'	=> array(
		'repeat'	=> 'repeat',
		'no-repeat' => 'no-repeat',
		'repeat-x'	=> 'repeat-x',
		'repeat-y'	=> 'repeat-y'
	)
);

/* Styling : Misc
/*-------------------------------------------------------*/
$setting['sections']['styling-misc'] = array(
	'title'		=> 'Misc',
	'tab'		=> 'styling'
);

//! Shadows 1
$setting[] = array(
	'id'		=> 'styling-misc-shadows-1',
	'label'		=> 'Subheader & Footer Shadows',
	'section'	=> 'styling-misc',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'styling-misc-shadows-1'=> 'Disable'
	)
);
$setting[] = array(
	'id'		=> 'styling-misc-shadows-2',
	'label'		=> 'Header & Subfooter Shadows',
	'section'	=> 'styling-misc',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'styling-misc-shadows-2'=> 'Disable'
	)
);