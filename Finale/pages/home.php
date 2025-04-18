<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
    	<div class="shadow w-450 p-3 text-center">
            <h3 class="display-4 ">Welcome to Krispy M</h3>
			<a href="../view/index.html"> <center><h2>ORDER HERE</h2></center></a><br>
            <a href="../Controller/logout.php" class="btn btn-warning">
            	Logout
            </a>
		</div>
    </div>
</body>
</html>

<?php }else {
	header("Location: ../Controller/login.php");
	exit;
} ?>