<?php
$GLOBALS['absPath'] = "http://".$_SERVER['HTTP_HOST']."/helpdesk_ticketing_system";
session_start();
if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']=='true'){
    
    require '_dbconnection.php';
    require '_header.php'; ?>
<title>Ticket Raise Confirmation page</title>
<?php       
    require '_navbar.php';
    
} else {
    header("Location: ./_dashboard.php");
}
?>

<div class="container-fluid bodydiv">


    <div class="container ticketsuccess mt-5 ">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <img src="<?= $absPath?>/resources/images/tickets.png" style="display:block" alt="">
            </div>


        </div>
        <div class="row">
            <div class="col-md-12 mt-5">
                <p class="text-center"
                    style="color:black; font-size:40px; font-weight: 900; text-decoration:underline;">Ticket Raised
                    Successfully
                </p>
                <p style="font-weight:bold">Please wait 3 seconds</p>
            </div>

        </div>


    </div>

    <?php
echo "<script>
const redirectUser = function(){
    window.location.replace('".$absPath."/partials/_dashboard.php');
};
setInterval(redirectUser, 3000);
</script>";
?>
    <?php require '_footer.php';?>
</div>