<?php include './inc/db.php' ;
    session_start();
    if(isset($_SESSION['email']) && isset($_SESSION['pass'])){  
        $admin_sql="SELECT * FROM signaltracker.admin WHERE signaltracker.admin.email='$_SESSION[email]' AND signaltracker.admin.password='$_SESSION[pass]'";
        if($admin_run = mysqli_query($conn,$admin_sql)){
             if(mysqli_num_rows($admin_run)==1){
                while($adminRows = mysqli_fetch_assoc($admin_run)){           
                    $adminEmail =$adminRows['email'];                 
                    $adminName =$adminRows['name'];                 
                    $adminPhone =$adminRows['phone'];                
                    $adminId =$adminRows['id'];                    
                }
             }else{
                header('Location: ./registeration.php');
             }
        }else{
             header('Location: ./registeration.php');
        }        
    }else{
        header('Location: ./registeration.php');
    }

?>



<?php 
    $show_error= false;
        if(isset($_POST['submit-save'])){  
                $ins_sql = "UPDATE signaltracker.admin SET email='$_POST[editEmail]', name='$_POST[editName]', phone='$_POST[editPhone]' WHERE signaltracker.admin.id='$adminId'";
                if(mysqli_query($conn,$ins_sql)){  
                    header('Location: view_profile.php');                  
                }else{
                    $error = '<div class="alert alert-danger alert-dismissible fade show">The query was not working.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></div>';  
                    $show_error= true;
                }
            
            
        }        
    ?>




<!DOCTYPE html>
<html lang="en">   
    <?php include './inc/header.php' ?>
    
        <!-- Sidebar start -->
        <div class="container-fluid"  id="myContainer">
            <div class="row">
              <?php include './inc/sidebar.php' ?>  
                <!-- Main content start --> 
                <div class="col-sm-10">
                    <?php if($show_error== true) {echo $error;}?>
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2 wow fadeInLeft" data-wow-duration="0.5s">Admin Profile</h1>
                        <a href="view_profile.php" class="wow fadeInRight" data-wow-duration="0.5s"><button type="button" class="btn btn-info"  aria-pressed="false"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button></a>
                    </div>
                    
                    
                    <!--Modal start-->
                    <div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Edit your profile information.</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>

                                <div class="modal-body">
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="edit-email">Your email address:</label>
                                            <input type="email" id="edit-email" name="editEmail" class="form-control" aria-describedby="emailHelp" value="<?php echo $adminEmail; ?>">
                                            <small>If you change your email address, you'll be redirected to login page.</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-name">Your full name:</label>
                                            <input type="text" id="edit-name" name="editName" class="form-control" value="<?php echo $adminName; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-phone">Your phone number:</label>
                                            <input type="tel" id="edit-phone" name="editPhone" class="form-control" value="<?php echo $adminPhone; ?>">
                                        </div>
                                       <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <a><button type="submit" name="submit-save" class="btn btn-primary">Save</button></a>
                                           <p class="debug-url"></p>
                                        </div>
                                        
                                    </form>
                                    <!--<p class="debug-url"></p>-->
                                </div>

                                
                            </div>
                        </div>
                    </div>
                    <!--modal end-->
                    
                    
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="card">
                                <div class="card-header">
                                Your Profile
                                </div>  
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h6>Name </h6>
                                        </div>
                                        <div class="col-lg-6">
                                            <p><?php echo $adminName;?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h6>Phone Number </h6>
                                        </div>
                                        <div class="col-lg-6">
                                            <p><?php echo $adminPhone;?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h6>Email Address </h6>
                                        </div>
                                        <div class="col-lg-6">
                                            <p><?php echo $adminEmail;?></p>
                                        </div>
                                    </div>
                                    <a class="btn btn-info wow fadeInLeft" data-wow-duration="0.5s" data-toggle="modal" data-target="#edit-profile">Edit Your Profile</a>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-sm-7">
                            <div class="card">
                                <div class="card-header">
                                All Admins Info.
                                </div>  
                                <div class="card-body">     
                                    <div class="table-responsive">
                                        <table class="table table-light table-hover table-striped" id="pager">
                                            <thead class="bg-info" style="color:white;">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Admin Name</th>
                                                    <th>Email</th>
                                                    <th>Phone Number</th>
                                                </tr>
                                            </thead>
                                            <tbody>      
                                                <?php 
                                                    $sel_ad="SELECT * FROM signaltracker.admin";
                                                    $run_ad = mysqli_query($conn,$sel_ad);
                                                    while($adrows = mysqli_fetch_assoc($run_ad)){    
                                                            echo '
                                                            <tr class="wow fadeInUp" data-wow-duration="0.5s">   
                                                                <td>'.$adrows['id'].'</td>
                                                                <td>'.$adrows['name'].'</td>
                                                                <td>'.$adrows['email'].'</td>
                                                                <td>'.$adrows['phone'].'</td>
                                                            </tr>   
                                                            ';
                                                    }                                                                
                                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="pageNavPosition" class="pager-nav wow fadeInUp" data-wow-duration="1s"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Main content end --> 
            </div>
             <!-- footer -->
            <?php include './inc/footer.php' ?>
        </div>
    
    <?php include './inc/scripts.php' ?>
    </body>
</html>
            
        