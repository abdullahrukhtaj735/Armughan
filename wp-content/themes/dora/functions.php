<?php

/**
 * Dora functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Dora
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dora_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Dora, use a find and replace
		* to change 'dora' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('dora', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'dora'),
		)
	);

	// Add support for full and wide align images.
	add_theme_support('align-wide');

	// Add support for editor styles.
	add_theme_support('editor-styles');

	// Add support for responsive embedded content.
	add_theme_support('responsive-embeds');

	remove_theme_support('widgets-block-editor');

	add_filter('use_widgets_block_editor', '__return_false');

	add_image_size('dora-case-details', 1170, 600, ['center', 'center']);
}
add_action('after_setup_theme', 'dora_setup');


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dora_content_width()
{
	$GLOBALS['content_width'] = apply_filters('dora_content_width', 640);
}
add_action('after_setup_theme', 'dora_content_width', 0);

/**
 * Define global variable 
 */

define('DORA_THEME_DIR', get_template_directory());
define('DORA_THEME_URI', get_template_directory_uri());
define('DORA_THEME_CSS_DIR', DORA_THEME_URI . '/assets/css/');
define('DORA_THEME_JS_DIR', DORA_THEME_URI . '/assets/js/');
define('DORA_THEME_INC', DORA_THEME_DIR . '/inc/');

/**
 * Include dora require files
 */
require_once DORA_THEME_INC . 'common/dora-scripts.php';
require_once DORA_THEME_INC . 'class-navwalker.php';
require_once DORA_THEME_INC . 'common/dora-breadcrumb.php';
require_once DORA_THEME_INC . 'common/dora-widgets.php';
require_once DORA_THEME_INC . 'class-tgm-plugin-activation.php';
require_once DORA_THEME_INC . 'add_plugin.php';


/**
 * initialize kirki customizer class.
 */
include_once DORA_THEME_INC . 'kirki-customizer.php';
include_once DORA_THEME_INC . 'class-dora-kirki.php';



/**
 * Custom template tags for this theme.
 */
require DORA_THEME_INC . 'template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require DORA_THEME_INC . 'template-helper.php';
require DORA_THEME_INC . 'template-functions.php';



/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require DORA_THEME_INC . 'jetpack.php';
}
