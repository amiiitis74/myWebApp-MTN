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
            <div class="row">
              <?php include './inc/sidebar.php' ?>  
                <!-- Main content start --> 
                <div class="col-sm-10">
                    <?php if($show_error== true) {echo $error;}?>
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2 wow fadeInLeft" data-wow-duration="0.5s">All Network Types</h1>
                        <a href="view_allNetTypes.php" class="wow fadeInRight" data-wow-duration="0.5s"><button type="button" class="btn btn-info"  aria-pressed="false"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button></a>
                    </div>
                    <div id="pageNavPosition" class="pager-nav wow fadeInUp" data-wow-duration="1s"></div>
                    <div class="table-responsive">
                        <table class="table table-light table-hover table-striped" id="pager">
                            <thead class="bg-info" style="color:white;">
                                <tr>
                                    <th>No.</th>
                                    <th>Network Type</th>
                                </tr>
                            </thead>
                            <tbody>      
                                <?php 
                                    $sel_sql="SELECT DISTINCT net_type FROM complaints";
                                    $run = mysqli_query($conn,$sel_sql);
                                $count = 0;
                                    while($rows = mysqli_fetch_assoc($run)){ 
                                        $count = $count+1;
                                            echo '
                                            <tr class="wow fadeInUp" data-wow-duration="0.5s">   
                                                <td>'.$count.'</td>
                                                <td>'.$rows['net_type'].'</td>
                                            </tr>   
                                            ';
                                    }                                                                
                                    ?>
                            </tbody>
                        </table>
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
            
        