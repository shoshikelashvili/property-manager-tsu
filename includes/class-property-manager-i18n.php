<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       Rati Shoshikelashvili, Irakli Kapanadze, Luka Metreveli
 * @since      1.0.0
 *
 * @package    Property_Manager
 * @subpackage Property_Manager/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Property_Manager
 * @subpackage Property_Manager/includes
 * @author     Rati Shoshikelashvili, Irakli Kapanadze, Luka Metreveli <rati.shoshikelashvili@gmail.com>
 */
class Property_Manager_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'property-manager',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
