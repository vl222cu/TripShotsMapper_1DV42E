"use strict";

var google,
map,
//xmlUrl,
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
    
    // Eventlistener which calls the function for creating marker and comment box 
    google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng);
    });

    loadMarkers();
}

function loadMarkers() {
    downloadUrl("ActionHandler.php?action=get", function(data) {
        console.log(data);
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
            var point = new google.maps.LatLng(
                parseFloat(markers[i].getAttribute("lat")),
                parseFloat(markers[i].getAttribute("lng")));
            var html = markers[i].getAttribute("comment");
            var id = markers[i].getAttribute("markerID");
            console.log(id);
            createMarkers(point, html, id);
        }
    });
} 

function createMarkers(location, html, id) {
    var marker = new google.maps.Marker({
        position : location,
        map : map,
        draggable: false,
        html: html || "",
        icon : './pics/pinkpin.png'
    });

    // Creates comment box
    var htmlBox = document.createElement("div");
    htmlBox.id = "htmlbox";
    htmlBox.innerHTML = marker.html;
    var textBox = document.createElement("textarea");
    textBox.id = "textbox";
    textBox.innerText = marker.html;
    var deleteBtn = document.createElement("button");
    deleteBtn.id = "deleteBtn";
    deleteBtn.innerText = "Delete this marker";
    var imgBtn = document.createElement("button");
    imgBtn.className = "imageBtn";
    imgBtn.innerText = "Photo Album";
    var container = document.createElement("div");
    container.id = "infocontainer";
    container.appendChild(htmlBox);
    container.appendChild(textBox);
    container.appendChild(deleteBtn);
    container.appendChild(imgBtn);

    var infoWin = new google.maps.InfoWindow({
        content : container
    });
    
    // Opens comment box on click 
    google.maps.event.addListener(marker, 'click', function () {
        infoWin.open(map, this);
    });


    google.maps.event.addDomListener(deleteBtn, "click", function() {
        deleteMarker(marker);
    });

    google.maps.event.addDomListener(imgBtn, "click", function() {
        window.location.href = 'ActionHandler.php?action=img&id=' + id;
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
    var saveBtn = document.createElement("button");
    saveBtn.id = "saveBtn";
    saveBtn.innerText = "Save this marker";
    var container = document.createElement("div");
    container.id = "infocontainer";
    container.appendChild(htmlBox);
    container.appendChild(textBox);
    container.appendChild(editBtn);
    container.appendChild(saveBtn);

    var infoWin = new google.maps.InfoWindow({
        content : container
    });
    
    // Opens comment box on click 
    google.maps.event.addListener(marker, 'click', function () {
        infoWin.open(map, this);
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
    
    // Cancel the new marker on right click
    google.maps.event.addListener(marker, "rightclick", function() {
        if (marker.getDraggable()) {
            marker.setMap(null);
        } 
    }); 
    // Saves the marker to database when clicking on the save button
    google.maps.event.addDomListener(saveBtn, "click", function() {
        saveMarker(marker, infoWin);
    });
}


function saveMarker(Marker, infoWin) {

    var comment = escape(document.getElementById("textbox").value);
    var lat = Marker.getPosition().lat();
    var lng = Marker.getPosition().lng();
    var url = "ActionHandler.php?action=add&lat=" + lat + "&lng=" + lng + "&comment=" + comment;

    downloadUrl(url, function(data) {
        console.log(data);
        if (data.status == 200) {
            Marker.setDraggable(false);
            infoWin.close();
            loadMarkers();
            messages('The location has successfully been saved');
        }
    });
}

function deleteMarker(Marker) {

    var lat = Marker.getPosition().lat();
    var lng = Marker.getPosition().lng();
    var url = "ActionHandler.php?action=delete&lat=" + lat + "&lng=" + lng;

    downloadUrl(url, function(data, status) {
        console.log(data);
        if (data.status == 200) {
            Marker.setMap(null);
            messages('The location has successfully been deleted');
        }
    });
}

function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
         new ActiveXObject('Microsoft.XMLHTTP') :
         new XMLHttpRequest;
     
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            //request.onreadystatechange = doNothing;
            callback(request, request.status);
        }
    };
    request.responseType = "document";
    request.open('GET', url, true);
    request.send(null);
}
        
google.maps.event.addDomListener(window, 'load', initialize);


