<?php

class Property_Manager_Ajax {

    public function example_ajax_request()
	{
        // echo json_encode($_GET);
        $post_id = $_GET['postId'];
        $meta_values = get_post_meta($post_id);

        echo json_encode($meta_values['custom_map_data']);
		// Always die in functions echoing AJAX content
        wp_die();
	}

    public function get_leaflet_key()
	{
        $key = get_option('leafletapi');
        echo json_encode($key);
		// Always die in functions echoing AJAX content
        wp_die();
	}
}