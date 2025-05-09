<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Document</title>
</head>

<body>
<div class="d-flex justify-content-center align-items-center vh-100">

<form class="shadow w-450 p-3 color-yellow" 
    	      action="../Controller/registration.php"
    	      method="post">
			  <h1>WELCOME TO KRISPY M!</h1>
    		<h4 class="display-4 color-red fs-1">Sign up Here!</h4><br>
    		<?php if(isset($_GET['error'])){ ?>
    		<div class="alert alert-danger" role="alert">
			  <?php echo $_GET['error']; ?>
			</div>
		    <?php } ?>

		  <div class="mb-3">
		    <label class="form-label">User name</label>
		    <input type="text" 
		           class="form-control"
		           name="username"
		           value="<?php echo (isset($_GET['username']))?$_GET['username']:"" ?>">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Password</label>
		    <input type="password" 
		           class="form-control"
		           name="password">
		  </div>
		  
		  <button type="submit" class="btn btn-primary" name="register">Sign Up</button>
		  <a href="../pages/login.php" class="link-secondary">Log in</a>
		</form>

</body>

</html>