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




<div class="container">
    <div class="row mt-5 mb-5">
        <!-- Search form column -->
        <div class="col-md-6">
            <form method="post">        
                <div class="form-group mt-3">
                    <label for="search">Search for user</label>
                    <input type="text" name="search" class="form-control" id="search" placeholder="Username or email">
                </div>
                <div class="mt-3">
                    <a href="home.php" class="btn btn-primary">Return</a>
                    <button type="submit" name="search-button" class="btn btn-success ms-2">Search</button>
                </div>
            </form> 
        </div>

        <!-- Results column -->
        <div class="col-md-6">
            <?php if (isset($_POST['search'])): ?>
                <?php foreach ($user_array as $data): ?>
                    <h5 class="mt-5">Username: </h5>
                    <div class="d-flex  align-items-center mt-3">
                        <h5 class="me-5"><?php echo htmlspecialchars($data['u_name']); ?></h5>
                        <a href="admin-account.php?uid=<?php echo $data['u_id']; ?>" class="btn btn-primary">Edit user</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>



<?php 
include_once 'includes/footer.php';
?>