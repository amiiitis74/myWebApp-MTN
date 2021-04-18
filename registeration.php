<?php include './inc/db.php' ?>

<?php 
    $error ='';
    if(isset($_GET['login_error'])){
    if($_GET['login_error'] == 'empty'){
        $error = '<div class="alert alert-danger">Username or Password was Empty!</div>';
    }else if($_GET['login_error'] == 'wrong'){
        $error = '<div class="alert alert-danger">Username or Password was Wrong!</div>';
    }else if($_GET['login_error'] == 'query'){
        $error = '<div class="alert alert-danger">There is some kind of Query or Database Issue</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">   
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=0.75">
        <title>Map</title>     
        <link rel="stylesheet" href="../css/bootstrap.min.css" >
        <link rel="stylesheet" href="../v6.5.0-dist/ol.css" type="text/css"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
        <link rel="stylesheet" href="../css/animate.css">
        <link rel="stylesheet" href="../css/myStyle.css"/> 
    </head>
    <body >  
        <nav class="navbar navbar-dark bg-dark justify-content-between">
            <div>
                <img src="../img/antenna-white.png" id="header-img"/> <a class="navbar-brand" style="color:white;"> Signal Tracker </a>
            </div> 
            <ul class="navbar-nav">
                <li class="nav-item active" id="logoutMenu">
                    <a class="nav-link" href="../account/logout.php"><i class="fa fa-power-off" ></i> Logout</a>
                </li>
            </ul>
        </nav>
        <!-- Sidebar start -->
        <div class="container-fluid">
            <div class="row  h-100" >
               <div class="col-lg-4 mx-auto my-auto">
                   <div class="card"  style="margin-top:50px;display:none;" id="loginFormAll">
                       <div class="card-body">
                        <div class="text-center" style="margin-bottom:50px;">
                            <p>You are loged out of the system. Please login to continue.</p>  
                            <?php echo $error;?>
                        </div>
                        <?php include './inc/loginform.php' ?>
                       </div>
                   </div>      
                </div> 
            </div>  
        </div>
    
    <?php include './inc/scripts.php' ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#loginFormAll").fadeToggle(500);
        })
    </script>
    </body>
</html>
            
        