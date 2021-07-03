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

wp_enqueue_style( 'properties-shortcode-css', plugin_dir_url( __FILE__ ) . '../css/properties-shortcode-display.css', array(), $this->version, 'all' );
wp_enqueue_script( 'properties-shortcode-js', plugin_dir_url( __FILE__ ) . '../js/property-shortcode-display.js', array( 'jquery' ), $this->version, false );

//CSS IMPORT

if(get_option('additional_css'))
{
    echo '<style type="text/css">';
    echo get_option('additional_css');
    echo '</style>';
}

///////////////// Shortcodes params filtration

$meta_query = array();
$meta_query['relation'] = 'AND';
// if(!empty($shortcode_attributes['bedrooms']))
// {
//     $meta_query  = array(
//         array(
//             'key'       => 'property_bedrooms',
//             'value'     => $shortcode_attributes['bedrooms'],
//             'type' => 'numeric',
//             'compare'   => '=',
//         )
//     );
// }

foreach($shortcode_attributes as $key => $value)
{
    if($key == "location")
    {
        $att_query = array(
            'key' => 'property_' . $key,
            'value'     => $value,
            'compare'   => 'LIKE',
        );
        array_push($meta_query, $att_query);
        continue;
    }

    if(str_contains($key,'min'))
    {
        $att_query = array(
            'key' => 'property_' . str_replace("min_","",$key),
            'value'     => $value,
            'compare'   => '>=',
        );
        if(is_numeric($value))
        {
            $att_query['type'] = 'numeric';
        }
    }
    elseif(str_contains($key,'max'))
    {
        $att_query = array(
            'key' => 'property_' . str_replace("max_","",$key),
            'value'     => $value,
            'compare'   => '<=',
        );
        if(is_numeric($value))
        {
            $att_query['type'] = 'numeric';
        }
    }
    else
    {
        $att_query = array(
            'key' => 'property_' . $key,
            'value'     => $value,
            'compare'   => '=',
        );
    }
    array_push($meta_query, $att_query);
}

// print_r($meta_query);
//////////////////////

$posts_per_page = get_option('properties_per_page');
if(!$posts_per_page) $posts_per_page = 6;

$page = $_GET['property_page'];

if($page > 0)
{
    $offset = ($page - 1) * $posts_per_page;
}
else{
    $offset = 0;
}

// echo $offset;
$properties = get_posts(array('post_type' => 'property', 'posts_per_page' => $posts_per_page, 'orderby' => 'ID', 'offset' => $offset, 'order' => 'ASC', 'meta_query' => $meta_query));

$last_post_id = get_posts(array('post_type' => 'property', 'posts_per_page' => 1, 'orderby' => 'ID', 'order' => 'DESC', 'meta_query' => $meta_query))[0]->ID;
$first_post_id = get_posts(array('post_type' => 'property', 'posts_per_page' => 1, 'orderby' => 'ID', 'order' => 'ASC', 'meta_query' => $meta_query))[0]->ID;
$property_ids = array();
foreach($properties as $p)
{
   array_push($property_ids, $p->ID);
}

echo '<div class="grid-container">';
foreach($properties as $property)
{
    $featured_image = get_the_post_thumbnail($property->ID, array(600,360), array('class'=>'property-image'));
    $property_data = get_post_meta($property->ID);
    echo '<a onclick="window.location='.$property->ID.'">';
    echo '<div class="grid-item">';
    if(get_option('font_title_grid'))
    {
        echo '<div class="title" style="font-size:'.get_option('font_title_grid').'">' . $property->post_title . '</div>';
    }
    else{
        echo '<div class="title">' . $property->post_title . '</div>';
    }
    
    echo '<div class="photo">';
    echo $featured_image;
    echo '</div>';
    echo '<div class="price">' . number_format($property_data['property_price'][0]) . ' ' . get_option('price_currency') .'</div>';
    echo '<div class="location">' . $property_data['property_location'][0] . '</div>';
    echo '<div class="appliances">';
    echo '<div class="bathrooms">';
    echo '<img class="bathroom-icon" src="https://www.freeiconspng.com/uploads/toilet-icon-png-17.png"/>';
    echo '<div class="bathroom-number">' . $property_data['property_bathrooms'][0] . '</div>';
    echo '</div>';
    echo '<div class="bedrooms">';
    echo '<img class="bedrooms-icon" src="https://www.freeiconspng.com/uploads/bedroom-icon-0.png"/>';
    echo '<div class="bedrooms-number">' . $property_data['property_bedrooms'][0] . '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</a>';
}
echo '</div>';
?>

<div class="property_pagination">
    <?php if(!in_array($last_post_id,$property_ids)): ?>
    <div class="next_page" onclick="redirect()"><?php _e('Next Page', 'property-manager')?></div>
    <?php endif ?>
    <?php if(!in_array($first_post_id,$property_ids)): ?>
    <div class="previous_page" onclick="redirect_previous()"><?php _e('Previous Page', 'property-manager')?></div>
    <?php endif ?>
</div>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->