<?php 
session_start();
if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']=='true'&& isset($_SESSION['role']) && $_SESSION['role']=='user'){
    require '_dbconnection.php';
    require '_header.php'; ?>
<title>User Dashboard</title>
<?php       
    require '_navbar.php';
     
    
    
    
} else {
    header("Location: ./../");
}

?>
<div class="container-fluid bodydiv">


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="_raise_a_ticket.php" method="post" enctype="multipart/form-data" class="mt-3">

                        <div class="form-group">
                            <label for="updatetitle">Title</label>
                            <input type="text" class="form-control" id="updatetitle" name="updatetitle"
                                placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="updatedescription">Description</label>
                            <textarea class="form-control" rows="8" id="updatedescription" name="updatedescription"
                                placeholder="Enter Description"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="ticket_no" id="hidden_ticket_no">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Close ticket Modal -->
    <div class="modal fade" id="closeTicketModal" tabindex="-1" role="dialog" aria-labelledby="closeTicketModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="closeTicketModalLabel">Close Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="_raise_a_ticket.php" method="POST">
                        <input type="hidden" name="hidden_close_ticket" id="hidden_close_ticket">
                        <h5 class="deleteMessage"></h5>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="close ticket" name="close_ticket">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>







    <div class="container-fluid dashboarddiv">
        <!-- use echo and put everthing in IF statement -->
        <div class="container-fluid row pt-5 ">
            <div class="col-lg-2 col-md-12 mb-5 dashmenuitems">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-raise_ticket-list"
                        data-toggle="list" href="#list-raise_ticket" role="tab" aria-controls="raise_ticket">Raise
                        Ticket</a>
                    <a class="list-group-item list-group-item-action" id="list-my_tickets-list" data-toggle="list"
                        href="#list-my_tickets" role="tab" aria-controls="my_tickets">My Tickets</a>
                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list"
                        href="#list-profile" role="tab" aria-controls="profile">Closed Tickets</a>
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list"
                        href="#list-settings" role="tab" aria-controls="settings">Profile</a>
                </div>
            </div>


            <!-- Raise a Ticket Tab -->
            <div class="col-lg-10 col-md-12 mb-5" id="contentdiv">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane  fade show active" id="list-raise_ticket" role="tabpanel"
                        aria-labelledby="list-raise_ticket-list">
                        <h5 class="mb-4 dashboardheader">Raise a Ticket</h5>
                        <form action="_raise_a_ticket.php" method="post" enctype="multipart/form-data" class="mt-3">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    aria-describedby="emailHelp" placeholder="Enter email"
                                    value="<?php echo $_SESSION["username"]?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter title" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"
                                    placeholder="Enter Description" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="department">Select Department</label>
                                <select id="department" class="form-control" name="department" required>
                                    <?php
                                    require '_dbconnection.php';
                            $getDepartmentsQuery= "SELECT * FROM `departments`";
                            $getDepartments = mysqli_query($conn, $getDepartmentsQuery);
                            if(mysqli_num_rows($getDepartments)>0){
                                while($row=mysqli_fetch_assoc($getDepartments)){
                                    echo '<option value="'.$row['department'].'">'.$row['department'].'</option>';
                                }
                            }
                            ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="attachfile">Attach Files</label>
                                <input type="file" class="form-control-file" id="attachfile" name="attachfile"
                                    aria-describedby="fileHelp" required>
                                <small id="fileHelp" class="form-text">Only
                                    .jpg/.jpeg/.png/.pdf extenstions
                                    allowed.</small>
                                <small id="fileHelp" class="form-text">File should be less than 2 MB.</small>

                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>


                    </div>


                    <!-- My Tickets Tab -->
                    <div class="tab-pane fade " id="list-my_tickets" role="tabpanel"
                        aria-labelledby="list-my_tickets-list">
                        <h5 class="mb-4 dashboardheader">My Tickets</h5>
                        <table class="table-responsive table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">Sr. No.</th>
                                    <th scope="col">Ticket Number</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">File Attached</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Assigned To</th>
                                    <th scope="col">Actions</th>
                                    <th scope="col">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                    require '_dbconnection.php';
                    $createdByUser = $_SESSION['serialno'];
                            $readTicketsQuery = "SELECT * FROM `tickets` WHERE `created_by_user`='$createdByUser'";
                            $readTicket = mysqli_query($conn, $readTicketsQuery);
                           
                                    $searchUserQuery = "SELECT * from `users` WHERE `serialno`='$createdByUser'";
                                    $searchUser = mysqli_query($conn, $searchUserQuery);
                                    $foundUser = mysqli_fetch_array($searchUser);
                                    
                            if(mysqli_num_rows($readTicket)>0){
                                $tableSerialNo = 0;
                                while($row=mysqli_fetch_assoc($readTicket)){
                                    
                                    if($row['status']!='closed'){
                                        $tableSerialNo += 1;
                                        $attachedFile=$row['attached_file'];
                                        $attachedFileFinal = substr($attachedFile,2,);
                                        $attachedFilePath = $absPath.$attachedFileFinal;
                                        $attachedFileName = $row['attached_file'];
                                        $attachedFileNameFinal = substr($attachedFileName,16,);
                                        $description = $row['description'];
                                        $shortDescription = substr($description,0,30);
                                        $agentUsername = $row['assigned_to'];
                                        $getAgentName = mysqli_query($conn,"SELECT * FROM `users` WHERE `username` = '$agentUsername' ");
                                        $agentName = mysqli_fetch_assoc($getAgentName);
                                        echo '<tr>
                                    <th scope="col">'.$tableSerialNo.'</th>
                                    <th scope="col"><a class="viewfilelinks" target="_blank" href="'.$absPath.'/partials/_ticket_details.php?t_no='.$row['ticket_no'].'">'.$row['ticket_no'].'</a></th>
                                    <th scope="col">'.$row['title'].'</th>
                                    <th scope="col">'.$description.'</th>
                                    <th scope="col">'.$foundUser['firstname'].' '.$foundUser['lastname'].'</th>
                                    <th scope="col">'.$row['department'].'</th>
                                    <th scope="col"><a class="viewfilelinks" target="_blank" href="'.$attachedFilePath.'">'.$attachedFileNameFinal.'</a></th>
                                    <th scope="col">'.$row['created_on'].'</th>';
                                    if($row['status']=='open'|| $row['status']=='Re Opened'){
                                        echo '<th scope="col"><button class="btn btn-sm btn-success mt-2">'.$row['status'].'</button></th>';
                                    }
                                    if($row['status']=='closed'){
                                        echo '<th scope="col"><button class="btn btn-sm btn-danger mt-2">'.$row['status'].'</button></th>';
                                    }
                                    echo '<th scope="col">'.$agentName['firstname'].' '.$agentName['lastname'].'</th>
                                    <th scope="col"><button type="button" class="btn btn-sm btn-success editbuttons mt-2" id="edit'.$row['ticket_no'].'" data-toggle="modal" data-target="#editModal">Edit</button></th>
                                    <th scope="col"><button type="button" class="btn btn-sm btn-danger closeticketbuttons mt-2" id="close'.$row['ticket_no'].'" data-toggle="modal" data-target="#closeTicketModal">Close Ticket</button></th>
                    
                                    </tr>';
                                        
                                    }
                                    
                                }

                            }
                            
                            ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Closed Tickets Tab -->
                    <div class="tab-pane fade " id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                        <h5 class="mb-4 dashboardheader">Closed Tickets</h5>
                        <table class="table-responsive table pr-2" id="myTable1">
                            <thead>
                                <tr>
                                    <th scope="col">Sr. No.</th>
                                    <th scope="col">Ticket Number</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">File Attached</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Assigned To</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Closed On</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                    require '_dbconnection.php';
                            $readTicketsQuery = "SELECT * FROM `tickets` WHERE `created_by_user`='$createdByUser'";
                            $readTicket = mysqli_query($conn, $readTicketsQuery);
                            $createdByUser = $_SESSION['serialno'];
                                    $searchUserQuery1 = "SELECT * from `users` WHERE `serialno`='$createdByUser'";
                                    $searchUser1 = mysqli_query($conn, $searchUserQuery1);
                                    $foundUser = mysqli_fetch_array($searchUser1);
                                    
                            if(mysqli_num_rows($readTicket)>0){
                                $serialNo1 = 0;
                                while($row=mysqli_fetch_assoc($readTicket)){
                                    
                                    if($row['status']=='closed'){
                                        $serialNo1+=1;
                                        $attachedFile=$row['attached_file'];
                                        $attachedFileFinal = substr($attachedFile,2,);
                                        $attachedFilePath = $absPath.$attachedFileFinal;
                                        $attachedFileName = $row['attached_file'];
                                        $attachedFileNameFinal = substr($attachedFileName,16,);
                                        $description = $row['description'];
                                        $shortDescription = substr($description,0,25);
                                        $agentUsername = $row['assigned_to'];
                                        $getAgentName = mysqli_query($conn,"SELECT * FROM `users` WHERE `username` = '$agentUsername' ");
                                        $agentName = mysqli_fetch_assoc($getAgentName);
                                        echo '<tr>
                                    <th scope="col">'.$tableSerialNo.'</th>
                                    <th scope="col"><a class="viewfilelinks" target="_blank" href="'.$absPath.'/partials/_ticket_details.php?t_no='.$row['ticket_no'].'">'.$row['ticket_no'].'</a></th>
                                    <th scope="col">'.$row['title'].'</th>
                                    <th scope="col">'.$description.'<a class="viewfilelinks" target="_blank" href="'.$absPath.'/partials/_ticket_details.php?t_no='.$row['ticket_no'].'"> ...</a></th>
                                    <th scope="col">'.$foundUser['firstname'].' '.$foundUser['lastname'].'</th>
                                    <th scope="col">'.$row['department'].'</th>
                                    <th scope="col"><a class="viewfilelinks" target="_blank" href="'.$attachedFilePath.'">'.$attachedFileNameFinal.'</a></th>
                                    <th scope="col">'.$row['created_on'].'</th>
                                    <th scope="col">'.$agentName['firstname'].' '.$agentName['lastname'].'</th>';
                                    if($row['status']=='open'|| $row['status']=='Re Opened'){
                                        echo '<th scope="col"><button class="btn btn-sm btn-success mt-2">'.$row['status'].'</button></th>';
                                    }
                                    if($row['status']=='closed'){
                                        echo '<th scope="col"><button class="btn btn-sm btn-danger mt-2">'.$row['status'].'</button></th>';
                                    }
                                    echo '<th scope="col">'.$row['closed_on'].'</th>
                                    <th scope="col">'.$row['duration'].'</th>
                                    <th scope="col"><button type="button" class="btn btn-sm btn-success editbuttons" id="reopen'.$row['ticket_no'].'" data-toggle="modal" data-target="#reOpenModal"><a style="color:white" href="_raise_a_ticket.php/?reOpenTicket='.$row['ticket_no'].'">Re Open</a></button></th>
                    
                                    </tr>';
                                    }
                                    
                                }

                            }
                            ?>
                            </tbody>
                        </table>

                    </div>


                    <!-- Profile Tab -->
                    <div class="tab-pane fade " id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                        <h5 class="mb-4 dashboardheader">Profile</h5>
                        <table class="table">

                            <?php require '_dbconnection.php';
$userName = $_SESSION['username'];
$searchUserQuery = "SELECT * FROM `users` WHERE `username`='$userName'";
$searchUser = mysqli_query($conn, $searchUserQuery);

if($searchUser){
    if(mysqli_num_rows($searchUser)==1){
        while($row=mysqli_fetch_assoc($searchUser)){
            if($row['photo_uploaded']!=NULL){
                $photoPath = $row['photo_uploaded'];
                $photoUrl = substr($photoPath,2,);
                echo '<tr>
                <th scope="col">Profile Photo</th>
                <th scope="col">
                <img src="'.$absPath.$photoUrl.'" height="200px" width="150px;" alt="Profile Photo">
                </th>
            </tr>';
            } else { echo '<tr>
            <th scope="col">Profile Photo</th>
            <th scope="col">
                <form action="_raise_a_ticket.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="photo"></label>
                        <input type="file" class="form-control-file" id="photo" name="photo"
                            aria-describedby="fileHelp" required>
                        <small id="fileHelp" class="form-text mb-1">Only .jpg/.jpeg/.png extenstions
                            allowed.
                        </small>
                        <input type="submit" name="photoupload" class="btn btn-outline-danger" id="photoupload" value="Upload Photo">

                    </div>
                </form>
            </th>
        </tr>';
            }
            echo '<tr>
            <th scope="col">First Name :</th>
            <th scope="col">'.$foundUser['firstname'].'</th>
                        </tr>
                        <tr>
                            <th scope="col">Last Name :</th>
                            <th scope="col">'.$foundUser['lastname'].'</th>
                        </tr>
                        <tr>
                            <th scope="col">Phone Number :</th>
                            <th scope="col"><input type="text" name="mobile" id="mobile" style="display:none "></th>
                        </tr>
                        <tr>
                            <th scope="col">Gender :</th>
                            <th scope="col">Male <input type="radio" name="gender" id="gender" value="male"
                                    checked="checked">
                                Female<input type="radio" name="gender" id="gender" value="female"></th>
                        </tr>
                        <tr>
                            <th scope="col">Address :</th>
                            <th scope="col"><textarea name="address" id="address" cols="25"></textarea></th>
                        </tr>';
                        }
                        }
                        }
                        ?>




                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php require '_footer.php';?>
</div>