<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Dora
 */

get_header();
?>

<div class="blog-area search-content-page">
	<div class="container">
		<?php if (have_posts()) :
			if (is_home() && !is_front_page()) :
		?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php
			endif;
			?>

			<div class="blogs">
				<?php while (have_posts()) : the_post();
					get_template_part('template-parts/content', get_post_format());
				endwhile ?>
				<div class="paggination">
					<?php dora_pagination('<i class="far fa-angle-left"></i>', '<i class="far fa-angle-right"></i>', '', ['class' => '']); ?>
				</div>
			</div>
		<?php else :
			get_template_part('template-parts/content', 'none'); ?>
		<?php endif; ?>
		<div class="blog-sidebar">
			<?php get_sidebar(); ?></div>
	</div>
</div>
<?php
get_footer();
