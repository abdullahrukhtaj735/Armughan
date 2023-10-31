<?php

namespace CFCore;

use CFCore\PageSettings\Page_Settings;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin
{

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Add Category
	 */

	public function cf_core_elementor_category($manager)
	{
		$manager->add_category(
			'cf-core',
			array(
				'title' => esc_html__('CF Core', 'cf-core'),
				'icon' => 'eicon-banner',
			)
		);
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts()
	{
		wp_register_script('cfcore', plugins_url('/assets/js/hello-world.js', __FILE__), ['jquery'], false, true);
	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts()
	{
		add_filter('script_loader_tag', [$this, 'editor_scripts_as_a_module'], 10, 2);

		wp_enqueue_script(
			'cfcore-editor',
			plugins_url('/assets/js/editor/editor.js', __FILE__),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}

	/**
	 * cf_enqueue_editor_scripts
	 */
	public function cf_enqueue_editor_scripts()
	{
		wp_enqueue_style('cf-element-addons-editor', CFCORE_ADDONS_URL . 'assets/css/elementor.css', null, '1.0');
		wp_enqueue_style('cf-element-font-awesome-pro', CFCORE_ADDONS_URL . 'assets/css/font-awesome-pro.css', null, '1.0');
	}

	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module($tag, $handle)
	{
		if ('cfcore-editor' === $handle) {
			$tag = str_replace('<script', '<script type="module"', $tag);
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */

	public function register_widgets($widgets_manager)
	{
		// Its is now safe to include Widgets files
		foreach ($this->cfcore_widget_list() as $widget_file_name) {
			require_once CFCORE_ELEMENTS_PATH . "/{$widget_file_name}.php";
		}
	}

	public function cfcore_widget_list()
	{
		return [
			'banner',
			'section-title',
			'service-section',
			'support-section',
			'skill-section',
			'feedback-section',
			'portfolio-section',
			'blog-section',
			'contact-section',
			'button',
			'cfcore-text',
			'isotope-with-filter',
			'blogs',
			'contact-from',
			'social-list',
			'service-slider',
			'tesimonial-slider',
			'skill-pogressbar',
		];
	}

	/**
	 * Add page settings controls
	 *
	 * Register new settings for a document page settings.
	 *
	 * @since 1.2.1
	 * @access private
	 */
	private function add_page_settings_controls()
	{
		require_once __DIR__ . '/page-settings/manager.php';
		new Page_Settings();
	}

	public function cf_add_custom_icons_tab($tabs = array())
	{

		$fontawsomeicon = array(
			'angle-up',
			'check',
			'times',
			'calendar',
			'language',
			'shopping-cart',
			'bars',
			'search',
			'map-marker',
			'arrow-right',
			'arrow-left',
			'arrow-up',
			'arrow-down',
			'angle-right',
			'angle-left',
			'angle-up',
			'angle-down',
			'phone',
			'users',
			'user',
			'map-marked-alt',
			'trophy-alt',
			'envelope',
			'marker',
			'globe',
			'broom',
			'home',
			'bed',
			'chair',
			'bath',
			'tree',
			'laptop-code',
			'cube',
			'cog',
			'play',
			'trophy-alt',
			'heart',
			'truck',
			'user-circle',
			'map-marker-alt',
			'comments',
			'award',
			'bell',
			'book-alt',
			'book-open',
			'book-reader',
			'graduation-cap',
			'laptop-code',
			'music',
			'ruler-triangle',
			'user-graduate',
			'microscope',
			'glasses-alt',
			'theater-masks',
			'atom',
		);

		$tabs['cf-fontawesome-icons'] = array(
			'name' => 'cf-fontawesome-icons',
			'label' => esc_html__('CF - Fontawesome Pro Light', 'cfcore'),
			'labelIcon' => 'fa-brands fa-square-font-awesome codeeflyicon-elementor',
			'prefix' => 'fa-',
			'displayPrefix' => 'fal',
			'url' => CFCORE_ADDONS_URL . 'assets/css/fontawesome-all.min.css',
			'icons' => $fontawsomeicon,
			'ver' => '1.0.0',
		);

		return $tabs;
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct()
	{

		// Register widget scripts
		add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);

		// Register widgets
		add_action('elementor/widgets/register', [$this, 'register_widgets']);

		// Register Catagory
		add_action('elementor/elements/categories_registered', [$this, 'cf_core_elementor_category']);

		// Register editor scripts
		add_action('elementor/editor/after_enqueue_scripts', [$this, 'editor_scripts']);

		add_filter('elementor/icons_manager/additional_tabs', [$this, 'cf_add_custom_icons_tab']);

		// Register editor css
		add_action('elementor/editor/after_enqueue_scripts', [$this, 'cf_enqueue_editor_scripts']);

		$this->add_page_settings_controls();
	}
}

// Instantiate Plugin Class
Plugin::instance();
