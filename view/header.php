<?php

?>
<html>
    <head>
       
        
        <style>
            .header {
                
                background: black;
                color: white;
                font-size: 20px;
                width:100%;
                height:50px; 
                position:absolute;
                top:0;
                left:0;
                font-family : Arial ;
                display: grid;
                grid-template-columns: auto auto auto auto;
                gap: 200px;
                
                padding: 10px;
                
            }

            h2{
                display: block;
                
                margin-block-start: 0.18em !important; 
                margin-block-end: 0 !important;
                margin-inline-start: 0px;
                margin-inline-end: 0px;
                
            }
            .container {
            display: inline-block;
            cursor: pointer;
            }

            .bar1, .bar2, .bar3 {
            width: 35px;
            height: 5px;
            background-color: white;
            margin: 6px 0;
            transition: 0.4s;
            }

            
            .dropbtn {
            background-color: black;
            color: white;
            padding: 5px;
            font-size: 10px;
            border: none;
            }

            .dropdown {
            position: relative;
            display: inline-block;
            }

            .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            }

            .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            }

            .dropdown-content a:hover {background-color: #ddd;}

            .dropdown:hover .dropdown-content {display: block;}

            .dropdown:hover .dropbtn {background-color: #3e8e41;}
            
        </style>
    </head>
    <body>
        <div class="header">
            <div><h2>&nbsp&nbspCapybara Cinema</h2></div>
            <div></div>
            <div></div>
            <div class="dropdown">
                <button class="dropbtn">
                <div class="container" onclick="myFunction(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
                </button>
                <div class="dropdown-content">
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                </div>
            </div>
        </div>
        <script>
            
        </script>
    </body>

</html>
