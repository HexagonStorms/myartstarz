<?php
/**
 * Title: Hero
 * Slug: myartstarz-fse/hero
 * Categories: myartstarz
 * Description: Full-width hero section with video background, headline, subtext, and CTA button.
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull mas-hero" style="margin:0;margin-top:0;margin-bottom:0;margin-block-start:0;margin-block-end:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
	<!-- wp:html -->
	<div style="position:relative;overflow:hidden;padding:clamp(80px,12vw,160px) 20px;">
		<video autoplay muted loop playsinline style="position:absolute;top:50%;left:50%;width:100%;height:100%;object-fit:cover;transform:translate(-50%,-50%);pointer-events:none;z-index:0;">
			<source src="/wp-content/themes/myartstarz-fse/assets/videos/ticker-bg.mp4" type="video/mp4">
		</video>
		<div style="position:absolute;inset:0;background:rgba(0,188,212,0.7);z-index:1;"></div>
		<div style="position:relative;z-index:2;max-width:900px;margin:0 auto;text-align:center;">
			<h1 style="color:#fff;font-size:clamp(2.5rem,5vw,4rem);font-weight:800;line-height:1.125;margin:0 0 1.25rem;">Introduce Your Child to the Wonderful World of Art</h1>
			<p style="color:#fff;font-size:1.25rem;line-height:1.5;margin:0 0 2.5rem;font-weight:300;">MyArtStarz offers creative art classes, camps, and parties for children of all ages in San Antonio. Let your child explore painting, drawing, sculpting, and more in a fun, supportive environment.</p>
			<a href="/classes" style="display:inline-block;background:#FF6F00;color:#fff;font-size:1.125rem;font-weight:700;padding:1.1rem 2.75rem;border-radius:50px;text-decoration:none;transition:transform 0.2s ease,box-shadow 0.2s ease;">Register for Classes Now</a>
		</div>
	</div>
	<!-- /wp:html -->
</div>
<!-- /wp:group -->
