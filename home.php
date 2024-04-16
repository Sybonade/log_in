<?php 
include_once 'includes/header.php';
include_once 'includes/functions.php';
$user -> checkLoginStatus();
$test = $user -> checkUserRole(500);

var_dump($test);

?>

<div class="container">
    <h2>Välkommen <?php echo $_SESSION['user_name']?></h2>
</div>



<?php
include_once 'includes/footer.php';
?>