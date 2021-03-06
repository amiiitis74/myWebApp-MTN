<?php
$server ='localhost' ;
$username = 'root';
$password ='9371642007shap';
$db = 'signaltracker';  

$conn = mysqli_connect($server, $username , $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
    $error_txt = 'Database Connection Failed';
    $alert_type = 'warning';
}
    $error_txt = 'Database Connection Successfull';
    $alert_type = 'success';


// Error box 
$error = 
    '
    <div class="alert alert-'.$alert_type.' alert-dismissible fade show" role="alert">
      '.$error_txt.'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    ';

?>

