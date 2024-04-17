<?php

include_once 'includes/header.php';

if ($user->checkUserRole(500)) {
    
}
else {
    header('Location: home.php');
}

$user -> checkLoginStatus();


if(isset($_POST['search'])) {
    $user_array = $user->searchUsers($_POST['search']);
}



?>




<div class="container ">
    <div class="row mt-5 mb-5">
        <div class="col">
        <form method="post" >        
        <div class="form-group mt-3" style="max-width: 250px;">
            <label for="search">Search for user</label>
            <input type="text" name="search" class="form-control" id="search" placeholder="Username or email">
        </div>

        <a href="home.php" type="button" class="btn btn-primary mt-3">Return</a>
        <button type="submit" name="edit-user" class="btn btn-success mt-3">Update Info</button>
        </form> 
</div>

<div class="col">
    <?php if(isset($_POST['search'])) {
        foreach ($user_array as $data){
            echo "<div class='row'>
                <div class='col'>
                     <h5>{$data['u_name']}</h5>
                </div>
                <div class='col'>
                <a type='button' class='btn btn-primary mt-3 '  href='admin-account.php?uid={$data['u_id']}'>Edit user</a>
           </div>
            </div>";
        }
    }
    ?>
</div>
</div>
</div>



<?php 
include_once 'includes/footer.php';
?>