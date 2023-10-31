<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Dora
 */

get_header();
?>

<div class="blog-area">
	<?php if (have_posts()) :
		if (is_home() && !is_front_page()) :
	?>
			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>
		<?php
		endif;
		?>

		<div class="container">
			<div class="blogs">
				<div class="blog-details">
					<?php while (have_posts()) : the_post();
						get_template_part('template-parts/content', get_post_type());
					endwhile ?>
					<div class="paggination">
						<?php dora_pagination('<i class="far fa-angle-left"></i>', '<i class="far fa-angle-right"></i>', '', ['class' => '']); ?>
					</div>
				</div>
				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if (comments_open() || get_comments_number()) :
					comments_template();
				endif;
				?>
			</div>
			<div class="blog-sidebar">
				<?php get_sidebar(); ?></div>
		<?php endif; ?>
		</div>
</div>
<?php
get_footer();
