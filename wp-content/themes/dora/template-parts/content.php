<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dora
 */

$categories = get_the_terms($post->ID, 'category');

?>
<?php if (is_single()) : ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if (has_post_thumbnail()) : ?>
			<?php the_post_thumbnail('full', ['class' => 'img-responsive']) ?>
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
		<h3 class="title">
			<?php the_title() ?>
		</h3>
		<?php the_content(); ?>
		<?php
		wp_link_pages([
			'before' => '<div class="page-links">' . esc_html__('Pages:', 'dora'),
			'after' => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after' => '</span>',
		]);
		?>
		<?php print dora_get_tag(); ?>
	</article>
<?php else : ?>
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
<?php endif; ?>