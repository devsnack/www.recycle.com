<?php
session_start();
include("db.php");
include("css.php");

                      if(isset($_SESSION["places"])){

                      
                        $places = $_SESSION["places"];
                        $map = [];
                       /* $sql = "SELECT * FROM  users WHERE 1";
                        $res =      mysqli_query($con, $sql);
                         if(mysqli_num_rows($res) > 0) {
                             $bnadem  = mysqli_fetch_all($res,MYSQLI_ASSOC);
                             foreach($bnadem as $abd) {
                                 $places[]= $abd["adress"];
                              }
                            }*/
                            foreach( $places as $place) {
                              //get position
                              $id = $place["id"];
                              $sql = "SELECT adress FROM  users WHERE id=$id";
                              $res =      mysqli_query($con, $sql);
                              $ad  = mysqli_fetch_all($res,MYSQLI_ASSOC);
                              $map[]= $ad[0]["adress"];
                           }
                           print_r($map);
                       
                         if(isset($_POST["confirm"])){
                           // get all nordres

                          foreach( $places as $place) {
                            $norder = $place["n_order"];
                            $ins= "INSERT INTO his (n_order,id,date_e,type,qt) 
                            SELECT n_order,id,date_e,type,qt
                            FROM trash where n_order='$norder'";
                            mysqli_query($con, $ins);
                            $del = "DELETE FROM trash WHERE  n_order='$norder'";
                             $res =      mysqli_query($con, $del);
                            echo"delete succefully";
                            header("location:admin.php");
                          }
                         }


                        }




?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Draggable Directions</title>
    <style>
    #show{
      height : 70vh;
      width : 90vw;
    }
      #right-panel {
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #right-panel select, #right-panel input {
        font-size: 15px;
      }

      #right-panel select {
        width: 100%;
      }

      #right-panel i {
        font-size: 12px;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
        float: left;
        width: 63%;
        height: 100%;
      }
      #right-panel {
        float: right;
        width: 34%;
        height: 100%;
        overflow : scroll;
      }
      .panel {
        height: 100%;
        overflow: auto;
      }
      .adp-directions{
          display : none;
      }
    </style>
  </head>
  <body>
  <div class="container">
  <div id="show">
    <div id="map"></div>
    <div id="right-panel">
      <p>Total Distance: <span id="total"></span></p>
    </div>

  </div>
  <div class="confirm">
  <form  action="" method="post">
  <button type="submit" name="confirm" class="btn btn-primary mt-3"> confirmer </button>
      </form>
  </div>

  </div>
    <script>
     
    ///  get places
    var places = <?php echo json_encode( $map ) ?>;
    var place = [];
    places.forEach(p=>{
        place.push({location: p});
      });
    //
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: {lat: 35.9311454, lng: 0.09094139999999999}  // mostaganem
        });

        var directionsService = new google.maps.DirectionsService;
        var directionsRenderer = new google.maps.DirectionsRenderer({
          draggable: false,
          map: map,
          panel: document.getElementById('right-panel')
        });

        directionsRenderer.addListener('directions_changed', function() {
          computeTotalDistance(directionsRenderer.getDirections());
        });

        displayRoute('mostaganem', 'mostaganem', directionsService,
            directionsRenderer);
      }

      function displayRoute(origin, destination, service, display) {
        service.route({
          origin: origin,
          destination: destination,
          waypoints: place,
          travelMode: 'DRIVING',
          avoidTolls: true
        }, function(response, status) {
          if (status === 'OK') {
            display.setDirections(response);
          } else {
            alert('Could not display directions due to: ' + status);
          }
        });
      }

      function computeTotalDistance(result) {
        var total = 0;
        var myroute = result.routes[0];
        for (var i = 0; i < myroute.legs.length; i++) {
          total += myroute.legs[i].distance.value;
        }
        total = total / 1000;
        document.getElementById('total').innerHTML = total + ' km';
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_zCkUYFyvhnp9pU4uw-kbKr_1AXaarC4&callback=initMap">
    </script>
  </body>
</html>