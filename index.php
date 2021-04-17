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

<!DOCTYPE html>
<html lang="en">   
    <?php include './inc/header.php' ?>
    
        <!-- Sidebar start -->
        <div class="container-fluid" id="myContainer">
            <div class="row">
              <?php include './inc/sidebar.php' ?>   
                <!-- Main content start --> 
                <div class="col-md-10">
                    <?php if($show_error== true) {echo $error;}?>
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2 wow fadeInLeft" data-wow-duration="0.5s">Dashboard</h1>
                        <a href="index.php" class="wow fadeInRight" data-wow-duration="0.5s"><button type="button" class="btn btn-info"  aria-pressed="false"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button></a>
                    </div>
                    <!--Cards Start -->
                    
                    <div class="row">
                        <div class="col-sm-3 myCards">
                            <div class="card wow fadeInDown" data-wow-duration="0.5s">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img class="card-img" src="img/png96/layer-1214322.png">
                                        </div>
                                        <div class="col-lg-8" style="padding-top:3%;padding-bottom:3%">
                                            <?php $run_re=mysqli_query($conn,"SELECT count(*) FROM complaints");
                                            $re_rows = mysqli_fetch_array($run_re);
                                            echo '<h5 class="card-title">'.$re_rows[0].'</h5>';
                                            ?>  
                                            <h6 class="card-subtitle mb-2 text-muted">Reports</h6>
                                        </div>
                                    </div>
                                </div>
                                <a href="view_allReports.php" class="card-link"><h5 class="card-header dash-card-header allRe" >View all reports <i class="fa fa-angle-right"></i></h5></a>
                            </div>
                        </div>
                        <div class="col-sm-3 myCards ">
                            <div class="card wow fadeInDown" data-wow-duration="0.5s">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img class="card-img" src="img/png96/phone.png">
                                        </div>
                                        <div class="col-lg-8" style="padding-top:3%;padding-bottom:3%">
                                            <?php $run_re=mysqli_query($conn,"SELECT count(*) FROM users");
                                            $re_rows = mysqli_fetch_array($run_re);
                                            echo '<h5 class="card-title">'.$re_rows[0].'</h5>';
                                            ?> 
                                            <h6 class="card-subtitle mb-2 text-muted">Users</h6>
                                        </div>
                                    </div>       
                                </div>
                                <a href="view_allUsers.php" class="card-link"><h5 class="card-header dash-card-header allUs">View all users <i class="fa fa-angle-right"></i></h5></a>
                            </div>
                        </div>
                        <div class="col-sm-3 myCards">
                            <div class="card wow fadeInDown"  data-wow-duration="0.5s">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img class="card-img" src="img/png96/network-1214308.png">
                                        </div>
                                        <div class="col-lg-8" style="padding-top:3%;padding-bottom:3%">
                                            <?php $run_re=mysqli_query($conn,"SELECT DISTINCT net_type FROM complaints");
                                            $c=0;
                                            while ($re_rows = mysqli_fetch_assoc($run_re)){
                                                $c = $c +1;
                                            }
                                            echo '<h5 class="card-title">'.$c.'</h5>';
                                            ?> 
                                            <h6 class="card-subtitle mb-2 text-muted">Network Types</h6>
                                        </div>
                                    </div>
                                    <div class="row">                                   
                                        
                                    </div>
                                </div>
                                <a href="view_allNetTypes.php" class="card-link"><h5 class="card-header dash-card-header allNet">View all network types <i class="fa fa-angle-right"></i></h5></a>
                            </div>
                        </div>
                 <!--
                        <div class="col-sm-4 myCards">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <img class="card-img" src="img/png96/exclamation-mark-1214332.png">
                                        </div>
                                        <div class="col-sm-8" style="padding-top:3%;padding-bottom:3%">
                                            <?php $run_re=mysqli_query($conn,"SELECT count(*) FROM complaints WHERE status !='checked'");
                                            $re_rows = mysqli_fetch_array($run_re);
                                            echo '<h5 class="card-title">'.$re_rows[0].'</h5>';
                                            ?>  
                                            <h6 class="card-subtitle mb-2 text-muted">Unchecked Reports</h6>
                                        </div>
                                    </div>
                                </div>
                                <a href="view_allReports.php" class="card-link"><h5 class="card-header dash-card-header allUn" >View all uncheched reports <i class="fa fa-angle-right"></i></h5></a>
                            </div>
                        </div>
                        <div class="col-sm-4 myCards">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <img class="card-img" src="img/png96/magnifier-1214318.png">
                                        </div>
                                        <div class="col-sm-8" style="padding-top:3%;padding-bottom:3%">
                                            <?php $run_re=mysqli_query($conn,"SELECT count(*) FROM complaints WHERE status ='Under Investigation'");
                                            $re_rows = mysqli_fetch_array($run_re);
                                            echo '<h5 class="card-title">'.$re_rows[0].'</h5>';
                                            ?> 
                                            <h6 class="card-subtitle mb-2 text-muted">Under Investigation</h6>
                                        </div>
                                    </div>       
                                </div>
                                <a href="view_allReports.php" class="card-link"><h5 class="card-header dash-card-header allIn">View all under investigation reports <i class="fa fa-angle-right"></i></h5></a>
                            </div>
                        </div>-->
                        <div class="col-sm-3 myCards">
                            <div class="card wow fadeInDown"  data-wow-duration="0.5s">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img class="card-img" src="img/png96/user_3936855%20(1).png" >
                                        </div>
                                        <div class="col-lg-8" style="padding-top:3%;padding-bottom:3%">
                                            <?php $run_re=mysqli_query($conn,"SELECT count(*) FROM signaltracker.admin");
                                            $re_rows = mysqli_fetch_array($run_re);
                                            echo '<h5 class="card-title">'.$re_rows[0].'</h5>';
                                            ?> 
                                            <h6 class="card-subtitle mb-2 text-muted">Admins</h6>
                                        </div>
                                    </div>
                                    <div class="row">                                   
                                        
                                    </div>
                                </div>
                                <a href="view_profile.php" class="card-link"><h5 class="card-header dash-card-header allAd">View all admins <i class="fa fa-angle-right"></i></h5></a>
                            </div>
                        </div>
                    </div>    
                    <!--Cards End -->
                    

                    
                    <!--Summery start -->
                    <div class="row" style="margin-top:5%;margin-bottom:5%;">
                        <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header wow fadeInDown" data-wow-duration="0.5s">
                            Your Profile
                            </div>  
                            <div class="card-body" >
                                <div class="table-responsive">
                                    <table class="table wow fadeInUp"  data-wow-duration="0.5s">
                                        <tbody>           
                                            <tr> 
                                                <td class="font-weight-bold"> Name </td>  
                                                <td><?php echo $adminName;?></td>
                                            </tr>
                                            <tr> 
                                                <td class="font-weight-bold"> Phone Number </td>  
                                                <td><?php echo $adminPhone;?></td>
                                            </tr> 
                                            <tr> 
                                                <td class="font-weight-bold"> Email Address </td>  
                                                <td><?php echo $adminEmail;?></td>
                                            </tr>                  
                                        </tbody>
                                    </table>
                                </div>
                                <a href="view_profile.php" class="btn btn-info  wow fadeInLeft" data-wow-duration="1s">Go to profile</a>
                            </div>
                        </div>
                        </div>
            
                    </div>
                    <!--Summery End -->

                    </div>
                    <!-- Main content end --> 
                </div>
            
            
            <!-- footer -->
            <?php include './inc/footer.php' ?>
        </div>
    
    <?php include './inc/scripts.php' ?>
    </body>
    
</html>
            
        