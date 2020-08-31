<?php

session_start();
 # code...
 $servername = "localhost";
 $username = "root";
 $password = "";
 $db="recycle";
 // Create connection
 $conn = new mysqli($servername, $username, $password,$db);
if(isset($_SESSION['user'])){


    $succ=0;

   if (isset($_POST["submit"])) {
       
    // start info
    $type=$_POST["type"];
    $qnt = $_POST["qnt"];
    $id = $_SESSION["id"];
    $dat = date("yy-m-d");
   
    
    
  
    
    

    ///  return resuly
    //if (empty($er)) {
            # code...
            // check if username exist deja
            
           
                $sql = "INSERT INTO trash (type,qt,id,date_e) VALUES ('$type','$qnt', '$id','$dat')";
                if ($conn->query($sql) === TRUE) {
                    $succ = 1;
                   
            } 
                else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                      }
                
    
            
    
        
                 

    
    
    
    }
    
    }else{
    
            header("location:login.php");
        }
    
    




    




?>


<!--****************************** start  html************************************-->

<html>
    <head>
        <title></title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.1/dist/sweetalert2.min.css"/>
        <link rel='stylesheet' type='text/css' media='screen' href='../css/home.css'>


        <style>
        body{
            background  : #000;
        }
        .succ{
            width: 80%;
            margin: auto;
            position: relative;
            bottom: 40%;
        }
        </style>
</head>
<body>




    <!-- start navigation -->
    
    
    <div class="landing">
    <!-- start nav -->
    
    <nav class="navbar">

        
    <div class="logo" style="color: rgb(255, 255, 255);
  text-transform: uppercase;
  letter-spacing: 5px;
  font-size: 20px;
  position: relative;">
    <img src="../logo.svg"  style="position: absolute;
  height: 80px;
  width: 80px;
  margin-top: -38px;">
    </div>
    <ul class="nav-links">
        <li><a href="#">Home</a></li>
        <li><a href="showc.php">Demandes</a></li>
        <!-- dropdown menu -->
        <li>
            <div class="dropdown">
                <a class=" dropdown-toggle" href="#" role="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php if(isset( $_SESSION['user']))  echo $_SESSION['user'] ; ?>
                </a>
                <div class="dropdown-menu dpm" aria-labelledby="dropdownMenuLink" style="width : 80%">
                <a class="dropdown-item" href="editinfo.php" style="color: black;">info</a>
                <a class="dropdown-item" href="logout.php" style="color: black;">logout</a>
                
                </div>
            </div>
        </li>
        <!-- end dropdown menu -->
        
    </ul>
    <!-- humbur-->
    <div class="burger">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
    </div>


</nav>


<!-- start post formula -->
<div class="add">

        <div class="wall">
        <img src="../img/add.png" style="margin-left: 30px;">
        </div>
        <div class="create">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Faire une demande</button>
        </div>

        <!-- start model -->
        <!-- Button trigger modal -->
        

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        $res =      mysqli_query($conn, $sql);
                         if(mysqli_num_rows($res) > 0) {
                             $bnadem  = mysqli_fetch_all($res,MYSQLI_ASSOC);
                             foreach($bnadem as $abd) { ?>
                    <option value="<?php echo $abd['type']; ?>"><?php echo $abd['type']; ?> </option>
                    <?php
                    }}?>
                    </select>
                    <div class="invalid-feedback">invalid </div>
                    </div>


                    <div class="form-group">
                        <label for="qnt">Quantitee</label>
                        <div class="input-group">
                            
                            <input type="number" class="form-control " id="qnt" name="qnt" placeholder="quantitee" aria-describedby="validationTooltipUsernamePrepend" required>
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
                    <input type="submit" class="btn btn-primary" name="submit" value="submit">
                </div>
                </form>
                </div>
            </div>
            </div>


</div>
<!-- end modal -->
<!-- success alert -->




</div>


<!-- start script -->
<script src="../js/jquery.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.1/dist/sweetalert2.all.min.js"></script>
<script>
    function navSlide() {
    const burger = document.querySelector(".burger");
    const nav = document.querySelector(".nav-links");
    const navLinks = document.querySelectorAll(".nav-links li");
    
    burger.addEventListener("click", () => {
        //Toggle Nav
        nav.classList.toggle("nav-active");
        
        //Animate Links
        navLinks.forEach((link, index) => {
            if (link.style.animation) {
                link.style.animation = ""
            } else {
                link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.5}s`;
            }
        });
        //Burger Animation
        burger.classList.toggle("toggle");
    });
    
}

navSlide();
</script>
<!---  verifivation form -->
<script>
$(document).ready(function () {
 
    $(".btn-primary").attr("disabled","disabled");
        $(".custom-select").blur(function(){
            if($(this).val() ==""){
                $(this).addClass('is-invalid').removeClass('is-valid');
                $(".btn-primary").attr("disabled","disabled");
            }else{
                $(this).addClass('is-valid').removeClass('is-invalid');
                $(".btn-primary").removeAttr("disabled","disabled");
            }
        });
        $("#qnt").blur(function(){
            if($(this).val() <= 0){
                $(this).addClass('is-invalid').removeClass('is-valid');
                $(".btn-primary").attr("disabled","disabled");
            }else{
                $(this).addClass('is-valid').removeClass('is-invalid');
                $(".btn-primary").removeAttr("disabled","disabled");
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
  text: 'Do you want to continue',
  icon: 'success',
  confirmButtonText: 'Cool'
})
  </script>
  

<?php
}

?>

</body>
</html>