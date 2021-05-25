<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       Rati Shoshikelashvili, Irakli Kapanadze, Luka Metreveli
 * @since      1.0.0
 *
 * @package    Property_Manager
 * @subpackage Property_Manager/public/partials
 */

wp_enqueue_style( 'property-details-view-css', plugin_dir_url( __FILE__ ) . '../css/property-details-view.css', array(), $this->version, 'all' );
wp_enqueue_style( 'splide-css', plugin_dir_url( __FILE__ ) . '../../vendor/splide/dist/css/splide.min.css', array(), $this->version, 'all' );
wp_enqueue_script( 'property-details-view-js', plugin_dir_url( __FILE__ ) . '../js/property-details-view.js', array( 'jquery' ), $this->version, false );
wp_enqueue_script( 'splide-js', plugin_dir_url( __FILE__ ) . '../../vendor/splide/dist/js/splide.min.js', array( 'jquery' ), $this->version, false );

//Only import this if setting is set to yes
wp_enqueue_style( 'property-details-view-theme-css', plugin_dir_url( __FILE__ ) . '../css/propeprty-details-view-theme-adjusted.css', array(), $this->version, 'all' );

$property = get_post($this->property_id);
$images = get_attached_media('image',$property);

$thumbnail_id = get_post_thumbnail_id($property);

//Reposition thumbnail at top
if(in_array($thumbnail_id,array_keys($images)))
{
    $value = $images[$thumbnail_id];
    unset($images[$thumbnail_id]);
    array_unshift($images, $value);
}

$property_data = get_post_meta($this->property_id);

$property_types = get_the_terms($property,'property_types');

$agent_slug = $property_data['property_agent'][0];
$agent = get_user_by('slug',$agent_slug);
?>

<div class="property-title"><?php echo $property->post_title?></div>
<div id="image-slider" class="splide">
	<div class="splide__track">
		<ul class="splide__list">
        <?php 
        foreach($images as $image)
        {
            echo '<li class="splide__slide"><img src="'.$image->guid.'"></li>';
        }
        ?>
		</ul>
	</div>
</div>

<div class="property_description">
    <div class="description-title"><?php echo __('Property Description','property-manager')?></div>
    <span><?php echo $property->post_content?></span>
</div>

<div class="details_holder">
    <div class="property_details">
        <div class="details_label"><?php _e('Basic Details','property-manager')?></div>
        <ul>
            <?php 
            $field_metadata = Property_Manager_Fields::get_fields_associative();
            foreach($property_data as $field => $field_value)
            {
                foreach($field_metadata as $key => $value)
                {
                    if($field == $key && $field_value[0])
                    {
                        if($value == __('Price','property-manager')) $field_value[0] .= '$';
                        if($value == __('Area','property-manager')) $field_value[0] .= 'მ²';
                        echo '<li>';
                        echo '<span class="field_name">' . $value . ':</span>';
                        echo '<span class="field_value">  ' . $field_value[0] . '</span>';
                        echo '</li>';
                        break;
                    }
                }
            }
            ?>
            <!-- <li>
                <span class="field_name">Name</span>
                <span class="field_value">Value</span>
            </li> -->
        </ul>
    </div>
    <?php if(!empty($property_types[0]->name)): ?>
    <div class="property_taxonomies">
        <div class="taxonomies_label"><?php _e('Property Type','property-manager')?></div>
        <ul>
            <?php 
            $field_metadata = Property_Manager_Fields::get_fields_associative();
            foreach($property_types as $type)
            {
                echo '<li>';
                echo '<span class="field_value">' . $type->name . '</span>';
                echo '</li>';
            }
            ?>
        </ul>
    </div>
    <?php else: ?>
        <div class="property_taxonomies">
        <div class="taxonomies_label"><?php _e('Property Type','property-manager')?></div>
        <ul>
            <li>
                <span class="field_value"><?php _e('Unknown','property-manager')?></span>
            </li>
        </ul>
    </div>
    <?php endif; ?>
    <div class="property_agent">
        <div class="agent_label"><?php _e('Agent Information','property-manager')?></div>
        <div class="image_container">
            <?php echo get_avatar($agent->data->ID,250);?>
        </div>
        <span class="agent_name"><?php echo $agent->data->display_name?></span>
        <div class="agent_details">
            <span class="agent_email"><?php echo $agent->data->user_email?></span>
            <span class="agent_description"><?php echo get_user_meta($agent->data->ID, 'description', true)?></span>
        </div>
    </div>
</div>
<div class="additional_details">
    <div class="description-title"><?php _e('Additional Details','property-manager')?></div>
    <ul>
    <?php 
    $are_additional_details = false;
    foreach($property_data as $field => $field_value)
    {
        $included = false;
        foreach($field_metadata as $key => $value)
        {
            if($field == $key || $field[0] == '_')
            {
                $included = true;
                // if($value == 'Price') $field_value[0] .= '$';
                // if($value == 'Area') $field_value[0] .= 'Sqft';
                // echo '<li>';
                // echo '<span class="field_name">' . $value . ':</span>';
                // echo '<span class="field_value">' . $field_value[0] . '</span>';
                // echo '</li>';
                break;
            }
        }
        if(!$included && $field != 'property_agent')
        {
            $are_additional_details = true;
            echo '<li>';
            echo '<span class="field_name">' . $field . ':</span>';
            echo '<span class="field_value">  ' . $field_value[0] . '</span>';
            echo '</li>';
        }
    }
    if(!$are_additional_details)
    {
        echo '<span>' . __('Additional fields have not been filled in, in case of questions, contact the agent directly','property-manager') . '</span>';
    }
    ?>
    </ul>
</div>