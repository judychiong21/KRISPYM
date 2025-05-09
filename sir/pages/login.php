<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	s<link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Log in</title>
</head>

<body>
<div class="d-flex justify-content-center align-items-center vh-100">

<form class="shadow w-450 p-3" method="post">
<h1>WELCOME TO KRISPY M!</h1>
    		<h4 class="display-4 color-red fs-1">Log in Here!</h4><br>
    		<?php if(isset($_GET['error'])){ ?>
    		<div class="alert alert-danger" role="alert">
			  <?php echo $_GET['error']; ?>
			</div>
		    <?php } ?>   
            
            <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" 
                               class="form-control" 
                               id="username" />
            </div>

            <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" 
                               class="form-control" 
                               id="password"/>
            </div>
                        <button type="button" class="btn btn-primary loginuser" id="loginuser">Login</button>
                        <a href="../pages/home.php" class="link-secondary">Sign up</a>
            </form>
</body>
<script src="../assets/js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {

        $('.loginuser').on('click', function(e) {
            e.preventDefault();

            const username = $('#username').val();
            const password = $('#password').val();

            console.log(username, password);
            $.ajax({
                url: "../Controller/login.php",
                method: 'post',
                data: {
                    'login': true,
                    username: username,
                    password: password
                },
                dataType: 'json',
                success: function(response) {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        Swal.fire({
                            title: response.error,
                            icon: "error",
                            draggable: true
                        });
                    }
                },
                error: function() {}
            })
        })

    })
</script>

</html>