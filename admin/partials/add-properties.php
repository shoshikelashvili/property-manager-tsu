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

wp_enqueue_style( 'add-properties', plugin_dir_url( __FILE__ ) . '../css/add-properties.css', array(), $this->version, 'all' );
?>

<div class="jumbotron">
    <form>
    <div class="form-group">
        <label for="property_price">Price</label>
        <input type="number" class="form-control" id="property_price" name="property_price" placeholder="0">
    </div>
    <div class="form-group">
        <label for="property_bedrooms">Bedrooms</label>
        <input type="number" class="form-control" id="property_bedrooms" name="property_bedrooms" placeholder="0">
    </div>
    <div class="form-group">
        <label for="property_bathrooms">Bathrooms</label>
        <input type="number" class="form-control" id="property_bathrooms" name="property_bathrooms" placeholder="0">
    </div>
    <div class="form-group">
        <label for="property_area">Area</label>
        <input type="number" class="form-control" id="property_area" name="property_area" placeholder="0">
    </div>
    <div class="form-group">
        <label for="property_year">Year Built</label>
        <input type="number" class="form-control" id="property_year" name="property_year" placeholder="0">
    </div>
    <div class="form-group">
        <label for="property_location">Location</label>
        <input type="text" class="form-control" id="property_location" name="property_location" placeholder="Tbilisi">
    </div>
    <div class="form-group">
        <label for="property_status">Status</label>
        <select class="form-control" id="property_status" name="property_status">
        <option>Active</option>
        <option>Sold</option>
        <option>Closed</option>
        <option>Unavailable</option>
        </select>
    </div>
    <div class="form-group">
        <label>Pets Allowed?</label>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="property_pets_yes" name="property_pets_yes" class="custom-control-input">
            <label class="custom-control-label" for="property_pets_yes">Yes</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="property_pets_no" name="property_pets_no" class="custom-control-input">
            <label class="custom-control-label" for="property_pets_no">No</label>
        </div>
    </div>
    <div class="form-group">
        <label for="property_id">Property ID</label>
        <input type="number" class="form-control" id="property_id" name="property_id" placeholder="0">
    </div>
    </form>
</div>