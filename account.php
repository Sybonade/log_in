<?php
include_once 'includes/header.php';

if(isset($_POST['edit-user'])) {
	$feedback = $user->checkUserRegisterInput($_POST['name'], $_POST['mail'], $_POST['newupass'], $_POST['newupassrepeat']);

    if($feedback === 1){
        $user->editUserInfo($_POST['mail'],$_POST['upass'], $_POST['newupass']);

    }else {
    foreach ($feedback as $item) {
        echo $item;
    }

}
}


$userInfo = $pdo->prepare('SELECT * FROM table_user WHERE u_id = :id');
$userInfo->bindParam(':id', $_SESSION['user_id']);
$userInfo->execute();
$userInfo->fetchAll();


?>


<div class="container-fluid ">
    <div class="row m-5">
        <form method="post" >
        <div class="form-group " style="max-width: 250px;">
            <label for="name">Username</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="<?php foreach ($userInfo as $row){
                 echo $row['u_name'];
                }?>
                 ">
        </div> 
        <div class="form-group mt-3" style="max-width: 250px;">
            <label for="mail">Email address</label>
            <input type="email" name="mail" class="form-control" id="mail" aria-describedby="mail" placeholder="<?php foreach ($userInfo as $row){
                 echo $row['u_mail'];
                }?>">
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
