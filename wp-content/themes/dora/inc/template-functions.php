<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Dora
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function dora_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'dora_pingback_header');


// dora_search_filter_form
if (!function_exists('dora_search_filter_form')) {
	function dora_search_filter_form($form)
	{
		$form = sprintf(
			'<form class="dora_search" action="%s" method="get">
		<input type="text" placeholder="Search your keyword..." value="%s" name="s" required id="search">
		<button type="submit">
		<i class="fa-light fa-magnifying-glass"></i>
		</button>
	   </form>',
			esc_url(home_url('/')),
			esc_attr(get_search_query()),
			esc_html__('Search', 'dora')
		);

		return $form;
	}
	add_filter('get_search_form', 'dora_search_filter_form');
}


// dora_comment 
if (!function_exists('dora_comment')) {
	function dora_comment($comment, $args, $depth)
	{
		$GLOBAL['comment'] = $comment;
		extract($args, EXTR_SKIP);
		$args['reply_text'] = 'Reply';
		$replayClass = 'comment-depth-' . esc_attr($depth);
?>
		<li id="comment-<?php comment_ID(); ?>">
			<div class="comments-box">
				<div class="comments-avatar">
					<?php print get_avatar($comment, 102, null, null, ['class' => []]); ?>
				</div>
				<div class="comments-text">
					<div class="avatar-name">
						<h5><?php print get_comment_author_link(); ?></h5>
						<span class="post-meta"><?php comment_time(get_option('date_format')); ?></span>
					</div>
					<?php comment_text(); ?>

					<div class="comment-reply">
						<?php comment_reply_link(array_merge($args, ['depth' => $depth, 'max_depth' => $args['max_depth']])); ?>
					</div>

				</div>
			</div>
	<?php
	}
}


function add_file_types_to_uploads($file_types)
{
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes);
	return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');
