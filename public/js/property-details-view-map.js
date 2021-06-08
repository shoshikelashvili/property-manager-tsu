var mymap = L.map('mapid').setView([41.69992741543987, 44.80685475561436], 13);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'sk.eyJ1IjoicmF0aXNob3NoaWtlbGFzaHZpbGkiLCJhIjoiY2twbjRraTZ4MG0xNDJ2bWU1aHdwczYwMiJ9.tDqMD0egXlVCvzC2kEJAKA'
}).addTo(mymap);