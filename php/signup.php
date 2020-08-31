<?php
//start session
session_start();
if(!isset($_SESSION['user'])){




if (isset($_POST["submit"])) {
    # code...
    $servername = "localhost";
$username = "root";
$password = "";
$db="recycle";
// start info
$nom=$_POST["nom"];
$email = $_POST["email"];
$pass=$_POST["pass"];
$company= $_POST["tel"];
$tel=$_POST["tel"];
$adress = $_POST["adress"];
$nrc= $_POST['nrc'];
$er="";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

        // check if email exist deja
        
        $res=  mysqli_query($conn,"SELECT email FROM users WHERE email='$email'");
        $rows = mysqli_num_rows($res);
        // check nrc 
        $res1=  mysqli_query($conn,"SELECT numrc FROM nrc WHERE numrc='$nrc'");
        $rows1 = mysqli_num_rows($res1);
        // check nrc 
        $res2=  mysqli_query($conn,"SELECT id FROM nrc WHERE numrc='$nrc'");
        $rows2 = mysqli_num_rows($res2);
        $i = mysqli_fetch_all($res2,MYSQLI_ASSOC);
         
       
        if($rows==1 || $rows1==0 || $i[0]["id"] !=0){

        if ($rows==1) {
           $er ="email exist try another <br>";
        }
        if($rows1==0){
            $er .="nrc n'exist try another <br>";
        }else{
            $er .= "nrc already taken";
        }
        /*if($i[0]["id"] !=0){
            $er .= "nrc elrady taken";
        }*/
        
        }else{
            $sql = "INSERT INTO users (nomc,email,pass,company,tel,adress) VALUES ('$nom','$email', '$pass','$company','$tel','$adress')";
            
           // mysqli_query($conn,"insert into nrc (id) values ('$i[0]["id"]') where numrc='$nrc' ");
            if ($conn->query($sql) === TRUE) {
                // check nrc 
            $res3=  mysqli_query($conn,"SELECT id FROM users WHERE email='$email'");
            $rows3 = mysqli_num_rows($res3);
            $i = mysqli_fetch_all($res3,MYSQLI_ASSOC);
            $id =$i["0"]["id"];
            echo $id;
            $sqlrc = " UPDATE nrc SET id = '$id' where numrc='$nrc'";
           
            $conn->query($sqlrc);
            print_r($i);
                $_SESSION['user'] = $_POST["nom"];
                $_SESSION['id'] =$i["0"]["id"];
            //echo "New record created successfully";
           header("location:home.php");
        } 
            else {
            echo "Error: " . $sql . "<br>" . $conn->error;
                  }
            }

        

    
             /*       }
else{
    //  print eror
    echo $er;
}*/


$conn->close();
}

}else{
    header("location:home.php");
}





?>

<!DOCTYPE html>
<html>

    <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/semantic.min.css" />
    <link rel="stylesheet" href="../css/bootstrap.css" >
    <style>
        .dot{
        position: absolute;
        height: 10;
        right: 4%;
        top: 55%;
        }
        </style>
    </head>

    <body>
       

    <div class="enrg">

    <div class='container'>
        <div class="card">
        <div class="card-header">Register</div>

        <div class="card-body"> 

        <form action=""  method="post">
        <?php  if(!empty($er)){?>

<div class="alert alert-danger custom-alert" role="alert"><?php echo $er ?></div>
<?php   }
  ?>
            <div class="form-group">
                <div class="col-md-4 mb-3">
                <label for="nom">Nom complet</label>
                <input type="text" class="form-control" id="nom" placeholder="First name" name="nom" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                </div>
            
            </div>

            <div class="form-group">
                <div class="col-md-4 mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control " id="email" placeholder="Enter Email" name="email" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                </div>

            </div>

            <div class="form-group">
                <div class="col-md-4 mb-3">
                <label for="pass">Password</label>
                <input type="password" class="form-control " id="pass" required name="pass">
                <div class="alert alert-danger custom-alert" role="alert" style="display : none; margin-top : 10px">password  must be greater than <strong>6</strong></div>
                <div class="valid-feedback">
                    Looks good!
                </div>
                </div>
            </div>

           

            <div class=" form-row form-group">

                 <!-- registre commerce-->

            <div class="col-md-4 mb-3" style=" padding-left: 20px">
                <label for="pass">nrc</label>
                <input type="text" class="form-control " id="nrc"  required name="nrc">
                <div class="alert alert-danger custom-alert1" role="alert" style="display : none; margin-top : 10px"> veuillez saisir le numéro </div>
                <div class="valid-feedback">
                    Looks good!
                </div>
                </div>
            
            <!---->

                <div class="col-md-4 mb-3"  style=" padding-left: 20px">
                <label for="pass">Company Name</label>
                <input type="text" class="form-control " id="company" name="company" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                </div>

                <div class="col-md-4 mb-3" style=" padding-left: 20px">
                <label for="tel">phone number</label>
                <input type="tel" class="form-control " id="tel" name="tel" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                </div>


                

            </div>

            <!---->
            <div class="form-group">
            <div class="col-md-4 mb-3" >
                <label for="adress">Adress</label>
                <!-- get position --->
                <div  class="icon  input"  id="locator-input-section">
                <input type="text" class="form-control adress" placeholder="Enter Your Address" id="autocomplete"  name="adress" required autocomplete="false">
                <i aria-hidden="true" class="dot circle outline link icon" id="locator-button"></i>
                </div>

                <!-- end get position -->
                <div class="valid-feedback">
                    Looks good!
                </div>
                </div>
                </div>
                <!---->

            <div class="form-group">
            <button type="submit"  name="submit" class="btn btn-primary my-1" style="margin-left: 15px;">Submit</button>
            </div>

            
            
        </form>

        </div>

        </div>

    </div>

    </div>





<script src="../js/jquery.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!-- import map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_zCkUYFyvhnp9pU4uw-kbKr_1AXaarC4&libraries=places">
</script>
<script src="../js/app.js"></script>
<!-- inputs check -->
<script>
    $(document).ready(function () {
        
        $("#nom").blur(function(){
            if($(this).val() ==""){
                $(this).addClass('is-invalid').removeClass('is-valid');
            }else{
                $(this).addClass('is-valid').removeClass('is-invalid');
            }
        });

        $("#email").blur(function(){
            if($(this).val() ==""){
                $(this).addClass('is-invalid').removeClass('is-valid');
            }else{
                $(this).addClass('is-valid').removeClass('is-invalid');
            }
        })

        $("#pass").blur(function(){
            
            // check password 
            if($(this).val().length <6){
                $(".custom-alert").fadeIn(300);
                $(this).addClass('is-invalid').removeClass('is-valid');
                $(".my-1").attr("disabled","disabled");
			}else{
                $(".custom-alert").fadeOut(300);
                $(this).addClass('is-valid').removeClass('is-invalid');
                $(".my-1").removeAttr("disabled","disabled");
                
			}
        })

        $("#nrc").blur(function(){
            
            // check password 
            if($(this).val()==""){
                $(".custom-alert1").fadeIn(300);
                $(this).addClass('is-invalid').removeClass('is-valid');
                $(".my-1").attr("disabled","disabled");
			}else{
                $(".custom-alert1").fadeOut(300);
                $(this).addClass('is-valid').removeClass('is-invalid');
                $(".my-1").removeAttr("disabled","disabled");
                
			}
        })

        $("#tel").blur(function(){
            if($(this).val() ==""){
                $(this).addClass('is-invalid').removeClass('is-valid');
            }else{
                $(this).addClass('is-valid').removeClass('is-invalid');
            }
        })
        
        $(".adress").blur(function(){
            if($(this).val() ==""){
                $(this).addClass('is-invalid').removeClass('is-valid');
            }else{
                $(this).addClass('is-valid').removeClass('is-invalid');
            }
        })


        
            
            




    })
</script>

    </body>

</html>