<?php

$_SESSION["places"] =[];
include("db.php");
if(isset($_GET['filter'])){
    $dt = $_GET["day"];
        $qt=  $_GET["qt"];
        // get date today
        $dat = date("yy-m-d");
    // check if empty
    if(!empty( $_GET["day"]) && !empty( $_GET["qt"])){
        
        //filter
        $sql = "SELECT * FROM trash where  date_e  like  ADDDATE('$dat', INTERVAL -$dt DAY)  and qt >= '$qt'";

    }else if(empty( $_GET["qt"])){
        $sql = "SELECT * FROM trash where  date_e  like  ADDDATE('$dat', INTERVAL -$dt DAY)";
    }else if(empty( $_GET["day"])){
        $sql = "SELECT * FROM trash where  qt >= '$qt' ";
    }else{
        $sql = "SELECT * FROM trash where qt >= '100' ORDER BY trash.id ASC";
    }
    
    
    
}else{
    $sql = "SELECT * FROM trash where qt >= '100' ORDER BY trash.id ASC";
}



?>

<html>
<head>
<style>

.fa-map-marked-alt{
    padding : 2px 10px;
}
</style>
</head>
 
<body>

</body>

    <div class="card mt-2">
  
    <!--start filter -->

    <nav class="navbar navbar-light bg-light">
    <form class="form-inline" action=""  method="get">
    <div class="form-group col-5">
    <input class="form-control mr-sm-2" type="text" placeholder="days" id="jour" name="day">
    </div>

    <div class="form-group col-5">
        <div class="input-group ">
        <input type="text" class="form-control" id="quantitee" placeholder="quantitee" name="qt">
        <div class="input-group-prepend">
          <div class="input-group-text">Kg</div>
        </div>
      </div>
    </div>

    <div class="form-group col-2">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="filter">Search</button>
    </div>
    </form>
    </nav>


    <!-- end filter -->
                                <table class="table table-bordered">
                                
                                <!-- start hesd-->
                                <thead class="thead-dark">
                                <tr>
                                <th scope="col">N° Order</th>
                                <th scope="col">ID</th>
                                <th scope="col">Type</th>
                                <th scope="col">Quantitee</th>
                                
                                </tr>
                                </thead>
                        
                                <tbody>

                        <?php
                        $count = 0;
                        $res =      mysqli_query($con, $sql);
                       
                         if(mysqli_num_rows($res) > 0) {
                             $ready  = mysqli_fetch_all($res,MYSQLI_ASSOC);
                              
                             foreach($ready as $rd) { 
                                
                                //

                                 
                                $item_array = array(  
                                     'n_order' =>   $rd["n_order"],  
                                     'id'  =>  $rd["id"],  
                                
                                );  
                                $_SESSION["places"][$count] = $item_array; 
                               // print_r($_SESSION["places"][$count])  ;
                                $count++;




                                //
                                 
                                 
                                 ?>

                                    <tr>
                                    <th><?php echo $rd['n_order']; ?> </th>
                                    <th><?php echo $rd['id']; ?> </th>
                                    <td><?php echo $rd['type']; ?> </td>
                                    <td><?php echo $rd['qt']; ?> </td>
                                    </tr>
                                <?php
                                    
                                     }
                                     }
                                    ?>
                        </tbody>

</table>
</div>
<!-- show onmap -->
<div class="col-3">
<a href="mapvol2.php"><button type="button" class="btn btn-info mt-2">Show On Map<i class="fas fa-map-marked-alt"></i> </button></a>
</div>
</html>
                        

