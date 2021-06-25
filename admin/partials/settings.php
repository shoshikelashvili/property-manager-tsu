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
wp_enqueue_style( 'settings-css', plugin_dir_url( __FILE__ ) . '../css/settings.css', array(), $this->version, 'all' );
wp_enqueue_script( 'settings-js', plugin_dir_url( __FILE__ ) . '../js/settings.js', array( 'jquery' ), $this->version, false );

?>

<div class="settings_container">
    <form id="setting_fields">
        <div class="form-group">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="inputPassword6" class="col-form-label"><?php _e('Leaflet Map API Key','property-manager')?></label>
                </div>
                <div class="col-auto">
                    <input type="password" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="my-1 mr-2" for="inlineFormCustomSelectPref"><?php _e('Price Currency','property-manager')?></label>
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                <option selected value="1">USD ($)</option>
                <option value="2">GEL (ლ)</option>
            </select>
        </div>
        <div class="form-group">
        <label class="my-1 mr-2" for="inlineFormCustomSelectPref"><?php _e('Area Format','property-manager')?></label>
        <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
            <option selected value="1"><?php _e('Square metre (m²)','property-manager')?></option>
            <option value="2"><?php _e('Square kilometre (km²)','property-manager')?></option>
            <option value="3"><?php _e('Hectare (ha)','property-manager')?></option>
        </select>
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <label class="custom-control-label" for="customCheck1"><?php _e('Display map on property view?','property-manager');?></label>
                <input type="checkbox" class="custom-control-input" id="customCheck1">
            </div>
        </div>
        <div class="form-group">
            <label class="my-1 mr-2" for="inlineFormCustomSelectPref"><?php _e('Amount of properties displayed per page','property-manager')?></label>
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                <option value="1">3</option>
                <option selected value="2">6</option>
                <option value="3">9</option>
            </select>
        </div>
    </form>
</div>