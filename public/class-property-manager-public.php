<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       Rati Shoshikelashvili, Irakli Kapanadze, Luka Metreveli
 * @since      1.0.0
 *
 * @package    Property_Manager
 * @subpackage Property_Manager/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Property_Manager
 * @subpackage Property_Manager/public
 * @author     Rati Shoshikelashvili, Irakli Kapanadze, Luka Metreveli <rati.shoshikelashvili@gmail.com>
 */
class Property_Manager_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/property-manager-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/property-manager-public.js', array( 'jquery' ), $this->version, false );

	}


	//Output properties shortcode
	public function properties_shortcode_display(){
		
		wp_enqueue_style( 'properties-shortcode-css', plugin_dir_url( __FILE__ ) . 'css/properties-shortcode-display.css', array(), $this->version, 'all' );
		$properties = get_posts(array('post_type' => 'property'));

		ob_start();
		echo '<div class="grid-container">';
		foreach($properties as $property)
		{
			$featured_image = get_the_post_thumbnail($property->ID, array(600,360), array('class'=>'property-image'));
			$property_data = get_post_meta($property->ID);
			echo '<div class="grid-item">';
			echo '<div class="title">' . $property->post_title . '</div>';
			echo '<div class="photo">';
			echo $featured_image;
			echo '</div>';
			echo '<div class="price">' . $property_data['property_price'][0] . '$</div>';
			echo '<div class="location">' . $property_data['property_location'][0] . '</div>';
			echo '<div class="appliances">';
			echo '<div class="bathrooms">';
			echo '<img class="bathroom-icon" src="https://www.freeiconspng.com/uploads/toilet-icon-png-17.png"/>';
			echo '<div class="bathroom-number">' . $property_data['property_bathrooms'][0] . '</div>';
			echo '</div>';
			echo '<div class="bedrooms">';
			echo '<img class="bedrooms-icon" src="https://www.freeiconspng.com/uploads/bedroom-icon-0.png"/>';
			echo '<div class="bedrooms-number">' . $property_data['property_bedrooms'][0] . '</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}
		echo '</div>';
		$output = ob_get_clean();
		return $output;
	}
	
}
