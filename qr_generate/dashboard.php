<?php
 include 'masterdb.php';
 $msg=$_GET['msg'];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>QR-dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
   
  </head>
  <body>
    <div class = "container-fluid mt-5">
        <div class="row">
        <div class ="col-md-12">
          <div class="card">
          <div class="card-header bg-info">
                <h3 class="text-white text-center">Company Information<br>
                <small style="color:red"><?php echo $msg;?></small></h3>

          </div>
          <div class="card-body">
<?php
             $sqlSelect = "SELECT * FROM qr";
          $result = $conn-> query($sqlSelect);
             
            ?>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col"> Sno.</th>
                  <th scope="col"> Owner Name</th>
                  <th scope="col"> Company Name</th>
                  <th scope="col"> Phone</th>
                  <th scope="col"> Email</th>
                  <th scope="col"> Website</th>
                  <th scope="col"> QR Image</th>
                  <th scope="col"> Menu Image</th>
                 <th scope="col">Edit</th>   
                 <th scope="col"> Delete</th>   

                </tr>
              </thead>
              <tbody>
             <?php
         
          if(mysqli_num_rows($result) > 0 ){
          
            //  $row = $result -> fetch_assoc();
            $sno = 0;
            foreach($result as $row){
                $sno += 1;
           ?>
               <tr>
                      <!--<td><?php  //echo $row['id'];?></td>-->
                      <td><?php  echo $sno;?></td>

                      <td><?php  echo $row['owner_name'];?></td>
                      <td><?php  echo $row['company_name'];?></td>
                      <td><?php  echo $row['phone'];?></td>
                      <td><?php  echo $row['email'];?></td>
                      <td><?php  echo $row['website'];?></td>
                      <td>
                          <img src="<?php echo "https://hellou.in/qr/qr_generate/qrimage/".$row['qr_image']?>"  alt="qr image" >

                      </td>
                      <td>
                        <img src="<?php echo "https://hellou.in/qr/qr_generate/uploadmenuimage/".$row['menu_image']?>" alt="image" width="100px" />  
                       </td>
                      <td><a href='edit.php?id=<?php echo $row['id'];?>' class="btn btn-success"> Edit</a></td>
                       <td><a href='delete.php?id=<?php echo $row['id']?>' class="btn btn-danger"> Delete</a></td>
               </tr>
               <?php 
          } 
          
          }else
              {
             echo 'No Record is present';
              }
                   ?>
              </tbody>

            </table>
          </div>

          </div>


        </div>


        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
  </body>
</html>