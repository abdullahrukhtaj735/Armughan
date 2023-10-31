<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dora
 */

get_header();
?>

<div class="blog-area">
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
		<?php if (!empty(is_active_sidebar('custom-blog-widget'))) : ?>
			<div class="blog-sidebar">
				<?php get_sidebar(); ?></div>
		<?php endif ?>
	</div>
</div>
<?php
get_footer();
