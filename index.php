<?php 
include_once 'includes/header.php';

if(isset($_POST['login'])){
    $errorMessage = $user->login($_POST['uemail'], $_POST['upass']);
    

}
?>
<div class="container-fluid">
    <?php
        if(isset($_GET['newuser'])) {
            echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
            <div>
              You have logged in
            </div></div><svg xmlns='http://www.w3.org/2000/svg' style='display: none;'>
            <symbol id='check-circle-fill' fill='currentColor' viewBox='0 0 16 16'>
              <path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
            </symbol>";
        }
        if(isset($_GET['wrongpass'])) {
            echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
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
      </div>";
        }
        
    ?>
<div class="container">
    <div class="row justify-content-center m-5">
        <div class="col-md-6">
          <h1>Login</h1>
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username or email</label>
                    <input type="text" name="uemail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group mt-3">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="upass" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-check mt-3">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Keep me signed in</label>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-3">
                    <button type="submit" name="login" class="btn btn-success" >Login</button>
                    <a class="btn btn-secondary "  href="register.php" role="button">Create account</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>



<?php 
include_once 'includes/footer.php';
?>