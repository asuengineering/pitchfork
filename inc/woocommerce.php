<?php

/**
 * WooCommerce Compatibility File
 *
 * @package Byvex
 */


// Unhook the WooCommerce wrappers;
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


// Own functions to display the wrappers your theme requires
function byvex_wrapper_start()
{
    echo '<section class="container py-4">';
}
add_action('woocommerce_before_main_content', 'byvex_wrapper_start', 10);
function byvex_wrapper_end()
{
    echo '</section>';
}
add_action('woocommerce_after_main_content', 'byvex_wrapper_end', 10);


// Setup functions
function byvex_woocommerce_support()
{
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'byvex_woocommerce_support');


// Disbable Extra WooCoomerce Sidebar
function disable_woo_commerce_sidebar()
{
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
}
add_action('init', 'disable_woo_commerce_sidebar');
