<?php 
session_start();
include("css.php");
include("db.php");

if(isset($_SESSION['admin'])){


/*echo '
<div class="card">
  <h5 class="card-header">Featured</h5>
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

';*/
// delete user cammande ////////////
if(isset($_POST["delete"])){
    $did = $_GET["id"];
    $norder = $_GET["norder"];
    $del = "DELETE FROM trash WHERE id = '$did' and n_order='$norder'";
    $res =      mysqli_query($con, $del);
    //echo"delete succefully";

}
////////////////////////
}else{
    header("location:dashbord.php");
}


?>


<html>
<head>
        <title></title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" >
        <link rel="stylesheet"  href="../css/admin.css">

</head>

                <body>
            <div class="dashbord">
                <!-- navbar  -->
                
                    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
                    <a class="navbar-brand" href="#">
                        <img src="../logo.svg" width="30" height="30" class="d-inline-block align-top" alt="">
                        Dashbord
                    </a>
                    </nav>
                     <!-- end navbar  -->
                <div class='row'>
                <div class="col-2 pad">
                    <div class="side"> 
                        <ul>
                        <li id="cam">Demandes</li>
                        <li id="ready">Filtrer </li>
                        </ul>
                    
                    </div>
                    
                    </div>
                    <!-- start content -->

                    <div class="col-10 pad">
                        <div class="content">
                <!--start camande-->
                   <div class="cam">
                    <!-- table -->
                    <div class="container">
                <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">N° demande</th>
                    <th scope="col">ID</th>
                    <th scope="col">Type</th>
                    <th scope="col">Quantitee</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php

                        $sql = "SELECT * FROM trash ORDER BY trash.id ASC";
                        $res =      mysqli_query($con, $sql);
                         if(mysqli_num_rows($res) > 0) {
                             $bnadem  = mysqli_fetch_all($res,MYSQLI_ASSOC);
                             foreach($bnadem as $abd) { ?>
                                <form action="admin.php?action=delete&id=<?php echo $abd['id']; ?>&norder=<?php echo $abd['n_order']; ?>" method="post">
                                    <tr>
                                    <th><?php echo $abd['n_order']; ?> </th>
                                    <th><?php echo $abd['id']; ?> </th>
                                    <td><?php echo $abd['type']; ?> </td>
                                    <td><?php echo $abd['qt']; ?> </td>
                                    <td>
                                    
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#s<?php echo $abd['n_order']; ?>" >
                                   info
                                    </button>
                                    
                                        <!---->
                                    

                                            <!-- Modal -->
<div class="modal fade" id="s<?php echo $abd['n_order']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-address-card mr-1"></i> Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php
                                     $no =  $abd['n_order'];
                                     
                                       $sql1 = "SELECT * FROM users where id = (select id from trash where n_order='$no') ";
                                        $res1 =      mysqli_query($con, $sql1);
                                         
                                        if(mysqli_num_rows($res1) > 0) {
                                            
                                            $bnadem2  = mysqli_fetch_all($res1,MYSQLI_ASSOC);
                                            foreach($bnadem2 as $abd1) {?>
                                            <h5><i class="fas fa-user mr-1"></i> <?php echo $abd1['nomc']; ?></h5>
                                            <h5><i class="far fa-envelope mr-1"></i> <?php echo $abd1['email']; ?></h5>
                                            <h5><i class="fas fa-map-marker-alt mr-1"></i><?php echo $abd1['adress']; ?></h5>
                                            <?php
                                            }
                                            }?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
 
                                       <!---->
                                    
                                    </td>
                                    
                                    <td><button  class="btn btn-danger" name="delete">delete</button></td>
                                    </tr>
                                    </form>
                                    
                               

                             <?php  
                         }   
                     }
                         ?>
                    
                  
                </tbody>
                </table>
                </div>

                </div>

                <!-- end table-->

                <!-- start ready-->

                     <div class="ready">
                     <div class="container">
                        <?php
                      include("ready.php");

                        ?>
                    </div>
                    </div>


                <!-- end ready -->
                    
                    
                    
                    </div>
                    </div>
                    <!-- end content -->
                </div>
            </div>




                

<script src="../js/jquery.js"></script>  
<script src="../js/popper.js"></script>   
<script src="../js/bootstrao.min.js"></script>            
<script>
    var cam = document.getElementById('cam');
   var  ready = document.getElementById('ready') ;
    var ccam =  document.querySelector('.cam');
    var cready =  document.querySelector('.ready');
      
      


    // start events
    cam.onclick = function(){
        ccam.style.display = "block";
        cready.style.display = "none";
    }
    ready.onclick = function(){
        ccam.style.display = "none";
        cready.style.display = "block";
    }

</script>
</body>


</html>


