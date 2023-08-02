<?php 
session_start();
if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']=='true' && $_GET['t_no']){
    
    require '_dbconnection.php';
    $ticketNumber = $_GET['t_no'];
    $checkTicketNumber = mysqli_query($conn, "SELECT * FROM `tickets` WHERE `ticket_no`='$ticketNumber'");
if(mysqli_num_rows($checkTicketNumber)==1){
    require '_header.php';?>
<title>Ticket Details</title>
<?php 
    require '_navbar.php';
    $_SESSION['ticket_no'] = $_GET['t_no'];
    // Start point of Function for calculating time ago 
 function timestampToTimeAgo($timestamp) {
    $now = time(); // Current timestamp
    $time = strtotime($timestamp);
    $diff = $now - $time ; // Calculate the difference between the current time and the given timestamp

    // Define time intervals in seconds and their corresponding labels
    $intervals = array(
        31536000 => array('year', 'years'),
        2592000 => array('month', 'months'),
        86400 => array('day', 'days'),
        3600 => array('hour', 'hours'),
        60 => array('minute', 'minutes'),
        1 => array('second', 'seconds')
    );

    foreach ($intervals as $seconds => $labels) {
        $quotient = floor($diff / $seconds);

        if ($quotient > 0) {
            $label = $quotient === 1 ? $labels[0] : $labels[1];
            return $quotient . ' ' . $label . ' ago';
        }
    }

    return 'just now'; // If the timestamp is in the future or too recent
}
?>
<div class="container-fluid bodydiv">
    <?php
// End point of function for calculating time ago
require ('_dbconnection.php');
$ticketNumber = $_GET['t_no'];
        $readTicketsQuery = "SELECT * FROM `tickets` WHERE `ticket_no`='$ticketNumber'";
        $readTicket = mysqli_query($conn, $readTicketsQuery);
        if($readTicket){
         if(mysqli_num_rows($readTicket)>0){
            while($row=mysqli_fetch_assoc($readTicket)){
            $attachedFile=$row['attached_file'];
            $attachedFileFinal = substr($attachedFile,2,);
            $attachedFilePath = $absPath.$attachedFileFinal;
            $attachedFileName = $row['attached_file'];
            $attachedFileNameFinal = substr($attachedFileName,16,);
            $userId = $row['created_by_user'];
            $searchUserQuery = "SELECT * from `users` WHERE `serialno`='$userId'";
            $searchUser = mysqli_query($conn, $searchUserQuery);
            $foundUser = mysqli_fetch_assoc($searchUser);
            $agentUsername = $row['assigned_to'];
            $getAgentName = mysqli_query($conn,"SELECT * FROM `users` WHERE `username` = '$agentUsername' ");
            $agentName = mysqli_fetch_assoc($getAgentName);
            echo '<div class="container mt-5 mb-3" id="ticketdiv">
                    <h2 class="text-white text-center mb-5 ticketdetailsheadings"><strong>Ticket Details</strong></h2>
                    <table class="table" border>
                        <tr>
                            <td><span>Ticket Number : </span>'.$row['ticket_no'].'</td>
                            <td><span>Department : </span>'.$row['department'].'</td>
                            <td><span>Status : </span>'.$row['status'].'</td>
                            <td><span>Created On : </span>'.$row['created_on'].'</td>
                        </tr>

                        <tr>
                            <td colspan="2"><span>Title : '.$row['title'].'</span></td>
                            <td colspan="2"><span>Description : '.$row['description'].'</span></td>
                        </tr>

                        <tr>
                            <td colspan="2"><span>Created By : '.$foundUser['firstname'].' '.$foundUser['lastname'].'</span></td>
                            <td><span>Assigned To : '.$agentName['firstname'].' '.$agentName['lastname'].'</span></td>
                            <td><span>File Attached : <a class="viewfilelinks" target="_blank" href="'.$attachedFilePath.'">'.$attachedFileNameFinal.'</a></span></td>
                        </tr>';
                        if($row['status']=='closed'){
                            echo ' <tr>
                            <td colspan="2"><span>Closed On : '.$row['closed_on'].'</span></td>
                            <td colspan="2"><span>Duration : '.$row['duration'].'</span></td>
                        </tr>';}
                        
                    echo '</table>
                  </div> ';

        

        }}}


// Enter Ticket Threads

echo '<div class="container my-3" id="contentdiv3" >

<form action="_admin_backend.php" method="POST">
<div class="form-group">
  <label for="ticket_comment">Enter Comment</label>
  <textarea class="form-control" id="ticket_comment" placeholder="Enter comment" name="ticket_comment"></textarea>
</div>
<input type="hidden" name="t_no" value="'.$_GET['t_no'].'">
<button type="submit" class="btn btn-success">Comment</button>
</form>

    </div>';
    


// Retrieve Ticket Threads List
        echo '<div class="container p-5 mb-5" id="commentsparentdiv">
                <h2 class="text-center text-white mb-5 ticketdetailsheadings"><strong>Comments</strong></h2>';
        if(isset($_GET['t_no'])){
            $ticket_no = $_GET['t_no'];
            $getTicketCommentsQuery = "SELECT * FROM `ticket_comments` WHERE `ticket_no`= '$ticket_no'";
            $getTicketComments = mysqli_query($conn, $getTicketCommentsQuery);
            if(mysqli_num_rows($getTicketComments)>0){
                if($getTicketComments){
                    while($row = mysqli_fetch_assoc($getTicketComments)){
                            $user_id = $row['user_id'];
                            $foundUserQuery = mysqli_query($conn, "SELECT * FROM `users` WHERE `serialno` = '$user_id'");
                            $foundUser = mysqli_fetch_assoc($foundUserQuery);
                            $timestamp=$row['created_on'];
                            
                            echo   '<div class="container" id="contentdiv4">
                                    <div class="row mt-4 pt-3 pl-3">
                                        <div class="col-md-6">
                                        <span><img src="'.$absPath.'/resources/images/user_icon.png" class="mr-2" height="25px" width="22px"> '.$foundUser['firstname'].' '.$foundUser['lastname'].'</span>
                                        </div>
                                        <div class="col-md-6">
                                        <span><img src="'.$absPath.'/resources/images/clock_icon.png" class="mr-2" height="18px" width="18px">'.timestampToTimeAgo($timestamp).'</span>
                                        </div>
                                    </div>
                            </div>
                            <div class="container " id="contentdiv5">
                                <div class="row">
                                    <span>'.$row['comment_text'].'</span>
                                </div>   
                            </div>
                            
                            ';
                    }
                }
            } else echo '<h4 class="text-center text-white">No comments found on this ticket !!!</h4>';
        }

        echo '</div>';
        
        
        require '_footer.php';


} else {
    header("Location: ./_dashboard.php");
}   
} else {
    header("Location: ./_dashboard.php");
}
?>












</div>