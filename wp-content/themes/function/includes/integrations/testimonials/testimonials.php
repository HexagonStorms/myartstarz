<?php
/**
 * Integrates this theme with the Testimonials by WooThemes plugin
 * http://wordpress.org/plugins/testimonials-by-woothemes/
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Support Declaration
 * @since   1.0.0
 * @return  void
 */
function woo_testimonials_support() {
	add_theme_support( 'testimonials-by-woothemes' );
}
add_action( 'after_setup_theme', 'woo_testimonials_support' );

/**
 * Styles
 * @since   1.0.0
 * @return  void
 */
function woo_testimonials_scripts() {
	wp_register_style( 'woo-testimonials-css', get_template_directory_uri() . '/includes/integrations/testimonials/css/testimonials.css' );
	wp_enqueue_style( 'woo-testimonials-css' );
}
add_action( 'wp_enqueue_scripts', 'woo_testimonials_scripts', 10 );

/**
 * Customise Testimonials
 * Change the default testimonials columns to 3. Change the Gravatar size to 100.
 * @param  integer $args['per_row'] Number of columns to display
 * @param  integer $args['size'] Gravatar size
 * @return array Testimonials args
 */
function woo_customise_testimonials( $args ) {
	$args['per_row'] 	= 3;
	$args['size']		= 100;
	return $args;
}
add_filter( 'woothemes_testimonials_default_args', 'woo_customise_testimonials', 10 );