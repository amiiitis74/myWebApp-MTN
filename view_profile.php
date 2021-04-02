<?php include './inc/db.php' ;
    session_start();
    if(isset($_SESSION['email']) && isset($_SESSION['pass'])){
        $admin_sql="SELECT * FROM signaltracker.admin WHERE signaltracker.admin.email='$_SESSION[email]' AND signaltracker.admin.password='$_SESSION[pass]'";
        if($admin_run = mysqli_query($conn,$admin_sql)){
            while($adminRows = mysqli_fetch_assoc($admin_run)){
                if(mysqli_num_rows($admin_run) == 1){
                    $adminEmail =$adminRows['email'];                 
                    $adminName =$adminRows['name'];                 
                    $adminPhone =$adminRows['phone'];                
                }else{
                    header('Location: ./registeration.php');
                }
            }
        } 
    }else{
        header('Location: ./registeration.php');
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
                    
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="card">
                                <div class="card-header">
                                Your Profile
                                </div>  
                                <div class="card-body">
                                    <table class="table">
                                        <tbody>           
                                            <tr class="wow fadeInUp" data-wow-duration="0.5s"> 
                                                <td class="font-weight-bold"> Name </td>  
                                                <td><?php echo $adminName;?></td>
                                            </tr>
                                            <tr class="wow fadeInUp" data-wow-duration="0.5s"> 
                                                <td class="font-weight-bold"> Phone Number </td>  
                                                <td><?php echo $adminPhone;?></td>
                                            </tr> 
                                            <tr class="wow fadeInUp" data-wow-duration="0.5s"> 
                                                <td class="font-weight-bold"> Email Address </td>  
                                                <td><?php echo $adminEmail;?></td>
                                            </tr>                  
                                        </tbody>
                                    </table>
                                    <a href="#" class="btn btn-info wow fadeInLeft" data-wow-duration="0.5s">Edit Your Profile</a>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-sm-7">
                            <div class="card">
                                <div class="card-header">
                                All Admins Info.
                                </div>  
                                <div class="card-body">
                                    <div id="pageNavPosition" class="pager-nav wow fadeInUp" data-wow-duration="1s"></div>
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
            
        