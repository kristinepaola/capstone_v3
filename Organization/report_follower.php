 <?php  
 $count = 0;
  require('../sql_connect.php');
  require('Header_Organization.php');
  $id = $_SESSION['num'];

  $query = "SELECT A.user_id, B.user_id, D.first_name, D.last_name, B.organization_name, D.user_prof_pic
            FROM volunteer_details A, organization_details B, follow C, user D, user E
            WHERE org_id = '$id'
            AND C.volunteer_id = A.user_id 
            AND C.org_id = B.user_id
            AND D.user_id = A.user_id
            AND E.user_id = B.user_id";


  $data = mysqli_query($sql, $query);
    if (!$data){
      echo "ERROR QUERY IN follow TABLE";
    }

 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Follower | Reports </title>  
          <script src="../assets/plugins/dataTables/jquery.min.js"></script>  
           <link rel="stylesheet" href="../assets/plugins/dataTables/bootstrap.min.css" />  
           <script src="../assets/plugins/dataTables/jquery.dataTables.min.js"></script>  
           <script src="../assets/plugins/dataTables/dataTables.bootstrap.min.js"></script> 
           <script src="../assets/plugins/dataTables/bootstrap.min.js"></script>             
           <link rel="stylesheet" href="../assets/plugins/dataTables/dataTables.bootstrap.min.css" />
           <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      </head>  
      <style>
            .img{
            height: 75px;
            width: 75px;
            text-align: center;

            }
      </style>   
      <body>  
        <br/>
           <div class="container"><a href="view_report.php" class="btn btn-info" background-color: "black">
              <span class="fa fa-mail-reply"></span> Back to View Reports
            </a>
            <div class="pull-right"></div>
           <br/>
              <h3><b>Followers</b>  |   Report <br></h3>  
                <br/>  
              <div class="table-responsive">  
                   <table id="reportEvent" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td width="20%"><center><strong>Image</strong></center></td>
                                    <td width="20%"><center><strong>Follower Name</strong></center></td>
                                    
                               </tr>  
                          </thead>  
                          <?php  
                          while($row = mysqli_fetch_array($data))  
                          {  
                              $item_img = $row['user_prof_pic'];
                              $img_src = "../admin/userProfPic/".$item_img;
                               echo '  
                               <tr>  
                                    <td><center><img src='.$img_src.' class="img"></center></td>
                                    <td><h5><center><a href="../volunteer/publicvolunteerProfile_1.php?id='.$row['user_id'].'">'.$row['first_name'].' '.$row['last_name'].'</center></h5></td>
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
      $('#reportEvent').DataTable();  
 });  
 </script>  