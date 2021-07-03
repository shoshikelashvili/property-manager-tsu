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
    <form id="setting_fields" method="post" action="options.php">
    <?php
    settings_fields('propertymanagersettings');
    do_settings_sections('propertymanagersettings');
    ?>
        <div class="form-group">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="leafletapi" class="col-form-label"><?php _e('Leaflet Map API Key','property-manager')?></label>
                </div>
                <div class="col-auto">
                    <input type="text" id="leafletapi" name="leafletapi" value="<?php echo get_option('leafletapi')?>" class="form-control" aria-describedby="passwordHelpInline">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="my-1 mr-2" for="price_currency"><?php _e('Price Currency','property-manager')?></label>
            <select class="custom-select my-1 mr-sm-2" id="price_currency" name="price_currency">
                <option <?php if(get_option('price_currency') == '$') echo "selected"; if(get_option('price_currency') == false) echo "selected"?> value="$">USD ($)</option>
                <option <?php if(get_option('price_currency') == '₾') echo "selected"?> value="₾">GEL (₾)</option>
            </select>
        </div>
        <div class="form-group">
        <label class="my-1 mr-2" for="area_format"><?php _e('Area Format','property-manager')?></label>
        <select class="custom-select my-1 mr-sm-2" id="area_format" name="area_format">
            <option  <?php if(get_option('area_format') == '1') echo "selected"; if(get_option('area_format') == false) echo "selected"?> value="1"><?php _e('Square metre (m²)','property-manager')?></option>
            <option <?php if(get_option('area_format') == '2') echo "selected"?> value="2"><?php _e('Square kilometre (km²)','property-manager')?></option>
            <option <?php if(get_option('area_format') == '3') echo "selected"?> value="3"><?php _e('Hectare (ha)','property-manager')?></option>
        </select>
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <label class="custom-control-label" for="map_boolean"><?php _e('Display map on property view?','property-manager');?></label>
                <input type="checkbox" class="custom-control-input" id="map_boolean" name="map_boolean" <?php if(get_option('map_boolean') == 'on' || get_option('map_boolean') === false) echo 'checked'?>>
            </div>
        </div>
        <div class="form-group">
            <label class="my-1 mr-2" for="properties_per_page"><?php _e('Amount of properties displayed per page','property-manager')?></label>
            <select class="custom-select my-1 mr-sm-2" id="properties_per_page" name="properties_per_page">
                <option <?php if(get_option('properties_per_page') == '3') echo "selected"?> value="3">3</option>
                <option <?php if(get_option('properties_per_page') == '6') echo "selected"; if(get_option('properties_per_page') == false) echo "selected"?> value="6">6</option>
                <option <?php if(get_option('properties_per_page') == '9') echo "selected"?> value="9">9</option>
            </select>
        </div>
        <div class="form-group">
            <label class="my-1 mr-2" for="font_title_grid"><?php _e('Font size for the property title on property listings page','property-manager')?></label>
            <select class="custom-select my-1 mr-sm-2" id="font_title_grid" name="font_title_grid">
                <option <?php if(get_option('font_title_grid') == '1.5rem') echo "selected"; if(get_option('font_title_grid') == false) echo "selected"?> value="1.5rem">1.5rem</option>
                <option <?php if(get_option('font_title_grid') == '15px') echo "selected"?> value="15px">15px</option>
                <option <?php if(get_option('font_title_grid') == '40px') echo "selected"?> value="40px">40px</option>
            </select>
        </div>
        <div class="form-group">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="fields_color" class="col-form-label"><?php _e('Main font color for property fields','property-manager')?></label>
                </div>
                <div class="col-auto">
                    <input type="color" id="fields_color" name="fields_color" value="<?php echo get_option('fields_color')?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="additional_css" class="col-form-label"><?php _e('Additional CSS','property-manager')?></label>
                </div>
                <div class="col-auto">
                    <textarea class="additional_css" name="additional_css" style="    resize: auto;
    margin: 0px;
    width: 370px;
    height: 155px;"><?php echo get_option('additional_css')?></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><?php _e('Submit','property-manager')?></button>
    </form>
</div>