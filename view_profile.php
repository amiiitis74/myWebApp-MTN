<?php include './inc/db.php' ?>

<!DOCTYPE html>
<html lang="en">   
    <?php include './inc/header.php' ?>
    
        <!-- Sidebar start -->
        <div class="container-fluid">
            <div class="row" >
              <?php include './inc/sidebar.php' ?>  
                <!-- Main content start --> 
                <div class="col-sm-10">
                    <?php if($show_error== true) {echo $error;}?>
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Admin Profile</h1>
                        <a href="view_profile.php"><button type="button" class="btn btn-info"  aria-pressed="false"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button></a>
                    </div>
                    <?php 
                        $sel_ad="SELECT * FROM signaltracker.admin";
                        $run_ad = mysqli_query($conn,$sel_ad);
                        while($adrows = mysqli_fetch_assoc($run_ad)){ echo '
                    <div class="card">
                        <div class="card-header" style="background-color:#17A2B8;color:white;">
                        Admin'.$adrows['id'].'
                        </div>  
                        <div class="card-body">
                            <table class="table">
                                <tbody>      

                                                
                                                <tr> 
                                                    <td> Name </td>  
                                                    <td>  </td>
                                                </tr>
                                                <tr> 
                                                    <td> Phone Number </td>  
                                                    <td>  </td>
                                                </tr> 
                                                <tr> 
                                                    <td> Email Address </td>  
                                                    <td>'.$adrows['email'].'</td>
                                                </tr> 
                                                
                                      
                                </tbody>
                            </table>
                        </div>
                    </div>'
                    ; }  ?>
                </div>
                <!-- Main content end --> 
            </div>
        </div>
    
    <?php include './inc/footer.php' ?>
    </body>
</html>
            
        