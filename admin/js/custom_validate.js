jQuery().ready(function() {

    jQuery.tools.validator.localize("fi", {
        '*'          : 'Virheellinen arvo',
        ':email'     : 'Virheellinen s&auml;hk&ouml;postiosoite',
        ':number'    : 'Arvon on oltava numeerinen',
        ':url'       : 'Virheellinen URL',
        '[max]'      : 'Arvon on oltava pienempi, kuin $1',
        '[min]'      : 'Arvon on oltava suurempi, kuin $1',
        '[required]' : 'Kent&auml;n arvo on annettava'
    });

    jQuery("#property_fields").validate({
        lang: 'fi'
    });
});