<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
require realpath(__DIR__). '/_dbconnection.php';
$GLOBALS['absPath'] = "http://".$_SERVER['HTTP_HOST']."/helpdesk_ticketing_system";


    
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
                header("Location: $absPath/partials/_ticket_raise_success.php/?isTicketRaised=true&ticketRaiseConfirmationMessage=$ticketRaiseConfirmationMessage");
                exit;
               
       
    }
    else {
            $ticketRaiseFailureMessage = "Error ! Ticket cannot be raised";
            header("Location: $absPath/partials/_dashboard.php/?isTicketRaised=false&ticketRaiseFailureMessage=$ticketRaiseFailureMessage");
            exit;
         } 

       
}
}
            



    if(isset($_POST['updatetitle'])){
       $updateTitle = $_POST['updatetitle'];
       $updateDescription = $_POST['updatedescription'];
       $ticketNumber = $_POST['ticket_no']; 
       $updateQuery = "UPDATE `tickets` SET `title` = '$updateTitle', `description`= '$updateDescription' WHERE `ticket_no` = '$ticketNumber' ";
       $runUpdateQuery = mysqli_query($conn, $updateQuery);
        mysqli_close($conn);
        if($runUpdateQuery){
            $updateSuccessfullyMessage = "Your Ticket has been updated successfully";
            header("Location: $absPath/partials/_dashboard.php?isUpdated=true&updateSuccessfullyMessage=$updateSuccessfullyMessage");
            exit;
        }
    }

    
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
            
        }
       
        
        if($closeTicket){
            $closedSuccessfullyMessage = "Ticket closed successfully";
            header("Location: $absPath/partials/_dashboard.php?isClosed=true&closedSuccessfullyMessage=$closedSuccessfullyMessage");
            exit;
        }
        else {
            echo ' close query not successful';        }
    }




if(isset($_GET['reOpenTicket'])){
    $reOpenTicketNumber = $_GET['reOpenTicket'];
    $reOpenQuery = "UPDATE `tickets` SET `status`='Re Opened', `closed_on` = NULL WHERE `ticket_no`='$reOpenTicketNumber'";
    $runReOpenQuery = mysqli_query($conn, $reOpenQuery);
    mysqli_close($conn);
    if($runReOpenQuery){
        $reOpenSuccessfullyMessage = "Ticket Re-Opened successfully";
            header("Location: $absPath/partials/_dashboard.php?isReOpened=true&reOpenSuccessfullyMessage=$reOpenSuccessfullyMessage");
            exit;
    } else {
        echo 'Unable to reopen the ticket. Please try again later';
    }
}


// Photo upload logic in profile Tab
if(isset($_POST['photoupload'])){
$username = $_SESSION['username'];
$photo_name_primary = rand(1000,10000).'-'.$_FILES['photo']['name'];
$photo_name = str_replace(' ', '-', $photo_name_primary);
$photo_type = $_FILES['photo']['type'];
$photo_size = $_FILES['photo']['size'];
$photo_tmp = $_FILES['photo']['tmp_name'];
$photoUploadDirectory = "../uploads/photos/";
$photo_path = $photoUploadDirectory.$photo_name;


if($photo_size<='2048000'){
    if($photo_type=='image/jpg' || $photo_type=='image/jpeg' || $photo_type=='image/png'){
    $uploadPhotoQuery = "UPDATE `users` SET `photo_uploaded` = '$photo_path' WHERE `username`='$username'";
    $uploadPhoto = mysqli_query($conn, $uploadPhotoQuery);
    mysqli_close($conn);
    }} else {
        echo 'Either file size is greater than 2 mb or file type is not supported';
    }
    
    
    if($uploadPhoto){
                    move_uploaded_file($photo_tmp, $photo_path);
                    $photoUploadConfirmationMessage = "Your Photo has been successfully uploaded";
                    header("Location: $absPath/partials/_dashboard.php/?isPhotoUploaded=true&photoUploadConfirmationMessage=$photoUploadConfirmationMessage");
                    exit;
             } else {
                    $photoTypeErrorMessage = "Please upload a photo with jpg/jpeg/png/pdf extensions only";
                    header("Location: $absPath/partials/_dashboard.php/?isphotoTypeError=true&photoTypeErrorMessage=$photoTypeErrorMessage");
                    exit;
                    }
                    } else {
                     $photoSizeErrorMessage = "The photo size should not be greater than 2 MB";
                     header("Location: $absPath/partials/_dashboard.php/?isPhotoSizeError=true&photoSizeErrorMessage=$photoSizeErrorMessage");
                     exit;
                    }
?>