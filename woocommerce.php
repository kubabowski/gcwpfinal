<?php
/**
 * WooCommerce template wrapper
 * Required for AJAX add-to-cart to work correctly
 */
get_header();
woocommerce_content();
get_footer();