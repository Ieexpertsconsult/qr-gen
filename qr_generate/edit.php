<?php
require_once 'masterdb.php';
$msg = $_GET['msg'];
$id =$_GET['id'];
?>
           
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>QR_Generator System</title>
    <style> 
          h2{
            text-align:center;
            margin-top:10px;
            background-color: #774BF6;
            border-radius: 8px;
            COLOR:white;
            
          }
  </style>
  </head>
  <body>
  <div class="container"> <h2 >Edit - Files</h2></div>
  <div class="container"> 
 <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Hey..!!</strong><?php echo $_GET['msg']; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
 </div>
 <?php
 //  echo $id;
 $sqlSelect = "SELECT * FROM qr WHERE id='$id'";
 $result = $conn->query($sqlSelect);
 
 if(mysqli_num_rows($result) > 0){
    
    foreach($result as $row){
        // echo $row['company_name'];
      ?> 
      
 <div class="container">
  <form action="edit2.php" autocomplete="off" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="individual_id" value="<?php echo $row['id'];?>">
      
  <div class="form-group">
    <label for="exampleInputEmail1">Owner Name</label>
    <input class="form-control form-control-lg" type="text" name ="oname" value="<?php echo $row['owner_name'];?>" required>
    <!--<small id="emailHelp" class="form-text text-muted">We'll never share your data with anyone else.</small>-->
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Company Name</label>
    <input class="form-control form-control-lg" type="text"  name ="cname" value="<?php echo $row['company_name'];?>" required>
    <!--<small id="emailHelp" class="form-text text-muted">We'll never share your data with anyone else.</small>-->
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Phone Number</label>
    <input type="tel" id="typePhone" class="form-control form-control-lg" name ="phone" value="<?php echo $row['phone'];?>" required>
    <!--<small id="emailHelp" class="form-text text-muted">We'll never share your data with anyone else.</small>-->
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1"  name ="email" aria-describedby="emailHelp" value="<?php echo $row['email'];?>" required>
    <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Website</label>
    <input class="form-control form-control-lg" type="text"  name ="website" value="<?php echo $row['website'];?>" required>
    <!--<small id="emailHelp" class="form-text text-muted">We'll never share your data with anyone else.</small>-->
  </div>
  <div class="form-group">
    <label for="exampleFormControlFile1"><em>Company Menu Image</em></label>
    <input type="file" class="form-control-file"  name ="menuimage"  id="exampleFormControlFile1" required>
    <input type="hidden" name="menuimage_old" value="<?php echo $row['menu_image'];?>" >
    
    <span style="color:red;"><em>Note: Image Size should be less than or 90kb</em></span>
  </div>
  <button type="submit"  name ="updatebtn" class="btn btn-primary">Update Company Data</button>
</form>
</div>
 <div class="container mt-2"><a href="dashboard.php" class="btn btn-success">Dashboard</a></div>
        
<?php       
    } 
 }
$conn->close();
?>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>