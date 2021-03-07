<?php include './inc/db.php' ?>
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
                    <?php echo $error;?>
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
                        <div class="col-sm-6">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                                <h1 class="h2">Markers Guide</h1>
                            </div>
                            <!-- Guide Start -->
                            <table class="table table-hover table-sm">
                                <thead class="thead-light">
                                    <th>Icon</th>
                                    <th>Color</th>
                                    <th>Network Type</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><img src="./img/loc/sharp-green.png" style="width:30px;height:30px;padding:5px;" /></td>
                                        <td> Sharp Green </td>
                                        <td> LTE </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./img/loc/dark-blue.png" style="width:30px;height:30px;padding:5px;" /></td>
                                        <td> Dark Blue </td>
                                        <td> 3G (Including: CDMA, HSUPA, UMTS) </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./img/loc/light-blue.png" style="width:30px;height:30px;padding:5px;" /></td>
                                        <td> Light Blue </td>
                                        <td> 4G (Including: HSDPA, HSPA) </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./img/loc/red.png" style="width:30px;height:30px;padding:5px;" /></td>
                                        <td> Red </td>
                                        <td> EDGE (2.75G) </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./img/loc/orange.png" style="width:30px;height:30px;padding:5px;" /></td>
                                        <td> Orange </td>
                                        <td> EVDO (Including: EVDO_0, EVDO_A, EVDO_B)  </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./img/loc/yellow.png" style="width:30px;height:30px;padding:5px;" /></td>
                                        <td> Yellow </td>
                                        <td> GPRS (2.5G) </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./img/loc/green.png" style="width:30px;height:30px;padding:5px;" /></td>
                                        <td> Green </td>
                                        <td> EHRPD </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./img/loc/purple.png" style="width:30px;height:30px;padding:5px;" /></td>
                                        <td> Purple </td>
                                        <td> IDEN </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./img/loc/white.png" style="width:30px;height:30px;padding:5px;" /></td>
                                        <td> White </td>
                                        <td> Unknown Network </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Guide End -->
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
            
        