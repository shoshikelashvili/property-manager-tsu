<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       Rati Shoshikelashvili, Irakli Kapanadze, Luka Metreveli
 * @since      1.0.0
 *
 * @package    Property_Manager
 * @subpackage Property_Manager/public/partials
 */

wp_enqueue_style( 'property-details-view-css', plugin_dir_url( __FILE__ ) . '../css/property-details-view.css', array(), $this->version, 'all' );
wp_enqueue_style( 'splide-css', plugin_dir_url( __FILE__ ) . '../../vendor/splide/dist/css/splide.min.css', array(), $this->version, 'all' );
wp_enqueue_script( 'property-details-view-js', plugin_dir_url( __FILE__ ) . '../js/property-details-view.js', array( 'jquery' ), $this->version, false );
wp_enqueue_script( 'splide-js', plugin_dir_url( __FILE__ ) . '../../vendor/splide/dist/js/splide.min.js', array( 'jquery' ), $this->version, false );

$property = get_post($this->property_id);
$images = get_attached_media('image',$property);
$property_data = get_post_meta($property);

?>

<div id="image-slider" class="splide">
	<div class="splide__track">
		<ul class="splide__list">
        <?php 
        foreach($images as $image)
        {
            echo '<li class="splide__slide"><img src="'.$image->guid.'"></li>';
        }
        ?>
		</ul>
	</div>
</div>