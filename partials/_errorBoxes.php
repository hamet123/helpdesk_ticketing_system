<?php

if(isset($_SESSION['isLoggedIn'])){
  if($_SESSION['role']=='user'){
    $pathToRedirect = '/_dashboard.php';
  }
  if($_SESSION['role']=='admin'){
    $pathToRedirect = '/_admin_dashboard.php';
  }
  if($_SESSION['role']=='agent'){
    $pathToRedirect = '/_agent_dashboard.php';
  }
  
  
}


require '_signup.php';
if(isset($_GET['showUsernameExistError']) && $_GET['showUsernameExistError']==true){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">'.
    $_GET["showUsernameExistErrorMessage"].'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
    
}


if(isset($_GET['showSignupConfirmation']) && $_GET['showSignupConfirmation']=='true'){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'.
  $_GET["showSignupConfirmationMessage"].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  
}

if(isset($_GET['showPasswordMismatchError']) && $_GET['showPasswordMismatchError']=='true'){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.
  $_GET["showPasswordMismatchErrorMessage"].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  
}

if(isset($_GET['isLoggedIn']) && $_GET['isLoggedIn']=='false'){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.
  $_GET["loginFailMessage"].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
echo "<script>
const redirectUser = function(){
    window.location.replace('".$absPath."/partials/'.$pathToRedirect.'');
};
setInterval(redirectUser, 1000);
</script>";
  
}



if(isset($_GET['isLoggedIn']) && $_GET['isLoggedIn']=='true' && $_GET['redirectedFromLogin']=='true'){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'.
  $_GET["loginSuccessMessage"].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
echo "<script>
const redirectUser = function(){
    window.location.replace('".$absPath."/partials/'.$pathToRedirect.'');
};
setInterval(redirectUser, 1000);
</script>";
  
}



// Raise ticket error handling/


if(isset($_GET['isTicketRaised']) && $_GET['isTicketRaised']=='true'){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'.
  $_GET["ticketRaiseConfirmationMessage"].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
echo '<script>
const redirectUser = function(){
    window.location.replace("'.$absPath.'/partials'.$pathToRedirect.'");
};
setInterval(redirectUser, 1000);
</script>';
  
}



if(isset($_GET['isTicketRaised']) && $_GET['isTicketRaised']=='false'){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.
  $_GET["ticketRaiseFailureMessage"].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
echo '<script>
const redirectUser = function(){
    window.location.replace("'.$absPath.'/partials'.$pathToRedirect.'");
};
setInterval(redirectUser, 1000);
</script>';
  
}



if(isset($_GET['isSizeError']) && $_GET['isSizeError']=='true'){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.
  $_GET["sizeErrorMessage"].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
echo "<script>
const redirectUser = function(){
    window.location.replace('".$absPath."/partials/'.$pathToRedirect.'');
};
setInterval(redirectUser, 1000);
</script>";
  
}



if(isset($_GET['isFileTypeError']) && $_GET['isFileTypeError']=='true'){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.
  $_GET["fileTypeErrorMessage"].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
echo "<script>
const redirectUser = function(){
    window.location.replace('".$absPath."/partials/'.$pathToRedirect.'');
};
setInterval(redirectUser, 1000);
</script>";
  
}


if(isset($_GET['isUpdated']) && $_GET['isUpdated']=='true'){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'.
  $_GET["updateSuccessfullyMessage"].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';  
echo '<script>
const redirectUser = function(){
    window.location.replace("'.$absPath.'/partials'.$pathToRedirect.'");
};
setInterval(redirectUser, 1000);

</script>';
}


if(isset($_GET['isReOpened']) && $_GET['isReOpened']=='true'){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'.
  $_GET["reOpenSuccessfullyMessage"].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';  
echo "<script>
const redirectUser = function(){
    window.location.replace('".$absPath."/partials/'.$pathToRedirect.'');
};
setInterval(redirectUser, 1000);
</script>";
}

if(isset($_GET['isClosed']) && $_GET['isClosed']=='true'){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'.
  $_GET["closedSuccessfullyMessage"].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';  
echo "<script>
const redirectUser = function(){
    window.location.replace('".$absPath."/partials/'.$pathToRedirect.'');
};
setInterval(redirectUser, 1000);
</script>";
}







if(isset($_GET['isUpdatedAdmin']) && $_GET['isUpdatedAdmin']=='true'){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'.
  $_GET["updateSuccessfullyMessageAdmin"].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';  
echo "<script>
const redirectUser = function(){
    window.location.replace('".$absPath."/partials/'.$pathToRedirect.'');
};
setInterval(redirectUser, 1000);
</script>";
}


if(isset($_GET['isReOpenedAdmin']) && $_GET['isReOpenedAdmin']=='true'){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'.
  $_GET["reOpenSuccessfullyMessageAdmin"].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';  
echo '<script>
const redirectUser = function(){
    window.location.replace('.$absPath.'/partials/'.$pathToRedirect.');
};
setInterval(redirectUser, 1000);
</script>';
}

if(isset($_GET['isClosedAdmin']) && $_GET['isClosedAdmin']=='true'){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'.
  $_GET["closedSuccessfullyMessageAdmin"].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';  
echo "<script>
const redirectUser = function(){
    window.location.replace('".$absPath."/partials/'.$pathToRedirect.'');
};
setInterval(redirectUser, 1000);
</script>";
}





?>