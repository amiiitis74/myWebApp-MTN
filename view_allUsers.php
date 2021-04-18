<?php include './inc/db.php' ;
    session_start();
    if(isset($_SESSION['email']) && isset($_SESSION['pass'])){
        $admin_sql="SELECT * FROM signaltracker.admin WHERE signaltracker.admin.email='$_SESSION[email]' AND signaltracker.admin.password='$_SESSION[pass]'";
        if($admin_run = mysqli_query($conn,$admin_sql)){
            if(mysqli_num_rows($admin_run)==1){

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
    if (isset($_GET['del_id'])){
        
        $del_sql = "DELETE FROM users WHERE id='$_GET[del_id]'";
        if(mysqli_query($conn,$del_sql)){
            header('Location: view_allUsers.php');
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
                <div class="col-lg-10">
                    <?php if($show_error== true) {echo $error;}?>
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2 wow fadeInLeft" data-wow-duration="0.5s">All Users</h1>
                        <a href="view_allUsers.php" class="wow fadeInRight" data-wow-duration="0.5s"><button type="button" class="btn btn-info"  aria-pressed="false"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button></a>
                    </div>
                    
                    <!--Modal start-->
                    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>

                                <div class="modal-body">
                                    <p>You are about to delete one user and all of it's details, this procedure is irreversible.</p>
                                    <p>Do you want to proceed?</p>
                                    <!--<p class="debug-url"></p>-->
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <a class="btn btn-danger btn-ok">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--modal end-->
                    
                    <!-- user table start -->
                    <div id="pageNavPosition" class="pager-nav wow fadeInUp" data-wow-duration="1s"></div>
                    <div class="table-responsive">
                        <table class="table table-light table-hover table-striped" id="pager">
                            <thead class="bg-info" style="color:white;">
                                <tr>
                                    <th>No.</th>
                                    <th>Phone Number</th>
                                    <th>Number of Complaints</th>
                                    <th>Delete User</th>
                                </tr>
                            </thead>
                            <tbody>      
                                <?php 
                                    $sel_sql="SELECT * FROM users ORDER BY users.id DESC";
                                    $run = mysqli_query($conn,$sel_sql);
                                    while($rows = mysqli_fetch_assoc($run)){  
                                        $count_q="SELECT count(*) FROM complaints AS c WHERE c.user_id = '$rows[id]'";
                                        $run_count_q=mysqli_query($conn,$count_q);
                                        $number_rows=mysqli_fetch_array($run_count_q);
                                            echo '
                                            <tr class="wow fadeInUp" data-wow-duration="0.5s">   
                                                <td>'.$rows['id'].'</td>
                                                <td>'.$rows['tel_number'].'</td>
                                                <td>'.$number_rows[0].'</td>
                                                <td><a href="#" data-href="view_allUsers.php?del_id='.$rows['id'].'" class="btn btn-danger smallBtn" data-toggle="modal" data-target="#confirm-delete" >Delete</a></td>
                                            </tr>   
                                            ';
                                    }                                                                
                                    ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- user table end-->   
                </div>
                <!-- Main content end --> 
            </div>
            
        </div>
    
    <?php include './inc/scripts.php' ?>
    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
    </body>
</html>
            
        