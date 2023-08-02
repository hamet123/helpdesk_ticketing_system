<?php 

$dbhost = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "helpdesk_123";


$conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

if($conn){
    
}
else {
    die("Could not connect to the database due to" .mysqli_connect_error());
}

?>