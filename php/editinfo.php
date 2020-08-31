<?php
session_start();
include("db.php");
include("css.php");
// get user info ************************
if(isset($_SESSION['user'])){

    $id = $_SESSION["id"] ;
    // get data
    $sql = "SELECT * FROM users where id=$id";
    $res =      mysqli_query($con, $sql);
     
         

}else{
    header("location:login.php");
}

// update user info ***************************
if(isset($_POST['update']))
{
    $id = $_POST['edit_id'];
    
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    $adress = $_POST["adress"];
    $query = "UPDATE users SET  email='$email', pass='$password',adress='$adress' WHERE id='$id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: home.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: home.php'); 
    }
}




?>

<html>

<head>
    <title></title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <style>
        .dot{
        position: absolute;
        height: 10;
        right: 2%;
        top: 55%;
        }
        </style>
<head>

<body>
<div class="container">
<div class="card" >
  <div class="card-header">
    Featured
  </div>
  <!-- form container -->
<div class="p-3">

<?php
$bnadem  = mysqli_fetch_all($res,MYSQLI_ASSOC);
foreach($bnadem as $abd)
    {
        ?>

          <form action="" method="POST">
                
              <input type="hidden" name="edit_id" value="<?php echo $abd['id'] ?>" >
              
              <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="edit_email" value="<?php echo $abd['email'] ?>" class="form-control" placeholder="Enter Email">
              </div>
              <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="edit_password" value="<?php echo $abd['pass'] ?>" class="form-control" placeholder="Enter Password">
              </div>

              <!-- get position --->
              <div class="con" style="position:relative" >
              <div class="form-group">
                  <label>Adress</label>
              <div  class="icon  input"  id="locator-input-section">
                <input type="text" class="form-control" value='<?php echo $abd['adress'] ?>' placeholder="Enter Your Address" id="autocomplete"  name="adress" required autocomplete="false">
                <i aria-hidden="true" class="dot circle outline link icon" id="locator-button"></i>
                </div>

                </div>
            </div>

                <!-- end get position -->

              <a href="home.php" class="btn btn-danger" > CANCEL  </a>
              <button type="submit" name="update" class="btn btn-primary"> Update </button>

          </form>

          <?php
    }?>
    </div>
</div> 
</div>

<!-- import map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_zCkUYFyvhnp9pU4uw-kbKr_1AXaarC4&libraries=places">
</script>
<script src="../js/app.js"></script>
<!-- inputs check -->
</body>

</html>
