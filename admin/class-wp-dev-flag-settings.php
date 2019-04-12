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
 * The admin settings page of the plugin.
 *
 * Defines the options page
 *
 * @package    Wp_Dev_Flag
 * @subpackage Wp_Dev_Flag/admin
 * @author     Chris Allen <me@chrisjallen.com>
 */
class Wp_Dev_Flag_Settings {

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
	 * The active server environment.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    array    $version    The current web server environment.
	 */
	private $active_environment;

	/**
	 * The set server environment.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    array    $version    The current web server environment.
	 */
	private $stored_environment;

	/**
	 * Whether or not to show the flag. If the stored environment matches the current environment.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    array    $version    The current web server environment.
	 */
	private $show_flag;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name        = $plugin_name;
		$this->version            = $version;
		$this->active_environment = $this->get_environment();
		$this->stored_environment = unserialize( get_option( 'wp_dev_flag_trigger_options' )['dev_environment'] );
		$this->show_flag          = md5( serialize( $this->stored_environment ) ) === md5( serialize( $this->active_environment ) );

	}

	/**
	 * This function introduces the theme options into the 'Appearance' menu and into a top-level
	 * 'WP Dev Flag' menu.
	 */
	public function setup_plugin_options_menu() {

		// Add the menu to the Plugins set of menu items
		add_plugins_page(
			'WP Dev Flag Options',                  // The title to be displayed in the browser window for this page.
			'WP Dev Flag Options',                  // The text to be displayed for this menu item
			'manage_options',                               // Which type of users can see this menu item
			'wp_dev_flag_options',                  // The unique ID - that is, the slug - for this menu item
			array( $this, 'render_settings_page_content' )               // The name of the function to call when rendering this menu's page
		);

	}

	/**
	 * Provides default values for the Display Options.
	 *
	 * @return array
	 */
	public function default_display_options() {

		$defaults = array(
			'horizontal'   => 'left',
			'vertical'     => 'middle',
			'bg_colour'    => '#0085ba',
			'text_colour'  => '#ffffff',
			'custom_class' => '',
			'message'      => 'Development Site',
		);

		return $defaults;

	}

	/**
	 * Fetches some useful environment info for the user, to help determine which site they are on.
	 */
	public function get_environment() {

		$environment = [
			'domain'          => $_SERVER['SERVER_NAME'],
			'server_ip'       => $_SERVER['SERVER_ADDR'],
			'server_software' => $_SERVER['SERVER_SOFTWARE'],
			'doc_root'        => $_SERVER['DOCUMENT_ROOT'],
			'server_os'       => php_uname(),
		];

		return $environment;

	}

	/**
	 * Renders a simple page to display the plugin settings.
	 */
	public function render_settings_page_content( $active_tab = '' ) {
		?>
		<!-- Create a header in the default WordPress 'wrap' container -->
		<div class="wrap">

			<h2><?php _e( 'WP Dev Flag Options', 'wp-dev-flag-plugin' ); ?></h2>
		<?php settings_errors(); ?>

		<?php
		if ( isset( $_GET['tab'] ) ) {
			$active_tab = $_GET['tab'];
		} elseif ( 'trigger_options' === $active_tab ) {
			$active_tab = 'trigger_options';
		} elseif ( 'display_options' === $active_tab ) {
			$active_tab = 'display_options';
		} else {
			$active_tab = 'trigger_options';
		} // end if/else
		?>

			<h2 class="nav-tab-wrapper">
				<a href="?page=wp_dev_flag_options&tab=trigger_options" class="nav-tab <?php echo 'trigger_options' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php _e( 'Trigger Options', 'wp-dev-flag-plugin' ); ?></a>
				<a href="?page=wp_dev_flag_options&tab=display_options" class="nav-tab <?php echo 'display_options' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php _e( 'Display Options', 'wp-dev-flag-plugin' ); ?></a>
			</h2>

			<form method="post" action="options.php">
		<?php

		if ( 'trigger_options' === $active_tab ) {

			settings_fields( 'wp_dev_flag_trigger_options' );
			do_settings_sections( 'wp_dev_flag_trigger_options' );

			$options = get_option( 'wp_dev_flag_trigger_options' );

			if ( isset( $options['update_environment'] ) ) {

				$markup  = '<p>' . __( 'Development Flag is set for the following environment:', 'wp-dev-flag-plugin' ) . '</p>';
				$markup .= '<div class="wp_dev_flag info active">';
				$markup .= '<ul>';
				$markup .= '<li><strong>Domain Name: </strong><code>' . $this->active_environment['domain'] . '</code></li>';
				$markup .= '<li><strong>Web Server IP Address: </strong><code>' . $this->active_environment['server_ip'] . '</code></li>';
				$markup .= '<li><strong>Web Server Software: </strong><code>' . $this->active_environment['server_software'] . '</code></li>';
				$markup .= '<li><strong>Web Server OS: </strong><code>' . $this->active_environment['server_os'] . '</code></li>';
				$markup .= '<li><strong>Web Server Root Directory: </strong><code>' . $this->active_environment['doc_root'] . '</code></li>';
				$markup .= '</ul>';
				$markup .= '</div>';

				if ( $this->stored_environment === $this->active_environment ) {

					update_option( 'wp_dev_flag_show_flag', true );
					$markup .= '<h4 class="match">Development environment is set. The flag WILL be shown on the front end.</h4>';

				} else {

					delete_option( 'wp_dev_flag_show_flag' );
					$markup .= '<h4 class="nomatch">The above details do not match your current webserver environment. Click \'Update Settings\' to fix.</h4>';

				}

				echo $markup;

			}
		} else {

			settings_fields( 'wp_dev_flag_display_options' );
			do_settings_sections( 'wp_dev_flag_display_options' );

		}

		submit_button( 'Update Settings' );

		?>
			</form>

		</div><!-- /.wrap -->
		<?php
	}

	/**
	 * This function provides a simple description for the Trigger Options page.
	 *
	 * It's called from the 'initialize_trigger_options' function by being passed as a parameter
	 * in the add_settings_section function.
	 */
	public function trigger_options_callback() {
		$options = get_option( 'wp_dev_flag_trigger_options' );

		$environment = $this->active_environment;
		$markup      = '<p>' . __( 'Current environment:', 'wp-dev-flag-plugin' ) . '</p>';
		$markup     .= '<div class="wp_dev_flag info">';
		$markup     .= '<ul>';
		$markup     .= '<li><strong>Domain Name: </strong><code>' . $environment['domain'] . '</code></li>';
		$markup     .= '<li><strong>Web Server IP Address: </strong><code>' . $environment['server_ip'] . '</code></li>';
		$markup     .= '<li><strong>Web Server Software: </strong><code>' . $environment['server_software'] . '</code></li>';
		$markup     .= '<li><strong>Web Server OS: </strong><code>' . $environment['server_os'] . '</code></li>';
		$markup     .= '<li><strong>Web Server Root Directory: </strong><code>' . $environment['doc_root'] . '</code></li>';
		$markup     .= '</ul>';
		$markup     .= '</div>';

		echo $markup;

	} // end general_options_callback

	/**
	 * This function provides a simple description for the Display Options page.
	 *
	 * It's called from the 'initialize_display_options' function by being passed as a parameter
	 * in the add_settings_section function.
	 */
	public function display_options_callback() {
		$options = get_option( 'wp_dev_flag_display_options' );
		echo '<p>' . __( 'Choose the position, colour & default text of your WP Dev Flag badge.', 'wp-dev-flag-plugin' ) . '</p>';
	}

	/**
	 * Initializes the theme's display options page by registering the Sections,
	 * Fields, and Settings.
	 *
	 * This function is registered with the 'admin_init' hook.
	 */
	public function initialize_trigger_options() {

		// First, we add a settings section to contain all the settings fields.
		add_settings_section(
			'trigger_settings_section',                    // ID used to identify this section and with which to register options
			__( 'Trigger Options', 'wp-dev-flag-plugin' ), // Title to be displayed on the administration page
			array( $this, 'trigger_options_callback' ),    // Callback used to render the description of the section
			'wp_dev_flag_trigger_options'                  // Page on which to add this section of options
		);

		// The checkbox to determine if you want to set the current environment as development.
		add_settings_field(
			'update_environment',                                   // ID used to identify the field throughout the theme
			__( 'Set This As Development?', 'wp-dev-flag-plugin' ), // The label to the left of the option interface element
			array( $this, 'update_environment_callback' ),          // The name of the function responsible for rendering the option interface
			'wp_dev_flag_trigger_options',                          // The page on which this option will be displayed
			'trigger_settings_section',                             // The name of the section to which this field belongs
			array(                                                  // The array of arguments to pass to the callback. In this case, just a description.
				__( 'This will flag the current environment as development, displaying the badge on the front end.', 'wp-dev-flag-plugin' ),
			)
		);

		// A hidden field to pass the current environment and store it as 'dev_environment'.
		add_settings_field(
			'dev_environment',                           // ID used to identify the field throughout the theme
			'',                                          // The label to the left of the option interface element (blank in this case)
			array( $this, 'dev_environment_callback' ),  // The name of the function responsible for rendering the option interface
			'wp_dev_flag_trigger_options',               // The page on which this option will be displayed
			'trigger_settings_section',                  // The name of the section to which this field belongs
			[ 'class' => 'hidden' ]
		);

		// Finally, we register the fields with WordPress
		register_setting(
			'wp_dev_flag_trigger_options',
			'wp_dev_flag_trigger_options'
		);

	} // end initialize_trigger_options

	/**
	 * Initializes the theme's display options by registering the Sections,
	 * Fields, and Settings.
	 *
	 * This function is registered with the 'admin_init' hook.
	 */
	public function initialize_display_options() {

		// Set the defaults for the display settings, if none exist.
		if ( false === get_option( 'wp_dev_flag_display_options' ) ) {
			$default_array = $this->default_display_options();
			update_option( 'wp_dev_flag_display_options', $default_array );
		}

		// First, we add a settings section to contain all the settings fields.
		add_settings_section(
			'display_settings_section',                    // ID used to identify this section and with which to register options
			__( 'Display Options', 'wp-dev-flag-plugin' ), // Title to be displayed on the administration page
			array( $this, 'display_options_callback' ),    // Callback used to render the description of the section
			'wp_dev_flag_display_options'                  // Page on which to add this section of options
		);

		// The horizontal position (x axis)
		add_settings_field(
			'horizontal',
			'Horizontal Position',
			array( $this, 'horizontal_callback' ),
			'wp_dev_flag_display_options',
			'display_settings_section'
		);

		// The vertical position (y axis)
		add_settings_field(
			'vertical',
			'Vertical Position',
			array( $this, 'vertical_callback' ),
			'wp_dev_flag_display_options',
			'display_settings_section'
		);

		// The badge background colour
		add_settings_field(
			'bg_colour',
			'Background Colour',
			array( $this, 'background_colour_callback' ),
			'wp_dev_flag_display_options',
			'display_settings_section'
		);

		// The badge text colour
		add_settings_field(
			'text_colour',
			'Text Colour',
			array( $this, 'text_colour_callback' ),
			'wp_dev_flag_display_options',
			'display_settings_section'
		);

		// The badge message text
		add_settings_field(
			'message',
			'Message Text',
			array( $this, 'message_callback' ),
			'wp_dev_flag_display_options',
			'display_settings_section'
		);

		// Finally, we register the fields with WordPress
		register_setting(
			'wp_dev_flag_display_options',
			'wp_dev_flag_display_options',
			array( $this, 'sanitize_display_options' )
		);

	}

	/**
	 * This function renders the checkbox field to indicate whether you want to store the environment values with WordPress
	 *
	 */
	public function update_environment_callback( $args ) {

		// First, we read the options collection
		$options = get_option( 'wp_dev_flag_trigger_options' );

		if ( ! $options['update_environment'] ) {
			delete_option( 'wp_dev_flag_show_flag' );
		}

		// Generate a checkbox and set its default checked/unchecked state.
		$html = '<input type="checkbox" id="update_environment" name="wp_dev_flag_trigger_options[update_environment]" value="1" ' . ( ( $options['update_environment'] ) ? 'checked="checked"' : '' ) . ' />';

		// Here, we'll take the first argument of the array and add it to a label next to the checkbox
		$html .= '<label for="update_environment">&nbsp;' . $args[0] . '</label>';

		echo $html;

	} // update_environment_callback

	/**
	 * This function renders the hidden field for storing the environment values.
	 *
	 */
	public function dev_environment_callback() {

		// Get the current environment and serialize it to add to the hidden field.
		$environment = htmlentities( serialize( $this->get_environment() ) );

		$html = '<input type="hidden" id="dev_environment" name="wp_dev_flag_trigger_options[dev_environment]" value="' . $environment . '"/>';

		echo $html;

	} // end toggle_header_callback

	/**
	 * This function renders the radio buttons for the horizontal positioning.
	 */
	public function horizontal_callback() {

		// First, we read the social options collection
		$options = get_option( 'wp_dev_flag_display_options' );

		// Render the output
		echo '<p>';
		echo '<label for="left">Left </label>';
		echo '<input id="left" type="radio" name="wp_dev_flag_display_options[horizontal]" value="left" ' . ( ( isset( $options['horizontal'] ) && 'left' === $options['horizontal'] ) ? ' checked="checked"' : '' ) . '/>';
		echo '</p><p>';
		echo '<label for="right">Right </label>';
		echo '<input id="right" type="radio" name="wp_dev_flag_display_options[horizontal]" value="right" ' . ( ( isset( $options['horizontal'] ) && 'right' === $options['horizontal'] ) ? ' checked="checked"' : '' ) . '/>';
		echo '</p>';

	} // end horizontal_callback

	/**
	 * This function renders the radio buttons for the vertical positioning.
	 */
	public function vertical_callback() {

		// First, we read the social options collection
		$options = get_option( 'wp_dev_flag_display_options' );

		// Render the output
		echo '<p>';
		echo '<label for="top">Top </label>';
		echo '<input id="top" type="radio" name="wp_dev_flag_display_options[vertical]" value="top" ' . ( ( isset( $options['vertical'] ) && 'top' === $options['vertical'] ) ? ' checked="checked"' : '' ) . '/>';
		echo '</p><p>';
		echo '<label for="middle">Middle </label>';
		echo '<input id="middle" type="radio" name="wp_dev_flag_display_options[vertical]" value="middle" ' . ( ( isset( $options['vertical'] ) && 'middle' === $options['vertical'] ) ? ' checked="checked"' : '' ) . '/>';
		echo '</p><p>';
		echo '<label for="bottom">Bottom </label>';
		echo '<input id="bottom" type="radio" name="wp_dev_flag_display_options[vertical]" value="bottom" ' . ( ( isset( $options['vertical'] ) && 'bottom' === $options['vertical'] ) ? ' checked="checked"' : '' ) . '/>';
		echo '</p>';

	} // end vertical_callback

	/**
	 * This function renders the colour picker for the background colour setting.
	 */
	public function background_colour_callback() {

		$options = get_option( 'wp_dev_flag_display_options' );

		echo '<input name="wp_dev_flag_display_options[bg_colour]" type="text" value="' . $options['bg_colour'] . '" class="bg_colour" data-default-color="#effeff" />';

	}

	/**
	 * This function renders the colour picker for the text colour setting.
	 */
	public function text_colour_callback() {

		$options = get_option( 'wp_dev_flag_display_options' );

		echo '<input name="wp_dev_flag_display_options[text_colour]" type="text" value="' . $options['text_colour'] . '" class="text_colour" data-default-color="#effeff" />';

	}

	/**
	 * This function renders the text field for the badge message.
	 */
	public function message_callback() {

		$options = get_option( 'wp_dev_flag_display_options' );

		echo '<input name="wp_dev_flag_display_options[message]" type="text" value="' . $options['message'] . '" class="message" />';

	}

	/**
	 * Sanitization callback for the display options. Since some of the display options are text inputs,
	 * this function loops through the incoming option and strips all tags and slashes from the values
	 * before serializing it.
	 *
	 * @params $input  The unsanitized collection of options.
	 *
	 * @returns The collection of sanitized values.
	 */
	public function sanitize_display_options( $input ) {

		// Define the array for the updated options
		$output = array();

		// Loop through each of the options sanitizing the data
		foreach ( $input as $key => $val ) {

			if ( isset( $input[ $key ] ) ) {
				$output[ $key ] = strip_tags( stripslashes( $input[ $key ] ) );
			} // end if
		} // end foreach

		// Return the new collection
		return apply_filters( 'sanitize_display_options', $output, $input );

	} // end sanitize_display_options

}
