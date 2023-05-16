<?php
require('../../controller/manager_controller.php');
$array = $controller -> getYearController();

print_r($array);
?>
<html>
<head>
  <title>Date Selection Form</title>
</head>
<body>
  <form>
    <label for="selection">Select Option:</label>
    <select id="selection" onchange="handleOptionChange()">
      <option value="">Select Report</option>
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

    <input type="submit" value="Submit">
  </form>

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
  </script>
</body>
</html>
