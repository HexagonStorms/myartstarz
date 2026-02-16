<?php
/**
 * Title: Announcement Banner
 * Slug: myartstarz-fse/announcement
 * Categories: myartstarz
 * Description: Seasonal announcement banner for class registration and updates.
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"bottom":{"color":"var:preset|color|accent-6","width":"1px"},"top":{"color":"var:preset|color|accent-6","width":"1px"}}},"backgroundColor":"accent-5","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-accent-5-background-color has-background" style="border-top-color:var(--wp--preset--color--accent-6);border-top-width:1px;border-bottom-color:var(--wp--preset--color--accent-6);border-bottom-width:1px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
	<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"clamp(1.5rem, 3vw, 2rem)","fontWeight":"800","textTransform":"uppercase"}},"textColor":"accent-1"} -->
	<h2 class="wp-block-heading has-text-align-center has-accent-1-color has-text-color" style="font-size:clamp(1.5rem, 3vw, 2rem);font-weight:800;text-transform:uppercase">Spring Classes Beginning in January</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.1rem","fontWeight":"600"}},"textColor":"accent-2"} -->
	<p class="has-text-align-center has-accent-2-color has-text-color" style="font-size:1.1rem;font-weight:600">Registration Opening Soon &mdash; Be Sure to Reserve Your Spot!</p>
	<!-- /wp:paragraph -->

	<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.95rem"},"spacing":{"margin":{"top":"var:preset|spacing|30"}}},"textColor":"contrast"} -->
	<p class="has-text-align-center has-contrast-color has-text-color" style="margin-top:var(--wp--preset--spacing--30);font-size:0.95rem">Visit <a href="/class-locations">Class Locations</a> to see a complete listing of classes, or click below to register and pay supply fees.</p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
	<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)">
		<!-- wp:button {"style":{"typography":{"fontWeight":"700"}}} -->
		<div class="wp-block-button" style="font-weight:700"><a class="wp-block-button__link wp-element-button" href="/classes">Register for Classes / Pay Supply Fee</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
