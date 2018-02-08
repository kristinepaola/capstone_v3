
<?php 
  include("../sql_connect.php");
  require("nameTitle.php");
  $id = $_SESSION['num'];
 
 

?>
<!DOCTYPE html>
<html>
  <head>
     <title>Volunteered Resources </title>  
           <script src="../assets/plugins/dataTables/jquery.min.js"></script>  
           <link rel="stylesheet" href="../assets/plugins/dataTables/bootstrap.min.css" />  
           <script src="../assets/plugins/dataTables/jquery.dataTables.min.js"></script>  
           <script src="../assets/plugins/dataTables/dataTables.bootstrap.min.js"></script> 
           <script src="../assets/plugins/dataTables/bootstrap.min.js"></script>             
           <link rel="stylesheet" href="../assets/plugins/dataTables/dataTables.bootstrap.min.css" />
           <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  </head>
  <body>
    <div class="container">
            <div class="pull-right">
            </a> 
        </div>
           <br/>
                 <div class="container"><a href="volunteer_report.php" class="btn btn-info" background-color: "black">
              <span class="fa fa-mail-reply"></span> Back to View Reports
            </a>
            <div class="pull-right"></div>
           <br/>
              <h3><b>Volunteered Resources</b> | Report <br></h3>  
                <br/>  
                <br/>  
                <div class="table-responsive">  
                     <table id="volunteerResou" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    
                                    <td width="20%"><center><strong>Resources Name</strong></center></td>
                                    <td width="20%"><center><strong>Description</strong></center></td>
                                    <td width="20%"><center><strong>(#)Items</strong></center></td>
                                    <td width="20%"><center><strong>Date of Resources Volunteered</strong></center></td> 
                                    <td width="20%"><center><strong>Event Name</strong></center></td>
                                  
                               </tr>  
                          </thead>  
                          <?php
                          
                        ?> 
                     </table>  
              </div>  
            </div>  
          </div>  
  </body>
</html>
<script>
$(document).ready(function(){
    $('#attendedEvent').DataTable();
  }
</script>