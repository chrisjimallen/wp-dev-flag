<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link    https://chrisjallen.com
 * @since   1.0.0
 * @package Wp_Dev_Flag
 *
 * @wordpress-plugin
 * Plugin Name:       WP Dev Flag
 * Description:       Shows a floating badge on the front end, to visually distinguish your development site from production.
 * Version:           1.0.0
 * Author:            Chris Allen
 * Author URI:        https://chrisjallen.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-dev-flag
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_DEV_FLAG_VERSION', '1.0.0' );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-dev-flag-deactivator.php
 */
function deactivate_wp_dev_flag() {
	include_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-dev-flag-deactivator.php';
	Wp_Dev_Flag_Deactivator::deactivate();
}

register_deactivation_hook( __FILE__, 'deactivate_wp_dev_flag' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-dev-flag.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function run_wp_dev_flag() {
	$plugin = new Wp_Dev_Flag();
	$plugin->run();

}
run_wp_dev_flag();
