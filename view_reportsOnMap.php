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
<?php $latitude=''; $longitude=''; ?>


<!DOCTYPE html>
<html lang="en">   
    <?php include './inc/header.php' ?>
    
        <!-- Sidebar start -->

         <div class="container-fluid" >
             <div class="row" >
                <?php include './inc/sidebar.php' ?>
                <!-- Main content start --> 
                <div class="col-md-10">
                    <?php if($show_error== true) {echo $error;}?>
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Reports on map</h1>
                        <a href="view_reportsOnMap.php"><button type="button" class="btn btn-info"  aria-pressed="false"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button></a>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- map start -->
                            <div class="map" id="map"></div>
                            <div id="popup" class="ol-popup">
                                 <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                                 <div id="popup-content"></div>
                            </div>
                            <!-- map end-->
                        </div>
                    </div>   
                    
                    
                    
                    
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                                <h1 class="h2">Guide</h1>
                            </div>
                            <!-- Guide Start -->
                            <table class="table table-hover table-sm">
                                <thead class="thead-light">
                                    <th>Icon</th>
                                    <th>Network Type</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><img src="./img/loc/sharp-green.png" style="width:30px;height:30px;padding:5px;" /></td>
                                        <td> LTE </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./img/loc/dark-blue.png" style="width:30px;height:30px;padding:5px;" /></td>
                                        <td> 3G (Including: CDMA, HSUPA, UMTS) </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./img/loc/light-blue.png" style="width:30px;height:30px;padding:5px;" /></td>
                                        <td> 4G (Including: HSDPA, HSPA) </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./img/loc/red.png" style="width:30px;height:30px;padding:5px;" /></td>
                                        <td> EDGE (2.75G) </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./img/loc/orange.png" style="width:30px;height:30px;padding:5px;" /></td>
                                        <td> EVDO (Including: EVDO_0, EVDO_A, EVDO_B)  </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./img/loc/yellow.png" style="width:30px;height:30px;padding:5px;" /></td>
                                        <td> GPRS (2.5G) </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./img/loc/green.png" style="width:30px;height:30px;padding:5px;" /></td>
                                        <td> EHRPD </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./img/loc/purple.png" style="width:30px;height:30px;padding:5px;" /></td>
                                        <td> IDEN </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./img/loc/white.png" style="width:30px;height:30px;padding:5px;" /></td>
                                        <td> Unknown Network </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Guide End -->
                        </div>
                        <div class="col-sm-9">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                                <h1 class="h2">Marker Datails <span  class="fa fa-question-circle"  data-toggle="tooltip" title="Click on any marker on the map to see the details."></span></h1>
                            </div>
                            <div class="row">
                                 <div class="col-md-4">
                                    <div class="card" > 
                                      <div class="card-body">
                                        <p class="card-text c_info" data-toggle="tooltip" title="Complaint ID"><span class="fa fa-tag"></span> <span id="com_id" >Id</span></p>
                                        <p class="card-text c_info" data-toggle="tooltip" title="Network Type"><span class="fa fa-signal"></span> <span id="com_net" >Network type</span></p>
                                        <p class="card-text c_info" data-toggle="tooltip" title="Latitude,Longitude"><span class="fa fa-map-marker"></span> <span id="com_loc">Location</span></p>
                                        <p class="card-text c_info" data-toggle="tooltip" title="Signal Strength"><span class="fa fa-flash"></span> <span id="com_str">Strength</span></p>
                                        <p class="card-text c_info" data-toggle="tooltip" title="Status"><span class="fa fa-bookmark"></span> <span id="com_status">Status</span></p>
                                      </div> 
                                      <ul class="list-group list-group-flush" id="edit_btn">
                                        
                                      </ul>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card" >   
                                      <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><span class="font-weight-bold">Title </span><p id="com_title"></p></li>
                                          <li class="list-group-item"><span class="font-weight-bold"> Content </span><p id="com_content"></p></li>     
                                      </ul>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    
                    
                 </div>
                 <!-- Main content end -->
             </div>
        </div>
     
    
        
    
    <?php include './inc/footer.php' ?>
    <?php include 'showmarkers.php' ?>
    </body>
    
</html>
            
        