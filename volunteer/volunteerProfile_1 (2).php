<?php
  require ("../sql_connect.php");
  include ('nameTitle.php');
  
	$id = $_GET['id'];
  $query = "SELECT * FROM user where user_id = $id";
  $data = mysqli_query($sql, $query);
  if (!$data)
  {
    echo "error";
  }
  
		$row = mysqli_fetch_array($data);
		$volunteer_img = $row['user_prof_pic'];
		$img_src = "../admin/userProfPic/".$volunteer_img;

	  $vol = "SELECT * FROM volunteer_details WHERE user_id = $id";
	  $data2 = mysqli_query($sql, $vol);
	  $num_rows = mysqli_num_rows($data2);
  
  if (!$data2){
    echo "error";
  }else{

  $row2 = mysqli_fetch_array($data2);

  $disp_ad_query = "SELECT advocacies FROM user WHERE user_id = ".$id."";
  $advoc = mysqli_query($sql, $disp_ad_query);
    if (!$disp_ad_query){
      echo "Error in Query!";
      exit(); 
    }
  }

?>

  <!DOCTYPE html>
  <html class="no-js">
  <title>Your Profile</title>

<?php
include ('css.php');
?>
      <body>
        

          <div class="page-head">
            <div class="col-sm-3 col-sm-offset-1">
              <p>
                <p>
                <div class="picture-container">
                    <div class="picture">
                    <!--<input type="file" id="wizard-picture">-->
                      <img src="<?php echo $img_src; ?>" >
                        <div class="col-md-1" >
                        </b>
                    </div>
                  </div>
                </div>
              </div>
            </p>
            
            <div class="tab-content">
            <div class="row p-b-15">
            <div class="col-sm-4 col-sm-offset-1">
          <span><?php echo $row['first_name']." ".$row['last_name']; ?></span><br>
          <span><?php echo $row['user_location']; ?></span><br>
          <span><?php echo $row2['volunteer_birthday']; ?> </span><br>
          <span><?php echo $row2['volunteer_occupation']; ?></span><br>
          <span><?php echo $row2['volunteer_schedule']; ?></span><br>
          <span><?php echo $row2['volunteer_about_me']; ?></span><br>
          <span><?php echo $row2['volunteer_hobbies']; ?></span><br>
          <a href='editProfile.php?vol_id=<?php echo $row['user_id'];?>'>Edit</a>
          </div>
           </div>
           </div>
             
      <div class="row">
      </div>
          <div class="content-area recent-property padding-top-40" style="background-color: #FFF;">
              <div class="container">

                  <div class="col-md-9">

                      <div class="" id="contact1">
                          <div class="row">
                              <div class="col-md-6">
                                  <h2> No Activities Yet. </h2>
                                  </p>
                              </div>
                              <!-- /.col-sm-4 -->
                              <div class="col-sm-5">
                                  <h3> No Recent Activities Yet </h3>
                          </div>
                          </form>
                      </div>
                  </div>
                  </form>
                  </div>
                  </div>
                  <!-- /.col-md-9 -->

                  <div class="col-md-3">
                      <div class="blog-asside-center">
                          <div class="panel panel-default sidebar-menu wow fadeInRight animated">
                              <div class="panel-heading">
                                  <h3 class="panel-title">Organizations</h3>
                              </div>
                              <h5>No Organizations Yet </h5>
                              <a href="#">Join Organization</a>

      <!--***<div class="row">
    </div>
          <div class="content-area recent-property padding-top-40" style="background-color: #FFF;">
              <div class="container">

                  <div class="col-md-9">

                      <div class="" id="contact1">
                          <div class="row">
                              <div class="col-md-6">
                                  <h2> UPCOMING ACTIVITIES </h2>
                                  <img src="red.png" alt="Red Cross" width="250" height="250">
                                  <p><h3>Res Cross Medical Mission </h3> </p>
                                      <strong>READ MORE</strong>
                                  </p>
                              </div>
                              <div class="col-sm-5">
                                  <h2></i> RECENT ACTIVITIES </h2>
                                  <img src="feeding.png" alt="feeding" width="170" height="170">
                                  <p><strong>Feeding Program</strong></p>
                                  <p> Location: Brgy. Kasambagan </p>
                                  <p> Date: June 29, 2017 </p>

                                  <img src="treePlanting.png" alt="tree planting" width="170" height="170">
                                  <p><strong> Tree Planting </strong> </p>
                                  <p> Location: Brgy. Talamban </p>
                                  <p> Date: April 15, 2017 </p>
                                  </p>
                              </div>
                          </div>
                          </form>
                      </div>
                  </div>

                  <div class="col-md-3">
                      <div class="blog-asside-center">
                          <div class="panel panel-default sidebar-menu wow fadeInRight animated">
                              <div class="panel-heading">
                                  <h3 class="panel-title">Organizations</h3>
                              </div>
                              <div class="panel-body recent-property-widget">
                                  <ul>
                                      <li>
                                          <div class="col-md-3 blg-thumb p0">
                                              <img src="red.png">
                                          </div>
                                          <div class="col-md-8 blg-entry">
                                              <h6> <a href="OrgProfileHERE.html">Red Cross </a></h6>
                                              <span class="property-price">Cebu City</span>
                                          </div>
                                      </li>
                                      <li>
                                          <div class="col-md-3 blg-thumb p0">
                                              <img src="feeding.png">
                                          </div>
                                          <div class="col-md-8 blg-entry">
                                              <h6> <a href="OrgProfileHERE.html">Feeding Org </a></h6>
                                              <span class="property-price">Cebu City</span>
                                          </div>
                                      </li>
                          </div>
                      </div>
                  </div>
              </div>
          </div>-->



         <?php
         include ('footer2.php');
         ?>

      </body>
  </html>
