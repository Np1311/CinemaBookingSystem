<?php

// Include the header file
require('../header.html');

// Include the booking controller
require('../../controller/booking_controller.php');

session_start();

// Get the phone and date values from the URL parameters
$phone = $_GET['phone'];
$date = $_GET['date'];

// Check if the food and drink data is available
if($booking_controller -> getFoodAndDrinkController() == false){
    echo '<script>alert("No food listed")</script>';
}else{
    // Retrieve the food and drink data
    $array = $booking_controller -> getFoodAndDrinkController();
}
// Print the food and drink data
print_r($array);

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
            

            
            .food-container {
                margin-top : 100px;
                max-width: 1200px;
                margin-left: 150px ;
                padding: 20px;
            }
            
            .food-list {
                display: flex;
                flex-wrap: wrap;
            }
            .food {
                
                width: 300px;
                margin: 20px;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                position: relative;
                transition: background-color 0.3s ease-in-out;
                box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.2);
            }
            .food img {
                width: 100%;
                height: 400px;
                object-fit: cover;
                border-radius: 5px;
            }
            .food h2 {
                font-size: 24px;
                margin-top: 10px;
                margin-bottom: 5px;
            }
            .food p {
                font-size: 16px;
                margin-top: 5px;
                margin-bottom: 10px;
            }
            
            /* .food button:hover {
                background-color: white;
                color: #bd9a7a;
                border: 2px solid #bd9a7a;
            } */
            body {background-color: #e7dbd0}
            
            body {font-family: Verdana, sans-serif; margin:0}
            
            img {vertical-align: middle;}

            .quantity {
            display: flex;
            align-items: center;
            }

            input[type=number]::-webkit-inner-spin-button, 
            input[type=number]::-webkit-outer-spin-button { 
                -webkit-appearance: none;
                margin: 0;
            }

            input[type=number] {
                -moz-appearance:textfield;
                appearance:textfield;
                width: 40px;
                text-align: center;
                border: none;
                border-bottom: 1px solid #ddd;
                font-size: 16px;
                margin: 0 10px;
            }

            .minus-btn, .plus-btn {
                font-size: 18px;
                font-weight: bold;
                color: #222;
                cursor: pointer;
                border: none;
                background: transparent;
                outline: none;
            }

            .minus-btn:hover, .plus-btn:hover {
                color: white;
            }

            .plus-btn:focus, .minus-btn:focus {
                outline: none;
            }

            .disabled {
                opacity: .5;
                pointer-events: none;
            }

            input[type="submit"] {
                flex: 1;
                margin: 0 5px;
                padding-top:10px;
                padding: 10px;
                border-radius: 5px;
                cursor: pointer;
                background-color: #bd9a7a;
                color: white;
                border: none;
                font-size: 14px;
                margin-left:26%;
                width:25%;
                margin-bottom:3%;
            }
            
            input[type="submit"]:hover {
            background-color:white;
                color: #bd9a7a;
                border: 2px solid #bd9a7a;
            }

            .custom-button {
            flex: 1;
            margin: 0 5px;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            background-color: #bd9a7a;
            color: white;
            border: none;
            font-size: 14px;
            text-decoration: none;
            width:25%;
        }

        .custom-button:hover {
            background-color:white;
            color: #bd9a7a;
            border: 2px solid #bd9a7a;
        }

            
        </style>
        
    </head>
    <body>        
        <!--Display the all of the foods available for order-->
        <form method ='post'>
            <div class="food-container">
                <div class="food-list">
                <?php
                foreach($array as $key=>$arr){
                ?>
                    <div class="food">
                    <img src="<?php echo $arr['image'];?>" alt="Movie 1">
                    <h2 ><?php echo $arr['foodName'];?></h2><br>
                    <p><b>Description = </b><?php echo $arr['foodDescription'];?></p>
                    <label>Price:</label>
                    <input type="number" name="price[<?php echo $arr['foodID']?>]" value="<?php echo $arr['price'];?>" ></br><br>


                    <label for="number"><b>Quantity:</b></label><br>
                    <div class="quantity">
                        <button type='button' class="minus-btn">-</button>
                        <input type="number" name="quantity[<?php echo $arr['foodID']?>]" value="0">
                        <button type='button' class="plus-btn">+</button>
                    </div>
                    </div>
                <?php
                }
                ?>
                </div>
            </div>
            <input type="submit" name="submit" value="Order">
            <button type="button" class= "custom-button" onclick="goBack()">Back</button>

            </form>
            <script>
                // Get the plus and minus buttons
                const plusBtns = document.querySelectorAll('.plus-btn');
                const minusBtns = document.querySelectorAll('.minus-btn');

                // Add event listeners to plus buttons
                for (let i = 0; i < plusBtns.length; i++) {
                plusBtns[i].addEventListener('click', () => {
                    const input = plusBtns[i].previousElementSibling;
                    let value = parseInt(input.value);
                    value++;
                    input.value = value;
                });
                // Add event listeners to minus buttons
                minusBtns[i].addEventListener('click', () => {
                    const input = minusBtns[i].nextElementSibling;
                    let value = parseInt(input.value);
                    if (value > 1) {
                    value--;
                    input.value = value;
                    }
                });
                }
                // Function to go back to the previous page
                function goBack() {
            window.history.go(-1);
        }
            </script>



        <?php
        //Get the price and quantity of the foods
        if(isset($_POST['submit'])){
            $orderedFood = $_POST['quantity'];
            $priceArr = $_POST['price'];
            $price = 0;
            
            // Calculate the total price based on the ordered quantities and prices
            foreach ($orderedFood as $id => $quantity1) {
                if($quantity1 != 0){
                    $price += $quantity1 * $priceArr[$id];
                }
            }
            // Set the loyalty points to the total price
            $loyaltypoints = $price;

            // Call the orderFoodController function to place the food order
            if($booking_controller->orderFoodController($phone,$date,$price,$loyaltypoints,$orderedFood)){
                echo" <script>window.location='booking_preorder_receipt.php';</script>";
            }


                  
        }
        
        require('../footer.html');
        
        ?>
        
    </body>
</html>