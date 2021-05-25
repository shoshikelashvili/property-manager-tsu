<?php

/**
 * Fired during plugin deactivation
 *
 * @link       Rati Shoshikelashvili, Irakli Kapanadze, Luka Metreveli
 * @since      1.0.0
 *
 * @package    Property_Manager
 * @subpackage Property_Manager/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Property_Manager
 * @subpackage Property_Manager/includes
 * @author     Rati Shoshikelashvili, Irakli Kapanadze, Luka Metreveli <rati.shoshikelashvili@gmail.com>
 */
class Property_Manager_Fields {

    // public static $fields = ['property_price' => __('Price','property-manager'), 'property_bedrooms' => 'Bedrooms', 'property_area' => 'Area', 'property_year' => 'Year Built',
    // 'property_location' => 'Location', 'property_status' => 'Status', 'petsAllowed' => 'Pets allowed?', 'property_id' => 'Property ID', 'property_bathrooms' => 'Bathrooms'];
    
    public static $fields = array();
    static function get_fields_associative()
    {
        self::$fields['property_price'] = __('Price','property-manager');
        self::$fields['property_bedrooms'] = __('Bedrooms','property-manager');
        self::$fields['property_bathrooms'] = __('Bathrooms','property-manager');
        self::$fields['property_area'] = __('Area','property-manager');
        self::$fields['property_year'] = __('Year Built','property-manager');
        self::$fields['property_location'] = __('Location','property-manager');
        self::$fields['property_status'] = __('Status','property-manager');
        self::$fields['petsAllowed'] = __('Pets Allowed','property-manager');
        self::$fields['property_id'] = __('Property ID','property-manager');
    
        return self::$fields;
    }

}
