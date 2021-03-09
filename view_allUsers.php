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
                        <h1 class="h2">All Users</h1>
                        <a href="view_allUsers.php"><button type="button" class="btn btn-info"  aria-pressed="false"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button></a>
                    </div>
                    <table class="table table-light table-hover table-striped">
                        <thead class="bg-info" style="color:white;">
                            <tr>
                                <th>No.</th>
                                <th>Phone Number</th>
                                <th>Number of Complaints</th>
                            </tr>
                        </thead>
                        <tbody>      
                            <?php 
                                $sel_sql="SELECT * FROM users";
                                $run = mysqli_query($conn,$sel_sql);
                                while($rows = mysqli_fetch_assoc($run)){  
                                    $count_q="SELECT count(*) FROM complaints AS c WHERE c.user_id = '$rows[id]'";
                                    $run_count_q=mysqli_query($conn,$count_q);
                                    $number_rows=mysqli_fetch_array($run_count_q);
                                        echo '
                                        <tr>   
                                            <td>'.$rows['id'].'</td>
                                            <td>'.$rows['tel_number'].'</td>
                                            <td>'.$number_rows[0].'</td>
                                        </tr>   
                                        ';
                                }                                                                
                                ?>
                        </tbody>
                    </table>
                </div>
                <!-- Main content end --> 
            </div>
        </div>
    
    <?php include './inc/footer.php' ?>
    </body>
</html>
            
        