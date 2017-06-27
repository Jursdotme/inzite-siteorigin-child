<?php
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 60);
 ?>
