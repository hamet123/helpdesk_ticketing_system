<?php
require '_dbconnection.php';
if(isset($_GET['t_no'])){
    $t_no = $_GET['t_no'];
    $getTicket = mysqli_query($conn,"SELECT * FROM `tickets` WHERE `ticket_no`='$t_no'");
    $row = mysqli_fetch_assoc($getTicket);
    $title = $row['title'];
    $description = $row['description'];
    
    $ticket = ['title'=> $title, 'description'=> $description];
    echo '<pre>';
    var_dump($ticket);
    echo '</pre>';
    
    return $ticket;
    
    }
?>


<?php 

$api_url = 'http://localhost/helpdesk_ticketing_system/partials/ticketapi.php?t_no=347388';

// Read JSON file
$json_data = file_get_contents($api_url);

// Decode JSON data into PHP array
$response_data = json_decode($json_data);

// All user data exists in 'data' object
$ticket_data = $response_data->data;



// Print data if need to debug
//print_r($user_data);

// Traverse array and display user data
foreach ($ticket_data as $ticket) {
	echo "name: ".$ticket->employee_name;
	echo "<br />";
	echo "name: ".$ticket->employee_age;
	echo "<br /> <br />";
}
?>