<?php 
session_start();
if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']=='true'&& isset($_SESSION['role']) && $_SESSION['role']=='admin' || $_SESSION['role']=='agent'){
    require '_dbconnection.php';
    require '_header.php';  ?>
<title>Agent Dashboard</title>
<?php      
    require '_navbar.php';
     
    
    
    
} else {
    header("Location: ./_dashboard.php");
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
                    <form action="_agent_backend.php" method="post" enctype="multipart/form-data" class="mt-3">

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
                    <form action="_agent_backend.php" method="POST">
                        <input type="hidden" name="hidden_close_ticket" id="hidden_close_ticket">
                        <h5 class="deleteMessage"></h5>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-danger" value="Close Ticket" name="close_ticket">
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
                        href="#list-my_tickets" role="tab" aria-controls="my_tickets">Open Tickets</a>
                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list"
                        href="#list-profile" role="tab" aria-controls="profile">Closed Tickets</a>

                </div>
            </div>


            <!-- Raise a Ticket Tab -->
            <div class="col-lg-10 col-md-12 mb-5" id="contentdiv">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane  fade show active" id="list-raise_ticket" role="tabpanel"
                        aria-labelledby="list-raise_ticket-list">
                        <h5 class="mb-4 dashboardheader">Raise a Ticket</h5>
                        <form action="_agent_backend.php" method="post" enctype="multipart/form-data" class="mt-3">
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




                    <!-- Open Tickets Tab -->
                    <div class="tab-pane fade " id="list-my_tickets" role="tabpanel"
                        aria-labelledby="list-my_tickets-list">
                        <h5 class="mb-4 dashboardheader">Open Tickets</h5>
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
                            $agentUserId = $_SESSION['serialno'];
                            $searchAgentQuery = "SELECT * from `users` WHERE `serialno`='$agentUserId'";
                            $searchAgent = mysqli_query($conn, $searchAgentQuery);
                            $foundAgent = mysqli_fetch_assoc($searchAgent);
                            $foundAgentDepartment = $foundAgent['associated_department'];
                            $readTicketsQuery = "SELECT * FROM `tickets` WHERE `department`='$foundAgentDepartment'";
                            $readTicket = mysqli_query($conn, $readTicketsQuery);
                             $tableSerialNo = 0;
                                while($row=mysqli_fetch_assoc($readTicket)){

                                    $userId = $row['created_by_user'];
                                    
                                    $searchUserQuery = "SELECT * from `users` WHERE `serialno`='$userId'";
                                    $searchUser = mysqli_query($conn, $searchUserQuery);
                                    $foundUser = mysqli_fetch_assoc($searchUser);
                                    
                                   
                                    
                                    // if($row['department']==$foundAgentDepartment){
                                        
                                        $tableSerialNo += 1;
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
                                        if($row['status']!='closed'){
                                            echo '<tr>
                                            <th scope="col">'.$tableSerialNo.$userId.'</th>
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
                                    
                                    
                                // }

                            
                            ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Closed Tickets Tab -->
                    <div class="tab-pane fade " id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                        <h5 class="mb-4 dashboardheader">Closed Tickets</h5>
                        <table class="table-responsive table" id="myTable1">
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
                    
                            $agentUserId = $_SESSION['serialno'];
                            $searchAgentQuery = "SELECT * from `users` WHERE `serialno`='$agentUserId'";
                            $searchAgent = mysqli_query($conn, $searchAgentQuery);
                            $foundAgent = mysqli_fetch_assoc($searchAgent);
                            $foundAgentDepartment = $foundAgent['associated_department'];
                            $readTicketsQuery = "SELECT * FROM `tickets` WHERE `department`='$foundAgentDepartment'";
                            $readTicket = mysqli_query($conn, $readTicketsQuery);
                             $tableSerialNo = 0;
                                while($row=mysqli_fetch_assoc($readTicket)){
                                    $userName = $row['assigned_to'];
                                    $searchAgentQuery = "SELECT * from `users` WHERE `username`='$userName'";
                                    $searchAgent = mysqli_query($conn, $searchAgentQuery);
                                    $foundAgent = mysqli_fetch_assoc($searchAgent);
                                    $foundAgentDepartment = $foundAgent['associated_department'];

                                    $userId = $row['created_by_user'];
                                    
                                    $searchUserQuery = "SELECT * from `users` WHERE `serialno`='$userId'";
                                    $searchUser = mysqli_query($conn, $searchUserQuery);
                                    $foundUser = mysqli_fetch_assoc($searchUser);
                                    
                                    if($row['department']==$foundAgentDepartment){
                                        $tableSerialNo += 1;
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
                                        if($row['status']=='closed'){
                                            echo '<tr>
                                            <th scope="col">'.$tableSerialNo.$userId.'</th>
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
                                            <th scope="col"><button type="button" class="btn btn-sm btn-success editbuttons" id="reopen'.$row['ticket_no'].'" data-toggle="modal" data-target="#reOpenModal"><a style="color:white" href="_agent_backend.php/?reOpenTicket='.$row['ticket_no'].'">Re Open</a></button></th>
                            
                                            </tr>';
                                        }
                                    
                                    }
                                        
                                    
                                }

                            
                            ?>
                            </tbody>
                        </table>

                    </div>



                </div>
            </div>
        </div>
    </div>




    <?php require '_footer.php';?>
</div>