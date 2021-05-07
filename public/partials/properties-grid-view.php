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

wp_enqueue_style( 'properties-shortcode-css', plugin_dir_url( __FILE__ ) . '../css/properties-shortcode-display.css', array(), $this->version, 'all' );
wp_enqueue_script( 'properties-shortcode-js', plugin_dir_url( __FILE__ ) . '../js/properties-shortcode-display.js', array( 'jquery' ), $this->version, false );

$properties = get_posts(array('post_type' => 'property'));

echo '<div class="grid-container">';
foreach($properties as $property)
{
    $featured_image = get_the_post_thumbnail($property->ID, array(600,360), array('class'=>'property-image'));
    $property_data = get_post_meta($property->ID);
    echo '<a onclick="window.location='.$property->ID.'">';
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
    echo '</a>';
}
echo '</div>';
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->