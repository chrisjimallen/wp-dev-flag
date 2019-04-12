<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link  https://chrisjallen.com
 * @since 1.0.0
 *
 * @package    Wp_Dev_Flag
 * @subpackage Wp_Dev_Flag/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Dev_Flag
 * @subpackage Wp_Dev_Flag/includes
 * @author     Chris Allen <me@chrisjallen.com>
 */
class Wp_Dev_Flag_I18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since 1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-dev-flag',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
