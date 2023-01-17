<?php

$conn = new mysqli('localhost',"qrCode",'','qrCode'); 

if($conn->connection_error){
    die('connection failed :' .$conn->connection_error);
}else{
    // echo 'Database Connection Successful';
}



?>