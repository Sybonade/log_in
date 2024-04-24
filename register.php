<?php
include_once 'includes/header.php';

if(isset($_POST['add-user'])) {
	$feedback = $user->checkUserRegisterInput($_POST['name'], $_POST['mail'], $_POST['upass'], $_POST['upassrepeat']);

    if($feedback === 1){
        $user->register($_POST['name'], $_POST['mail'], $_POST['upass']);

    }else {
    foreach ($feedback as $item) {
        echo $item;
    }
}
}
?>

<div class="container-fluid">
    <div class="row justify-content-center m-5">
        <div class="col-md-6">
        <h1>Register user</h1>
            <form method="post">
                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Username">
                </div> 
                <div class="form-group mt-3">
                    <label for="mail">Email address</label>
                    <input type="email" name="mail" class="form-control" id="mail" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>                                                      
                
                <div class="form-group mt-3">
                    <label for="upass">Password</label>
                    <input type="password" name="upass" class="form-control" id="upass" placeholder="Password">
                </div>
                
                <div class="form-group mt-3">
                    <label for="upassrepeat">Re-enter password</label>
                    <input type="password" name="upassrepeat" class="form-control" id="upassrepeat" placeholder="Re-enter Password">
                </div>

                <button type="submit" name="add-user" class="btn btn-success mt-3">Create account</button>
            </form> 
        </div>
    </div>
</div>


<?php 
include_once 'includes/footer.php';
?>