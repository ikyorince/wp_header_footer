<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.shafeeamin.com
 * @since             1.0.0
 * @package           Headerfootershafee
 *
 * @wordpress-plugin
 * Plugin Name:       WP header footer injector
 * Plugin URI:        github.com/ikyorince
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Shafee Amin
 * Author URI:        www.shafeeamin.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       headerfootershafee
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
define( 'HEADERFOOTERSHAFEE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-headerfootershafee-activator.php
 */
function activate_headerfootershafee() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-headerfootershafee-activator.php';
	Headerfootershafee_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-headerfootershafee-deactivator.php
 */
function deactivate_headerfootershafee() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-headerfootershafee-deactivator.php';
	Headerfootershafee_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_headerfootershafee' );
register_deactivation_hook( __FILE__, 'deactivate_headerfootershafee' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-headerfootershafee.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_headerfootershafee() {

	$plugin = new Headerfootershafee();
	$plugin->run();

}
run_headerfootershafee();


	function shafee_admin_menu_option()
	{
		add_menu_page('Header & Footer Scripts','Scripts to add in your header and footer','manage_options','shafee-admin-menu','shafee_scripts_page','',200);
	}

	add_action('admin_menu','shafee_admin_menu_option');

	function shafee_scripts_page()
	{

		if(array_key_exists('submit_scripts_update',$_POST))
		{
			update_option('shafee_header_scripts',$_POST['header_scripts']);
			update_option('shafee_footer_scripts',$_POST['footer_script']);

			?>
			<div id="setting-error-settings-updated" class="updated_settings_error notice is-dismissible"><strong>Settings have been saved.</strong></div>
			<?php

		}

		$header_scripts = get_option('shafee_header_scripts','none');
		$footer_scripts = get_option('shafee_footer_scripts','none');


		?>
		<div class="wrap">
			<h2>Update Scripts</h2>
			<form method="post" action="">
			<label for="header_scripts">Header Scripts</label>
			<textarea name="header_scripts" class="large-text"><?php print $header_scripts; ?></textarea>
			<label for="footer_scripts">Footer Scripts</label>
			<textarea name="footer_script" class="large-text"><?php print $footer_scripts; ?></textarea>
			<input type="submit" name="submit_scripts_update" class="button button-primary" value="UPDATE SCRIPTS">
			</form>
		</div>	
		<?php
	}


	function shafee_display_header_scripts()
	{
		$header_scripts = get_option('shafee_header_scripts','none');

		print $header_scripts;
	}
	add_action('wp_head','shafee_display_header_scripts');

	function shafee_display_footer_scripts()
	{
		$footer_scripts = get_option('shafee_footer_scripts','none');
		print $footer_scripts;
	}
	add_action('wp_footer','shafee_display_footer_scripts');

