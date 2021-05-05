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
wp_enqueue_script( 'add-properties-js', plugin_dir_url( __FILE__ ) . '../js/add-properties.js', array( 'jquery' ), $this->version, false );
?>

<?php
global $post;
$meta_values = get_post_meta($post->ID);
// var_dump($meta_values);
?>
<div class="jumbotron">
    <form>
    <div class="form-group">
        <label for="property_price">Price</label>
        <input type="number" class="form-control" id="property_price" name="property_price" placeholder="0" <?php if($meta_values['property_price'][0] != 0) echo 'value='.$meta_values['property_price'][0]?>>
    </div>
    <div class="form-group">
        <label for="property_bedrooms">Bedrooms</label>
        <input type="number" class="form-control" id="property_bedrooms" name="property_bedrooms" placeholder="0" <?php if($meta_values['property_bedrooms'][0] != 0) echo 'value='.$meta_values['property_bedrooms'][0]?>
    </div>
    <div class="form-group">
        <label for="property_bathrooms">Bathrooms</label>
        <input type="number" class="form-control" id="property_bathrooms" name="property_bathrooms" placeholder="0" <?php if($meta_values['property_bathrooms'][0] != 0) echo 'value='.$meta_values['property_bathrooms'][0]?>
    </div>
    <div class="form-group">
        <label for="property_area">Area</label>
        <input type="number" class="form-control" id="property_area" name="property_area" placeholder="0" <?php if($meta_values['property_area'][0] != 0) echo 'value='.$meta_values['property_area'][0]?>
    </div>
    <div class="form-group">
        <label for="property_year">Year Built</label>
        <input type="number" class="form-control" id="property_year" name="property_year" placeholder="0" <?php if($meta_values['property_year'][0] != 0) echo 'value='.$meta_values['property_year'][0]?>
    </div>
    <div class="form-group">
        <label for="property_location">Location</label>
        <input type="text" class="form-control" id="property_location" name="property_location" placeholder="Tbilisi" <?php if($meta_values['property_location'][0] != 0) echo 'value='.$meta_values['property_location'][0]?>
    </div>
    <div class="form-group">
        <label for="property_status">Status</label>
        <select class="form-control" id="property_status" name="property_status">
        <option <?php if($meta_values['property_status'][0] == 'Active') echo "selected" ?>>Active</option>
        <option <?php if($meta_values['property_status'][0] == 'Sold') echo "selected" ?>>Sold</option>
        <option <?php if($meta_values['property_status'][0] == 'Closed') echo "selected" ?>>Closed</option>
        <option <?php if($meta_values['property_status'][0] == 'Unavailable') echo "selected" ?>>Unavailable</option>
        </select>
    </div>
    <div class="petsText"> Pets Allowed</div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="petsAllowed" id="petsAllowedYes" value="Yes" <?php if(empty($meta_values['petsAllowed'][0]) || $meta_values['petsAllowed'][0] == 'Yes') echo 'checked'?>>
        <label class="form-check-label" for="petsAllowedYes">
            Yes
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="petsAllowed" id="petsAllowedNo" value="No" <?php if($meta_values['petsAllowed'][0] == 'No') echo 'checked'?>>
        <label class="form-check-label" for="petsAllowedNo">
            No
        </label>
    </div>
    <div class="form-group">
        <label for="property_id">Property ID</label>
        <input type="text" class="form-control" id="property_id" name="property_id" placeholder="A10978033" <?php if($meta_values['property_id'][0] != 'A10978033') echo 'value='.$meta_values['property_id'][0]?>>
    </div>
    </form>
</div>