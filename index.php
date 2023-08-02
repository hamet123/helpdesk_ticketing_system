<?php 
$GLOBALS['absPath'] = "http://".$_SERVER['HTTP_HOST']."/helpdesk_ticketing_system";

session_start();
    require 'partials/_dbconnection.php';
    require 'partials/_header.php';
    ?>
<title>Knowledge Base & Helpdesk Ticketing System</title>
<?php 
    require 'partials/_navbar.php';
   
?>

<?php  require 'partials/_footer.php';?>


<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="<?= $absPath?>/resources/images/bg/img1.png" alt="First slide"
                height="800px">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="<?= $absPath?>/resources/images/bg/img2.png" alt="Second slide"
                height="800px">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" height="800px" src="<?= $absPath?>/resources/images/bg/img4.png"
                alt="Third slide">
        </div>

    </div>

    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<div class="container-fluid" id="featuresdiv">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="card lottiecard" style="width: 18rem;">
                    <lottie-player src="<?= $absPath?>/resources/lottie/tickets.json" background="Transparent" speed="1"
                        style="width:300px; height: 250px; margin-left:-20px;" direction="1" mode="normal" autoplay
                        loop>
                    </lottie-player>
                    <div class="card-body">
                        <p class="card-text" style="text-align: justify;">The ticketing system streamlines issue
                            reporting and support communication.
                            Users submit structured tickets with details on problems or inquiries. Support agents
                            efficiently manages and resolve tickets, ensuring a seamless user experience.
                            The system provides transparency, historical records, and optimal resource allocation.
                        </p>
                    </div>
                </div>
            </div>


            <div class="col-md-4 col-sm-12">
                <div class="card lottiecard" style="width: 18rem;">
                    <lottie-player src="<?= $absPath?>/resources/lottie/knowledgebase.json" background="Transparent"
                        speed="1" style="width:300px; height: 250px; margin-left:-6px;" direction="1" mode="normal"
                        autoplay loop>
                    </lottie-player>
                    <div class="card-body">
                        <p class="card-text" style="text-align: justify;">The knowledgebase in our helpdesk ticketing
                            system is a comprehensive
                            repository of valuable information, FAQs, and troubleshooting guides. It empowers users and
                            support agents to
                            access self-help resources, enabling quick issue resolution. It
                            efficiently reduces ticket volumes, and fosters a more informed &
                            satisfied user community.</p>
                    </div>
                </div>
            </div>


            <div class="col-md-4 col-sm-12">
                <div class="card lottiecard" style="width: 18rem;">
                    <lottie-player src="<?= $absPath?>/resources/lottie/videos.json" background="Transparent" speed="1"
                        style="width:300px; height: 250px; margin-left:-20px;" direction="1" mode="normal" autoplay
                        loop>
                    </lottie-player>
                    <div class="card-body">
                        <p class="card-text" style="text-align: justify;">The video tutorials available offer
                            visual and step-by-step
                            guidance regarding various student life cycle related topics. Covering various topics and
                            issues, these tutorials cater to diverse learning preferences, empowering users with
                            practical insights to get detailed information and improve overall
                            user experience.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class=" custom-container" style="height:710px; background:rgba(0,0,0,0.5); margin-top:-860px; ">
    <h3 class="text-center mainheading animate__animated animate__fadeInUp" style="padding-top:150px; font-weight:900;">
        Welcome to iDesk
    </h3><br>
    <h5 class="text-center mainheading animate__animated animate__fadeInUp" style="margin-top:-30px; font-weight:900;">
        Knowledgebase and Helpdesk Ticket
        System
    </h5>
</div>


<!-- Mid Section -->
<div class="container-fluid" style="margin-top:450px;">
    <div class="container">

        <!-- Main Code goes here -->
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-5">New to iDesk ?</h2>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-12">
                <p style="display:block">
                    <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button"
                        aria-expanded="false" aria-controls="multiCollapseExample1">Toggle first element</a>
                    <button class="btn btn-primary" type="button" data-toggle="collapse"
                        data-target="#multiCollapseExample2" aria-expanded="false"
                        aria-controls="multiCollapseExample2">Toggle second element</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".multi-collapse"
                        aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Toggle both
                        elements</button>
                </p>
                <div class="row">
                    <div class="col">
                        <div class="collapse multi-collapse" id="multiCollapseExample1">
                            <div class="card card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                                sapiente
                                ea proident.
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="collapse multi-collapse" id="multiCollapseExample2">
                            <div class="card card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                                sapiente
                                ea proident.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</div>