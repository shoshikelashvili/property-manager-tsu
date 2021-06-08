var hidden = document.getElementById('mapCoordinates');
var markerValue = hidden.getAttribute('value');

if(markerValue != null)
{
    markerValueParsed = markerValue.substring(7);
    markerValueParsed = markerValueParsed.slice(0,-1);
    markerArray =  markerValueParsed.split(",");
    markerArray[1] = markerArray[1].substring(1);
    var mymap = L.map('mapid').setView(markerArray, 13);
}
else{
    var mymap = L.map('mapid').setView([41.69992741543987, 44.80685475561436], 13);
}


L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'sk.eyJ1IjoicmF0aXNob3NoaWtlbGFzaHZpbGkiLCJhIjoiY2twbjRraTZ4MG0xNDJ2bWU1aHdwczYwMiJ9.tDqMD0egXlVCvzC2kEJAKA'
}).addTo(mymap);

var mainMarker = {};

console.log('markerValue',markerValue);
if(markerValue != null)
{
    console.log('insidie if');
    markerValueParsed = markerValue.substring(7);
    markerValueParsed = markerValueParsed.slice(0,-1);
    markerArray =  markerValueParsed.split(",");
    markerArray[1] = markerArray[1].substring(1);
    
    mainMarker = L.marker(markerArray).addTo(mymap);
}

function onMapClick(e) {
    if (mainMarker != undefined) {
        mymap.removeLayer(mainMarker);
    };
    mainMarker = new L.marker(e.latlng).addTo(mymap);

    var hidden = document.getElementById('mapCoordinates');
    hidden.setAttribute('value', e.latlng);
}

mymap.on('click', onMapClick);
