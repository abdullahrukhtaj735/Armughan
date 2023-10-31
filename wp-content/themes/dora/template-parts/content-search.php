<?php

/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dora
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog'); ?>>
	<?php if (has_post_thumbnail()) : ?>
		<a href="<?php the_permalink() ?>" class="blog-img">
			<?php the_post_thumbnail('full', ['class' => 'img-responsive']) ?>
		</a>
	<?php endif ?>
	<div class="blog-meta">
		<?php if (!empty($categories[0]->name)) : ?>
			<a href="<?php print esc_url(get_category_link($categories[0]->term_id)) ?>" class="category"><?php echo esc_html($categories[0]->name) ?></a>
		<?php endif ?>
		<span>/</span>
		<?php if (!empty(get_the_author_meta('ID'))) : ?>
			<a href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))) ?>" class="author"><?php print get_the_author() ?></a>
		<?php endif ?>
	</div>
	<h3>
		<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
	</h3>
	<?php the_excerpt(); ?>
	<a href="<?php the_permalink() ?>" class="btn primary-btn"><?php echo esc_html__('Read More', 'dora') ?></a>
</article>