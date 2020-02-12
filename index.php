<?php
/**
 * @package WoocommerceConnection
 * @version 1.0.0
 */
/*
Plugin Name: Woocommerce Connection
Description: Add functionalities to wc api.
Author: LOUD s.r.l.
Version: 1.0.0
Author URI: https://loudsrl.com
*/

if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) return;


add_action("woocommerce_rest_insert_product", "wc_api_insert_product_connection_hook", 10, 2);



function wc_api_insert_product_connection_hook( WP_Post $product, WP_REST_Request $request ) {

    if($product instanceof WP_Post && ($body = $request->get_body_params()) && ($taxs = $body['taxonomies'])) {

        foreach ($taxs as $tax) {

	        wp_set_object_terms($product->ID, $tax['terms'], $tax['taxonomy'], true);

        }

    }

}


