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
	public function properties_shortcode_display($atts){
		$pid = get_query_var('property_id');
		$view_name = 'properties-grid-view';
		if($pid)
		{
			$view_name = 'property-details-view';
		}
		$controller = new Property_Manager_Public_View_Controller($this->plugin_name, $this->version);
		return $controller->render_view($view_name, $pid, $atts);
	}

	public function property_rewrite_rules(){
		$current_url="http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$current_page_id = url_to_postid($current_url);
		$current_page = get_post($current_page_id);

		// Only affect properties with shortcode
		if(has_shortcode($current_page->post_content, 'properties'))
		{
			add_rewrite_tag( '%property_id%', '([^/]+)');
			add_rewrite_rule('^'.$current_page->post_name . '/([0-9]+)/?', 'index.php?pagename=' . $current_page->post_name . '&property_id=$matches[1]', 'top');
		}
		flush_rewrite_rules();
	}
	
}
