<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capstone Project for Electric Bill</title>
</head>

<body>
<?php
	$amount = '';
	$kwh_usage = '';
	if (isset($_POST['submit'])) {
		$units = $_POST['kwh'];
		if (!empty($units)) {
			$kwh_usage = calculate_electricity_bill($units);
			$amount = '<strong>Total amount of ' . $units . ' units -</strong> ' . $kwh_usage;
		}
	}
	/**
	 * To calculate electricity bill as per unit cost
	 */
	function calculate_electricity_bill($units) {
		$first_unit_cost = 3.50;
		$second_unit_cost = 4.00;
		$third_unit_cost = 5.20;
		$fourth_unit_cost = 6.50;

        // Check units consumed is less than equal to the 50, If yes then the total electricity bill will be:

        // Total Electricity Bill = units * 3.50) 
		if($units <= 50) {
			$bill = $units * $first_unit_cost;
		}

        // Else if, check that units consumed is less than equal to the 150, if yes then total electricity bill will be:

        // Total Electricity Bill = (50 * 3.50) + (units - 50) * 4.00 
		else if($units > 50 && $units <= 150) {
			$temp = 50 * $first_unit_cost;
			$remaining_units = $units - 50;
			$bill = $temp + ($remaining_units * $second_unit_cost);
		}

        // Else if, check that units consumed is less than equal to the 250, if yes then total electricity bill will be:

        // Total Electricity Bill = (50* 3.5) + (50 * 4.00) + (units- 150) * 5.20
		else if($units > 150 && $units <= 250) {
			$temp = (50 * $first_unit_cost) + (50 * $second_unit_cost);
			$remaining_units = $units - 150;
			$bill = $temp + ($remaining_units * $third_unit_cost);
		}

        // Else check that units consumed greater than 250, if yes then total electricity bill will be:

        // Total Electricity Bill = (50 * 3.5) + (50 * 4.00) + (50 * 5.20) + (units- 250) * 6.50
        else {
			$temp = (50 * $first_unit_cost) + (50 * $second_unit_cost) + (50 * $third_unit_cost);
			$remaining_units = $units - 250;
			$bill = $temp + ($remaining_units * $fourth_unit_cost);
		}
		return number_format((float)$bill, 2, '.', '');
	}
	?>
	<div class="container">
		<h1>Capstone Project Calculating Electric bill in PHP</h1>
		<div class="form-group">
		<form action="" method="post">
			<div class="form-group">
				<input type="number" name="kwh" placeholder="Please enter no. of Units" class="form-control" />
			</div>
			<br>
			<div class="form-group">		
				<input type="submit" name="submit" class="btn btn-primary" value="Submit" />
			</div>	
		</form>
		</div>
		<div>
		    <?php echo '<br />' . $amount; ?>
		</div>
	</div>
</body>
</html>