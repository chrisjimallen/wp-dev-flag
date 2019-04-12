<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link  https://chrisjallen.com
 * @since 1.0.0
 *
 * @package    Wp_Dev_Flag
 * @subpackage Wp_Dev_Flag/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Dev_Flag
 * @subpackage Wp_Dev_Flag/public
 * @author     Chris Allen <me@chrisjallen.com>
 */
class Wp_Dev_Flag_Public {


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
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Dev_Flag_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Dev_Flag_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		/**
		 * The scripts wil only be enqueued if the badge is meant to be shown.
		 */
		if ( get_option( 'wp_dev_flag_show_flag' ) ) {
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-dev-flag-public.js', array( 'jquery' ), $this->version, false );
			wp_localize_script( $this->plugin_name, 'wp_dev_flag_options', array_merge( get_option( 'wp_dev_flag_trigger_options' ), get_option( 'wp_dev_flag_display_options' ) ) );
		}

	}

}
