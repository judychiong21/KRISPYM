<?php

if (isset($_POST['add'])) {

	include('Connection.php');
	include('Connection.php');

	$order_id = $_POST['order_id'];
	$customer_id = $_POST['customer_id'];
	$order_date = $_POST['order_date'];
	$total_amount = $_POST['total_amount'];
	

		$sql = "INSERT INTO orders (order_id, customer_id, order_date, total_amount) 
        VALUES ('$order_id', '$customer_id', '$order_date', '$total_amount')";

		$result = mysqli_query($conn, $sql);

		if (mysqli_query($conn, $sql)) {
			echo '<script type = "text/javascript">';
			echo 'alert("Item added sucessfully");';
			echo 'window.location.href = "../include/admin_panel.php" ';
			echo '</script>';
		} else {
			echo "Error: " . mysqli_error($conn);
		}
	
} 