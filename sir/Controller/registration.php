<?php

include('../class/Users.php');
$user = new Users();

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = "username=".$username;
    
    }if(empty($username)){
    	$em = "Username is required";
    	header("Location: ../pages/home.php?error=$em&$data");
	    exit;
    }else if(empty($password)){
    	$em = "Password is required";
    	header("Location: ../pages/home.php?error=$em&$data");
	    exit;
    }

    //Sanitize
    $sanitized_username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sanitized_password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $result = $user->register($sanitized_username, $sanitized_password);

    if ($result) {
        header('location: ../pages/login.php');
    } else {
        echo "Error";
    }

