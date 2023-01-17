<?php
include 'masterdb.php';
require_once 'phpqrcode/qrlib.php';


if(isset($_POST['updatebtn'])){
    
$individual_id = $_POST['individual_id'];
$oname = $_POST['oname'];
$cname = $_POST['cname'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$website = $_POST['website'];
$new_menuimage = $_FILES['menuimage']['name'];
$menuimage_old = $_POST['menuimage_old'];

// if($new_menuimage != ''){
//     $updateImage = $_FILES['menuimage']['name'];
    
// }else{
    
//     $updateImage = $_POST['menuimage_old'];
// }




 $errors = array();
    if (isset($_FILES['menuimage']) && $_FILES['menuimage']['error'] == 0) {

        $image_name = time() . '_' . $_FILES["menuimage"]["name"];
        $file_size = $_FILES['menuimage']['size'];
        $file_tmp = $_FILES['menuimage']['tmp_name'];
        $file_type = $_FILES['menuimage']['type'];
        $file_ext = pathinfo($image_name, PATHINFO_EXTENSION);

        $extensions = array("jpeg", "jpg", "png", "gif");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 90000) {
            $errors[] = 'File size must be excatly 90KB';
        header("Refresh:2, url='/qr/qr_generate/edit.php'");
        }

 if (empty($errors) == true && $_SERVER['REQUEST_METHOD'] ==='POST') {
            
         $PNG_QRC_DIR = 'qrimage/';
         
        if(!file_exists($PNG_QRC_DIR)){
            mkdir($PNG_QRC_DIR);
        }
        $filename = $PNG_QRC_DIR . 'test.png';
        
        if($_SERVER['REQUEST_METHOD'] ==='POST'){
        $codeString =  $_POST['website'] ;                     
          // $codeString .= $_POST['menuimage'] .'\n';
          // $codeString .= $_POST['cname'] ; 
    
        $filename = $PNG_QRC_DIR .'test'. md5($codeString) . '.png'; /*md5 use to  generate random string, so that duplicate wouldn't occur*/
        QRcode::png($codeString,$filename); /* we pass values to phpqrcode library i.e., QRcode and png() fxn so to create file in png format*/
        // $qr_img = '<img src="'. $PNG_QRC_DIR . basename($filename).'"><hr/>';
      $qr_img = basename($filename);

        }
        
    move_uploaded_file($file_tmp, "uploadmenuimage/"  . $image_name);
    if($_FILES['menuimage']['name'] != ''){
    unlink("uploadmenuimage/".$menuimage_old);
    }    

$sqlUpdate = "UPDATE qr SET owner_name='$oname' , company_name='$cname' , phone='$phone' , email='$email' , website='$website' , qr_image='$qr_img' , menu_image='$image_name'  WHERE id='$individual_id'";
 $result = $conn->query($sqlUpdate);

        if ($result) {
                //  echo 'NEW RECORD HAS BEEN CREATED';                
                 header("Location: /qr/qr_generate/edit.php?msg=QR Code Generation Successful&qr_img=$qr_img&&id=$individual_id");
                      } else {
                 echo 'Update failed';
                             }
        } else {
            print_r($errors);
               }
        
        } else {
        echo "Error in Updating file";
               }
 $conn->close();   
}


?>