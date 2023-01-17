<?php
include 'masterdb.php';

$individual_id=$_GET['id'];
$sqlSelect ="SELECT menu_image FROM qr WHERE id='$individual_id'";
$res =$conn->query($sqlSelect);
if(mysqli_num_rows($res) > 0){
foreach($res as $row){
    $menu_image = $row['menu_image'];
    unlink("uploadmenuimage/" .$menu_image);
}
}
// ECHO $individual_id ;
$sqlDelete ="DELETE FROM qr WHERE id='$individual_id'";
$result =$conn->query($sqlDelete);

if($result){
    
    // echo 'deleted successfully';
    header("Location: /qr/qr_generate/dashboard.php?msg=Delete Successful");
    
}else{
    // echo 'Error in deletion';
    header("Location: /qr/qr_generate/dashboard.php?msg=Delete Failed");
}




?>