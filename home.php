<?php 
include_once 'includes/header.php';
$user -> checkLoginStatus();



?>

<div class="container">
    <h2> <?php 
    if ($user->checkUserRole(500)){
    echo "Welcome admin {$_SESSION['user_name']}";}
    else {
        echo "Welcome user {$_SESSION['user_name']}";}?></h2>
    
</div>



<?php
include_once 'includes/footer.php';
?>