<?php

/* should be set for a proper Wordpress theme*/

if ( ! isset( $content_width ) ) {
	
	$content_width = 777;
	
}



/**
 * Proper way to enqueue scripts and styles
 *  wp_enqueue_script( $handle, $source, $dependencies, $version,
 */


function cerulean_theme_scripts() {

	wp_enqueue_script( 'tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js', false );

	wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css', false );

	wp_enqueue_script( 'bootstrapjs', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js', array('jquery'), false, true );

	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', false );
	
	wp_enqueue_script( 'theme', get_stylesheet_directory_uri() . '/js/theme.js', array('jquery', 'bootstrap'), false, true );

	wp_enqueue_style( 'core',  get_stylesheet_directory_uri(). '/style.css', false );	
}

add_action( 'wp_enqueue_scripts', 'cerulean_theme_scripts' );

add_theme_support( "title-tag" );

$bgargs = array(
	'default-color' => '000000',
);

add_theme_support( 'custom-background', $bgargs );

add_theme_support( 'automatic-feed-links' );

add_theme_support( "post-thumbnails" );

add_action( 'widgets_init', 'cerulean_sidebars' );


/**
 * sidebar
 */

function cerulean_sidebars() {
	
	/* Register the 'primary' sidebar. */
	
	register_sidebar(
		array(
		'id' => 'primary',
		'name' => __( 'Primary', 'cerulean-for-wordpress' ),
		'description' => __( 'Main sidebar.', 'cerulean-for-wordpress' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h1 class="widget-title text-left-title-featured-sidebar">',
		'after_title' => '</h1>'
		)
	);
	
	
	/* Repeat register_sidebar() code for additional sidebars. */
	
}

/* register main navigation */

function register_mainmenu() {
	
	register_nav_menu('header-menu',__( 'Header Menu', 'cerulean-for-wordpress' ));
	
}

add_action( 'init', 'register_mainmenu' );

// Register Custom Navigation Walker
require_once('wp-bootstrap-navwalker.php');

// Bootstrap navigation
function bootstrap_nav()
{
	wp_nav_menu( array(
            'theme_location'    => 'header-menu',
            'depth'             => 2,
            'container'         => 'false',
            'menu_class'        => 'nav navbar-nav ml-auto w-100 justify-content-end',
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new wp_bootstrap_navwalker())
    );
}


/** Display a list of pingbacks and trackbacks with the Disqus plugin **/

add_filter( 'comments_template', function( $theme_template) {

    // Check if the Disqus plugin is installed:
    if( ! function_exists( 'dsq_is_installed' ) || ! dsq_is_installed() )
        return $theme_template;

    // List comments with filters:
    $pings = wp_list_comments( 
        array(  
            'type'     => 'pings', 
            'style'    => 'ul', 
            'echo'     => 0 
        ) 
    ); 

    // Display:
    if( $pings )
        printf( "<div><ul class=\"pings commentlist\">%s</ul></div>", $pings );

    return $theme_template;

}, 9 );

/* shoutout to WPBeginner -> http://www.wpbeginner.com/wp-themes/how-to-add-numeric-pagination-in-your-wordpress-theme/ */
function cerulean_pagination_numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="pagination"><ul class="mx-auto">' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link('<i class="fa fa-chevron-left" aria-hidden="true"></i>') );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, get_pagenum_link( 1, true ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li class="pagination-dash">-</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, get_pagenum_link( $link, 1, true ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li class="pagination-dash">-</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, get_pagenum_link( $max, 1, true ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link('<i class="fa fa-chevron-right" aria-hidden="true"></i>') );

	echo '</ul></div>' . "\n";
}

/* sanitize checkbox as was asked by the theme checker */
function cerulean_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function cerulean_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'settings_section_one',
        array(
            'title' =>  __('Cerulean Settings', 'cerulean-for-wordpress'),
            'description' => __('Tweak Cerulean to your liking.', 'cerulean-for-wordpress'),
            'priority' => 35,
        )
    );

	$wp_customize->add_setting(
		'display_slider',
		array(
			'default' => true,
			'sanitize_callback'	=> 'cerulean_sanitize_checkbox',
		)
	);

	
	$wp_customize->add_setting(
		'display_today',
		array(
			'default' => true,
			'sanitize_callback'	=> 'cerulean_sanitize_checkbox',
		)
	);

	$wp_customize->add_setting(
		'move_sidebar_left',
		array(
			'default' => false,
			'sanitize_callback'	=> 'cerulean_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'display_slider',
		array(
			'label' =>  __('Show slider?', 'cerulean-for-wordpress'),
			'section' => 'settings_section_one',
			'type' => 'checkbox',
		)
		);

	$wp_customize->add_control(
		'display_today',
		array(
			'label' =>  __('Show Today section?', 'cerulean-for-wordpress'),
			'section' => 'settings_section_one',
			'type' => 'checkbox',
		)
		);

	$wp_customize->add_control(
		'move_sidebar_left',
		array(
			'label' => __('Move sidebar to the left?', 'cerulean-for-wordpress'),
			'section' => 'settings_section_one',
			'type' => 'checkbox',
		)
		);

	}
add_action( 'customize_register', 'cerulean_customizer' );


/**
 * add custom site logo (to header)
 */

function cerulean_setup() {
	
	
	add_theme_support( 'custom-logo', array(
	'height'      => 64,
	'width'       => 64,
	'flex-width' => true,
	'header-text' => array( 'site-title', 'site-description' ),
	) );
	
	
}

add_action( 'after_setup_theme', 'cerulean_setup' );

load_theme_textdomain( 'cerulean-for-wordpress', get_template_directory().'/languages' );

?>
