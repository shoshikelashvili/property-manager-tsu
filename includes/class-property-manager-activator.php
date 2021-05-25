<?php

/**
 * Fired during plugin activation
 *
 * @link       Rati Shoshikelashvili, Irakli Kapanadze, Luka Metreveli
 * @since      1.0.0
 *
 * @package    Property_Manager
 * @subpackage Property_Manager/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Property_Manager
 * @subpackage Property_Manager/includes
 * @author     Rati Shoshikelashvili, Irakli Kapanadze, Luka Metreveli <rati.shoshikelashvili@gmail.com>
 */
class Property_Manager_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		// We need to register taxonomies on activation too, to ensure that they exist, otherwise we cant add dummy data
		self::register_taxonomies();
		self::insert_dummy_taxonomy_terms();
		self::add_agent_roles();
	}

	private static function register_taxonomies()
	{
		$labels = array(
			'name'                       => _x( 'Property Types', 'taxonomy general name'),
			'singular_name'              => _x( 'Property Type', 'Taxonomy Singular Name'),
			'all_items'                  => __( 'All Property Types', 'text_domain' ),
			'new_item_name'              => __( 'New Property Type', 'text_domain' ),
			'add_new_item'               => __( 'Add Property Type', 'text_domain' ),
			'edit_item'                  => __( 'Edit Property Type', 'text_domain' ),
			'update_item'                => __( 'Update Property Type', 'text_domain' ),
			'view_item'                  => __( 'View Property Type', 'text_domain' )
		);
		$args = array(
			'labels'                     => $labels,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_in_rest' => true,
			'show_tagcloud'              => true,
			'rewrite' => array( 'slug' => 'property_types' )
		);
		register_taxonomy( 'property_types', array( 'property' ), $args );
	}

	private static function insert_dummy_taxonomy_terms(){
		wp_insert_term(
			'კომერციული ფართი',   // the term 
			'property_types', // the taxonomy
			array(
				'description' => 'კომერციული ფართი',
				'slug'        => 'კომ-ფართი'
			)
		);

		wp_insert_term(
			'აგარაკი',   // the term 
			'property_types', // the taxonomy
			array(
				'description' => 'აგარაკი',
				'slug'        => 'აგარაკი'
			)
		);
	}

	private static function add_agent_roles(){
		add_role( 'agent', (__('Agent','property-manager')), get_role( 'editor' )->capabilities);
	}

}
