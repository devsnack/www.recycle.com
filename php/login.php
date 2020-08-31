<?php 
session_start();
if(!isset($_SESSION['user'])){

	$host = "localhost";
    $name = "root";
    $pass = "";
    $db = "recycle";
    $con = new mysqli($host,$name,$pass,$db);
    // check databases error
    if($con->connect_error){
        die("connection failes" .$con->connect_error);
    }

	if (isset($_POST["submit"]) && !empty($_POST["email"])  && !empty($_POST["pass"])   ) {

        # code...7
		// array of error 
        $ferror = array();
        // data
        $user = $_POST["email"];
        $pass = $_POST["pass"];
        //check  avialabel
        $sql = mysqli_query($con, "SELECT email,pass FROM users WHERE email='$user' AND pass='$pass'");
        
        $rows = mysqli_num_rows($sql);
        if($rows==1){

            $sql1 = mysqli_query($con, "SELECT nomc,id FROM users WHERE email='$user' AND pass='$pass'");
            $res1  =    mysqli_fetch_all($sql1,MYSQLI_ASSOC);
              
            $_SESSION["user"] =  $res1[0]["nomc"];
            $_SESSION["id"] =  $res1[0]["id"];

           header("Location:home.php");
        }else{
            $ferror[] = 'user or pass invalid';
            
           
        }
        
        }


    }else{
        header("Location:home.php");
    }


		

		


?>




<!DOCTYPE html>
<html>

    <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://fonts.googleapis.com/css?family=Sen&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css">
    </head>

<body>

<!--------------------------- start  box input ------------------------------------>

<div class="underbox">
    <div class="text">
        <h4>clean&<br><span>live</span></h4>
        <img src="https://image.freepik.com/free-vector/hand-drawn-ecology-concept-background_23-2148200338.jpg">
    </div>
</div>
<form action=""   method="post">
    <div class="logbox">
        <h3>welcome back!</h3>


        <?php  if(!empty($ferror)){?>

      <div class="alert alert-danger custom-alert" role="alert">email or pass invalid</div>
     <?php   }
        ?>
        
        
        <div class="ginput">
            <div class="field input-effect">
                <input class="effect-16" type="email" placeholder="" name="email">
                <label>Email</label>
                <span class="focus-border"></span>
            </div>
        </div>

        <div class="ginput">
            <div class="field input-effect">
                <input class="effect-16" type="password" placeholder=""  name="pass" id="pass">
                <label>Password</label>
                <span class="focus-border"></span>
            </div>
        </div>
        

        <div class="ginput">
            <input type="submit" name="submit" class="submit">
        </div>



    </div>
    </form>








<script src="../js/jquery.js"></script>
<script>
    // JavaScript for label effects only
	function check(){
		$(".field input").val("");
		
		$(".input-effect input").focusout(function(){
			if($(this).val() != ""){
				$(this).addClass("has-content");
			}else{
				$(this).removeClass("has-content");
			}
		})
	}
    check();

</script>

<!--  input check ----->


<!--<script>
	$(function(){
		$("#pass").blur(function(){
			if($(this).val().length <6){
				$(".custom-alert").fadeIn(300);
			}else{
				$(".custom-alert").fadeOut(300);
			}
		});
	});
</script>-->

<!--  start conection to databases -->
<!--<script>
			$(document).ready(function() {
    $('#loginform').submit(function(e) {
        /*e.preventDefault();*/
       
        $.ajax({
            type: "POST",
            url: 'ajax.php',
            data: $(this).serialize() ,/*$(this).serialize()*/
            success: function(response)
            {

            	alert(response);
               /* var jsonData = JSON.parse(response);
 
                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1")
                {
                    console.log(response);
                }
                else
                {
                    alert('Invalid Credentials!');
                }*/
           }
       });
     });
});
	</script>-->

</body>
</html>