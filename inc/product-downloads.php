<?php

/**
* Product downloads metabox (with cmb2)
*/
add_action( 'cmb2_admin_init', 'inz_register_product_downloads_metabox' );
function inz_register_product_downloads_metabox() {
	$prefix = 'inz_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$product_downloads = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Downloads', 'inz' ),
		'object_types'  => array( 'product' ), // Post type
		// 'show_on_cb' => 'inze_show_if_front_page', // function should return a bool value
		'context'    => 'side',
		'priority'   => 'low',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'inze_add_some_classes', // Add classes through a callback.
	) );

	$product_downloads->add_field( array(
		'name'         => esc_html__( 'Downloads', 'inz' ),
		'desc'         => esc_html__( 'Upload or add multiple images/attachments.', 'inz' ),
		'id'           => $prefix . 'file_list',
		'type'         => 'file_list',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );

}


/**
* Add downloads tab
*/


add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );



function woo_new_product_tab( $tabs ) {

    if (get_post_meta( get_the_ID(), 'inz_file_list', 1 ) !== '') {
        // Adds the new tab
    	$tabs['test_tab'] = array(
    		'title' 	=> __( 'Downloads', 'inz' ),
    		'priority' 	=> 50,
    		'callback' 	=> 'woo_new_product_tab_content'
    	);
    }



	return $tabs;

}
function woo_new_product_tab_content() {

	// The new tab content

	echo '<h2>'.__( 'Downloads', 'woocommerce' ).'</h2>';

    // Get the list of files
	$product_downloads = get_post_meta( get_the_ID(), 'inz_file_list', 1 );

	echo '<ul class="file-list-wrap">';
	// Loop through them and output an image
	foreach ( (array) $product_downloads as $attachment_id => $attachment_url ) {
        $attachment_title = get_the_title($attachment_id);
		echo '<li class="file-list-image">';
        echo '<a href="' . wp_get_attachment_url( $attachment_id ) . '">';
		echo $attachment_title;
		echo '</a></li>';
	}
	echo '</ul>';

}
?>
