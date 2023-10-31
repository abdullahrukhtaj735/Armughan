<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Dora
 */

get_header();
?>
<section class="page-section error-404">
	<div class="container">
		<div class="error-contnet">
			<div class="error-icon-container">
				<i class="fa-light fa-hexagon-exclamation"></i>
				<!-- <i class="fa-sharp fa-solid fa-hexagon-exclamation"></i> -->
				<!-- <i class="fa-light fa-circle-exclamation"></i> -->
			</div>
			<h2 class="error-content">Oops! Page not found</h2>
			<p class="text-center">Sorry, but the page you are looking for was moved, removed, renamed or might never existed...</p>
			<?php get_search_form(); ?>
		</div>
	</div>
</section>

<?php
get_footer();
