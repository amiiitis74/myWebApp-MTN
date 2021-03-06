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
                        <h1 class="h2">All Users</h1>
                        <a href="view_allUsers.php"><button type="button" class="btn btn-info"  aria-pressed="false"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button></a>
                    </div>
                    <table class="table table-light table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No.</th>
                                    <th>Phone Number</th>
                                </tr>
                            </thead>
                            <tbody>      
                                <?php 
                                    $sel_sql="SELECT * FROM users";
                                    $run = mysqli_query($conn,$sel_sql);
                                    while($rows = mysqli_fetch_assoc($run)){    
                                            echo '
                                            <tr>   
                                                <td>'.$rows['id'].'</td>
                                                <td>'.$rows['tel_number'].'</td>
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
            
        