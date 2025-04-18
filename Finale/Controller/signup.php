<?php 

if(isset($_POST['fname']) && 
   isset($_POST['uname']) && 
   isset($_POST['pass'])){

    include "../class/Connection.php";

    $fname = $_POST['fname'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $data = "fname=".$fname."&uname=".$uname;
    
    if (empty($fname)) {
    	$em = "Name is required";
    	header("Location: ../public/index.php?error=$em&$data");
	    exit;
    }else if(empty($uname)){
    	$em = "Username is required";
    	header("Location: ../public/index.php?error=$em&$data");
	    exit;
    }else if(empty($pass)){
    	$em = "Password is required";
    	header("Location: ../public/index.php?error=$em&$data");
	    exit;
    }else {

    	// para di makita ang password sa admin haha
    	$pass = password_hash($pass, PASSWORD_DEFAULT);

    	$sql = "INSERT INTO users(fname, username, password) 
    	        VALUES(?,?,?)";
    	$stmt = $conn->prepare($sql);
    	$stmt->execute([$fname, $uname, $pass]);

    	header("Location: ../view/index.html");
	    exit;
    }


}else {
	header("Location: ../public/index.php?error=error");
	exit;
}
