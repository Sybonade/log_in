
<?php

include_once 'config.php';

class User {
    private $role;
    private $status;
    private $pdo;
  
    public function __construct($pdo) {
        $this->role = 4;
        $this->username = "RandomGuest123";
        $this->pdo = $pdo;

    }

    
private function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

    public function checkUserRegisterInput ($uname, $umail, $upass, $upassrepeat) {
       $errorMessages = [];
       $errorState = 0;
        //Checking if username or email is taken
        if(isset($_POST['add-user'])) {
            $stmt_checkUsername = $this->pdo->prepare('SELECT * FROM table_user WHERE u_name = :uname OR u_email = :umail');
            $stmt_checkUsername->bindParam(":uname", $uname, PDO::PARAM_STR);
            $stmt_checkUsername->bindParam(":umail", $umail, PDO::PARAM_STR);
            $stmt_checkUsername->execute();


            if ($stmt_checkUsername->rowCount() > 0) {
                array_push($errorMessages,"Username or email is already taken ");
                $errorState = 1;
            }
            //Checking user email for update user
        }else {
            $stmt_checkEmail = $this->pdo->prepare('SELECT * FROM table_user WHERE u_email = :umail');
            $stmt_checkEmail->bindParam(":umail", $umail, PDO::PARAM_STR);
            $stmt_checkEmail->execute();
            if ($stmt_checkEmail->rowCount() > 0) {
                array_push($errorMessages,"Email is already taken ");
                $errorState = 1;
            }
        }
        //check if password is long enough and they match
        if($upass !== $upassrepeat) {
            array_push($errorMessages, "Password does not match ");
            $errorState = 1;
        }else {
            if(strlen($upass) < 8) {
            array_push($errorMessages, "Password is too short ");
            $errorState = 1;
            }
        }
        
        //Check if email is valid
        if (!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
            array_push($errorMessages, "Email not correct format ");
            $errorState = 1;
          
        }

        if ($errorState === 1) {
        return $errorMessages;
        }
        else {
            return 1;
            //$this->register($uname, $umail, $upass);
        }

    
}

    public function register($uname, $umail, $upass) {
        $errorMessages = [];
        $errorState = 0;
        
        $new_upass = password_hash($upass, PASSWORD_DEFAULT);
        $uname = $this->cleanInput($uname);
        
        if(password_verify($upass, $new_upass)) {
            $stmt_inputUser = $this->pdo->prepare('INSERT INTO table_user(u_name, u_email, u_password, u_role_fk, u_status) VALUES (:uname, :umail, :upass, 1, 1)');
            $stmt_inputUser->bindParam(":uname", $uname, PDO::PARAM_STR);
            $stmt_inputUser->bindParam(":umail", $umail, PDO::PARAM_STR);
            $stmt_inputUser->bindParam(":upass", $new_upass, PDO::PARAM_STR);
            if ($stmt_inputUser->execute()) {
                header('Location: index.php?newuser=1');
            }else {
                return "Something went wrong";
            }
        }    


    }
      
    public function login($unamemail, $upass){
        $errorMessages = [];
        $errorState = 0;
 
        $stmt_selectLoginInfo = $this->pdo->prepare('SELECT * FROM table_user WHERE u_name = :uname OR u_email = :uemail');
        $stmt_selectLoginInfo->bindParam(":uname", $unamemail, PDO::PARAM_STR);
        $stmt_selectLoginInfo->bindParam(":uemail", $unamemail, PDO::PARAM_STR);
        $stmt_selectLoginInfo->execute();

        //Check if statement returns a result

        if ($stmt_selectLoginInfo->rowCount() === 0) {
            array_push($errorMessages,"Username or email does not exist ");
            $errorState = 1;
        }
        //Save user data to an array
        $userData = $stmt_selectLoginInfo->fetch();

        if(password_verify($upass , $userData['u_password'])){
            $_SESSION['user_id'] = $userData['u_id'] ;
            $_SESSION['user_name'] = $userData['u_name'];
            $_SESSION['user_email'] = $userData['u_email'];
            $_SESSION['user_role'] = $userData['u_role_fk'];
            header('Location: home.php');
        }else {
            header('Location: index.php?wrongpass=1');
        }


    }


    public function checkLoginStatus(){
        if(isset($_SESSION['user_id'])){
            return TRUE;
        }else {
            header('Location: index.php');
        }

    }

    public function checkUserRole( $value){
        //$number = 0;
        $stmt_checkUserRole = $this->pdo->prepare('SELECT * FROM table_role WHERE r_id = :id');
        $stmt_checkUserRole->bindParam(":id", $_SESSION['user_role']);
        $stmt_checkUserRole->execute();
        $rolefk = $stmt_checkUserRole->fetch();
        
        if($rolefk['r_level'] >= $value) {
            return TRUE;
        }else {
            return FALSE;
        }
    }


    public function logout() {
        session_unset();
        session_destroy();
        header('Location: index.php');
    }

    public function editUserInfo($umail, $upass,  $newpass, $uid, $role, $status) {
        $errorMessages = [];
        $errorState = 0;
        //Get old user password to verify if it matches
        $stmt_selectLoginInfo = $this->pdo->prepare('SELECT u_password FROM table_user WHERE u_id = :id');
        $stmt_selectLoginInfo->bindParam(":id", $uid, PDO::PARAM_STR);
        $stmt_selectLoginInfo->execute();

        //Save user data to an array
        $userData = $stmt_selectLoginInfo->fetch();

        if(isset($_POST['edit-user'])){
        if(!password_verify($upass , $userData['u_password'])){
            return "The password is invalid ";
            }
        } 
        $new_upass = password_hash($newpass, PASSWORD_DEFAULT);
        
        //Updating user info
        $stmt_updateUserInfo = $this->pdo->prepare('UPDATE table_user SET u_email = :umail, u_password = :upassword, u_role_fk = :urole, u_status = :ustatus WHERE u_id = :id ');
        $stmt_updateUserInfo->bindParam(":id" , $uid, PDO::PARAM_INT);
        $stmt_updateUserInfo->bindParam(":umail" , $umail, PDO::PARAM_STR);
        $stmt_updateUserInfo->bindParam(":upassword" , $new_upass, PDO::PARAM_STR);
        $stmt_updateUserInfo->bindParam(":urole" , $role, PDO::PARAM_INT);
        $stmt_updateUserInfo->bindParam(":ustatus" , $status, PDO::PARAM_INT);
        if ($stmt_updateUserInfo->execute() && $uid == $_SESSION['user_id']) {
            $_SESSION['user_email'] = $umail;
            header('Location: account.php?succes=1');
        } else {
            header('Location: account.php?denied=1');
                 
        }
    }


    public function searchUsers($input) {
        $inputJoker = "%{$input}%";
        $stmt_searchUserInfo = $this->pdo->prepare('SELECT * FROM table_user WHERE u_name LIKE :uname OR u_email Like :email');
        $stmt_searchUserInfo->bindParam(':uname', $inputJoker, PDO::PARAM_STR);
        $stmt_searchUserInfo->bindParam(':email', $inputJoker, PDO::PARAM_STR);
        $stmt_searchUserInfo->execute();
        $userArray = $stmt_searchUserInfo->fetchAll();
        return $userArray;

    }



    public function getUserInfo($userId) {
        $stmt_selectUserData = $this->pdo->prepare('SELECT * FROM table_user WHERE u_id = :uid');
        $stmt_selectUserData->bindParam(':uid', $userId, PDO::PARAM_INT);
        $stmt_selectUserData->execute();
        $userDataArray = $stmt_selectUserData->fetch();
        return $userDataArray;
    }



    public function deleteUser($uid){
        $stmt_deleteUser = $this->pdo->prepare('DELETE FROM table_user WHERE u_id = :uid');
        $stmt_deleteUser->bindParam(':uid', $uid, PDO::PARAM_INT);

        if($stmt_deleteUser->execute()) {
            header('Location: confirm_delete.php?succes=1');
        }else {
            return "There was a error";
        }

    }


}

