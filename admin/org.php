 <?php  
 include("../sql_connect.php");

 $query = "SELECT A.user_id, A.user_status, A.timestamp, B.organization_name, B.organization_mission, B.organization_vision, B.organization_date_established, B.organization_status, B.organization_certificate
                      FROM user A, organization_details B
                      WHERE A.user_id = B.user_id AND A.user_type = 'organization' AND B.organization_status = 'Pending' ORDER BY user_id DESC"; 

 $result = mysqli_query($sql, $query);  
 ?>
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>iHelp | New Organization</title>  
           <script src="plugins/dataTables/jquery.min.js"></script>  
           <link rel="stylesheet" href="plugins/dataTables/bootstrap.min.css" />  
           <script src="plugins/dataTables/jquery.dataTables.min.js"></script>  
           <script src="plugins/dataTables/dataTables.bootstrap.min.js"></script> 
           <script src="plugins/dataTables/bootstrap.min.js"></script>             
           <link rel="stylesheet" href="plugins/dataTables/dataTables.bootstrap.min.css" />
           <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
          <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
          <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
          <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
          <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
          <link rel="stylesheet" href="bower_components/morris.js/morris.css">
          <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
          <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
          <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
          <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
          <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">    
      </head>  
      <body>  
        <br/>
           <div class="container">
            <div class="pull-right"><a href="admin_dashboard.php" class="btn btn-info">
              <span class="glyphicon glyphicon-home"></span> Back to Home
            </a> </div>
           <br/>
                <h3>iHelp | Organization</h3>  
                <br/>  
                <div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td width ="10% px"><strong><center>Organization Name</center></strong></td>
                                    <td width ="15% px"><strong><center>Organization Mission</center></strong></td>
                                    <td width ="15% px"><strong><center>Organization Vision</center></strong></td>
                                    <td width ="10% px"><strong><center>Date Established</center></strong></td>
                                    <td width ="10% px"><strong><center>Status</center></strong></td>
                                    <td width ="15% px"><strong><center>Date Registered</center></strong></td>
                                    <td width ="10% px"><strong><center>Certificate</center></strong></td>
                                    <td width ="20% px"><strong><center>Action</center></strong></td>      
                               </tr>  
                          </thead>  
                          <?php   
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>
                                    <td>'.$row["organization_name"].'</td>
                                    <td>'.$row["organization_mission"].'</td>
                                    <td>'.$row["organization_vision"].'</td>
                                    <td><center>'.date("M d, Y h:i A", strtotime($row["organization_date_established"])).'</center></td>
                                    <td>'.$row["organization_status"].'</td>
                                    <td><center>'.date("M d, Y h:i A", strtotime($row["timestamp"])).'</center></td>
                                    <td><a target="_blank" href="orgCert/'?><?php echo $row["organization_certificate"]?><?php echo '" target="_blank"> View Certificate</a></td>
                                    <td><button class="btn btn-primary Approve upd'.$row["user_id"].'" data-target='.$row["user_id"].' 
                                      id="user'.$row["user_id"].'">Approve</button>
                                      <button class="btn btn-danger Reject upd'.$row["user_id"].'" data-target='.$row["user_id"].' 
                                      id="user'.$row["user_id"].'">Reject</button> 
                                </tr> 
                               ';  
                          }  
                          ?>  
                     </table> 
                     <div id="certificatemodal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                    <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title" id="org_img"></h4>
                           <img src="'.$img_src.'" class="">
                        </div>
                        <div class="modal-body">
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      </div>
                  </div>  
                </div>
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable(); 

      $( ".Approve" ).click(function() {
          user_id = $(this).data("target");
          $.ajax({
                  url: "Model/updateStatusOrgApprove.php",
                  method: "POST",
                  data: {
                    id:user_id }
                  }).done(function(x) {
                    console.log(x);
          });
      }); 
       $( ".Reject" ).click(function() {
          user_id = $(this).data("target");
          $.ajax({
                  url: "Model/updateStatusOrgReject.php",
                  method: "POST",
                  data: {
                    id:user_id }
                  }).done(function(x) {
                    console.log(x);
          });
      }); 

    // $(".certificate").click(function(){
    //   var user_id = $(this).data("target");
    //   $.ajax({
    //       url: "Model/view_cert.php",
    //       method: "GET",
    //       data: {
    //          id:user_id }
    //       }).done(function(x) {
    //          console.log(x);
    //       });
    //   // fetchData(user_id);
    // });
 });  
//   function fetchData (user_id){
//     var x = $.ajax({
//       url:"view_cert.php",
//       method: "GET",
//       data:{
//         cid:user_id
//       },
//       dataType: "json",
//       success:function(retval){
//         $("#org_img").html("");
//         org_img = "../admin/orgCert/"+retval[0].org_img;
//         $("#org_img").attr("src", org_img);
//         $("#certificatemodal").modal("show");
//       }
//     });
//     console.log(x);
// }
 </script>  