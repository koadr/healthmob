<!DOCTYPE html> 
<html <?php language_attributes(); ?>> 
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width">

<title><?php wp_title(''); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,700italic,600italic,600,400italic,300italic,300">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/js/fancybox/jquery.fancybox.css?v=2.0.6" media="screen" />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/ie-responsive.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo get_template_directory_uri(); ?>/ie8.css" />
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
<div id="wrap">
	
	<header id="header">
		<div id="header-inner" class="container fix">
			<?php bandit::site_name(); ?>
			<?php bandit::site_desc(); ?>
			
			<?php if(!bandit::get_option('header-disable-search')): ?>
			<div id="header-search" class="fix">
				<?php get_search_form(); ?>
			</div>
			<?php endif; ?>
			
			<?php bandit::social_media_links(array('id'=>'header-social')); ?>
			
			<?php wp_nav_menu(array('container'=>'nav','container_id'=>'header-nav','container_class'=>'fix','theme_location'=>'bandit_nav_header','menu_id'=>'nav','fallback_cb'=>FALSE)); ?>
			
			<?php if(bandit::breadcrumbs_enabled()): ?>
				<div id="header-breadcrumbs">
					<?php bandit::breadcrumbs(); ?>
				</div>
			<?php endif; ?>
		</div>
	</header><!--/header-->