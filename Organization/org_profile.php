 <?php
    require ("../sql_connect.php");
    include ("Header_Organization.php");
    $id = $_SESSION['num'];

    //display Upcoming Events
    $event_query ="SELECT * FROM event WHERE user_id =".$id."";
    $event_data = mysqli_query($sql, $event_query);
      if(!$event_data){
      echo "ERROR IN QUERY";
    }
    $event_row = mysqli_fetch_array($event_data);

    ////Organization's Profile Logo and Details
    $org_profile_query ="SELECT * FROM user WHERE user_id=".$id."";
    $org_profile_data = mysqli_query($sql, $org_profile_query);
      if(!$org_profile_data){
        echo "ERROR IN QUERY";
      }
      $org_row = mysqli_fetch_array($org_profile_data);

      // Display Recent Events
      $recent_query = "SELECT * FROM event WHERE user_id = ".$id." AND status = 'DONE'";
    $recent_data = mysqli_query($sql, $recent_query);
    if (!$recent_data){
      echo "ERROR IN QUERY";
      exit();
    }
    // /display advocacy sa user
    $disp_ad_query = "SELECT advocacies FROM user WHERE user_id = ".$id."";
    $disp_ad_data = mysqli_query($sql, $disp_ad_query);
        if (!$disp_ad_query){
      echo "Error in Query!";
      exit(); 
    }


    //advocacies para sa compare sa ubos    
    $adv_query = "SELECT * FROM advocacies";
    $adv_data = mysqli_query($sql, $adv_query);
    if (!$adv_data){
      echo "ERROR IN QUERY";
    }

    
?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> <?php echo $user_row['organization_name']; ?>  | Property  page</title>
			<style>

			  .banner-color{
				background-color: pink;
			  }
			  .adv{
			  width: 40px;
			  height: 40px;
			  margin: 1px;
			}
			</style>
    </head>
    <body>

        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>
        <!-- Body content -->
        <!-- property area -->
        <div class="content-area single-property" style="background-color: #FFF;">&nbsp;
            <div class="container">   

                <div class="clearfix padding-top-40" >   
                    <div class="col-md-8" style="background-color: rgb(251, 251, 251);">
                        <div class="">

                            <div class="single-property-wrapper">

                                <div class="section">
                                    <h4 class="s-property-title">Mission</h4>
                                    <div class="s-property-content">
                                        <p><?php echo $user_row['organization_mission'];?></p>
                                    </div>
                                </div>
								 <div class="section">
                                    <h4 class="s-property-title">Vision</h4>
                                    <div class="s-property-content">
                                        <p><?php echo $user_row['organization_vision'];?></p>
                                    </div>
                                </div>
                        </div>

                        <div class="similar-post-section padding-top-40"> 
                            <div id="prop-smlr-slide_0"> 
                                <div class="box-two proerty-item">
                                    <div class="item-thumb">
                                        <a href="property-1.html" ><img src="assets/img/similar/property-1.jpg"></a>
                                    </div>
                                    <div class="item-entry overflow">
                                        <h5><a href="property-1.html"> Super nice villa </a></h5>
                                        <div class="dot-hr"></div>
                                        <span class="pull-left"><b> Area :</b> 120m </span>
                                        <span class="proerty-price pull-right"> $ 300,000</span> 
                                    </div>
                                </div> 
                                <div class="box-two proerty-item">
                                    <div class="item-thumb">
                                        <a href="property-1.html" ><img src="assets/img/similar/property-2.jpg"></a>
                                    </div>
                                    <div class="item-entry overflow">
                                        <h5><a href="property-1.html"> Super nice villa </a></h5>
                                        <div class="dot-hr"></div>
                                        <span class="pull-left"><b> Area :</b> 120m </span>
                                        <span class="proerty-price pull-right"> $ 300,000</span> 
                                    </div>
                                </div> 
                                <div class="box-two proerty-item">
                                    <div class="item-thumb">
                                        <a href="property-1.html" ><img src="assets/img/similar/property-3.jpg"></a>
                                    </div>
                                    <div class="item-entry overflow">
                                        <h5><a href="property-1.html"> Super nice villa </a></h5>
                                        <div class="dot-hr"></div>
                                        <span class="pull-left"><b> Area :</b> 120m </span>
                                        <span class="proerty-price pull-right"> $ 300,000</span> 
                                    </div>
                                </div> 
                                <div class="box-two proerty-item">
                                    <div class="item-thumb">
                                        <a href="property-1.html" ><img src="assets/img/similar/property-1.jpg"></a>
                                    </div>
                                    <div class="item-entry overflow">
                                        <h5><a href="property-1.html"> Super nice villa </a></h5>
                                        <div class="dot-hr"></div>
                                        <span class="pull-left"><b> Area :</b> 120m </span>
                                        <span class="proerty-price pull-right"> $ 300,000</span> 
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 p0">
                        <aside class="sidebar sidebar-property blog-asside-right property-style2">
                            <div class="dealer-widget">
                                <div class="dealer-content">
                                    <div class="inner-wrapper">
                                        <div class="dealer-section-space">
                                            <h3><?php echo $user_row['organization_name']; ?> </h3>
                                        </div>
                                        <div class="clear">
                                            <div class="col-xs-12 col-sm-12">
                                                <h3 class="text-center">
                                                           
                                                </h3>     
                                            </div>
                                            <div class="col-xs-12 col-sm-12 ">
												<?php echo "<img src='".$img_src."' class='prof_pic_logo'>"; ?>    
                                            </div>
                                        </div>

                                        <div class="clear">
                                            <ul class="dealer-contacts">                                       
                                                <li><i class="pe-7s-map-marker strong"> </i> <?php echo $org_row['email_address'];?></li>
                                                <li><i class="pe-7s-mail strong"> </i> <?php echo $org_row['email_address'];?>m</li>
                                                
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="panel panel-default sidebar-menu wow fadeInRight animated">
                                <div class="panel-heading">
                                    <h3 class="panel-title">ADVOCACIES:  </h3>
                                </div>
                                <div class="panel-body recent-property-widget">
                                    <?php 
										$row = mysqli_fetch_array($disp_ad_data);
										
										$exp = explode (', ', $row['advocacies']);
										$size = count($exp);
										while ($adv_row = mysqli_fetch_array($adv_data)){
										$adv_icon = $adv_row['advocacy_icon'];
										$img_src = "../admin/advocaciesIcon/".$adv_icon;
										for ($i=0; $i<$size; $i++){
										  
											if ($exp[$i] == $adv_row['advocacy_name']){
											  echo "<img src='".$img_src."' class='adv'>";
											}
										  }
										}
										//while ($row = mysqli_fetch_array($disp_ad_data)){
										  //echo $row['advocacies']." ";
										//}
									  ?>	
                                </div>
                            </div> 

                        </aside>
                    </div>

                </div>

            </div>
        </div>

        
       
        <script src="assets/js/main.js"></script>

        <script>
            $(document).ready(function () {

                $('#image-gallery').lightSlider({
                    gallery: true,
                    item: 1,
                    thumbItem: 9,
                    slideMargin: 0,
                    speed: 500,
                    auto: true,
                    loop: true,
                    onSliderLoad: function () {
                        $('#image-gallery').removeClass('cS-hidden');
                    }
                });
            });
        </script>

    </body>
</html>
