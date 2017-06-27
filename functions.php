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

add_action( 'cmb2_admin_init', 'inze_register_theme_options_metabox' );
/**
 * Hook in and register a metabox to handle a theme options page
 */
function inze_register_theme_options_metabox() {

	$option_key = 'inze_theme_options';

	/**
	 * Registers options page menu item and form.
	 */
	$cmb_options = new_cmb2_box( array(
		'id'       => $option_key . 'page',
		'title'    => esc_html__( 'Theme Options', 'cmb2' ),
		'icon_url' => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
		'show_on'  => array(
			// Important, don't remove.
			'options-page' => $option_key,
		),
		// 'menu_title'      => esc_html__( 'Options', 'cmb2' ), // Falls back to 'title' (above).
		// 'parent_slug'     => 'themes.php', // Make options page a submenu item of the themes menu.
		// 'capability'      => 'manage_options', // Cap required to view options-page.
		// 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
		// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
		// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
		// 'save_button'     => esc_html__( 'Save Theme Options', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
	) );

	/**
	 * Options fields ids only need
	 * to be unique within this option group.
	 * Prefix is not needed.
	 */
	$cmb_options->add_field( array(
		'name'    => esc_html__( 'Site Background Color', 'cmb2' ),
		'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'      => 'bg_color',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
	) );

}

 ?>
