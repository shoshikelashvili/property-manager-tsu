<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       Rati Shoshikelashvili, Irakli Kapanadze, Luka Metreveli
 * @since      1.0.0
 *
 * @package    Property_Manager
 * @subpackage Property_Manager/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Property_Manager
 * @subpackage Property_Manager/admin
 * @author     Rati Shoshikelashvili, Irakli Kapanadze, Luka Metreveli <rati.shoshikelashvili@gmail.com>
 */
class Property_Manager_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Property_Manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Property_Manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/property-manager-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'bootstrap-css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
		
		
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Property_Manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Property_Manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/property-manager-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'bootstrap-js', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );

	}

	private $submenu_array = array(
		['Name' => 'Settings', 'Slug' => 'settings', 'callback' => 'settings_display'],
		['Name' => 'Add Properties', 'Slug' => 'add_properties', 'callback' => 'add_properties_display'],
		['Name' => 'Edit Properties', 'Slug' => 'edit_properties', 'callback' => 'edit_properties_display'],
		['Name' => 'Delete Properties', 'Slug' => 'delete_properties', 'callback' => 'delete_properties_display'],
	);

	/**
	 * Adds custom settings menu
	 *
	 * @since    1.0.0
	 */
	public function add_manager_menu() {

		add_menu_page(
            'Property Management',
            'Property Management',
            'manage_options',
            'property_management',
            array($this, 'main_dashboard_display'),
            'dashicons-admin-home',
            9
        );

		foreach($this->submenu_array as $submenu)
		{
			add_submenu_page( 
				'property_management', 
				$submenu['Name'],
				$submenu['Name'], 
				'manage_options', 
				$submenu['Slug'],
				array( $this , $submenu['callback'] )
			);
		}
	}

	/**
	 * Returning the main dashboard view
	 *
	 * @since    1.0.0
	 */
	public function main_dashboard_display(){
		require_once 'partials/main-dashboard.php';
	}

	/**
	 * Returning the settings view
	 *
	 * @since    1.0.0
	 */
	public function settings_display(){
		require_once 'partials/settings.php';
	}

	/**
	 * Returning the add properties view
	 *
	 * @since    1.0.0
	 */
	public function add_properties_display(){
		require_once 'partials/add-properties.php';
	}

	/**
	 * Returning the edit properties view
	 *
	 * @since    1.0.0
	 */
	public function edit_properties_display(){
		require_once 'partials/edit-properties.php';
	}

	/**
	 * Returning the delete properties view
	 *
	 * @since    1.0.0
	 */
	public function delete_properties_display(){
		require_once 'partials/delete-properties.php';
	}

}
