<?php include './inc/db.php' ;
    session_start();
    if(isset($_SESSION['email']) && isset($_SESSION['pass'])){
        $admin_sql="SELECT * FROM signaltracker.admin WHERE signaltracker.admin.email='$_SESSION[email]' AND signaltracker.admin.password='$_SESSION[pass]'";
        if($admin_run = mysqli_query($conn,$admin_sql)){
            while($adminRows = mysqli_fetch_assoc($admin_run)){
                if(mysqli_num_rows($admin_run) == 1){
                                    
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
            <div class="row"  >
              <?php include './inc/sidebar.php' ?>  
                <!-- Main content start --> 
                <div class="col-sm-10">
                    <?php if($show_error== true) {echo $error;}?>
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">All Reports</h1>
                        <a href="view_allReports.php"><button type="button" class="btn btn-info"  aria-pressed="false"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button></a>
                    </div>
                    <!-- Table Start -->
                    <table class="table table-light table-hover table-striped">
                            <thead class="bg-info"  style="color:white;">
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Network Type</th>
                                    <th>Signal Strength</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>User Phone</th>
                                    <th>Status</th>
                                    <th>Change Status</th>
                                </tr>
                            </thead>
                            <tbody>      
                                <?php 
                                    $sel_sql="SELECT *,complaints.id AS cid , users.tel_number AS ut 
                                    FROM complaints , users WHERE complaints.user_id = users.id ORDER BY cid";
                                    $run = mysqli_query($conn,$sel_sql);
                                    while($rows = mysqli_fetch_assoc($run)){    
                                            echo '
                                            <tr>   
                                                <td>'.$rows['cid'].'</td>
                                                <td>'.$rows['title'].'</td>
                                                <td>'.$rows['content'].'</td>
                                                <td>'.$rows['net_type'].'</td>
                                                <td>'.$rows['signal_str'].'</td>
                                                <td>'.$rows['latitude'].'</td>
                                                <td>'.$rows['longitude'].'</td>
                                                <td>'.$rows['ut'].'</td>
                                                <td>'.$rows['status'].'</td>
                                                <td><a href="edit_status.php?edit_id='.$rows['cid'].'" class="btn btn-success ">Edit</a></td>
                                            </tr>   
                                            ';
                                        $latitude = $rows['latitude'];
                                        $longitude = $rows['longitude'];
                                    }                                                                
                                    ?>
                            </tbody>
                        
                        </table>
                    <!-- Table End -->
                    
                    
                    
                </div>
                <!-- Main content end --> 
            </div>
             <!-- footer -->
            <?php include './inc/footer.php' ?>
        </div>
    <?php include './inc/scripts.php' ?>
    </body>
</html>
            
        