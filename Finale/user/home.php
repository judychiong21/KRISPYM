<?php
session_start();
$_SESSION['user_id'];

include("..//..//class/Users.php");
$data = new Users ();
$result = $data->viewItems();
?>

<link rel="stylesheet" href="../../assets/css/userHome.css">
<h1>Welcome user </h1>

<div class="container2">
    <?php foreach ($result as $yes) { ?> 
        <?php
        $image = json_decode ($yes['r_image'], true);
        $firstImage = (!empty(images) && is_array ($image)) ? htmlspecialchars($images[0], ENT_QUOTES,
        'UTF-8') : 'default.jpg'; ?>

        <div class="container">
            <div class="box">
                <span class="title"><?php echo htmlspecialchars($yes['r_name']) ?></span>
                <div>
                    <img height="60" width="60" src="../uploads/<?php echo $firstImage; ?>"
                    alt="Property Image" />

                   <strong> <?php echo htmlspecialchars(number_format($yes['r_price'], 2)) ?></strong>
                   <p>Available Room : <?php echo htmlspecialchars($yes['r_quantity']) ?> </p>
                   <br>
                   <span><?php  echo htmlspecialchars($yes['r_description']) ?> </span>
    </div>
    
    <button class="btn-53">
        <div class="original">Booking</div>
        <div class="letters">

        <span>B</span>
        <span>O</span> 
        <span>O</span>
        <span>K</span>
        <span>I</span>
        <span>N</span>
        <span>G</span>
    </div>
    </button>
    </div>
    <?php} ?>

    </div>

        
    
    
    