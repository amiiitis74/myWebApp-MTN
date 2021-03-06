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
                    <?php echo $error;?>
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">All Reports</h1>
                        <a href="view_allReports.php"><button type="button" class="btn btn-info"  aria-pressed="false"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button></a>
                    </div>
                    <!-- Table Start -->
                    <table class="table table-light table-hover table-striped" >
                            <thead class="thead-dark">
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Network Type</th>
                                    <th>Signal Strength</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>User Phone</th>
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
        </div>
    <?php include './inc/footer.php' ?>
    </body>
</html>
            
        