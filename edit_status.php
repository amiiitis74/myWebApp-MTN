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
    
   <?php 
    $show_error= false;
    if (isset($_GET['edit_id'])){
        if(isset($_POST['submit_change'])){  
            $ins_sql = "UPDATE complaints SET status='$_POST[status]' WHERE complaints.id='$_GET[edit_id]'";
            if(mysqli_query($conn,$ins_sql)){
                header('Location: view_allReports.php');
            }else{
                $error = '<div class="alert alert-danger alert-dismissible fade show">The query was not working.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>';
                $show_error= true;
            }

        }        
    }
    ?>
    
        <!-- Sidebar start -->
        <div class="container-fluid">
            <div class="row" >
              <?php include './inc/sidebar.php' ?>  
                <!-- Main content start --> 
                <div class="col-sm-10">
                    <?php if($show_error== true) {echo $error;}?>
                    
 
                    <?php 
                        $sel_sql="SELECT *,complaints.id AS cid , users.tel_number AS ut 
                        FROM complaints , users WHERE complaints.user_id = users.id AND complaints.id ='$_GET[edit_id]' ORDER BY cid";
                        $run = mysqli_query($conn,$sel_sql);
                        while($rows = mysqli_fetch_assoc($run)){ ?>
              
 
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Complaint Details</h1>
                    </div> 
                    
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card" > 
                              <div class="card-body">
                                <h5 class="card-title">Complaint id:</h5>
                                <p class="card-text"><?php echo $rows['id'];?></p>
                                <h5 class="card-title">Title:</h5>
                                <p class="card-text"><?php echo $rows['title'];?></p>
                                <h5 class="card-title">Content:</h5>
                                <p class="card-text"><?php echo $rows['content'];?></p>
                              </div> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" >   
                              <ul class="list-group list-group-flush">
                                <li class="list-group-item"><p><span class="font-weight-bold">Network Type: </span><?php echo $rows['net_type'];?></p></li>
                                  <li class="list-group-item"><p><span class="font-weight-bold"> Location (lat,lon) : </span><?php echo $rows['latitude'].' , '.$rows['latitude'];?></p></li>
                                  <li class="list-group-item"><p><span class="font-weight-bold"> Signal Strength: </span><?php echo $rows['signal_str'];?> dbm</p></li>
                              </ul>
                              <div class="card-body">
                                <p><span class="font-weight-bold">Current Status: </span><?php echo $rows['status'];?></p>
                                <form action="edit_status.php?edit_id=<?php echo $_GET['edit_id']; ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <select class="form-control" id="status" name="status">
                                          <option value="Pending" <?php if(isset($_GET['edit_id'])){if($rows['status']=='Pending'){echo 'selected';}}  ?> >Pending</option>
                                          <option value="Under Investigation" <?php if(isset($_GET['edit_id'])){if($rows['status']=='Under Investigation'){echo 'selected';}} ?>>Under Investigation</option>
                                          <option value="Checked" <?php if(isset($_GET['edit_id'])){if($rows['status']=='Checked'){echo 'selected';}}  ?> >Checked</option>
                                        </select>   
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Save" name="submit_change" class="btn btn-danger">
                                    </div>
                                </form> 
                              </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php } ?>
                    
          
                    
                </div>
                <!-- Main content end --> 
            </div>
        </div>
    <?php include './inc/footer.php' ?>
    </body>
</html>
            
        