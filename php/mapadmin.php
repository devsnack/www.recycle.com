<?php
session_start();
include("db.php");


                        $places = array();
                        $sql = "SELECT * FROM  users WHERE 1";
                        $res =      mysqli_query($con, $sql);
                         if(mysqli_num_rows($res) > 0) {
                             $bnadem  = mysqli_fetch_all($res,MYSQLI_ASSOC);
                             foreach($bnadem as $abd) {
                                 $places[]= $abd["adress"];
                              }
                            }
                       
                            




?>




<html>
    <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    </head>
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>

<body>
<div id="floating-panel">
      <input id="address" type="textbox" value="Sydney, NSW">
      <input id="submit" type="button" value="Geocode">
    </div>
    <div id="map"></div>
    <script>
        
        
        var places = <?php echo json_encode( $places ) ?>;
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: {lat: 35.9311454, lng: 0.09094139999999999}
           
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
            var address = document.getElementById('address').value;
          geocodeAddress(geocoder, map,address);
        });

        // add places from database
        
         places.forEach(p=>{
        geocodeAddress(geocoder, map,p);
      });

        ////
      }
      
      function geocodeAddress(geocoder, resultsMap,address) {
        //var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
              
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_zCkUYFyvhnp9pU4uw-kbKr_1AXaarC4&callback=initMap">
    </script>





</body>





</html>