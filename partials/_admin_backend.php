<?php
session_start();

date_default_timezone_set('Asia/Kolkata');
require realpath(__DIR__). '/_dbconnection.php';
$GLOBALS['absPath'] = "http://".$_SERVER['HTTP_HOST']."/helpdesk_ticketing_system";

// Route to create tickets
if(isset($_POST['title'])){

    $username = $_SESSION['username'];
    $ticket_title = $_POST['title'];
    $ticket_description = $_POST['description'];
    $ticket_department = $_POST['department']; 
    $created_by_user = $_SESSION['serialno'];
    $file_name_primary = rand(1000,10000).'-'.$_FILES['attachfile']['name'];
    $file_name = str_replace(' ', '-', $file_name_primary);
    $file_type = $_FILES['attachfile']['type'];
    $file_size = $_FILES['attachfile']['size'];
    $file_tmp = $_FILES['attachfile']['tmp_name'];
    
    $uploadDirectory = "../uploads/".$file_name;
    $randomTicketNumber = rand(343883,999939);
    
    $status = "open";
    
   
    $isTicketNumberExists = mysqli_query($conn, "SELECT * FROM `tickets` WHERE `ticket_no`='$randomTicketNumber'");
    if(mysqli_num_rows($isTicketNumberExists)<1){
        if($file_size<='2048000'){
            if($file_type=='application/pdf' || $file_type=='image/jpg' || $file_type=='image/jpeg' || $file_type=='image/png'){
                $getAgentQuery = "SELECT * FROM `users` WHERE `associated_department`='$ticket_department'";
                $getAgent = mysqli_query($conn, $getAgentQuery);
                $foundAgent = mysqli_fetch_assoc($getAgent);
                $foundAgentUsername = $foundAgent['username'];
                echo $foundAgentUsername;
                echo var_dump($foundAgent);
                // insert the value to query just below this line
                $raiseTicketQuery = "INSERT INTO `tickets` (`ticket_no`,`username`, `title`, `description`, `department`, `attached_file`, `created_by_user`, `status`,`assigned_to`) 
        VALUES ('$randomTicketNumber', '$username','$ticket_title','$ticket_description','$ticket_department','$uploadDirectory','$created_by_user','$status','$foundAgentUsername')";
        $raiseTicket = mysqli_query($conn, $raiseTicketQuery);
        
            }} else {
                echo 'Either file type is not valid or File Size is greater than 2 MB';
            } 
            if($raiseTicket){
            
                move_uploaded_file($file_tmp, $uploadDirectory);
                $ticketRaiseConfirmationMessage = "Your Ticket has been raised successfully";
                header("Location: $absPath/partials/_admin_dashboard.php/?isTicketRaised=true&ticketRaiseConfirmationMessage=$ticketRaiseConfirmationMessage");
                exit;
               
       
    }
    else {
            $ticketRaiseFailureMessage = "Error ! Ticket cannot be raised";
            header("Location: $absPath/partials/_admin_dashboard.php/?isTicketRaised=false&ticketRaiseFailureMessage=$ticketRaiseFailureMessage");
            exit;
         } 

       
}
}



// Route to update tickets

if(isset($_POST['updatetitle'])){
    $updateTitle = $_POST['updatetitle'];
    $updateDescription = $_POST['updatedescription'];
    $ticketNumber = $_POST['ticket_no']; 
    $updateQuery = "UPDATE `tickets` SET `title` = '$updateTitle', `description`= '$updateDescription' WHERE `ticket_no` = '$ticketNumber' ";
    $runUpdateQuery = mysqli_query($conn, $updateQuery);
    
     if($runUpdateQuery){
         $updateSuccessfullyMessageAdmin = "Your Ticket has been updated successfully";
         header("Location: $absPath/partials/_admin_dashboard.php?isUpdatedAdmin=true&updateSuccessfullyMessageAdmin=$updateSuccessfullyMessageAdmin");
         exit;
     }
 }

//  Route to close tickets
 
 if(isset($_POST['hidden_close_ticket'])){
    $ticketNumber2 = $_POST['hidden_close_ticket'];
    $currentTime = date("Y-m-d H:i:s");
    $closeTicketQuery = "UPDATE `tickets` SET `status` = 'closed', `closed_on`='$currentTime' WHERE `ticket_no`='$ticketNumber2'";
    $closeTicket = mysqli_query($conn, $closeTicketQuery);
    

    $getStamp = mysqli_query($conn, "SELECT * FROM `tickets` WHERE `ticket_no`='$ticketNumber2'");
    
    while($row=mysqli_fetch_assoc($getStamp)){
        $timestamp1 = strtotime($row['created_on']);
        $timestamp2 = strtotime($row['closed_on']);
    
        // Step 3: Calculate the difference in seconds
        $differenceInSeconds = $timestamp2 - $timestamp1;
    
        // Step 4: Convert the difference to days and hours
        $days = floor($differenceInSeconds / (60 * 60 * 24));
            if($days!=0){
                $finalDays = $days." days ";
            }else{
                $finalDays =NULL;
            }
            $hours = floor(($differenceInSeconds % (60 * 60 * 24)) / (60 * 60));
            if($hours!=0){
                $finalHours = $hours." hours ";
            }else{
                $finalHours =NULL;
            }
            $minutes = floor(($differenceInSeconds % (60 * 60)) / 60);
            if($minutes!=0){
                $finalMinutes = $minutes." minutes ";
            }else{
                $finalMinutes =NULL;
            }
            $totalTimeLasped = $finalDays.$finalHours.$finalMinutes;
        $duration = mysqli_query($conn,"UPDATE `tickets` SET `duration`='$totalTimeLasped' WHERE `ticket_no` = '$ticketNumber2'");
        mysqli_close($conn);
    }
     if($closeTicket){
         $closedSuccessfullyMessageAdmin = "Ticket closed successfully";
         header("Location: $absPath/partials/_admin_dashboard.php?isClosedAdmin=true&closedSuccessfullyMessageAdmin=$closedSuccessfullyMessageAdmin");
         exit;
     }
     else {
         echo ' close query not successful';        }
 }


// Route to reopen tickets

if(isset($_GET['reOpenTicket'])){
 $reOpenTicketNumber = $_GET['reOpenTicket'];
 $reOpenQuery = "UPDATE `tickets` SET `status`='Re Opened', `closed_on` = NULL WHERE `ticket_no`='$reOpenTicketNumber'";
 $runReOpenQuery = mysqli_query($conn, $reOpenQuery);
 mysqli_close($conn);
 if($runReOpenQuery){
     $reOpenSuccessfullyMessageAdmin = "Ticket Re-Opened successfully";
         header("Location: $absPath/partials/_admin_dashboard.php?isReOpenedAdmin=true&reOpenSuccessfullyMessageAdmin=$reOpenSuccessfullyMessageAdmin");
         exit;
 } else {
     echo 'Unable to reopen the ticket. Please try again later';
 }
}


// Route to create Departments

if(isset($_POST['createdepartment'])){
    $department_id = rand(3475,8934);
    $department = $_POST['createdepartment'];
    $createDepartmentQuery = "INSERT INTO `departments` (`department_id`,`department`) VALUES ('$department_id','$department')";
    $createDepartment = mysqli_query($conn, $createDepartmentQuery);
    if($createDepartment){
        $createdDepartmentSuccessfully = "Department Created successfully";
         header("Location: $absPath/partials/_admin_dashboard.php?isDepartmentCreated=true&createdDepartmentSuccessfully=$createdDepartmentSuccessfully");
         exit;
 } else {
     echo 'Unable to create the department. Please try again later';
 }
    
}


// Route to update Departments

if(isset($_POST['updatedepartment'])){
    
    $department = $_POST['updatedepartment'];
    $department_id = $_POST['department_id'];
    $updateDepartmentQuery = "UPDATE `departments` SET `department` = '$department' WHERE `department_id` = '$department_id'";
    $updateDepartment = mysqli_query($conn, $updateDepartmentQuery);
    if($updateDepartment){
        $updateDepartmentSuccessfully = "Department updated successfully";
         header("Location: $absPath/partials/_admin_dashboard.php?isDepartmentupdated=true&updateDepartmentSuccessfully=$updateDepartmentSuccessfully");
         exit;
 } else {
     echo 'Unable to create the department. Please try again later';
 }
    
}



// Route to delete Departments

if(isset($_POST['deletedepartmentid'])){
    $department_id = $_POST['deletedepartmentid'];
    $deleteDepartmentQuery = "DELETE FROM `departments` WHERE `department_id` = '$department_id'";
    $deleteDepartment = mysqli_query($conn, $deleteDepartmentQuery);
    if($deleteDepartment){
        $deleteDepartmentSuccessfully = "Department deleted successfully";
         header("Location: $absPath/partials/_admin_dashboard.php?isDepartmentdeleted=true&updateDepartmentSuccessfully=$deleteDepartmentSuccessfully");
         exit;
 } else {
     echo 'Unable to create the department. Please try again later';
 }
    
}

// Route to handle the agent signup form at the admin's end

if(isset($_POST['agentemail'])){


    $firstname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lastname =  mysqli_real_escape_string($conn, $_POST['lname']);
    $username =  mysqli_real_escape_string($conn, $_POST['agentemail']);
    $department =  mysqli_real_escape_string($conn, $_POST['associated_department']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $password =  mysqli_real_escape_string($conn, $_POST['password']);    ;

    

    $ifUsernameExists = mysqli_query($conn, "SELECT * from `users` where `username` = '$username'");

    if(mysqli_num_rows($ifUsernameExists)==1){
         $showUsernameExistError=true;
         $showUsernameExistErrorMessage= "Unable to create account. Email already exists";
        
        
        header("Location: ./_admin_dashboard.php?showUsernameExistError=true&showUsernameExistErrorMessage=$showUsernameExistErrorMessage");
        exit;        
    } else {
        if($password==$cpassword){
            $role = "agent";
        $finalPassword = password_hash($password, PASSWORD_DEFAULT);
        $signupQuery = "INSERT INTO `users` (`firstname`,`lastname`,`username`,`password`,`role`,`associated_department`) VALUES ('$firstname','$lastname','$username','$finalPassword','$role','$department')";
        $signup = mysqli_query($conn, $signupQuery);

        if($signup){
            
            $agentCreatedSuccessfullyMessage = "Agent created";
            header("Location: ./_admin_dashboard.php?isAgentCreated=true&agentCreatedSuccessfullyMessage=$agentCreatedSuccessfullyMessage");
        exit;
        }
    }else {
        $showPasswordMismatchError = true;
        $showPasswordMismatchErrorMessage = "Passwords do not match";
        header("Location: ./_admin_dashboard.php?showPasswordMismatchError=true&showPasswordMismatchErrorMessage=$showPasswordMismatchErrorMessage");
        exit;
    }
    }

};


// Edit/Update agent details
if(isset($_POST['hiddenupdateagentemail'])){
    $firstname = mysqli_real_escape_string($conn, $_POST['updatefname']);
    $lastname =  mysqli_real_escape_string($conn, $_POST['updatelname']);
    $username =  mysqli_real_escape_string($conn, $_POST['updateagentemail']);
    $realUsername =  mysqli_real_escape_string($conn, $_POST['hiddenupdateagentemail']);
    $department =  mysqli_real_escape_string($conn, $_POST['update_associated_department']);
    

    

    $ifRealUsernameExists = mysqli_query($conn, "SELECT * from `users` WHERE `username` = '$realUsername'");
    if(mysqli_num_rows($ifRealUsernameExists)==1){
        $row = mysqli_fetch_assoc($ifRealUsernameExists);
        if($username==$realUsername){
            $updateAgent = mysqli_query($conn, "UPDATE `users` SET `firstname`= '$firstname', `lastname`='$lastname', `associated_department`='$department' WHERE `username` = '$realUsername' AND `role`='agent'");
            header("Location: _admin_dashboard.php");
            exit;
        } else {
            $ifUsernameExist = mysqli_query($conn,"SELECT * FROM `users` WHERE `username` = '$username'");
            if(mysqli_num_rows($ifUsernameExist)==1){
                echo 'This email ID is already registered with some other user. Please go back and try again with new Email ID.';
            } else {
                $updateAgent = mysqli_query($conn, "UPDATE `users` SET `firstname`= '$firstname', `username`='$username' ,`lastname`='$lastname', `associated_department`='$department' WHERE `username` = '$realUsername' AND `role`='agent'");
                header("Location: _admin_dashboard.php");
            exit;
            }
        }
       

    } else {
        echo 'username doesnt exist';
    }
   
};



// Delete Agent Route
if(isset($_POST['hiddenusername'])){
    $username = mysqli_real_escape_string($conn, $_POST['hiddenusername']);

    $deleteAgent = mysqli_query($conn, "DELETE FROM `users` WHERE  `username`='$username' AND `role`='agent'");
    header("Location: _admin_dashboard.php");
    exit;
}
    

// Route to create ticket comments

if(isset($_POST['ticket_comment'])){
    $comment_text = $_POST['ticket_comment'];
    $ticket_no = $_POST['t_no'];
    $user_id = $_SESSION['serialno'];

    $enterCommentQuery = "INSERT INTO `ticket_comments` (`ticket_no`,`user_id`,`comment_text`) VALUES('$ticket_no','$user_id','$comment_text')";
    $enterComment = mysqli_query($conn, $enterCommentQuery);

    if($enterComment){
        $commentCreatedSuccessfully = "Your comment was posted successfully";
        header("Location: _ticket_details.php?isCommentRaised=true&commentCreatedSuccessfully=$commentCreatedSuccessfully&t_no=$ticket_no"); 
    } else {
        echo 'Something went wrong !!';
    }

}


?>