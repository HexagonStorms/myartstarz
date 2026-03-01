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
	wp_enqueue_script(
		'myartstarz-cart-drawer',
		get_stylesheet_directory_uri() . '/assets/js/cart-drawer.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
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
 * Redirect old page slugs to new ones.
 */
add_action( 'template_redirect', function () {
	if ( is_404() && trim( $_SERVER['REQUEST_URI'], '/' ) === 'childrens-birthday-parties' ) {
		wp_redirect( home_url( '/art-parties/' ), 301 );
		exit;
	}
} );

/**
 * WooCommerce customizations (carried over from legacy Function theme).
 */
if ( class_exists( 'WooCommerce' ) ) {
	// Load WooCommerce block assets on all pages so the mini-cart in the header hydrates everywhere.
	add_filter( 'should_load_wc_block_assets', '__return_true' );

	// Fix: One Page Checkout plugin treats pages with no global $post (like the FSE front page)
	// as checkout pages, which hides the mini-cart. Override on the front page.
	add_filter( 'woocommerce_is_checkout', function ( $is_checkout ) {
		if ( $is_checkout && is_front_page() ) {
			return false;
		}
		return $is_checkout;
	}, 20 );

	// Change default "Add to cart" button text to "Register Now", but preserve custom button text.
	add_filter( 'woocommerce_product_single_add_to_cart_text', function ( $text ) {
		return ( strtolower( $text ) === 'add to cart' ) ? __( 'Register Now', 'myartstarz-fse' ) : $text;
	} );
	add_filter( 'woocommerce_product_add_to_cart_text', function ( $text ) {
		return ( strtolower( $text ) === 'add to cart' ) ? __( 'Register Now', 'myartstarz-fse' ) : $text;
	} );

	// Exclude supply fees from the main classes grid (they have their own section).
	add_action( 'pre_get_posts', function ( $query ) {
		if ( is_admin() || ! is_shop() ) {
			return;
		}
		if ( 'product' !== $query->get( 'post_type' ) ) {
			return;
		}
		// Skip if query already filters by product_cat (e.g., the supply fee shortcode).
		$existing = $query->get( 'tax_query' ) ?: array();
		foreach ( $existing as $clause ) {
			if ( is_array( $clause ) && isset( $clause['taxonomy'] ) && 'product_cat' === $clause['taxonomy'] ) {
				return;
			}
		}
		$existing[] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => array( 'supply-fees-district' ),
			'operator' => 'NOT IN',
		);
		$query->set( 'tax_query', $existing );
	} );

	// Custom placeholder for the order comments field.
	add_filter( 'woocommerce_checkout_fields', function ( $fields ) {
		$fields['order']['order_comments']['placeholder'] = 'Please let us know any information or special needs that your child may have.';
		return $fields;
	} );
}
