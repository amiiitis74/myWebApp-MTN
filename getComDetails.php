<?php
    
    echo '<script type="text/javascript">  var places = [';


    $result = mysqli_query($conn,"SELECT * FROM complaints");
        while ($row = mysqli_fetch_assoc($result)) { 
            if(strpos($row['net_type'], "LTE") !== false){
                $src = "'./img/loc/sharp-green.png'";
            }else if(strpos($row['net_type'],"3G") !== false ){
            $src = "'./img/loc/dark-blue.png'";
            }else if( strpos($row['net_type'],"4G") !== false ){
                $src = "'./img/loc/light-blue.png'";
            }else if( strpos($row['net_type'],"EDGE") !== false ){
                $src = "'./img/loc/red.png'";
            }else if( strpos($row['net_type'],"EVDO") !== false ){
                $src = "'./img/loc/orange.png'";
            }else if( strpos($row['net_type'],"GPRS") !== false ){
                $src = "'./img/loc/yellow.png'";
            }else if( strpos($row['net_type'],"EHRPD") !== false ){
                $src = "'./img/loc/green.png'";
            }else if( strpos($row['net_type'],"IDEN") !== false ){
                $src = "'./img/loc/purple.png'";
            }else if( strpos($row['net_type'],"UNKNOWN") !== false ){
                $src = "'./img/loc/white.png'";
            }
            echo "
            [".$row['longitude'].",".$row['latitude'].",".$src.",'".$row['net_type']."','".$row['title']."','".$row['content']."','".$row['id']."','".$row['status']."','".$row['signal_str']."' ],
            ";
        }       
  
    echo ']; ';
    include './showMarkersInJs.js';
?>

    
                                         
</script>
