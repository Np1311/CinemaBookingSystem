<?php
session_start();

?>
<html>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"> <!--Show password-->
    <head>
    <script type="text/javascript"> 
    function togglePasswordVisibility() 
    {
    const passwordInput = document.getElementById('password-input');
    const showPasswordIcon = document.querySelector('.show-password-icon');

    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      showPasswordIcon.classList.remove('fa-eye-slash');
      showPasswordIcon.classList.add('fa-eye');
    } else {
      passwordInput.type = 'password';
      showPasswordIcon.classList.remove('fa-eye');
      showPasswordIcon.classList.add('fa-eye-slash');
    }
    } //show password
</script>

    <title>Capybara Cinema</title>
        <style>
        form {
        width: 400px;
        margin: 0 auto;
        background-color: #FFFFFF;
        padding: 20px;
        margin-top: 30px;
        border-radius: 5px;
        box-shadow: 0px 2px 5px #666666;
        }
            .btn-primary{
                background-color: #bd9a7a; 
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
            /*New thing */
            .btn-primary:hover {
                background-color: #fff;
                color: #bd9a7a;
                border: 2px solid;
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
            

            body {background-color: #e7dbd0 }
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
            .movie-container {
                max-width: 1200px;
                margin-left: 150px ;
                padding: 20px;
            }
            
            .movie-list {
                display: flex;
                flex-wrap: wrap;
            }
            .movie {
                
                width: 300px;
                margin: 20px;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                position: relative;
                transition: background-color 0.3s ease-in-out;
                box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.2);
            }
            .movie img {
                width: 100%;
                height: 400px;
                object-fit: cover;
                border-radius: 5px;
            }
            .movie h2 {
                font-size: 24px;
                margin-top: 10px;
                margin-bottom: 5px;
            }
            .movie p {
                font-size: 16px;
                margin-top: 5px;
                margin-bottom: 10px;
            }
            .movie button {
                display: block;
                width: 100%;
                padding: 10px;
                border: none;
                border-radius: 5px;
                background-color: #bd9a7a;
                color: #fff;
                font-size: 16px;
                cursor: pointer;
            }
            .movie button:hover {
                background-color: #fff;
                color: #bd9a7a;
                border: 2px solid;
            }
            /* Style the banner */
            .banner {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #1a237e;
            color: #fff;
            padding: 20px;
            }

            /* Style the left partition */
            .banner-left {
            flex-basis: 33.33%;
            padding-right: 20px;
            border-right: 1px solid #fff;
            }

            /* Style the middle partition */
            .banner-middle {
            flex-basis: 33.33%;
            padding-right: 20px;
            padding-left: 20px;
            border-right: 1px solid #fff;
            }

            /* Style the right partition */
            .banner-right {
            flex-basis: 33.33%;
            padding-left: 20px;
            }

            /* Style the banner divider */
            .banner-divider {
            height: 50%;
            border-left: 1px solid #fff;
            margin: 0 20px;
            }

            /* Style the footer */
            .footer {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: darkseagreen;
            color: #fff;
            }

            /* Style the footer */
            .footer {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #bd9a7a;
            color: #fff;
            padding: 1px;
            font-size: 13px;
            background-color: #bd9a7a;
            }

            /* Style the system administrators partition */
            .footer-admins {
            flex-basis: 5%;
            padding-right: 20px;
            }

            /* Style the managers partition */
            .footer-managers {
            flex-basis: 5%;
            padding-left: 5px;
            padding-right: 5px;
            border-left: 1px solid #fff;
            border-right: 1px solid #fff;
            }

            /* Style the staff partition */
            .footer-staff {
            flex-basis: 5%;
            padding-left: 5px;
            }

            /* Style the line partition */
            .footer-line {
            height: 100%;
            width: 1px;
            background-color: #fff;
            }
            a:visited{
                color:black;
            }
            a:link{
                color:black; /*beside Don't have account*/
            }
            a:hover{
                color:red;
            }
            a:focus{
                color:red;
            }
            a:active{
                color:red;
            }
            .password-container {
            position: relative;
            }

            .show-password-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            }

            input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #CCCCCC;
            margin-bottom: 20px;
        }
            

            
        </style>
    </head>
    <body>
        <?php require ('header.html');?>
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
                <span class="input-group-text" id="phone-label">Phone</span>
                <input class="form-control" type="text" name="phone" id="phone" placeholder="Enter Phone Number" required>
                                
            </br></br>
                            
                <div class="password-container">
                <span class="input-group-text" id="basic-addon1">Password</span>
                <input type="password" placeholder="Enter Password" id="password-input" name='pass'>
                <i class="show-password-icon fa fa-eye-slash" aria-hidden="true" onclick="togglePasswordVisibility()"></i>
                </div>
            </div>
                </br>
                <button class="btn-primary" type ='submit' name='submit' value='submit'> Log in </button>
                <h3></br>Don't have account ? <a href="signUp.php">Sign up</a></h3>
            </form>
            </br>
        </div>
        </br></br></br></br></br>
        <div class="movie-container">
		
            <div class="movie-list">
                <div class="movie">
                    <img src="https://via.placeholder.com/300x400.png?text=Movie+1" alt="Movie 1">
                    <h2>Movie 1</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae magna eget augue placerat elementum.</p>
                    <button>Book Now</button>
                </div>
                <div class="movie">
                    <img src="https://via.placeholder.com/300x400.png?text=Movie+2" alt="Movie 2">
                    <h2>Movie 2</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae magna eget augue placerat elementum.</p>
                    <button>Book Now</button>
                </div>
                <div class="movie">
                    <img src="https://via.placeholder.com/300x400.png?text=Movie+3" alt="Movie 3">
                    <h2>Movie 3</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae magna eget augue placerat elementum.</p>
                    <button>Book Now</button>
                </div>
                <div class="movie">
                    <img src="https://via.placeholder.com/300x400.png?text=Movie+4" alt="Movie 4">
                    <h2>Movie 4 </h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae magna eget augue placerat elementum.</p>
                    <button>Book Now</button>
                </div>
                <div class="movie">
                    <img src="https://via.placeholder.com/300x400.png?text=Movie+5" alt="Movie 5">
                    <h2>Movie 5</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae magna eget augue placerat elementum.</p>
                    <button>Book Now</button>
                </div>
                <div class="movie">
                    <img src="https://via.placeholder.com/300x400.png?text=Movie+6" alt="Movie 6">
                    <h2>Movie 6</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae magna eget augue placerat elementum.</p>
                    <button>Book Now</button>
                </div>
            </div>
        </div>
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
        require('../controller/login_controller.php');
        if (isset($_POST['submit'])){
            $phone = $_POST['phone'];
            $pass = $_POST['pass'];
            if(isset($_SESSION['profile'])== null){
                $_SESSION['profile'] = 'customer';
            }
            echo $_SESSION['profile'];
            
            $controller = new login_controller();
            
            $controller->validateLogin($_SESSION['profile'],$phone,$pass);
                
            
        }
        
        require('footer.html');
        ?>
        <footer class="footer">
            <div class="footer-admins">
                <!-- Content for system administrators partition goes here -->
                <a href="login_view.php?profile=system_admin">System Administrator</a>
            </div>
            <div class="footer-line"></div>
            <div class="footer-managers">
                <!-- Content for managers partition goes here -->
                <a href="login_view.php?profile=manager">Manager</a>
            </div>
            <div class="footer-line"></div>
            <div class="footer-staff">
                <!-- Content for staff partition goes here -->
                <a href="login_view.php?profile=staff">Staff</a>
            </div>
        </footer>
    </body>
</html>