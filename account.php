<?php
include_once 'includes/header.php';

$user -> checkLoginStatus();


if(isset($_POST['edit-user'])) {
	$feedback = $user->checkUserRegisterInput($_SESSION['user_name'], $_POST['mail'], $_POST['newupass'], $_POST['newupassrepeat']);

    if($feedback === 1){
        $user->editUserInfo($_POST['mail'],$_POST['upass'], $_POST['newupass'], $_SESSION['user_id'], $_SESSION['user_role'], 1);

    }else {
    foreach ($feedback as $item) {
        echo $item;
    }

}
}






if(isset($_GET['succes'])) {
    echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
            <div>
              User info updated successfully
            </div></div><svg xmlns='http://www.w3.org/2000/svg' style='display: none;'>
            <symbol id='check-circle-fill' fill='currentColor' viewBox='0 0 16 16'>
              <path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
            </symbol>";
}





?>


<div class="container-fluid ">
    <div class="row m-5">
        <form method="post" >
        <div class="form-group " style="max-width: 250px;">
            <label for="name">Username</label>
            <input type="text" name="name" readonly class="form-control" id="name" value="<?php echo $_SESSION['user_name']; ?>">
        </div> 
        <div class="form-group mt-3" style="max-width: 250px;">
            <label for="mail">Email address</label>
            <input type="email" name="mail" class="form-control" id="mail" aria-describedby="mail" value="<?php echo $_SESSION['user_email']; ?>">
        </div>                                                      
        
        <div class="form-group mt-3" style="max-width: 250px;">
            <label for="upass">Old Password</label>
            <input type="password" name="upass" class="form-control" id="upass" placeholder="Password">
            <label for="upass">New Password</label>
            <input type="password" name="newupass" class="form-control" id="upass" placeholder="Password">
            <label class="mt-3" for="upassrepeat">Re-enter new password</label>
            <input type="password" name="newupassrepeat" class="form-control" id="upassrepeat" placeholder="Password">

        </div>

        <a href="home.php" type="button" class="btn btn-primary mt-3">Return</a>
        <button type="submit" name="edit-user" class="btn btn-success mt-3">Update Info</button>

        </form> 
</div>
