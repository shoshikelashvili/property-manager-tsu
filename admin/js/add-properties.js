//Customizing the Custom fields panel to fit our needs
jQuery(window).load(function(){
    var existing_metas = ["petsAllowed","property_area","property_bathrooms","property_bedrooms","property_id","property_location","property_price", "property_status", "property_year", "property_agent"]

    jQuery('#the-list').children().each(function(){
        var inputElement = jQuery(this).find(jQuery('input[type=text]'));
        if(existing_metas.includes(inputElement.val()))
        {
            jQuery(this).css("display","none");
        }
    });


    console.log(jQuery('#enternew').parent());
    jQuery('#enternew').parent().click();
});