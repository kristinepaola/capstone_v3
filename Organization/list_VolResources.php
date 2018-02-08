 <?php  
 $connect = mysqli_connect("localhost", "root", "", "webportal");  
 require("Header_Organization.php");
 $id = $_GET['cid'];

 $query = "SELECT A.resources_name, A.resources_description, A.resources_photo, A.event_id, B.event_name, A.user_id, A.noItems, C.first_name, C.last_name
    FROM volunteer_resources A, event B, user C
    WHERE A.event_id = B.event_id
    AND A.user_id = C.user_id
    AND A.event_id = '$id'
    ";  
 $result = mysqli_query($connect, $query);  
 
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>iHelp |Volunteered Resources </title>  
           <script src="../assets/plugins/dataTables/jquery.min.js"></script>  
           <link rel="stylesheet" href="../assets/plugins/dataTables/bootstrap.min.css" />  
           <script src="../assets/plugins/dataTables/jquery.dataTables.min.js"></script>  
           <script src="../assets/plugins/dataTables/dataTables.bootstrap.min.js"></script> 
           <script src="../assets/plugins/dataTables/bootstrap.min.js"></script>             
           <link rel="stylesheet" href="../assets/plugins/dataTables/dataTables.bootstrap.min.css" />
           <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
           <style>
            .img{
            height: 75px;
            width: 75px;
            text-align: center;

            }
          </style>
      </head> 
      <body >  
        <br/>
           <div class="container">
           <br/>
                <h3><strong>Volunteered Resources</strong></h3>  
                <br/>  
                <div class="table-responsive">
            <table id="list_volResources" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <td width="15%"><center><strong>Image</strong></center></td>
                  <td width="25%"><center><strong>Resources Name</strong></center></td>
                  <td width="30%"><center><strong>Description</strong></center></td>
                  <td width="10%"><center><strong>Quantity</strong></center></td>
                  <td width="20%"><center><strong>Volunteer Name</strong></center></td>
                </tr>
              </thead>
              <?php
                while($row = mysqli_fetch_array($result))
                {
                    $item_img = $row['resources_photo'];
                    $img_src = "../admin/volunteerResourcesImages/".$item_img;

                  echo '
                    <tr>
                        <td><center><img src='.$img_src.' class="img"></center></td>
                        <td><h4><center>'.$row['resources_name'].'</center></h4></td>
                        <td><h5><center>'.$row['resources_description'].'</center></h5></td>
                        <td><h5><center>'.$row['noItems'].'</center></h5></td>
                        <td><h5><center><a href="../volunteer/publicvolunteerProfile_1.php?id='.$row['user_id'].'">'.$row['first_name'].''.$row['last_name'].'</center></h5></td>
                     </tr>
                     ';
                }
              ?>
            </table>
           </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
    $('#list_volResources').DataTable();  
 });  
 </script>  