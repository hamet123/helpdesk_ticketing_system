<?php 
require '_dbconnection.php';

global $showUsernameExistError;
$showUsernameExistError = false;
$showSignupConfirmation = false;
$showPasswordMismatchError = false;



if($_SERVER['REQUEST_METHOD']=='POST'){

   if(isset($_POST['cpassword'])){
    $firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
    $username = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $cpassword = mysqli_real_escape_string($conn,$_POST['cpassword']);
    

    $ifUsernameExists = mysqli_query($conn, "SELECT * from `users` where `username` = '$username'");

    if(mysqli_num_rows($ifUsernameExists)==1){
         $showUsernameExistError=true;
         $showUsernameExistErrorMessage= "Unable to create account. Email already exists";
        
        
        header("Location: ../?showUsernameExistError=true&showUsernameExistErrorMessage=$showUsernameExistErrorMessage");
        exit;
        
        
        

   
        
    } else {
        if($password==$cpassword){
            $role = "user";
        $finalPassword = password_hash($password, PASSWORD_DEFAULT);
        $signupQuery = "INSERT INTO `users` (`firstname`,`lastname`,`username`,`password`,`role`) VALUES ('$firstname','$lastname','$username','$finalPassword','$role')";
        $signup = mysqli_query($conn, $signupQuery);

        if($signup){
            $showSignupConfirmation = true;
            $showSignupConfirmationMessage = "Account created";
            $verifyUsernameQuery = "SELECT * FROM `users` WHERE `username` = '$username'";
            $verifiedUsername = mysqli_query($conn, $verifyUsernameQuery);

            if(mysqli_num_rows($verifiedUsername)==1){
                while($row=mysqli_fetch_assoc($verifiedUsername)){
                    session_start();
                    $_SESSION['isLoggedIn']="true";
                    $_SESSION['role']=$row['role'];
                    $_SESSION['username']=$row['username'];
                    $_SESSION['firstname']=$row['firstname'];
                    $_SESSION['lastname']=$row['lastname'];
                    $_SESSION['serialno']=$row['serialno'];
                    $loginSuccessMessage = "You have successfully Logged In";
                    header("Location: _dashboard.php?showSignupConfirmation=true&showSignupConfirmationMessage=$showSignupConfirmationMessage&isLoggedIn=true&redirectedFromLogin=false");
                    exit;
                }
                }
            
        }
    }else {
        $showPasswordMismatchError = true;
        $showPasswordMismatchErrorMessage = "Passwords do not match";
        header("Location: ../?showPasswordMismatchError=true&showPasswordMismatchErrorMessage=$showPasswordMismatchErrorMessage");
        exit;
    }
    }
   }

};


mysqli_close($conn);




?>