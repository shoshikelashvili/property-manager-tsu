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

$args = array(
    'role__in'    => array('agent','administrator'),
    'orderby' => 'user_nicename',
    'order'   => 'ASC'
);
$users = get_users( $args );
?>
<div class="jumbotron">
    <form>
    <div class="form-group">
        <label for="property_price"><?php _e('Price', 'property-manager') ?></label>
        <input type="number" class="form-control" id="property_price" name="property_price" placeholder="0" <?php if($meta_values['property_price'][0] != 0) echo 'value='.$meta_values['property_price'][0]?>>
    </div>
    <div class="form-group">
        <label for="property_bedrooms"><?php _e('Bedrooms', 'property-manager') ?></label>
        <input type="number" class="form-control" id="property_bedrooms" name="property_bedrooms" placeholder="0" <?php if($meta_values['property_bedrooms'][0] != 0) echo 'value='.$meta_values['property_bedrooms'][0]?>>
    </div>
    <div class="form-group">
        <label for="property_bathrooms"><?php _e('Bathrooms', 'property-manager')?></label>
        <input type="number" class="form-control" id="property_bathrooms" name="property_bathrooms" placeholder="0" <?php if($meta_values['property_bathrooms'][0] != 0) echo 'value='.$meta_values['property_bathrooms'][0]?>>
    </div>
    <div class="form-group">
        <label for="property_area"><?php _e('Area', 'property-manager')?></label>
        <input type="number" class="form-control" id="property_area" name="property_area" placeholder="0" <?php if($meta_values['property_area'][0] != 0) echo 'value='.$meta_values['property_area'][0]?>>
    </div>
    <div class="form-group">
        <label for="property_year"><?php _e('Year Built', 'property-manager')?></label>
        <input type="number" class="form-control" id="property_year" name="property_year" placeholder="0" <?php if($meta_values['property_year'][0] != 0) echo 'value='.$meta_values['property_year'][0]?>>
    </div>
    <div class="form-group">
        <label for="property_location"><?php _e('Location', 'property-manager')?></label>
        <input type="text" class="form-control" id="property_location" name="property_location" placeholder="Tbilisi" <?php if($meta_values['property_location'][0] != 0) echo 'value="'.$meta_values['property_location'][0] . '"'?>>
    </div>
    <div class="form-group">
        <label for="property_status"><?php _e('Status', 'property-manager')?></label>
        <select class="form-control" id="property_status" name="property_status">
        <option <?php if($meta_values['property_status'][0] == __('Active', 'property-manager')) echo "selected" ?>><?php _e('Active','property-manager')?></option>
        <option <?php if($meta_values['property_status'][0] == __('Sold', 'property-manager')) echo "selected" ?>><?php _e('Sold','property-manager')?></option>
        <option <?php if($meta_values['property_status'][0] == __('Closed','property-manager')) echo "selected" ?>><?php _e('Closed','property-manager')?></option>
        <option <?php if($meta_values['property_status'][0] == __('Unavailable','property-manager')) echo "selected" ?>><?php _e('Unavailable','property-manager')?></option>
        </select>
    </div>
    <div class="petsText"> <?php _e('Pets Allowed', 'property-manager')?></div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="petsAllowed" id="petsAllowedYes" value="<?php _e('Yes','property-manager')?>" <?php if(empty($meta_values['petsAllowed'][0]) || $meta_values['petsAllowed'][0] == __('Yes','property-manager')) echo 'checked'?>>
        <label class="form-check-label" for="petsAllowedYes">
        <?php _e('Yes', 'property-manager')?>
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="petsAllowed" id="petsAllowedNo" value="<?php _e('No','property-manager')?>" <?php if($meta_values['petsAllowed'][0] == __('No','property-manager')) echo 'checked'?>>
        <label class="form-check-label" for="petsAllowedNo">
        <?php _e('No', 'property-manager')?>
        </label>
    </div>
    <div class="form-group">
        <label for="property_id"><?php _e('Property ID', 'property-manager')?></label>
        <input type="text" class="form-control" id="property_id" name="property_id" placeholder="10978033" <?php if($meta_values['property_id'][0] != 'A10978033') echo 'value='.$meta_values['property_id'][0]?>>
    </div>
    <div class="form-group">
        <label for="property_agent"><?php _e('Agent', 'property-manager')?></label>
        <select class="form-control" id="property_agent" name="property_agent">
        <?php
        foreach($users as $user)
        {
            if($meta_values['property_agent'][0] == $user->data->user_login)
            {
                echo '<option selected>' . $user->data->user_login. '</option>';
            }
            else{
                echo '<option>' . $user->data->user_login. '</option>';
            }
            
        }
        ?>
        </select>
    </div>
    </form>
</div>