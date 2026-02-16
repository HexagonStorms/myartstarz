<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue parent theme (Twenty Twenty-Five) styles.
 */
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'twentytwentyfive-style',
		get_parent_theme_file_uri( 'style.css' ),
		array(),
		wp_get_theme( 'twentytwentyfive' )->get( 'Version' )
	);
	wp_enqueue_style(
		'myartstarz-fse-style',
		get_stylesheet_uri(),
		array( 'twentytwentyfive-style' ),
		wp_get_theme()->get( 'Version' )
	);
} );

/**
 * Register custom block pattern category.
 */
add_action( 'init', function () {
	register_block_pattern_category( 'myartstarz', array(
		'label' => __( 'MyArtStarz', 'myartstarz-fse' ),
	) );
} );

/**
 * Register the "portfolio" custom post type (carried over from legacy Function theme).
 * Portfolio items are displayed on the Art Gallery page.
 */
add_action( 'init', function () {
	register_post_type( 'portfolio', array(
		'labels'      => array(
			'name'          => 'Portfolio',
			'singular_name' => 'Portfolio Item',
		),
		'public'       => true,
		'has_archive'  => false,
		'show_in_rest' => true,
		'supports'     => array( 'title', 'editor', 'thumbnail' ),
		'menu_icon'    => 'dashicons-images-alt2',
		'rewrite'      => array( 'slug' => 'portfolio' ),
	) );
} );

/**
 * WooCommerce customizations (carried over from legacy Function theme).
 */
if ( class_exists( 'WooCommerce' ) ) {
	// Redirect to checkout after add-to-cart.
	add_filter( 'woocommerce_add_to_cart_redirect', function () {
		return wc_get_checkout_url();
	} );

	// Custom placeholder for the order comments field.
	add_filter( 'woocommerce_checkout_fields', function ( $fields ) {
		$fields['order']['order_comments']['placeholder'] = 'Please let us know any information or special needs that your child may have.';
		return $fields;
	} );
}
