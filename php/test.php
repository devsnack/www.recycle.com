<?php
include("db.php");
$dat = date("yy-m-d");
$dt = 3;
// ''+1'
$sql = "SELECT * FROM test where  date  like  ADDDATE('$dat', INTERVAL -$dt DAY)  ";
$res = mysqli_query($con,$sql) ;
if (mysqli_query($con,$sql)) {
    echo("Error description: " . mysqli_error($con));
  }

$ready  = mysqli_fetch_all($res,MYSQLI_ASSOC);

foreach($ready as $rd) { 
    echo $rd["date"];
    echo $rd["name"];
}




?>