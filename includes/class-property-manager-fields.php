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

    public static $fields = ['property_price' => 'Price', 'property_bedrooms' => 'Bedrooms', 'property_area' => 'Area', 'property_year' => 'Year Built',
    'property_location' => 'Location', 'property_status' => 'Status', 'petsAllowed' => 'Pets allowed?', 'property_id' => 'Property ID', 'property_bathrooms' => 'Bathrooms'];
    
    static function get_fields_associative()
    {
        return self::$fields;
    }

}
