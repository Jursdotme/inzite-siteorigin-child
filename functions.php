<?php

/**
* Include scripts and styles
*/

add_action( 'wp_enqueue_scripts', 'inz_enqueue_styles' );
function inz_enqueue_styles() {

    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/dist/css/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

/**
* Setup settings page
*/
// require get_stylesheet_directory() . '/inc/settings-page.php';


/**
* Include CMB2
*/
if ( file_exists( get_stylesheet_directory_uri() . 'inc/cmb2/init.php' ) ) {
	//require_once get_template_directory() . 'inc/cmb2/init.php';
}

 ?>
