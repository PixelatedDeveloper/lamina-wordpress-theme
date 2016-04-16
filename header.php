<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
    <!-- some meta -->
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
    <meta name="description" content="<?php bloginfo( 'description' ); ?>" />
    <link rel="shortcut icon" href="<?php echo get_template_directory(); ?>/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- my own css file (style.css) -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" type="text/css" />
    <!-- other used items -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/materialize.min.css">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/font-awesome.min.css">


    <!-- rss, pingback -->
    <link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo get_feed_link( 'rss2_url' )?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

    <!-- close with wp_head -->
    <?php wp_head(); ?>
</head>

<body <?php body_class();?>>

<!-- start of the actual header -->
<header>
    <div class="navbar-fixed">
    <nav class="accentcolor">
      <div class="nav-wrapper">
        <p class="brand-logo left">
            <a href="<?php echo home_url();  ?>" class="headerurl"><?php bloginfo('name'); ?></a>
        </p>

         <ul id="nav-mobile" class="right hide-on-med-and-down">
           <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
         </ul>
         <a href="#" data-activates="slide-out" class="button-collapse right"><i class="fa fa-bars" aria-hidden="true"></i></a>

<ul id="slide-out" class="side-nav">
    <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
</ul>

</div>
</nav>

</div>
</header>
<div class="container-fluid">
<!-- <img src="<?php header_image(); ?>" height="<?php // echo get_custom_header()->height; ?>" width="<?php //echo get_custom_header()->width;?>" class="center-align"  alt="header image" /> -->
