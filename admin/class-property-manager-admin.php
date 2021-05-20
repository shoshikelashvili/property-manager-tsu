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

	#region code for adding property management menu

	private $submenu_array = array(
		['Name' => 'Settings', 'Slug' => 'settings', 'callback' => 'settings_display'],
		['Name' => 'Add/Edit/Delete Properties', 'Slug' => 'add_edit_delete_properties', 'callback' => 'add_edit_delete_properties_display'],
	);

	/**
	 * Adds custom settings menu
	 *
	 * @since    1.0.0
	 */
	public function add_manager_menu() {

		add_menu_page(
            __('Property Management','property-manager'),
            __('Property Management','property-manager'),
            'manage_options',
            'property_management',
            array($this, 'main_dashboard_display'),
            'dashicons-admin-multisite',
            9
        );

		add_submenu_page( 
			'property_management', 
			__('Settings','property-manager'),
			__('Settings','property-manager'), 
			'manage_options', 
			'settings',
			array( $this , 'settings_display')
		);

		add_submenu_page( 
			'property_management', 
			__('Edit Properties','property-manager'),
			__('Edit Properties','property-manager'), 
			'manage_options', 
			'add_edit_delete_properties',
			array( $this , 'add_edit_delete_properties_display')
		);
		
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
		require_once 'partials/add-edit-delete-properties.php';
	}

	#endregion

	#region code for adding custom post type and taxonomies

	//Functino for registering custom post type for peoprerties
	public function custom_property_type(){
		/*
		* Creating a function to create our CPT
		*/
		$labels = array(
			'name'                => _x( 'Properies', 'Post Type General Name'),
			'singular_name'       => _x( 'Property', 'Post Type Singular Name'),
			'menu_name'           => __( 'Properties'),
			'all_items'           => __( 'All Properties'),
			'view_item'           => __( 'View Property'),
			'add_new_item'        => __( 'Add New Property'),
			'add_new'             => __( 'Add New Property'),
			'edit_item'           => __( 'Edit Property'),
			'update_item'         => __( 'Update Property'),
			'search_items'        => __( 'Search Property'),
			'not_found'           => __( 'Property Not Found'),
			'parent_item_colon'  => '',
			'not_found_in_trash'  => __( 'Property Not found in Trash'),
		);
		
		// Set other options for Custom Post Type
		
		$args = array(
			'label'               => __( 'properties'),
			'description'         => __( 'Holds properties and data about them'),
			'labels'              => $labels,
			'menu_icon' => 'dashicons-admin-home',
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields', ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			// 'taxonomies'          => array( 'genres' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/ 
			'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
			'publicly_queryable' => true,  // you should be able to query it
			'show_ui' => true,  // you should be able to edit it in wp-admin
			'exclude_from_search' => true,  // you should exclude it from search results
			'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
			'has_archive' => false,  // it shouldn't have archive page
			'rewrite' => false,  // it shouldn't have rewrite rules
			'menu_position'       => 5,
			'has_archive'         => true,
			'show_in_rest' => true,
			'capability_type'     => array('property','properties'),
			'map_meta_cap'        => true,
			// 'capability_type'     => 'post',
			// 'show_in_rest' => true,
	
		);
		
		// Registering your Custom Post Type
		register_post_type( 'property', $args );

		//  Register taxonomies for it
		$this->register_custom_taxonomies();
	}

	public function register_custom_taxonomies(){
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

	#endregion

	#region code for defining custom meta boxes and render functions
	public function register_custom_metabox()
	{
		add_meta_box( 
			'property_details',
			__( 'Property Details'),
			array($this,'property_details_content'),
			'property',
			'normal',
			'low'
		);
		add_meta_box( 
			'property_gallery',
			__( 'Property Gallery'),
			array($this,'property_gallery_content'),
			'property',
			'normal',
			'high'
		);
	}

	public function property_details_content()
	{
		require_once 'partials/add-properties.php';
	}

	public function property_gallery_content()
	{
		require_once 'partials/property-gallery.php';
	}

	#endregion

	#region code for saving meta data from meta box
	public function save_custom_meta_box_data($post_id, $post)
	{
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		$this->save_properties_data($post_id, $post);
		$this->save_images_meta($post_id,$post);
	}

	public function save_properties_data($post_id, $post)
	{
	
		$property_fields = array('property_price','property_bedrooms', 'property_bathrooms', 'property_area', 
		'property_area', 'property_year', 'property_location', 'property_status', 'petsAllowed','property_id');
		foreach($property_fields as $field)
		{
			update_post_meta( $post_id, $field, $_POST[$field] );
		}
		
	}

	public function save_images_meta($post_id, $post)
	{
		//Delete original photos, before adding the current/new data
        $args = array(
            'post_parent' => $post_id,
            'post_type' => 'attachment',
			'post__not_in'   => array(get_post_thumbnail_id($post_id)),
			'nopaging' => true,
            'meta_query' => array(
                array(
                    'key' => 'is_custom_image',
                    'value' => '1',
                    'compare' => '=',
                )
            )
        );
        
        $posts_array = get_posts($args);
		foreach($posts_array as $post)
		{
			$path_to_file = get_attached_file($post->ID);
			wp_delete_file($path_to_file);
			wp_delete_attachment($post->ID,true);
		}

		$postId = $post_id;
		$images_JSON = stripslashes($_POST['custom_image_data']);
		$images_decoded = json_decode($images_JSON,true);
		$directory = "/".date('Y')."/".date('m')."/";
		$wp_upload_dir = wp_upload_dir();

		$i = 0;
		foreach($images_decoded as $image)
		{
			$base64 = $image['base64'];
			$data = base64_decode($base64);
			$filename = "IMG_".time().$i.".png";
			$i++;
			$fileurl = $wp_upload_dir['url'] . '/' . basename( $filename );
			$fileurl = "../wp-content/uploads".$directory.$filename;
			$filetype = wp_check_filetype( basename( $fileurl), null );

			file_put_contents($fileurl, $data);

			$attachment = array(
				'guid' => $wp_upload_dir['url'] . '/' . basename( $fileurl ),
				'post_mime_type' => $filetype['type'],
				'post_title' => preg_replace('/\.[^.]+$/', '', basename($fileurl)),
				'post_content' => '',
				'post_status' => 'inherit'
			);
			
			$attach_id = wp_insert_attachment( $attachment, $fileurl ,$postId);
			require_once('../wp-admin/includes/image.php' );

			// Generate the metadata for the attachment, and update the database record.
			$attach_data = wp_generate_attachment_metadata( $attach_id, $fileurl );
			wp_update_attachment_metadata( $attach_id, $attach_data );
			update_post_meta( $attach_id, 'is_custom_image', $image['custom_image'] );
		}
	}

	#endregion


	//Function for disabling gutenberg editor for property custom post type
	public function disable_gutenberg($current_status, $post_type)
	{
		if ($post_type === 'property') return false;
    	return $current_status;
	}

	public function custom_redirect(){
		if( is_singular('property'))
		{
			global $wpdb;
			$query = "SELECT ID, post_title, guid FROM ".$wpdb->posts." WHERE post_content LIKE '%[properties]%' AND post_status = 'publish'";
			$results = $wpdb->get_results($query);
			$new_url = '';
			if(!empty($results))
			{
				$new_url = get_permalink($results[0]->ID);
				$new_url .= get_queried_object_id();
				wp_redirect($new_url);
			}
			else{
				include('partials/no-shortcodes.php');
				exit();
			}
		}
	}

	public function custom_property_capabilities(){
		// Add the roles you'd like to administer the custom post types
		$roles = array('agent','administrator');
		
		// Loop through each role and assign capabilities
		foreach($roles as $the_role) { 
 
		     $role = get_role($the_role);
			
	             $role->add_cap( 'read' );
	             $role->add_cap( 'read_property');
	             $role->add_cap( 'read_private_properties' );
	             $role->add_cap( 'edit_property' );
	             $role->add_cap( 'edit_properties' );
	             $role->add_cap( 'edit_others_properties' );
	             $role->add_cap( 'edit_published_properties' );
	             $role->add_cap( 'publish_properties' );
	             $role->add_cap( 'delete_others_properties' );
	             $role->add_cap( 'delete_private_properties' );
	             $role->add_cap( 'delete_published_properties' );
		
		}
	}
}
