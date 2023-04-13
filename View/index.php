<?php
require ("header.php");
session_start();
function checker($email){
   
   
   
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid";
        echo "<script>document.getElementById('emailErr').innerHTML = '$emailErr';</script>";
    }else {
        $emailErr = "false";
    }

   
    
   
    if($emailErr == 'false' ){
        
        echo" <script>window.location='homePage.php';</script>"; 
    }
}
?>
<html>
    <head>
        <title>Capybara Cinema</title>
        <style>
            .formContainer{
                
                background: black;
                color: white;
                margin: auto;
                width: 30%;
                border: 3px solid white;
                padding: 10px;
                font-family : Arial ;
                margin-top: 80px;
            
            }
            .btn-primary{
                background-color: blue; 
                border: 2px solid white;
                color: white;
                padding: 15px ;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                border-radius: 8px;
                width: 400px;
                /* margin-left: 100px; */
            }
            .form-control{
                white-space: nowrap;
                overflow: hidden;
                width: 100%;
                text-overflow: ellipsis;
            }
            .input-group-text{
                font-size: 20px;
            }
            

            body {background-color: gray}
            .slideShowContainer {box-sizing: border-box}
            body {font-family: Verdana, sans-serif; margin:0}
            .mySlides {display: none}
            img {vertical-align: middle;}

            /* Slideshow container */
            .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
            margin-top: 80px;
            }

            /* Next & previous buttons */
            .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            }

            /* Position the "next button" to the right */
            .next {
            right: 0;
            border-radius: 3px 0 0 3px;
            }

            /* On hover, add a black background color with a little bit see-through */
            .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.8);
            }

            /* Caption text */
            .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
            }

            /* Number text (1/3 etc) */
            .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
            }

            /* The dots/bullets/indicators */
            .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
            }

            .active, .dot:hover {
            background-color: #717171;
            }

            /* Fading animation */
            .fade {
            animation-name: fade;
            animation-duration: 1.5s;
            }

            @keyframes fade {
            from {opacity: .4} 
            to {opacity: 1}
            }

            /* On smaller screens, decrease text size */
            @media only screen and (max-width: 300px) {
            .prev, .next,.text {font-size: 11px}
            }
        </style>
    </head>
    <body>
        <div class="slideShowContainer">
            <div class="slideshow-container">

                <div class="mySlides fade">
                    <div class="numbertext">1 / 4</div>
                    <img src="mariobros.jpg" style="width:100%">
                    <div class="text">Caption Text</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">2 / 4</div>
                    <img src="air.jpg" style="width:100%">
                    <div class="text">Caption Two</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">3 / 4</div>
                    <img src="popeexorcist.jpg" style="width:100%">
                    <div class="text">Caption Three</div>
                </div>
                <div class="mySlides fade">
                    <div class="numbertext">4 / 4</div>
                    <img src="rideOn.jpg" style="width:100%">
                    <div class="text">Caption Four</div>
                </div>

                <a class="prev" onclick="plusSlides(-1)">❮</a>
                <a class="next" onclick="plusSlides(1)">❯</a>

            </div>
                <br>

            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span> 
                <span class="dot" onclick="currentSlide(2)"></span> 
                <span class="dot" onclick="currentSlide(3)"></span> 
                <span class="dot" onclick="currentSlide(4)"></span> 
            </div>

        </div>
         <div class="formContainer"  style="text-align:center;"  >
            <form method='post' >
            </br></br>
                <div class="signIn" style="text-align:left;"> 
                    <span class="input-group-text" id="emailSpan">Email</span>
                    <input class="form-control" type="text" name="email" id="email" required>
                    <span class="input-group-text" id="emailErr"></span></br>
                    
                    </br></br>
                   
                    <span class="input-group-text" id="basic-addon1">Password</span>
                    <input class="form-control" type="password" name="pass" id="pass" required>
                    
                    <input  style="font-size: 10px;" class="form-check-input mt-0" type="checkbox" onclick="myFunction('pass')"> &nbspShow Password</input>
                </div>
                </br>
                <button class="btn-primary" type ='submit' name='submit' value='submit'> Submit </button>
                <h3></br>Don't have account ? <a href="signUp.php">Sign up</a></h3>
            </form>
            </br>
        </div>
        </br></br></br></br></br>
        <script>
            function myFunction(type) {
            var x = document.getElementById(type);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            }
            let slideIndex = 1;
            showSlides(slideIndex);

            function plusSlides(n) {
            showSlides(slideIndex += n);
            }

            function currentSlide(n) {
            showSlides(slideIndex = n);
            }

            function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}    
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
            }
            let index = 0;
            runSlides();

            function runSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            index++;
            if (index > slides.length) {index = 1}    
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[index-1].style.display = "block";  
            dots[index-1].className += " active";
            setTimeout(runSlides, 4000); // Change image every 2 seconds
            }
        </script>
        <?php
        if(isset($_POST['submit'])){
            
            $_SESSION['email']=$_POST['email'];
           
            $_SESSION['pass'] = $_POST['pass'];

            checker($_SESSION['email']);
            
            
        }
        ?>
    </body>
</html>