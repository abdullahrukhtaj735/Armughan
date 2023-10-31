<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dora
 */
if (!is_active_sidebar('custom-blog-widget')) {
	return;
}
?>
<?php dynamic_sidebar('custom-blog-widget');
