<?php
include_once 'includes/header.php';

if ($user->checkUserRole(500)) {
    
}
else {
    header('Location: home.php');
}

$user -> checkLoginStatus();


$userInfoArray = $user->getUserInfo($_GET['uid']);

$roleArray = $pdo->query('SELECT * FROM table_role')->fetchAll();

if(isset($_POST['admin-edit-user'])) {
    if(isset($_POST['is_disabled'])) {$ustatus=0;}else{$ustatus=1;}
	$feedback = $user->checkUserRegisterInput($_POST['name'], $_POST['mail'], $_POST['newupass'], $_POST['newupassrepeat']);

    if($feedback === 1){
        $editFeedback = $user->editUserInfo($_POST['mail'],$_POST['newupass'], $_POST['newupassrepeat'], $_GET['uid'], $_POST['urole'], $ustatus);

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

if(isset($_GET['denied'])) {
    $denied = denied();
    echo $denied;
    /*echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
    <div>
      Password or username does not match
    </div>
  </div>
  <svg xmlns='http://www.w3.org/2000/svg' style='display: none;'>
  <symbol id='exclamation-triangle-fill' fill='currentColor' viewBox='0 0 16 16'>
  <path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
</symbol>
</svg>
</div>";*/
}?>

<style>
    
</style>


<div class="container">
    <div class="row justify-content-center m-5">
        <div class="col-md-6">
        <h1>Update user info</h1>
            <form method="post">
                <!-- Form fields remain unchanged -->
                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" name="name" readonly class="form-control" id="name" value="<?php echo $userInfoArray['u_name']; ?>">
                </div>
                <div class="form-group mt-3">
                    <label for="mail">Email address</label>
                    <input type="email" name="mail" class="form-control" id="mail" value="<?php echo $userInfoArray['u_email']; ?>">
                </div>
                <div class="form-group mt-3">
                    <label for="newupass">New Password</label>
                    <input type="password" name="newupass" class="form-control" id="newupass" placeholder="Password">
                </div>
                <div class="form-group mt-3">
                    <label for="newupassrepeat">Re-enter new password</label>
                    <input type="password" name="newupassrepeat" class="form-control" id="newupassrepeat" placeholder="Password">
                </div>
                <div class="form-group mt-3">
                    <label for="urole">Change role</label>
                    <select name="urole" class="form-select" id="urole">
                        <?php foreach ($roleArray as $role) {
                            $selected = $role['r_id'] === $userInfoArray['u_role_fk'] ? "selected" : "";
                            echo "<option value='{$role['r_id']}' {$selected}>{$role['r_name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-check mt-3">
                    <input type="checkbox" id="is-disabled" name="is_disabled" value="1" class="form-check-input" <?php if($userInfoArray['u_status'] === 0) { echo "checked"; } ?>>
                    <label class="form-check-label" for="is-disabled">Disable account</label>
                </div>
                <!-- Adjusted button layout -->
                <div class="mt-3 d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="home.php" class="btn btn-primary me-md-2">Return</a>
                    <button type="submit" name="admin-edit-user" class="btn btn-success">Update Info</button>
                    <a href="confirm_delete.php?uid=<?php echo $_GET['uid']?>" class="btn btn-danger ms-md-auto">Delete user</a>
                </div>
            </form>
        </div>
    </div>
</div>

        





<?php 
include_once 'includes/footer.php';
?>