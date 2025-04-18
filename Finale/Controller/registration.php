<?php

include('../class/Users.php');
$user = new Users();

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
}

//validation
if($name == ''){
    echo "Name is required";
    exit;
}
if($uname == ''){
    echo "Username is required";
    exit;
}
if($pass == ''){
    echo "Password is required";
    exit;
}

//sanitize
$name = filter_vara($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$uname = filter_vara($uname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$pass = filter_vara($pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

result = $user->register($name);
