<?php

wp_enqueue_style( 'help-css', plugin_dir_url( __FILE__ ) . '../css/help.css', array(), $this->version, 'all' );
wp_enqueue_script( 'help-js', plugin_dir_url( __FILE__ ) . '../js/help.js', array( 'jquery' ), $this->version, false );

?>


<h2><?php _e('Frequently Asked Questions','property-manager')?></h2>

<div style="visibility: hidden; position: absolute; width: 0px; height: 0px;">
  <svg xmlns="http://www.w3.org/2000/svg">
    <symbol viewBox="0 0 24 24" id="expand-more">
      <path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"/><path d="M0 0h24v24H0z" fill="none"/>
    </symbol>
    <symbol viewBox="0 0 24 24" id="close">
      <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/>
    </symbol>
  </svg>
</div>

<details open>
  <summary>
  <?php _e('How do I set up the plugin?','property-manager')?>
    <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>
    <svg class="control-icon control-icon-close" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" /></svg>
  </summary>
  <p style="font-size:1.3rem;    padding-top: 1rem;"><?php _e('The only thing needed to set up the plugin is to create a page which includes our main properties shortcode [properties]. Once the mentioned page is created, the properties will automatically populate there','property-manager')?></p>
</details>

<details>

  <summary>
  <?php _e('How do I filter the properties?','property-manager')?>
    <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>
    <svg class="control-icon control-icon-close" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" /></svg>
  </summary>
  <p style="font-size:1.3rem;padding-top: 1rem;"><?php _e('Our plugin offers a flexible solution when it comes to filtering. Basically, to filter the properties you need to modify the page and the [property] shortcode. The shortcode can be modified to include a number of different parameters, such as "bedrooms", "min_bedrooms" and so on. Once the parameters are added to the shortcode, that page will display only the filtered properties. For the full list of parameters, view the below question.','property-manager')?></p>
</details>

<details>
  <summary>
  <?php _e('What are the parameters that can be used to filter the properties?','property-manager')?>
    <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>
    <svg class="control-icon control-icon-close" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" /></svg>
  </summary>
  <p style="font-size:1.3rem;    padding-top: 1rem;"><?php _e('Currently these are the parameters that are supported: "price", "bedrooms", "area", "year", "location", "status", "id", "bathroooms", "agent". <br> With the mentioned parameters you can also use min and max prefixes, where min_price as an example would set the lowest bar for the price, and max_price would set the highest. The parameters work in conjuction with each other without issue.','property-manager')?></p>
</details>
<details>
  <summary>
  <?php _e('Can I modify the styles for the properties?','property-manager')?>
    <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>
    <svg class="control-icon control-icon-close" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" /></svg>
  </summary>
  <p style="font-size:1.3rem;    padding-top: 1rem;"><?php _e('Yes, in the options section of the property management plugin, there are a few options that can set the style for properties to your preference. In case those are not enough, you can also add additional CSS manually through the section in the options','property-manager')?></p>
</details>