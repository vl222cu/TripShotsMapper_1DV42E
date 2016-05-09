"use strict";
var google,
map,
infoWindow,
$;

// Source: https://developers.google.com/maps/documentation/javascript/tutorial
// Creates interactive Google Maps
function initialize () {
    var mapOptions = {
        center: new google.maps.LatLng(59.999999, 14.999999),
        zoom: 2
    };
    
    map = new google.maps.Map(document.getElementById('map-canvas'),
        mapOptions);

 //   infoWindow = new google.maps.InfoWindow;
  
    // Eventlistener which calls the function for creating marker and comment box 
    google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng);
    });

      $.get("./helper/AjaxHandler.php?action=markers", function (data) {
        console.log(data);
            $(data).find("marker").each(function () {
                 //Get user input values for the marker from database
                var point     = {lat: parseFloat($(this).attr('lat')), lng: parseFloat($(this).attr('lng'))};
                var html      = $(this).attr('comment');
                  //call placeMarker() function for xml loaded marker
                  console.log(html);
                  console.log(point);
                  placeMarker(point, html);

            });
        }); 

}
    
// Source: https://developers.google.com/maps/documentation/javascript/events
// Creates marker and comment box
function placeMarker (location, html) {
    var marker = new google.maps.Marker({
        position : location,
        map : map,
        draggable: true,
        html: html || "Click on 'Edit comment' button and start writing!",
        icon : './pics/pinkpin.png'
    });
        
    marker.set("editing", false);
        
    // Creates comment box
    var htmlBox = document.createElement("div");
    htmlBox.id = "htmlbox";
    htmlBox.innerHTML = marker.html;
    var textBox = document.createElement("textarea");
    textBox.id = "textbox";
    textBox.innerText = marker.html;
    var editBtn = document.createElement("button");
    editBtn.id = "editBtn";
    editBtn.innerText = "Edit comment";
    var container = document.createElement("div");
    container.id = "infocontainer";
    container.appendChild(htmlBox);
    container.appendChild(textBox);
    container.appendChild(editBtn);
    
    var infoWin = new google.maps.InfoWindow({
        content : container
    });
    
    // Opens comment box on click 
    google.maps.event.addListener(marker, 'click', function () {
        infoWin.open(map, marker);
    });
    
    // Changes status on the comment box button to edit on click 
    google.maps.event.addDomListener(editBtn, "click", function() {
        textBox.innerText = "";
        marker.set("editing", !marker.editing);
    });
    
    // Changes the comment box and edit button's status depending on if user wants to 
    // edit or save the comment 
    google.maps.event.addListener(marker, "editing_changed", function(){
        textBox.style.display = marker.editing ? "block" : "none";
        htmlBox.style.display = marker.editing ? "none" : "block";
        editBtn.innerText = marker.editing ? "Save comment" : "Edit comment";
    });
    
    // Saves the comment in the comment box 
    google.maps.event.addDomListener(textBox, "change", function(){
        htmlBox.innerHTML = textBox.value;
        marker.set("html", textBox.value);
    });
    
    // Eventlistener to cancel marker on right click
    google.maps.event.addListener(marker, "rightclick", function() {
        if (marker.getDraggable()) {
            marker.setMap(null);
        } 
    }); 
}

google.maps.event.addDomListener(window, 'load', initialize);



