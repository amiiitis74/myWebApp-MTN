<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $tel_number= "9999988";
    $title = $_POST['title'];
    $content = $_POST['content'];
    $signal_str = $_POST['signal_str'];
    $net_type = $_POST['net_type'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longiude'];
    $user_id='';
    
    require_once 'db.php';

        //insert user phone number
        $insert_user="INSERT IGNORE INTO signaltracker.users (tel_number) VALUES ('$tel_number')";
        if($run_insert_user=mysqli_query($conn,$insert_user)){ 
            $sel_user_id = "SELECT * FROM users WHERE tel_number = '$tel_number'";
            if($run_sel_id=mysqli_query($conn,$sel_user_id)){
                while($r=mysqli_fetch_assoc($run_sel_id)){
                    $user_id=$r['id'];
                }
            }

            //insert complaint
            $insert_com="INSERT IGNORE INTO signaltracker.complaints (title, content, net_type, signal_str, latitude, longitude,user_id) VALUES ('$title','$content','$net_type','$signal_str','$latitude','$longitude','$user_id')";
            if($run_insert_com=mysqli_query($conn,$insert_com)){
                $result["success"] = "1";
                $result["message"] = "success";
                echo json_encode($result);
            }else{
                $result["success"] = "0";
                $result["message"] = "failed";
                echo json_encode($result);
            }
        }else{
            $result["success"] = "0";
            $result["message"] = "failed";
            echo json_encode($result);
        }


mysqli_close($conn); 
       
}


?>



<!--
    $result["success"] = "0";
    $result["message"] = "failed";
    echo json_encode($result);
-->