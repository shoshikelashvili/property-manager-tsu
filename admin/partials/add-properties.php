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
        <label for="exampleFormControlInput1">Price</label>
        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="0">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Bedrooms</label>
        <input type="number" class="form-control" id="exampleFormControlInput2" placeholder="0">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput3">Bathrooms</label>
        <input type="number" class="form-control" id="exampleFormControlInput3" placeholder="0">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput4">Area</label>
        <input type="number" class="form-control" id="exampleFormControlInput4" placeholder="0">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput6">Year Built</label>
        <input type="number" class="form-control" id="exampleFormControlInput6" placeholder="0">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput5">Location</label>
        <input type="email" class="form-control" id="exampleFormControlInput5" placeholder="Tbilisi">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Status</label>
        <select class="form-control" id="exampleFormControlSelect1">
        <option>Active</option>
        <option>Sold</option>
        <option>Closed</option>
        <option>Unavailable</option>
        </select>
    </div>
    <div class="form-group">
        <label>Pets Allowed?</label>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
            <label class="custom-control-label" for="customRadioInline1">Yes</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
            <label class="custom-control-label" for="customRadioInline2">No</label>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Property ID</label>
        <input type="number" class="form-control" id="exampleFormControlInput2" placeholder="0">
    </div>
    </form>
</div>