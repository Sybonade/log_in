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


<div class="container">
    <div class="row justify-content-center m-5">
        <div class="col-md-6">
        <h1>Update user info</h1>
            <form method="post">
                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" name="name" class="form-control" id="name" readonly value="<?php echo $_SESSION['user_name']; ?>">
                </div>
                <div class="form-group mt-3">
                    <label for="mail">Email address</label>
                    <input type="email" name="mail" class="form-control" id="mail" value="<?php echo $_SESSION['user_email']; ?>">
                </div>
                <div class="form-group mt-3">
                    <label for="upass">Old Password</label>
                    <input type="password" name="upass" class="form-control" id="upass" placeholder="Old Password">
                </div>
                <div class="form-group mt-3">
                    <label for="newupass">New Password</label>
                    <input type="password" name="newupass" class="form-control" id="newupass" placeholder="New Password">
                </div>
                <div class="form-group mt-3">
                    <label for="newupassrepeat">Re-enter new password</label>
                    <input type="password" name="newupassrepeat" class="form-control" id="newupassrepeat" placeholder="Re-enter New Password">
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-3">
                    <a href="home.php" class="btn btn-primary">Return</a>
                    <button type="submit" name="edit-user" class="btn btn-success ">Update Info</button>
                </div>
            </form>
        </div>
    </div>
</div>
