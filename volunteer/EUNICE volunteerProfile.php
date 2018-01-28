<?php
  require ("../sql_connect.php");
  include ('nameTitle.php');
  

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
<body>
<div class="content-area recent-property" style="background-color: #FFF;">
  <div class="container"> 
    <div class="row">
      <div class="section"> 
        <div id="list-type" class="proerty-th-list">
         <div class="col-md-4 p0">
         <div class="box-two proerty-item">
        <div class="item-thumb">
        <?php
        $name = $row['user_prof_pic'];
        $img_src = "admin/userProfPic/" .$name; ?>

        <img src="<?php echo $img_src?>" height="100" width="100">
        </div>
        <div class="item-entry overflow">
            <h3><a href=""><?php echo $row['first_name']." ".$row['last_name']; ?> </a></h3>
            <div class="dot-hr"></div>
              <div class="col-sm-4">
                <span class="pull-left"><b> Location:</b> <?php echo $row['user_location']; ?></span><br>
                <span class="pull-left"><b> Birthday:</b> <?php echo $row2['volunteer_birthday']; ?></span><br>
                <span class="pull-left"><b> Occupation:</b> <?php echo $row2['volunteer_occupation']; ?></span><br>
                <span class="pull-left"><b> Schedule:</b> <?php echo $row2['volunteer_schedule']; ?></span><br>
                <a href='editProfile.php?vol_id=<?php echo $row['user_id'];?>'>Edit</a>
              </div>
                <span class="proerty-price pull-right"> Advocacies </span>
                <form>
                <span class="pull-left"><b> About Me:</b> <?php echo $row2['volunteer_about_me']; ?></span><br></form>
                <span class="pull-left"><b> Hobbies:</b> <?php echo $row2['volunteer_hobbies']; ?></span><br>
        </div>
        </div>
      </div>              
    </div>
    </div>
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
            <h2> UPCOMING ACTIVITIES </h2>
            <img src="uploads/red.png" alt="Red Cross" width="250" height="250">
            <p><h3>Res Cross Medical Mission </h3> </p>
            <strong>READ MORE</strong>
            </p>
          </div>
            <div class="col-sm-5">
            <h2></i> RECENT ACTIVITIES </h2>
            <img src="uploads/feeding.png" alt="feeding" width="170" height="170">
            <p><strong>Feeding Program</strong></p>
            <p> Location: Brgy. Kasambagan </p>
            <p> Date: June 29, 2017 </p>
            <img src="uploads/treePlanting.png" alt="tree planting" width="170" height="170">
            <p><strong> Tree Planting </strong> </p>
            <p> Location: Brgy. Talamban </p>
            <p> Date: April 15, 2017 </p>
            </p>
          </div>
      </div>
      </form>
      </div>
    </div>

  <div class="col-md-3 pl0 padding-top-40">
   <div class="blog-asside-right pl0">
     <div class="panel panel-default sidebar-menu wow fadeInRight animated" >
      <div class="panel-body search-widget">
        <form action="" class=" form-inline"> 
       <div class="panel panel-default sidebar-menu wow fadeInRight animated">
         <div class="panel-heading">
          <h3 class="panel-title">Followed Organizations</h3>
         </div>
         <div class="panel-body recent-property-widget">
          <ul>
            <li>
             <div class="col-md-3 col-sm-3 col-xs-3 blg-thumb p0">
               <a href="single.html"><img src="assets/img/demo/small-property-2.jpg"></a>
                 <span class="property-seeker">
                   <b class="b-1">A</b>
                   <b class="b-2">S</b>
                 </span>
              </div>
            <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
              <h6> <a href="single.html">Super nice villa </a></h6>
                <span class="property-price">3000000$</span>
            </div>
          </li>
          <li>
            <div class="col-md-3 col-sm-3  col-xs-3 blg-thumb p0">
              <a href="single.html"><img src="assets/img/demo/small-property-1.jpg"></a>
                <span class="property-seeker">
                  <b class="b-1">A</b>
                  <b class="b-2">S</b>
                </span>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
              <h6> <a href="single.html">Super nice villa </a></h6>
                <span class="property-price">3000000$</span>
            </div>
            </li>
            <li>
            <div class="col-md-3 col-sm-3 col-xs-3 blg-thumb p0">
              <a href="single.html"><img src="assets/img/demo/small-property-3.jpg"></a>
                <span class="property-seeker">
                  <b class="b-1">A</b>
                   <b class="b-2">S</b>
                </span>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
              <h6> <a href="single.html">Super nice villa </a></h6>
                <span class="property-price">3000000$</span>
                 </div>
              </li>
              <li>
            <div class="col-md-3 col-sm-3 col-xs-3 blg-thumb p0">
              <a href="single.html"><img src="assets/img/demo/small-property-2.jpg"></a>
                <span class="property-seeker">
                  <b class="b-1">A</b>
                  <b class="b-2">S</b>
                </span>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
             <h6> <a href="single.html">Super nice villa </a></h6>
               <span class="property-price">3000000$</span>
            </div>
            </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>           
</div>

        <script src="assets/js/modernizr-2.6.2.min.js"></script>

        <script src="assets/js/jquery-1.10.2.min.js"></script> 
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-select.min.js"></script>
        <script src="assets/js/bootstrap-hover-dropdown.js"></script>

        <script src="assets/js/easypiechart.min.js"></script>
        <script src="assets/js/jquery.easypiechart.min.js"></script>

        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/wow.js"></script>

        <script src="assets/js/icheck.min.js"></script>
        <script src="assets/js/price-range.js"></script>
        
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
        <script src="assets/js/gmaps.js"></script>        
        <script src="assets/js/gmaps.init.js"></script>

        <script src="assets/js/main.js"></script>

  </body>
</html>
