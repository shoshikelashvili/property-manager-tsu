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
wp_enqueue_script( 'property-details-view-map-js', plugin_dir_url( __FILE__ ) . '../js/property-details-view-map.js', array( 'jquery' ), $this->version, false );
wp_localize_script( 'property-details-view-map-js', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
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

<!-- For Map functionality -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>



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
                        if($value == __('Price','property-manager')) $field_value[0] = number_format($field_value[0]) . ' ' . get_option('price_currency');
                        if($value == __('Area','property-manager')) 
                        {
                            $area_value = get_option('area_format');
                            
                            if($area_value == '1') $area_value = __('m²','property-manager');
                            else if($area_value == '2') $area_value = __('km²','property-manager');
                            else if($area_value == '3') $area_value = __('ha','property-manager');
                            else $area_value = __('m²','property-manager');
                            $field_value[0] = number_format($field_value[0]) . ' ' . $area_value;
                        }
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
    <div class="taxonomy_and_calculator_container">
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
        <div class="calculator">
            <?php  if(get_locale() == 'en_US') : ?>
            <!-- Mortgage Calculator Widget --><div class="mcw-wrap_250" id="maoWrap"><div id="mcwWidget"></div><script>var maoCalc={};maoCalc.settings={"theme":"theme1","view":"vertical2","responsive":"mcw-wrap_responsive","font":"Open Sans, Helvetica, Arial, sans-serif","border":false,"boxShadow":true,"backgroundColor":"#fff","fieldColor":"#fff","textColor":"#334356","borderColor":"#dde2e5","currency":"$","currencySide":"left","delimiters":",.","popup":true,"popupView":"doughnutPopup","style":true,"widgetTotalInterest":false,"widgetTotalPrincipal":false,"monthlyPayment":"Monthly Payment","totalPrincipalPaid":"Total Principal","totalInterestPaid":"Total Interest","totalPayments":"Total Payments","years":"years","title":{"enabled":true,"color":"#334356","label":"Mortgage Calculator"},"homePrice":{"label":"Home Price","value":"<?php echo  number_format($property_data['property_price'][0])?>"},"downPayment":{"enabled":true,"label":"Down Payment","value":"52,000"},"interestRate":{"label":"Interest Rate","value":"4.05"},"mortgageTerm":{"label":"Mortgage Term","value":"30"},"pmi":{"enabled":false,"label":"PMI","value":false},"taxes":{"enabled":false,"label":"Taxes","value":false},"insurance":{"enabled":false,"label":"Insurance","value":false},"hoa":{"enabled":false,"label":"HOA","value":false},"extra":{"enabled":false,"labelAdd":"Add extra payments","labelRemove":"Remove extra payments","labelToMonthy":"To monthly","labelYearly":"Extra yearly"},"startDate":{"enabled":true,"label":"Start Date"},"monthsArr":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"button":{"color":"#fff","bg":"#09f","label":"Calculate"},"amortizationSchedule":"Amortization Schedule","popupLabels":{"monthlyPrincipalInterest":"Monthly Principal & Interest","monthlyExtraPayment":"Monthly Extra Payment","monthlyPayment":"MONTHLY PAYMENT","downPayment":"Down payment","extraPayments":"Extra payments","totalPrincipalPaid":"Total principal paid","totalInterestPaid":"Total interest paid","totalOfAllPayments":"TOTAL OF ALL PAYMENTS","amortizationSchedule":"Amortization Schedule","tablePaymentDate":"Payment date","tablePayment":"Payment","tablePrincipal":"Principal","tableInterest":"Interest","tableTotalInterest":"Total Interest","tableBalance":"Balance","pmi":"PMI","taxes":"Taxes","insurance":"Insurance","shortInsurance":"Ins","hoa":"HOA","chartBalance":"Balance","chartPrincipal":"Principal","chartInterest":"Interest"},"useTitleAsLink":false,"titleLinkUrl":"","useFooterLink":false,"footerLinkAnchor":"","footerLinkUrl":""};(function(){function loadScript(src){var s,t;s=document.createElement("script");s.src=src;t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);}function decode(str){return!window.btoa?'not_found':window.btoa(unescape(encodeURIComponent(str)));}var uri='https://mortgage-advice-online.org/widget/'+decode(window.location)+'.js';loadScript(uri);})();</script></div><!-- End Mortgage Calculator Widget -->
            <?php else :?>
            <!-- Mortgage Calculator Widget --><div class="mcw-wrap_250" id="maoWrap"><div id="mcwWidget"></div><script>var maoCalc={};maoCalc.settings={"theme":"theme1","view":"vertical2","responsive":"mcw-wrap_responsive","font":"Open Sans, Helvetica, Arial, sans-serif","border":false,"boxShadow":true,"backgroundColor":"#ffffff","fieldColor":"#fff","textColor":"#334356","borderColor":"#dde2e5","currency":"","currencySide":"right","delimiters":",.","popup":true,"popupView":"doughnutPopup","style":true,"widgetTotalInterest":false,"widgetTotalPrincipal":false,"monthlyPayment":"Monthly Payment","totalPrincipalPaid":"Total Principal","totalInterestPaid":"Total Interest","totalPayments":"Total Payments","years":"წელიწადი","title":{"enabled":true,"color":"#334356","label":"გირაოს კალკულატორი"},"homePrice":{"label":"ბინის ფასი","value":"<?php echo  number_format($property_data['property_price'][0])?>"},"downPayment":{"enabled":false,"label":"Down Payment","value":false},"interestRate":{"label":"განაკვეთი","value":"4.05"},"mortgageTerm":{"label":"გირაოს დრო","value":"30"},"pmi":{"enabled":false,"label":"PMI","value":false},"taxes":{"enabled":false,"label":"გადასახადები","value":false},"insurance":{"enabled":false,"label":"დაზღვევა","value":false},"hoa":{"enabled":false,"label":"HOA","value":false},"extra":{"enabled":false,"labelAdd":"Add extra payments","labelRemove":"Remove extra payments","labelToMonthy":"To monthly","labelYearly":"Extra yearly"},"startDate":{"enabled":true,"label":"აღების თარიღი"},"monthsArr":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"button":{"color":"#fff","bg":"#09f","label":"გამოიანგარიშე"},"amortizationSchedule":"Amortization Schedule","popupLabels":{"monthlyPrincipalInterest":"თვიური ძირითადი და პროცენტი","monthlyExtraPayment":"თვიური დამატებითი გადასახადი","monthlyPayment":"თვიური გადასახადი","downPayment":"Down payment","extraPayments":"ზედმეტი გადასახადი","totalPrincipalPaid":"ჯამური ძირითადი გადახდილი","totalInterestPaid":"ჯამური პროცენტი გადახდილი","totalOfAllPayments":"ყველა გადასახადის ჯამი","amortizationSchedule":"გადახდების გრაფიკი","tablePaymentDate":"გადახდის თარიღი","tablePayment":"გადასახადი","tablePrincipal":"მთავარი","tableInterest":"პროცენტი","tableTotalInterest":"ჯამური პროცენტი","tableBalance":"ბალანსი","pmi":"PMI","taxes":"Taxes","insurance":"Insurance","shortInsurance":"Ins","hoa":"HOA","chartBalance":"Balance","chartPrincipal":"Principal","chartInterest":"Interest"},"useTitleAsLink":false,"titleLinkUrl":"","useFooterLink":false,"footerLinkAnchor":"","footerLinkUrl":""};(function(){function loadScript(src){var s,t;s=document.createElement("script");s.src=src;t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);}function decode(str){return!window.btoa?'not_found':window.btoa(unescape(encodeURIComponent(str)));}var uri='https://mortgage-advice-online.org/widget/'+decode(window.location)+'.js';loadScript(uri);})();</script></div><!-- End Mortgage Calculator Widget -->
            <?php endif ?>        
        </div>
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
            <?php echo get_avatar($agent->data->ID,330);?>
        </div>
        <span class="agent_name"><?php echo $agent->data->display_name?></span>
        <div class="agent_details">
            <span class="agent_email"><?php echo $agent->data->user_email?></span>
            <span class="agent_description"><?php echo get_user_meta($agent->data->ID, 'description', true)?></span>
        </div>
    </div>
</div>

<?php if($property_data['custom_map_data'][0] != '' && get_option('map_boolean') == 'on') :?>
<div class="map_container">
    <div class="textcontainer">
        <?php _e('Property Map', 'property-manager');?>
    </div>
    <div id="mapid">
    </div>
</div>
<?php else: ?>
<div></div>
<?php endif;?>


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
        if(!$included && ($field != 'property_agent' && $field != 'custom_map_data'))
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
<div class="back_to_properties" onClick="redirect()">
        <span><?php _e('Back to the property listings', 'property-manager')?></span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M0 0h512v512H0z" fill="#ffffff" fill-opacity="0"></path><g class="" transform="translate(0,0)" style=""><path d="M208.242 24.629l-52.058 95.205 95.207 52.059 17.271-31.586-42.424-23.198A143.26 143.26 0 0 1 256 114c78.638 0 142 63.362 142 142s-63.362 142-142 142-142-63.362-142-142c0-16.46 2.785-32.247 7.896-46.928l-32.32-16.16C82.106 212.535 78 233.798 78 256c0 98.093 79.907 178 178 178s178-79.907 178-178S354.093 78 256 78c-13.103 0-25.875 1.44-38.18 4.148l22.008-40.25-31.586-17.27zm104.27 130.379L247 253.275V368h18V258.725l62.488-93.733-14.976-9.984z" fill="#000000" fill-opacity="1"></path></g></svg>
</div>