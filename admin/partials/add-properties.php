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
        <label for="exampleFormControlInput1">Property Title</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Exciting Villa">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Property Description</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Location</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Tbilisi">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Type</label>
        <select class="form-control" id="exampleFormControlSelect1">
        <option>For Sale</option>
        <option>For Rent</option>
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
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>