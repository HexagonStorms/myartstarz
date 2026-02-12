<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Features Template
 * Displays features using the woothemes_features action.
 *
 * @see woo_display_features()
 */
?>

<?php if ( class_exists( 'Woothemes_Features' ) ) { ?>

	<section class="features">

		<h1 class="section-title"><?php _e( 'Features', 'woothemes' ); ?></h1>

		<?php

		$limit 		= apply_filters( 'woo_template_features_limit', $features_limit = 3 );
		$columns 	= apply_filters( 'woo_template_features_columns', $features_columns = 3 );

		do_action( 'woothemes_features', apply_filters( 'woo_template_features_args', array(
			'limit' 	=> $limit,
			'per_row' 	=> $columns
			) )
		);

		?>

	</section>

<?php }