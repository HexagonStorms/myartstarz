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
	wp_enqueue_script(
		'myartstarz-class-title-format',
		get_stylesheet_directory_uri() . '/assets/js/class-title-format.js',
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

	// Change default "Add to cart" button text, but preserve custom button text.
	// Supply fees read "Pay Now"; everything else (classes, camps) reads "Register Now".
	$mas_supply_fee_cats = array( 'supply-fees-district', 'supply-fees' );
	$mas_cart_button_text = function ( $text, $product ) use ( $mas_supply_fee_cats ) {
		if ( strtolower( $text ) !== 'add to cart' ) {
			return $text;
		}
		if ( $product instanceof WC_Product && has_term( $mas_supply_fee_cats, 'product_cat', $product->get_id() ) ) {
			return __( 'Pay Now', 'myartstarz-fse' );
		}
		return __( 'Register Now', 'myartstarz-fse' );
	};
	add_filter( 'woocommerce_product_single_add_to_cart_text', function ( $text ) use ( $mas_cart_button_text ) {
		global $product;
		return $mas_cart_button_text( $text, $product );
	} );
	add_filter( 'woocommerce_product_add_to_cart_text', function ( $text, $product = null ) use ( $mas_cart_button_text ) {
		return $mas_cart_button_text( $text, $product );
	}, 10, 2 );

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
