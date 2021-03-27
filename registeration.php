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
    <?php include './inc/header.php' ?>
        <!-- Sidebar start -->
        <div class="container-fluid">
            <div class="row  h-100" >
               <div class="col-lg-4 mx-auto my-auto">
                   <div class="card"  style="margin-top:50px;">
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
    
    <?php include './inc/footer.php' ?>
    </body>
</html>
            
        