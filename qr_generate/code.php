<?php
include 'masterdb.php';
/// Using Php qr code Library
include "phpqrcode/qrlib.php";
session_start();

$oname = $cname = $phone = $email = $website = $qrimage = $menuimage = null;
$flag = true;

              if($_SERVER['REQUEST_METHOD'] ==='POST'){
                  if(empty($_POST['oname'])){
                    //   $oname_err = 'Please enter owner name';
                      $flag = false;
                  }else{
                      $oname = test_input($_POST['oname']);
                  }
                  
                  if(empty($_POST['cname'])){
                    //   $oname_err = 'Please enter owner name';
                      $flag = false;
                  }else{
                      $cname = test_input($_POST['cname']);
                  }
                  
                  if(empty($_POST['phone'])){
                    //   $oname_err = 'Please enter owner name';
                      $flag = false;
                  }else{
                      $phone = test_input($_POST['phone']);
                  }
                  
                  if(empty($_POST['email'])){
                    //   $oname_err = 'Please enter owner name';
                      $flag = false;
                  }else{
                      $email = test_input($_POST['email']);
                  } 
                  
                  if(empty($_POST['website'])){
                    //   $oname_err = 'Please enter owner name';
                      $flag = false;
                  }else{
                      $website = test_input($_POST['website']);
                  }
                   
                   
                //   if(empty($_FILES["menuimage"]["name"])){
                //     //   $oname_err = 'Please enter owner name';
                //       $flag = false;
                //   }else{
                //       $menuimage = test_input($_FILES["menuimage"]["name"]);
                //   }
                
                       
                  
            }

function test_input($data){
    $data = trim($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    
    return $data;
    
}
/*
echo '<pre>';
var_dump($_POST); /// it show all values in array form, also use to check POST data coming form action part
echo '</pre>';
*/
if(isset($_POST['subbtn'])){

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
        header("Refresh:3, url='/qr/qr_generate'");
        }

        if (empty($errors) == true && $flag && $_SERVER['REQUEST_METHOD'] ==='POST') {
            
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
         
$sqlInsert =  "INSERT INTO qr (owner_name, company_name, phone, email, website, qr_image, menu_image ) VALUES ('$oname', '$cname', '$phone', '$email', '$website','$qr_img', '$image_name')";
$result = $conn->query($sqlInsert);

        if ($result) {
                echo "Success";
                $_SESSION['status'] = 'Image stored Successfully';
                // header("Refresh:0, url='/qr/qr_generate?msg=QR Code Generation Successful&qr_img=$qr_img'");
                 header("Location: /qr/qr_generate?msg=QR Code Generation Successful&qr_img=$qr_img");
                      } else {
                echo "Error in file uploading";
                             }
        } else {
            print_r($errors);
               }
        
        } else {
        echo "Error in file uploading";
               }
}
$conn->close();
?>