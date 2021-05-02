<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              Rati Shoshikelashvili, Irakli Kapanadze, Luka Metreveli
 * @since             1.0.0
 * @package           Property_Manager
 *
 * @wordpress-plugin
 * Plugin Name:       Property Manager
 * Description:       This is a plugin for managing, adding and editing properties, it is made as a university project
 * Version:           1.0.0
 * Author:            Rati Shoshikelashvili, Irakli Kapanadze, Luka Metreveli
 * Author URI:        Rati Shoshikelashvili, Irakli Kapanadze, Luka Metreveli
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       property-manager
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
define( 'PROPERTY_MANAGER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-property-manager-activator.php
 */
function activate_property_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-property-manager-activator.php';
	Property_Manager_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-property-manager-deactivator.php
 */
function deactivate_property_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-property-manager-deactivator.php';
	Property_Manager_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_property_manager' );
register_deactivation_hook( __FILE__, 'deactivate_property_manager' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-property-manager.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_property_manager() {

	$plugin = new Property_Manager();
	$plugin->run();

}
run_property_manager();
