(function () {
    var locatorSection = document.getElementById("locator-input-section")
    var input = document.getElementById("autocomplete");


    function init() {
        var locatorButton = document.getElementById("locator-button");
        locatorButton.addEventListener("click", locatorButtonPressed)

    }

    function locatorButtonPressed() {
        locatorSection.classList.add("loading")

        navigator.geolocation.getCurrentPosition(function (position) {
            ////////////////////////////// position
               console.log(position.coords.latitude + " "+ position.coords.longitude);
                getUserAddressBy(position.coords.latitude, position.coords.longitude)
            },
            function (error) {
                locatorSection.classList.remove("loading")
                alert("The Locator was denied :( Please add your address manually")
            })
    }

    function getUserAddressBy(lat, long) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var address = JSON.parse(this.responseText)
                setAddressToInputField(address.results[0].formatted_address)
            }
        };
        xhttp.open("GET", "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + lat + "," + long + "&key=AIzaSyA_zCkUYFyvhnp9pU4uw-kbKr_1AXaarC4", true);
        xhttp.send();
    }

    function setAddressToInputField(address) {
        

        input.value = address
        locatorSection.classList.remove("loading")
    }

    var defaultBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(45.4215296, -75.6971931),
    );

    var options = {
        bounds: defaultBounds
    };
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    // added new things
    var geocoder = new google.maps.Geocoder;
    
    autocomplete.setFields(['place_id', 'geometry', 'name', 'formatted_address']);
    //alert(input.geometry.location);
    autocomplete.addListener('place_changed', function() {
 
        var place = autocomplete.getPlace();
    
        if (!place.place_id) {
          return;
        }
        geocoder.geocode({'placeId': place.place_id}, function(results, status) {
          if (status !== 'OK') {
            window.alert('Geocoder failed due to: ' + status);
            return;
          }
        console.log(results[0].geometry.location.lat() + " "+ results[0].geometry.location.lng());
          
          
    
          // Set the position of the marker using the place ID and location.
         /* marker.setPlace(
              {placeId: place.place_id, location: results[0].geometry.location});*/
          })
        });

    ///////////////////////////

    init()

})();
