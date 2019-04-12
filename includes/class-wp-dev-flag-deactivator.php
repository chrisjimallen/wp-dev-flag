<?php

/**
 * Fired during plugin deactivation
 *
 * @link  https://chrisjallen.com
 * @since 1.0.0
 *
 * @package    Wp_Dev_Flag
 * @subpackage Wp_Dev_Flag/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Wp_Dev_Flag
 * @subpackage Wp_Dev_Flag/includes
 * @author     Chris Allen <me@chrisjallen.com>
 */
class Wp_Dev_Flag_Deactivator {


	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since 1.0.0
	 */
	public static function deactivate() {

		delete_option( 'wp_dev_flag_trigger_options' );
		delete_option( 'wp_dev_flag_display_options' );
		delete_option( 'wp_dev_flag_show_flag' );

	}

}
