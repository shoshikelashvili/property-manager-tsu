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
wp_enqueue_style( 'property-gallery', plugin_dir_url( __FILE__ ) . '../css/property-gallery.css', array(), $this->version, 'all' );
wp_enqueue_script( 'property-gallery-js', plugin_dir_url( __FILE__ ) . '../js/property-gallery.js', array( 'jquery' ), $this->version, false );
?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<input type="hidden" id="image-hidden-field" name="custom_image_data">
<div class="container">
    <fieldset class="form-group">
        <a href="javascript:void(0)" onclick="jQuery('#pro-image').click()">Upload Image</a>
        <input type="file" id="pro-image" name="pro-image" style="display: none;" class="form-control" multiple>
    </fieldset>
    <div class="preview-images-zone">
        <div class="preview-image preview-show-1 placeholder">
            <div class="image-cancel" data-no="1">x</div>
            <div class="image-zone"><img id="pro-img-1" src="https://media.istockphoto.com/vectors/no-image-available-sign-vector-id922962354?k=6&m=922962354&s=612x612&w=0&h=_KKNzEwxMkutv-DtQ4f54yA5nc39Ojb_KPvoV__aHyU="></div>
            <!-- <div class="tools-edit-image"><a href="javascript:void(0)" data-no="1" class="btn btn-light btn-edit-image">edit</a></div> -->
        </div>
    </div>
</div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>