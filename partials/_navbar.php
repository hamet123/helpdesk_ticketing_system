</head>

<body>
    <?php 
$GLOBALS['absPath'] = "http://".$_SERVER['HTTP_HOST']."/helpdesk_ticketing_system";
if(!isset($_SESSION['isLoggedIn'])){
  
  session_unset();
  session_destroy();
}

echo '<nav class="navbar container-fluid navbar-expand-lg mainnav navbar-default bg-default">
<a class="navbar-brand" href="'.$absPath.'"><img src="https://cdn-icons-png.flaticon.com/512/4813/4813913.png" width="50px" height="50px">iDesk</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link" href="#">About Us</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Dropdown
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Something else here</a>
      </div>
    </li>';

    if(isset($_SESSION['isLoggedIn']) && $_SESSION['role']=='user'){
    echo '<li class="nav-item">
      <a class="nav-link" href="'.$absPath.'/partials/_dashboard.php">Dashboard</a>
    </li>';
    }

    if(isset($_SESSION['isLoggedIn']) && $_SESSION['role']=='admin'){
      echo '<li class="nav-item">
        <a class="nav-link" href="'.$absPath.'/partials/_admin_dashboard.php">Dashboard</a>
      </li>';
      }

      if(isset($_SESSION['isLoggedIn']) && $_SESSION['role']=='agent'){
        echo '<li class="nav-item">
          <a class="nav-link" href="'.$absPath.'/partials/_agent_dashboard.php">Dashboard</a>
        </li>';
        }

  echo '</ul>
  <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn searchButton my-2 my-sm-0 mr-2" type="submit">Search</button>
  </form>';


  
  if(!isset($_SESSION['isLoggedIn'])){
  echo '<!-- Signup trigger modal -->
<button type="button" class="btn authbuttons mx-2" data-toggle="modal" data-target="#signupModal">
  Signup
</button>

<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <form action="partials/_signup.php" method="post">
      <div class="form-group">
        <label for="firstname">First Name</label>
        <input type="text" class="form-control" id="firstname" name="firstname">
        
    </div>

    <div class="form-group">
    
    <label for="lastname">Last Name</label>
    <input type="text" class="form-control" id="lastname" name="lastname">
</div>
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"  name="email">
        
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password"  name="password">
      </div>
      <div class="form-group">
        <label for="cpassword">Confirm Password</label>
        <input type="password" class="form-control" id="cpassword"  name="cpassword">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Signup</button>
      </div>
    </form>


      </div>
      
    </div>
  </div>
</div>';
  



echo '<!-- Login trigger modal -->
<button type="button" class="btn authbuttons" data-toggle="modal" data-target="#loginModal">
  Login
</button>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="partials/_login.php" method="post">
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
        
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>
      </div>
      
    </div>
  </div>
</div>




</div>
';
}


if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']=='true') {
  
echo '<a  href="'.$absPath.'/partials/_logout.php" class="btn  authbuttons mr-2">
Logout
</a>';
}

if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']=='true') {
  echo '<a  href="#" class="btn authbuttons mx-2">Hi, 
'.$_SESSION['firstname'].'
</a>';

}


echo '</nav>';
require '_errorBoxes.php';


 
?>