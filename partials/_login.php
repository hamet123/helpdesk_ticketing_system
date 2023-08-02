<?php 
require realpath(__DIR__). '/_dbconnection.php';
$GLOBALS['absPath'] = "http://".$_SERVER['HTTP_HOST']."/helpdesk_ticketing_system";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = $_POST['email'];
    $password = $_POST['password'];
    

    $verifyUsernameQuery = "SELECT * FROM `USERS` WHERE `username` = '$username'";
    $verifiedUsername = mysqli_query($conn, $verifyUsernameQuery);

    if(mysqli_num_rows($verifiedUsername)>0){
        while($row=mysqli_fetch_assoc($verifiedUsername)){
            if(password_verify($password, $row['password'])){
            session_start();
            $_SESSION['role']=$row['role'];
            $_SESSION['isLoggedIn']='true';
            $_SESSION['username']=$row['username'];
            $_SESSION['firstname']=$row['firstname'];
            $_SESSION['lastname']=$row['lastname'];
            $_SESSION['serialno']=$row['serialno'];
            
            if($row['role']=='user'){
                $loginSuccessMessage = "You have successfully Logged In";
            header("Location: $absPath/partials/_dashboard.php?isLoggedIn=true&loginSuccessMessage=$loginSuccessMessage&redirectedFromLogin=true");
            exit;
            }
            if($row['role']=='admin'){
                $adminLoginSuccessMessage = "You have successfully Logged In";
            header("Location: $absPath/partials/_admin_dashboard.php?isAdminLoggedIn=true&adminLoginSuccessMessage=$adminLoginSuccessMessage&redirectedFromLogin=true");
            exit;
            }
            if($row['role']=='agent'){
                $agentLoginSuccessMessage = "You have successfully Logged In";
            header("Location: $absPath/partials/_agent_dashboard.php?isAdminLoggedIn=true&agentLoginSuccessMessage=$agentLoginSuccessMessage&redirectedFromLogin=true");
            exit;
            }

            
        }
        else {
           
            $loginFailMessage = "Oops ! Invalid Password";
            
            header("Location: ../?isLoggedIn=false&loginFailMessage=$loginFailMessage");
            exit;
        }
    }
    }
    else {
        
        $loginFailMessage = "Oops ! Invalid UserName";
            
            header("Location: ../?isLoggedIn=false&loginFailMessage=$loginFailMessage");
            exit;
    }

    
    
}

mysqli_close($conn);
?>