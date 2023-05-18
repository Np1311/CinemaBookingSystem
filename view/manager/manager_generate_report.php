<?php
require('../../controller/manager_controller.php');
require('../header.html');
$array = $controller -> getYearController();

print_r($array);
?>
<html>
<head>
  <title>Date Selection Form</title>
  <style>
    body {
        background-color: #e7dbd0;
        font-family: Arial, sans-serif;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
        margin-top: 100px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        background-color: white;
    }

    table th,
    table td {
        padding: 10px;
        border: 1px solid #ccc;
    }

    table th {
        background-color: #bd9a7a;
        color: white;
        font-weight: bold;
    }

    table td {
        text-align: center;
    }
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px;
    }

    label {
        margin-top: 10px;
        font-weight: bold;
    }

    select,
    input[type="date"],
    input[type="submit"] {
        margin-top: 5px;
        padding: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    input[type="submit"],
    button {
        background-color: #bd9a7a;
        color: white;
        cursor: pointer;
        border: none; 
        border-radius: 5px;
        font-size: 18px;
    }

    input[type="submit"]:hover {
        background-color: #a37c5f;
    }
    .button-container {
        display: flex;
        justify-content: center;
    }

    .button-container a {
        display: inline-block;
    }

</style>
</style>

</head>
<body>
  <form method='post' onsubmit="return validateForm()">
    <label for="selection">Select Option:</label>
    <select id="selection" onchange="handleOptionChange()" name="reportType">
      <option value="" disabled selected>Select Report</option>
      <option value="monthly">Monthly</option>
      <option value="weekly">Weekly</option>
    </select>

    <div id="monthlyFields" style="display: none;">
      <label for="year">Year:</label>
      <select id="year" name="year">
        <?php 
        foreach($array as $key => $value){

        ?>
        <option value="<?php echo $value;?>"><?php echo $value;?></option>
        <?php
        }
        ?>
        <!-- Add more years as needed -->
      </select>

      <label for="month">Month:</label>
      <select id="month" name="month">
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
      </select>
    </div>

    <div id="weeklyFields" style="display: none;">
      <label for="startDate">Start Date:</label>
      <input type="date" id="startDate" name="startDate">

      <label for="endDate">End Date:</label>
      <input type="date" id="endDate" name="endDate">
    </div>

    <input type="submit" name = "submit" value="Submit">
  </form>
  <div class="button-container">
    <a href="manager_home_view.php">
        <button>Back</button>
    </a>
  </div>
  <br>
       

  <script>
    function handleOptionChange() {
      var selection = document.getElementById("selection").value;
      var monthlyFields = document.getElementById("monthlyFields");
      var weeklyFields = document.getElementById("weeklyFields");

      if (selection === "monthly") {
        monthlyFields.style.display = "block";
        weeklyFields.style.display = "none";
      } else if (selection === "weekly") {
        monthlyFields.style.display = "none";
        weeklyFields.style.display = "block";
      }
    }
    function validateForm() {
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;

        if (startDate > endDate) {
        alert('Start date cannot be greater than the end date.');
        return false;
        }

        return true;
    }
  </script>
  <?php
    if (isset($_POST['submit'])) {
        $reportType = $_POST['reportType'];
        echo '<div class="container">';

        if ($reportType === 'monthly') {
            $year = $_POST['year'];
            $month = $_POST['month'];
            echo '<table>';
            echo '<thead><tr><th>#</th><th>Movie Name</th><th>Month</th><th>Total Tickets</th><th>Total Amount</th></tr></thead>';
            echo '<tbody>';
            if ($controller->generateMonthlyReportController($year, $month) != false) {
                $array = $controller->generateMonthlyReportController($year, $month);

                foreach ($array as $index => $row) {
                    echo '<tr>';
                    echo '<td>' . ($index + 1) . '</td>';
                    echo '<td>' . $row['movieName'] . '</td>';
                    echo '<td>' . $row['month'] . '</td>';
                    echo '<td>' . $row['totalTickets'] . '</td>';
                    echo '<td>' . $row['totalAmount'] . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="5">No data at the moment</td></tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo "Monthly Report Selected: Year = $year, Month = $month";
        } elseif ($reportType === 'weekly') {
            echo '<table>';
            echo '<thead><tr><th>#</th><th>Movie Name</th><th>Total Tickets</th><th>Total Amount</th></tr></thead>';
            echo '<tbody>';
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];
            if ($controller->generateWeeklyReportController($startDate, $endDate) != false) {
                $array = $controller->generateWeeklyReportController($startDate, $endDate);

                foreach ($array as $index => $row) {
                    echo '<tr>';
                    echo '<td>' . ($index + 1) . '</td>';
                    echo '<td>' . $row['movieName'] . '</td>';
                    echo '<td>' . $row['totalTickets'] . '</td>';
                    echo '<td>' . $row['totalAmount'] . '</td>';
                    echo '</tr>';
                }
            }else {
                echo '<tr><td colspan="4">No data at the moment</td></tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo "Weekly Report Selected: Start Date = $startDate, End Date = $endDate";
        }
        
    }
    echo '</div>';
    ?>
   
</body>
</html>
