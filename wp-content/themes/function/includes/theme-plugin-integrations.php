<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Checks if plugins are activated and loads logic accordingly.
 * @uses  class_exists() detect if a class exists
 * @uses  function_exists() detect if a function exists
 * @uses  defined() detect if a constant is defined
 */

/**
 * Projects
 * @link http://wordpress.org/plugins/projects-by-woothemes/
 */
if ( class_exists( 'Projects' ) ) {
	require_once( get_template_directory() . '/includes/integrations/projects/setup.php' );
	require_once( get_template_directory() . '/includes/integrations/projects/template.php' );
	require_once( get_template_directory() . '/includes/integrations/projects/functions.php' );
}

/**
 * Our Team
 * @link http://wordpress.org/plugins/our-team/
 */
if ( class_exists( 'Woothemes_Our_Team' ) ) {
	require_once( get_template_directory() . '/includes/integrations/our-team/our-team.php' );
}

/**
 * WooCommerce
 * @link http://wordpress.org/plugins/woocommerce/
 */
if ( is_woocommerce_activated() ) {
	require_once( get_template_directory() . '/includes/integrations/woocommerce/woocommerce.php' );
}

/**
 * Testimonials by WooThemes
 * @link http://wordpress.org/plugins/testimonials-by-woothemes/
 */
if ( class_exists( 'Woothemes_Testimonials' ) ) {
	require_once( get_template_directory() . '/includes/integrations/testimonials/testimonials.php' );
}

/**
 * Features by WooThemes
 * @link http://wordpress.org/plugins/features-by-woothemes/
 */
if ( class_exists( 'Woothemes_Features' ) ) {
	require_once( get_template_directory() . '/includes/integrations/features/features.php' );
}