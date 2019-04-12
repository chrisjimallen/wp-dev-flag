<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link  https://chrisjallen.com
 * @since 1.0.0
 *
 * @package    Wp_Dev_Flag
 * @subpackage Wp_Dev_Flag/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Dev_Flag
 * @subpackage Wp_Dev_Flag/admin
 * @author     Chris Allen <me@chrisjallen.com>
 */
class Wp_Dev_Flag_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * Load the styles necessary for the plugin. In this case, the wp-color-picker library is set as a dependency to the main admin css.
		 */

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-dev-flag-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-dev-flag-admin.js', array( 'wp-color-picker', 'jquery' ), $this->version, false );

	}

	/**
	 * Register an options page for the plugin. This appears within the 'Plugins' sub menu.
	 *
	 * @since 1.0.0
	 */
	public function register_options_page() {

		add_options_page( 'WP Dev Flag Settings', 'WP Dev Flag', 'manage_options', 'wp-dev-flag', [ $this, 'render_options_page' ] );

	}
}
