jQuery(document).ready(function() {
    var storedCoords = null;

    console.log('test page laod');
    var url = window.location.href;
    url = url.slice(0,-1);
    var parts = url.split('/');
    var lastSegment = parts.pop() || parts.pop();
    
    jQuery.ajax(
        {
            type: "get",
            dataType: "json",
            url: my_ajax_object.ajax_url,
            async: false,
            data: {
                action:'example_ajax_request', //this value is first parameter of add_action,,
                postId: lastSegment
            },
            success: function(msg){
                storedCoords = msg[0];
                 //output fruits to console
            }
        });

    console.log('stotredcoords',storedCoords);

    markerValueParsed = storedCoords.substring(7);
    markerValueParsed = markerValueParsed.slice(0,-1);
    markerArray =  markerValueParsed.split(",");
    markerArray[1] = markerArray[1].substring(1);


    var mymap = L.map('mapid').setView(markerArray, 15);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'sk.eyJ1IjoicmF0aXNob3NoaWtlbGFzaHZpbGkiLCJhIjoiY2twbjRraTZ4MG0xNDJ2bWU1aHdwczYwMiJ9.tDqMD0egXlVCvzC2kEJAKA'
    }).addTo(mymap);

    mainMarker = L.marker(markerArray).addTo(mymap);
});