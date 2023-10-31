<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dora
 */
$footer_text = get_theme_mod('dora_footer_text', __('<p>Developed with love by <a href="https://dora.net/" class="customize-unpreviewable">Codeefly</a> © 2023</p>', 'dora'));
$dora_footer_switch = get_theme_mod('dora_footer_switch', true);
$dora_megic_cursor = get_theme_mod('dora_megic_cursor', false);
?>
<?php if ($dora_footer_switch == true) : ?>
	<footer class="copyright wow fadeInUp">
		<div class="container">
			<?php if (!empty($footer_text)) :
				echo	dora_kses($footer_text);
			endif ?>
		</div>
	</footer>
<?php endif ?>

<?php wp_footer(); ?>
<?php if (!empty($dora_megic_cursor)) : ?>
	<div class="cursor"></div>
<?php endif ?>
</body>

</html>