<?php 
session_start();
if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']=='true'&& isset($_SESSION['role']) && $_SESSION['role']=='admin'){
    require '_dbconnection.php';
    require '_header.php'; ?>
<title>Admin Dashboard</title>
<?php 
    require '_navbar.php';
     
    
    
    
} else {
    header("Location: ./_dashboard.php");
}

?>
<div class="container-fluid bodydiv">


    <!-- Edit Ticket Modal -->
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
                    <form action="_admin_backend.php" method="post" enctype="multipart/form-data" class="mt-3">

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
                    <form action="_admin_backend.php" method="POST">
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


    <!-- Edit Department Modal -->
    <div class="modal fade" id="editDepartmentModal" tabindex="-1" role="dialog"
        aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDepartmentModalLabel">Edit Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="mb-5" action="./_admin_backend.php" method="POST">
                        <div class="form-group">
                            <label for="updatedepartment">Department</label>
                            <input type="text" class="form-control" id="updatedepartment"
                                placeholder="Enter name of the Department" name="updatedepartment" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="department_id"
                                placeholder="Enter name of the Department" name="department_id" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Delete Department Modal -->

    <div class="modal fade" id="deleteDepartmentModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteDepartmentModalLabel">Delete Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="mb-5" action="./_admin_backend.php" method="POST">
                        <h6 id="deletedepartmentmessage"></h6>
                        <div class="form-group">

                            <input type="hidden" class="form-control" id="deletedepartmentid" placeholder=""
                                name="deletedepartmentid" required>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Edit Agent Modal -->

    <div class="modal fade" id="editAgentModal" tabindex="-1" role="dialog" aria-labelledby="editAgentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAgentModalLabel">Edit Agent</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="mb-5" action="_admin_backend.php" method="POST">
                        <div class="form-group">
                            <label for="updateagentemail">Email ID</label>
                            <input type="email" class="form-control" id="updateagentemail"
                                placeholder="Enter Email ID of the user" name="updateagentemail" required>
                        </div>
                        <div class="form-group">

                            <input type="hidden" class="form-control" id="hiddenupdateagentemail"
                                placeholder="Enter Email ID of the user" name="hiddenupdateagentemail" required>
                        </div>
                        <div class="form-group">
                            <label for="updatefname">First Name</label>
                            <input type="text" class="form-control" id="updatefname"
                                placeholder="Enter First Name of the User" name="updatefname" required>
                        </div>
                        <div class="form-group">
                            <label for="updatelname">Last Name</label>
                            <input type="text" class="form-control" id="updatelname"
                                placeholder="Enter Last Name of the User" name="updatelname" required>
                        </div>
                        <div class="form-group">
                            <label for="update_associated_department">Department</label>
                            <select class="form-control" id="update_associated_department"
                                name="update_associated_department" required>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Delete Agent Modal -->

    <div class="modal fade" id="deleteAgentModal" tabindex="-1" role="dialog" aria-labelledby="deleteAgentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAgentModalLabel">Delete Agent</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="_admin_backend.php" method="POST">
                        <h6 id="deleteagentmessage"></h6>
                        <div class="form-group">

                            <input type="hidden" class="form-control" id="hiddenusername" aria-describedby="emailHelp"
                                placeholder="Enter email" name="hiddenusername">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
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
                    <a class="list-group-item list-group-item-action" id="list-createdepartment-list" data-toggle="list"
                        href="#list-createdepartment" role="tab" aria-controls="createdepartment">Manage
                        Departments</a>
                    <a class="list-group-item list-group-item-action" id="list-createagent-list" data-toggle="list"
                        href="#list-createagent" role="tab" aria-controls="createagent">Create/Manage Agents</a>
                    <a class="list-group-item list-group-item-action" id="list-search_ticket-list" data-toggle="list"
                        href="#list-search_ticket" role="tab" aria-controls="search_ticket">Search Ticket Details</a>
                </div>
            </div>


            <!-- Raise a Ticket Tab -->
            <div class="col-lg-10 col-md-12 mb-5" id="contentdiv">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane  fade show active" id="list-raise_ticket" role="tabpanel"
                        aria-labelledby="list-raise_ticket-list">
                        <h5 class="mb-4 dashboardheader">Raise a Ticket</h5>
                        <form action="_admin_backend.php" method="post" enctype="multipart/form-data" class="mt-3">
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
                    $createdByUser = $_SESSION['serialno'];
                            $readTicketsQuery = "SELECT * FROM `tickets`";
                            $readTicket = mysqli_query($conn, $readTicketsQuery);
                             $tableSerialNo = 0;
                                while($row=mysqli_fetch_assoc($readTicket)){

                                    $userId = $row['created_by_user'];
                                    
                                    $searchUserQuery = "SELECT * from `users` WHERE `serialno`='$userId'";
                                    $searchUser = mysqli_query($conn, $searchUserQuery);
                                    $foundUser = mysqli_fetch_assoc($searchUser);
                                    
                                    
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
                    $createdByUser = $_SESSION['serialno'];
                            $readTicketsQuery = "SELECT * FROM `tickets`";
                            $readTicket = mysqli_query($conn, $readTicketsQuery);
                             $tableSerialNo = 0;
                                while($row=mysqli_fetch_assoc($readTicket)){

                                    $userId = $row['created_by_user'];
                                    
                                    $searchUserQuery = "SELECT * from `users` WHERE `serialno`='$userId'";
                                    $searchUser = mysqli_query($conn, $searchUserQuery);
                                    $foundUser = mysqli_fetch_assoc($searchUser);
                                    
                                    
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
                                    <th scope="col">'.$shortDescription.'<a class="viewfilelinks" target="_blank" href="'.$absPath.'/partials/_ticket_details.php?t_no='.$row['ticket_no'].'"> ...</a></th>
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
                                    <th scope="col"><button type="button" class="btn btn-sm btn-success editbuttons" id="reopen'.$row['ticket_no'].'" data-toggle="modal" data-target="#reOpenModal"><a style="color:white" href="_admin_backend.php/?reOpenTicket='.$row['ticket_no'].'">Re Open</a></button></th>
                    
                                    </tr>';
                                        }
                                    
                                    
                                }

                            
                            ?>
                            </tbody>
                        </table>

                    </div>


                    <!-- Create and manage departments -->
                    <div class="tab-pane fade" id="list-createdepartment" role="tabpanel"
                        aria-labelledby="list-createdepartment-list">
                        <h5 class="mb-4 dashboardheader">Create and Manage Departments</h5>
                        <form class="mb-5" action="./_admin_backend.php" method="POST">
                            <div class="form-group">
                                <label for="createdepartment">Department</label>
                                <input type="text" class="form-control" id="createdepartment"
                                    placeholder="Enter name of the Department" name="createdepartment" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>

                        <!-- List of Departments -->
                        <table class="table-responsive table w-100 d-block d-md-table" id="myTable3">
                            <thead>
                                <tr>
                                    <th scope="col">Serial Number</th>
                                    <th scope="col">Department ID</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Actions</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            require '_dbconnection.php';
                            $readDepartmentQuery = "SELECT * FROM `departments`";
                            $readDepartment = mysqli_query($conn, $readDepartmentQuery);
                            if(mysqli_num_rows($readDepartment)>0){
                                $serialNo = 0;
                                while($row=mysqli_fetch_assoc($readDepartment)){
                                    $serialNo+=1;
                                    echo '<tr>
                                    <th scope="row">'.$serialNo.'</th>
                                    <td>'.$row['department_id'].'</td>
                                    <td>'.$row['department'].'</td>
                                    <td><button class="btn btn-sm btn-success editdeptbuttons" data-toggle="modal" data-target="#editDepartmentModal">Edit</button></td>
                                    <td><button class="btn btn-sm btn-danger deletedeptbuttons" data-toggle="modal" data-target="#deleteDepartmentModal">Delete</button></td>
                                </tr>';
                                }
                            }
                            ?>

                            </tbody>
                        </table>

                    </div>


                    <!-- Create and manage Agents -->
                    <div class="tab-pane fade " id="list-createagent" role="tabpanel"
                        aria-labelledby="list-createagent-list">
                        <h5 class="mb-4 dashboardheader">Create and Manage Agents</h5>
                        <form class="mb-5" action="./_admin_backend.php" method="POST">
                            <div class="form-group">
                                <label for="agentemail">Email ID</label>
                                <input type="email" class="form-control" id="agentemail"
                                    placeholder="Enter Email ID of the user" name="agentemail" required>
                            </div>
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" id="fname"
                                    placeholder="Enter First Name of the User" name="fname" required>
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" id="lname"
                                    placeholder="Enter Last Name of the User" name="lname" required>
                            </div>
                            <div class="form-group">
                                <label for="associated_department">Department</label>
                                <select class="form-control" id="associated_department" name="associated_department"
                                    required>
                                    <?php
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
                                <label for="password">Enter Password</label>
                                <input type="password" class="form-control" id="password"
                                    placeholder="Enter the Password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="cpassword">Confirm Password</label>
                                <input type="password" class="form-control" id="cpassword"
                                    placeholder="Enter the Password again" name="cpassword" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>

                        <!-- List of Agents -->
                        <table class="table table-responsive w-100 d-block d-md-table" id="myTable4">
                            <thead>
                                <tr>
                                    <th scope="col">Serial Number</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Department Associated</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Actions</th>
                                    <th scope="col">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            require '_dbconnection.php';
                            $readAgentQuery = "SELECT * FROM `users` WHERE `role`='agent'";
                            $readAgent = mysqli_query($conn, $readAgentQuery);
                            if(mysqli_num_rows($readAgent)>0){
                                $serialNo = 0;
                                while($row=mysqli_fetch_assoc($readAgent)){
                                    $serialNo+=1;
                                    echo '<tr>
                                    <th scope="row">'.$serialNo.'</th>
                                    <th scope="col">'.$row['username'].'</th>
                                    <th scope="col">'.$row['firstname'].'</th>
                                    <th scope="col">'.$row['lastname'].'</th>
                                    <th scope="col">'.$row['associated_department'].'</th>
                                    <th scope="col">'.$row['role'].'</th>
                                    <td><button class="btn btn-sm btn-success editagentbuttons" data-toggle="modal" data-target="#editAgentModal">Edit</button></td>
                                    <td><button class="btn btn-sm btn-danger deleteagentbuttons" data-toggle="modal" data-target="#deleteAgentModal">Delete</button></td>
                                </tr>';
                                }
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>



                    <!-- Search a Ticket -->
                    <div class="tab-pane fade" id="list-search_ticket" role="tabpanel"
                        aria-labelledby="list-search_ticket-list">
                        <h5 class="mb-4 dashboardheader">Search Ticket Details</h5>
                        <nav class="navbar navbar-light d-flex justify-content-center">
                            <form class="form-inline" style="background:transparent" action="_admin_dashboard.php"
                                method="POST">
                                <input class="form-control mr-sm-2" type="text" placeholder="Enter Ticket Number"
                                    aria-label="Search" name="t_no">
                                <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </nav>
                        <div class="container">
                            <table class="mt-5 table table-responsive w-100 d-block d-md-table" id="myTable5">
                                <?php  
                                    if(isset($_POST['t_no'])){
                                        require '_dbconnection.php';
                                        $t_no = $_POST['t_no'];
                                        $getTicketDetails = mysqli_query($conn, "SELECT * FROM `tickets` WHERE `ticket_no`='$t_no'");
                                            if(mysqli_num_rows($getTicketDetails)==1){
                                                $row = mysqli_fetch_assoc($getTicketDetails);
                                                $ticketUser = $row['created_by_user'];
                                                $ticketUserDetails = mysqli_query($conn,"SELECT * FROM `users` WHERE `serialno`='$ticketUser'");
                                                $foundUser = mysqli_fetch_assoc($ticketUserDetails);
                                                $agentUsername = $row['assigned_to'];
                                                $agentDetails = mysqli_query($conn,"SELECT * FROM `users` WHERE `username`='$agentUsername'");
                                                $foundAgent = mysqli_fetch_assoc($agentDetails);
                                                echo '<tr>
                                                    <th>Ticket No.</th>
                                                    <th>'.$row['ticket_no'].'</th>
                                                </tr>
                                                <tr>
                                                    <th>Department</th>
                                                    <th>'.$row['department'].'</th>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>'.$row['status'].'</th>
                                                </tr>
                                                <tr>
                                                    <th>Created On</th>
                                                    <th>'.$row['created_on'].'</th>
                                                </tr>
                                                <tr>
                                                    <th>Created By</th>
                                                    <th>'.$foundUser['firstname'].' '.$foundUser['lastname'].'</th>
                                                </tr>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>'.$row['title'].'</th>
                                                </tr>
                                                <tr>
                                                    <th>Description</th>
                                                    <th>'.$row['description'].'</th>
                                                </tr>
                                                <tr>
                                                    <th>Assigned To</th>
                                                    <th>'.$foundAgent['firstname'].' '.$foundAgent['lastname'].'</th>
                                                </tr>
                                                <tr>
                                                    <th>File Attached</th>
                                                    <th>'.$row['attached_file'].'</th>
                                                </tr>
                                                <tr>
                                                    <th>Closed On</th>
                                                    <th>'.$row['closed_on'].'</th>
                                                </tr>
                                                <tr>
                                                    <th>Duration</th>
                                                    <th>'.$row['duration'].'</th>
                                                </tr>';
                                                echo '<script>
                                                window.onload = function() {
                                                    setTimeout(function() {
                                                      document.getElementById("list-search_ticket-list").click();
                                                    }, 1000);
                                                  };
                                                    </script>';
                                            } else {
                                                header("Location: _admin_dashboard.php");
                                                exit;
                                            }
                                        
                                    }
                                    else {
                                        // echo 'search ticket above ';
                                    }
                                ?>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>




    <?php require '_footer.php';?>
</div>