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
<?php $latitude=''; $longitude=''; ?>
 <?php 
    $show_error= false;
    if (isset($_GET['del_id'])){
        
        $del_sql = "DELETE FROM complaints WHERE complaints.id='$_GET[del_id]'";
        if(mysqli_query($conn,$del_sql)){
            header('Location: view_reportsOnMap.php');
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
                <div class="col-md-10">
                    <?php if($show_error== true) {echo $error;}?>
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2 wow fadeInLeft" data-wow-duration="0.5s">Reports on map</h1>
                        <a href="view_reportsOnMap.php" class="wow fadeInRight" data-wow-duration="0.5s"><button type="button" class="btn btn-info"  aria-pressed="false"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button></a>
                    </div>
                    <div class="row">
                        <!-- map start -->
                        <div class="col-lg-10">  
                            <div class="map wow fadeInUp" id="map" data-wow-duration="0.5s"></div>
                            <div id="popup" class="ol-popup">
                                 <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                                 <div id="popup-content"></div>
                            </div>  
                        </div>
                        <!-- map end-->
                        <!-- marker guide start-->
                        <div class="col-lg-2 wow fadeInRight" data-wow-duration="0.5s">  
                            <ul class="guide-ul">
                                <h6>Marker Guide</h6>
                                <li class="guide-li">
                                    <div class="guid-li-div">
                                        <img src="./img/loc/sharp-green.png" class="guide-markers" />
                                        <span class="guide-span">LTE</span>
                                    </div>
                                </li>
                                <li class="guide-li">
                                    <div class="guid-li-div">
                                        <img src="./img/loc/dark-blue.png" class="guide-markers"  />
                                        <span class="guide-span">3G <span style="font-size:0.7em;color:gray;">(CDMA, HSUPA, UMTS)</span></span>
                                    </div>
                                </li>
                                <li class="guide-li">
                                    <div class="guid-li-div">
                                        <img src="./img/loc/light-blue.png" class="guide-markers" />
                                        <span class="guide-span">4G <span style="font-size:0.7em;color:gray;">(HSDPA, HSPA)</span></span>
                                    </div>
                                </li>
                                <li class="guide-li">
                                    <div class="guid-li-div">
                                        <img src="./img/loc/red.png" class="guide-markers" />
                                        <span class="guide-span">EDGE <span style="font-size:0.7em;color:gray;">(2.75G)</span></span>
                                    </div>
                                </li>
                                <li class="guide-li">
                                    <div class="guid-li-div">
                                        <img src="./img/loc/orange.png" class="guide-markers" />
                                        <span class="guide-span">EVDO <span style="font-size:0.7em;color:gray;">(EVDO_0, EVDO_A, EVDO_B)</span></span>
                                    </div>
                                </li>
                                <li class="guide-li">
                                    <div class="guid-li-div">
                                        <img src="./img/loc/yellow.png" class="guide-markers" />
                                        <span class="guide-span">GPRS <span style="font-size:0.7em;color:gray;">(2.5G)</span></span>
                                    </div>
                                </li>
                                <li class="guide-li">
                                    <div class="guid-li-div">
                                        <img src="./img/loc/green.png" class="guide-markers" />
                                        <span class="guide-span">EHRPD</span>
                                    </div>
                                </li>
                                <li class="guide-li">
                                    <div class="guid-li-div">
                                        <img src="./img/loc/purple.png" class="guide-markers" />
                                        <span class="guide-span">IDEN</span>
                                    </div>
                                </li>
                                <li class="guide-li">
                                    <div class="guid-li-div">
                                        <img src="./img/loc/white.png" class="guide-markers" />
                                        <span class="guide-span">Unknown Network</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!--marker guide end-->
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
                                    <p>You are about to delete one complaint and all of it's details, this procedure is irreversible.</p>
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
                    
                    
                    <div class="row"> 
                        <!-- Marker Detail cards start -->
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                                <h6 class="wow fadeInUp">Marker Datails <span  class="fa fa-question-circle"  data-toggle="tooltip" title="Click on any marker on the map to see the details."></span></h6>
                            </div>
                            <div class="row" id="markerDetails">
                                 <div class="col-lg-4">
                                    <div class="card wow fadeInUp" > 
                                      <div class="card-body">
                                        <p class="card-text c_info" data-toggle="tooltip" title="Complaint ID"><span class="fa fa-tag"></span> <span id="com_id" >Id</span></p>
                                        <p class="card-text c_info" data-toggle="tooltip" title="Network Type"><span class="fa fa-signal"></span> <span id="com_net" >Network type</span></p>
                                        <p class="card-text c_info" data-toggle="tooltip" title="Address"><span class="fa fa-map-marker"></span> <span id="com_loc">Address</span></p>
                                        <p class="card-text c_info" data-toggle="tooltip" title="Signal Strength"><span class="fa fa-flash"></span> <span id="com_str">Strength</span></p>
                                        <p class="card-text c_info" data-toggle="tooltip" title="Status"><span class="fa fa-bookmark"></span> <span id="com_status">Status</span></p>
                                      </div> 
                                      <ul class="list-group list-group-flush" id="edit_btn">
                                        
                                      </ul>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card wow fadeInUp" >   
                                      <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><span class="font-weight-bold">Title </span><p id="com_title"></p></li>
                                          <li class="list-group-item"><span class="font-weight-bold"> Content </span><p id="com_content"></p></li>     
                                      </ul>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <!-- Marker Detail cards end -->
                    </div>
                    
                    
                 </div>
                 <!-- Main content end -->
             </div>
              <!-- footer -->
            <?php include './inc/footer.php' ?>
        </div>

    <?php include './inc/scripts.php' ?>
    
    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
    <?php include 'getComDetails.php' ?>
    </body>
    
</html>
            
        