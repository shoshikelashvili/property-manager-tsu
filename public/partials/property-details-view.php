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
echo "test";
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
