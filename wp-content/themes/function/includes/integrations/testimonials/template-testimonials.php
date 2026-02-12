<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Testimonials Template
 * Displays testimonials using the woothemes_testimonials action.
 *
 * @see woo_display_testimonials()
 */
?>

<?php if ( class_exists( 'Woothemes_Testimonials' ) ) { ?>

	<section class="testimonials">

		<h1 class="section-title"><?php _e( 'Testimonials', 'woothemes' ); ?></h1>

		<?php

		$limit 		= apply_filters( 'woo_template_testimonials_limit', $testimonials_limit = 3 );
		$columns 	= apply_filters( 'woo_template_testimonials_columns', $testimonials_columns = 3 );

		do_action( 'woothemes_testimonials', apply_filters( 'woo_template_testimonials_args', array(
			'limit' 	=> $limit,
			'per_row' 	=> $columns
			) )
		);

		?>

	</section>

<?php }