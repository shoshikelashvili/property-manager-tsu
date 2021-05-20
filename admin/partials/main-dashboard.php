<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       Rati Shoshikelashvili, Irakli Kapanadze, Luka Metreveli
 * @since      1.0.0
 *
 * @package    Property_Manager
 * @subpackage Property_Manager/admin/partials
 */
//Enqueue CSS for the page
wp_enqueue_style( 'main-dashboard', plugin_dir_url( __FILE__ ) . '../css/main-dashboard.css', array(), $this->version, 'all' );
wp_enqueue_script( 'main-dashboard-js', plugin_dir_url( __FILE__ ) . '../js/main-dashboard.js', array( 'jquery' ), $this->version, false );
?>

<div class="main-dashboard">
    <button id="settings" type="button" class="btn btn-secondary btn-lg" onclick="redirect(this.id)"><?php _e('Settings') ?></button>
    <button id="add_edit_delete_properties" type="button" class="btn btn-secondary btn-lg" onclick="redirect(this.id)"> <?php _e('Edit Properties') ?></button>
</div> 