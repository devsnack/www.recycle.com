<?php

session_start();
if(isset($_SESSION['user'])){
include('nav.php');
include("db.php");
$id=  $_SESSION['id'];
$sql = "SELECT * FROM his where id='$id' ORDER BY his.date_e desc";
$res = mysqli_query($con, $sql);
$nu = mysqli_num_rows($res);
if($nu){
    $bnadem  = mysqli_fetch_all($res,MYSQLI_ASSOC);

}else{
   echo  '<div class="alert alert-primary" role="alert">
     demandes !
  </div>';
}
//  delete  demande
if(isset($_POST["delete"])){
  $nr =$_GET['norder'];
  $del = "DELETE FROM trash WHERE  n_order='$nr'";
    $res =      mysqli_query($con, $del);
}
// start update
$succ=0;

if (isset($_POST["submit"])) {
    
 // start info
 $type=$_POST["type"];
 $qnt = $_POST["qnt"];
 $no = $_POST["norder"];
 $id = $_SESSION["id"];

 
 

 
 

 ///  return resuly
 //if (empty($er)) {
         # code...
         // check if username exist deja
         
        
             $sql = "UPDATE trash SET qt = '$qnt', type = '$type' where n_order='$no' ";
             if ($con->query($sql) === TRUE) {
                 $succ = 1;
                
         } 
             else {
             echo "Error: " . $sql . "<br>" . $con->error;
                   }
             
 
         
 
     
              

 
 
 
 }
 // end  update  demande



}else{
    header("location:login.php");
}


?>


<html>
    <head>
        <title></title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <script src="../js/jquery.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.1/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" >
        <link rel='stylesheet' type='text/css' media='screen' href='../css/home.css'>


        <style>
    
        </style>
</head>
<body>
<div class="container mt-3">
<div class="row">

<?php
if(isset($bnadem)){
    foreach( $bnadem as $abd){
?>
<div class="col-md-3">
<div class="card border-success mb-3" style="max-width: 18rem;">
  <div class="card-header bg-success"><i class="far fa-calendar-alt mr-1"></i><?php echo $abd["date_e"] ?></div>
  <div class="card-body ">
    <h5 class="card-title">Quantitee : <?php echo $abd["qt"] ?> <i class="fas fa-weight-hanging"></i> </h5>
    <p class="card-text">Type  :  <?php echo $abd["type"] ?></p>
  </div>
</div>
</div>
<?php
    }
}?>

</div>
</div>


<!-- not commit  yet-->
<div class="container mt-3">
<div class="row">

<?php

$id=  $_SESSION['id'];
$sql3 = "SELECT * FROM trash where id= '$id' ORDER BY trash.date_e desc";
$res3 = mysqli_query($con, $sql3);
$nm = mysqli_num_rows($res3);
if($nm){
  $bnadem  = mysqli_fetch_all($res3,MYSQLI_ASSOC);
    foreach( $bnadem as $abd){
?>
<div class="col-md-3">
<div class="card border-success mb-3" style="max-width: 18rem;">
  <div class="card-header bg-success"><i class="far fa-calendar-alt mr-1"></i><?php echo $abd["date_e"] ?></div>
  <div class="card-body ">
    <h5 class="card-title">Quantitee : <?php echo $abd["qt"] ?> <i class="fas fa-weight-hanging"></i> </h5>
    <p class="card-text">Type  :  <?php echo $abd["type"] ?></p>
    <div class="form-group row">
    <form action="showc.php?delete&norder=<?php echo $abd['n_order'] ?>" method="post">
    <button class="btn btn-danger col mr-3  ml-2" name="delete">delete</button>
    </form>
    
    <button class="btn btn-primary col ml-4"  data-toggle="modal" data-target="#n<?php echo $abd['n_order'] ?>">Modifier</button>
      <!-- start model -->
        <!-- Button trigger modal -->
        

            <!-- Modal -->
            <div class="modal fade" id="n<?php echo $abd['n_order'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">formulaire</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                <div class="modal-body" style="height: 300px;">
                
                <div class="form-group">
                <label for="">Type de dechet</label>
                    <select class="custom-select form-control" name="type" required>
                    <option value="">Open this select menu</option>
                    <?php

                        $sql = "SELECT * FROM dechet ";
                        $res =      mysqli_query($con, $sql);
                         if(mysqli_num_rows($res) > 0) {
                             $bnadem  = mysqli_fetch_all($res,MYSQLI_ASSOC);
                             foreach($bnadem as $abd1) { ?>
                    <option value="<?php echo $abd1['type']; ?>"><?php echo $abd1['type']; ?> </option>
                    <?php
                    }}?>
                    </select>
                    <div class="invalid-feedback">invalid </div>
                    </div>

                    <input type="hidden" value="<?php echo $abd["n_order"] ?>" name="norder">
                    <div class="form-group">
                        <label for="qnt">Quantitee</label>
                        <div class="input-group">
                            
                            <input type="number" value="<?php echo $abd["qt"] ?>" class="form-control " id="qnt" name="qnt" placeholder="quantitee" aria-describedby="validationTooltipUsernamePrepend" required>
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="validationTooltipUsernamePrepend">kg</span>
                            </div>
                            <div class="invalid-tooltip">
                              Entrer valid quantitee
                            </div>
                        </div>
                    </div>
  

                        


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input id="submit" type="submit" class="btn btn-primary" name="submit" value="submit">
                </div>
                </form>
                </div>
            </div>
            </div>
            <!--end model -->
    </div>
    
  </div>
</div>
</div>
<?php
    }
}?>

</div>
</div>
<!-- end commit-->


      



<!---  verifivation form -->
<script>
$(document).ready(function () {
 
    $("#submit").attr("disabled","disabled");
        $(".custom-select").blur(function(){
            if($(this).val() ==""){
                $(this).addClass('is-invalid').removeClass('is-valid');
                $("#submit").attr("disabled","disabled");
            }else{
                $(this).addClass('is-valid').removeClass('is-invalid');
                $("#submit").removeAttr("disabled","disabled");
            }
        });
        $("#qnt").blur(function(){
            if($(this).val() <= 0){
                $(this).addClass('is-invalid').removeClass('is-valid');
                $("#submit").attr("disabled","disabled");
            }else{
                $(this).addClass('is-valid').removeClass('is-invalid');
                $("#submit").removeAttr("disabled","disabled");
            }
        });
        
})

</script>
    
<?php if($succ){ ?>
 <!-- <div class="alert alert-success alert-dismissible fade show succ" role="alert">
    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>-->  
  <script>
  Swal.fire({
  title: 'success',
  text: 'update successfully',
  icon: 'success',
  confirmButtonText: 'Cool'
})
  </script>
  

<?php
}

?>
</body>

</html>

