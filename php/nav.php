<?php
if(isset($_SESSION['user'])){
    include('css.php');

}else{
    header("location:login.php");
}




?>

<!-- start navigation -->
    
    
<div class="landing">
    <!-- start nav -->
    
    <nav class="navbar">

        
    <div class="logo">
        <h4>The Nav</h4>
    </div>
    <ul class="nav-links">
        <li><a href="home.php">Home</a></li>
        <li><a href="showc.php">About</a></li>
        <!-- dropdown menu -->
        <li>
            <div class="dropdown">
                <a class=" dropdown-toggle" href="#" role="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php if(isset( $_SESSION['user']))  echo $_SESSION['user'] ; ?>
                </a>
                <div class="dropdown-menu dpm" aria-labelledby="dropdownMenuLink">
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

<script src="../js/jquery.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>

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

