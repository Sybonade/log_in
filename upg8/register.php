<?php
include_once 'includes/header.php';

if(isset($_POST['add-user'])) {
	$feedback = $user->checkUserRegisterInput($_POST['name'], $_POST['mail'], $_POST['upass'], $_POST['upassrepeat']);

    if($feedback === 1){
        $user->register($_POST['name'], $_POST['mail'], $_POST['upass']);

    }else {
    foreach ($feedbackMessage as $item) {
        echo $item;
    }
}
}
?>

<div class="container-fluid ">
    <div class="row m-5">
        <form method="post" >
        <div class="form-group " style="max-width: 250px;">
            <label for="name">Username</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Username">
        </div> 
        <div class="form-group mt-3" style="max-width: 250px;">
            <label for="mail">Email address</label>
            <input type="email" name="mail" class="form-control" id="mail" aria-describedby="mail" placeholder="Enter email">
        </div>                                                      
        
        <div class="form-group mt-3" style="max-width: 250px;">
            <label for="upass">Password</label>
            <input type="password" name="upass" class="form-control" id="upass" placeholder="Password">
            <label class="mt-3" for="upassrepeat">Re-enter password</label>
            <input type="password" name="upassrepeat" class="form-control" id="upassrepeat" placeholder="Password">

        </div>

        <button type="submit" name="add-user" class="btn btn-success mt-3">Create account</button>
        </form> 
</div>
</div>