<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dora
 */
$primary_color = get_theme_mod('primary_color', __('#fd6e0a', 'dora'));
$dark_color = get_theme_mod('dark_color', __('#15295f', 'dora'));
$text_body_color = get_theme_mod('text_body_color', __('#6f6b80', 'dora'));
$border_color = get_theme_mod('border_color', __('#f2f2f2', 'dora'));
$dora_preloader = get_theme_mod('dora_preloader', false);
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php if (!empty($dora_preloader)) : ?>
		<div class="preloader">
			<div class="preloader__container">
				<div class="preloader__container__preload">
					<div class="preloader__container__preload__dot"></div>
					<div class="preloader__container__preload__dot"></div>
					<div class="preloader__container__preload__dot"></div>
					<div class="preloader__container__preload__dot"></div>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php get_template_part('template-parts/header') ?>
	<?php do_action('dora_before_main_content'); ?>