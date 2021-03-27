<?php session_start();
    include '../inc/db.php' ; 
    if(isset($_POST['submit_login'])){
        if(!empty($_POST['email']) && !empty($_POST['pass'])){
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $pass = mysqli_real_escape_string($conn,$_POST['pass']);
            $sql = "SELECT * FROM signaltracker.admin WHERE signaltracker.admin.email='$email' AND signaltracker.admin.password='$pass'";
            if($result=mysqli_query($conn,$sql)){
                 if( mysqli_num_rows($result) == 1){
                    $_SESSION['email']=$email;
                    $_SESSION['pass']=$pass;
                    header('Location: ../index.php'); 
                 }else{
                     //wrong info
                    header('Location: ../registeration.php?login_error=wrong'); 
                 }
            }else{
                //query not working
                header('Location: ../registeration.php?login_error=query'); 
            }
        }else{
            //empty
            header('Location: ../registeration.php?login_error=empty'); 
        }
    }
?>