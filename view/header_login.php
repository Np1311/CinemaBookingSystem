<?php
session_start();
?>
<html>
    <head>
        <link rel="icon" type="image/x-icon" href="/favicon.ico"> <!--new thing-->
        <style>
            .header {
                
                background: #bd9a7a;
                color: white;
                font-size: 20px;
                width:100%;
                height:50px; 
                position:fixed;
                top:0;
                left:0;
                font-family : Arial ;
                display: grid;
                grid-template-columns: auto auto auto auto !important;
                gap: 200px;
                
                padding: 10px;

                z-index: 999;
                

                
            }

            .header-image {
                height: 50px;
            }

            /* h2{
                
                margin-block-start: 0.18em !important; 
                margin-block-end: 0 !important;
                margin-inline-start: 0px;
                margin-inline-end: 0px;
                
            } */
            

            
            .logout {
            background-color: #0a0805 ;
            color: #FFFFFF ;
            padding: 10px 20px;
            font-size: 20px;
            border: none;
            margin-top: 4px;
            font-family: Arial;
            border-radius: 5px;
            cursor: pointer;
            }

            .back {
            background-color: #fff ;
            color: #0a0805 ;
            padding: 10px 20px;
            font-size: 20px;
            border: none;
            margin-top: 4px;
            font-family: Arial;
            border-radius: 5px;
            cursor: pointer;
            }

            .logout:hover {
            background-color: #FFFFFF;
            color: #0a0805;
            }
            .back:hover {
            background-color: #0a0805;
            color: #ffff;
            }

            /* .back {
            background-color: rgb(238, 238, 238);
            color: black;
            padding: 10px 20px;
            font-size: 20px;
            border: none;
            margin-top: 4px;
            font-family: Arial;
            border-radius: 5px;
            cursor: pointer;
            } */


            
            #home {
            text-decoration: none;
            color: inherit;
            font-size: 30px;
            align-items: center !important;
            }

            .logoAndName{
                display: inline-block !important;  
            }
           
            
            /* .button:hover {
            background-color: red;
            } */
            
        </style>
    </head>
    <body>
        <div class="header">
            <div class ='logoAndName'>
            <img src="../cap2.png" alt="Your Image" class="header-image">
            <a href="index.php" id="home">&nbsp&nbspCapybara Cinema</a>
            </div><!--new thing -->
            <div></div> 
            <div></div>
            <div class = 'logoutbtn'>
                <?php
                    if($_SESSION['profile'] == 'system_admin'){
                ?>
                    <button class="back" onclick="location.href='../view/admin_home_view.php'">Home</button> &nbsp&nbsp
                    <button class="logout" onclick="location.href='../controller/logout.php'">
                    Log Out
                    </button>
                <?php
                    }
                ?>
                <?php
                    if($_SESSION['profile'] == 'manager'){
                ?>
                    <button class="back" onclick="location.href='../manager/manager_home_view.php'">Home</button> &nbsp&nbsp
                    <button class="logout" onclick="location.href='../../controller/logout.php'">
                    Log Out
                    </button>
                <?php
                    }
                ?>
                
                
                
        </div>
            
        </div>
        <script>
            function goBack() {
              window.history.go(-1);
            }
          </script>
    </body>

</html>
