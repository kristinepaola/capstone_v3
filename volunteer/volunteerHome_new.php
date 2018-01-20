<?php
  require ("../sql_connect.php");
?>
  <!DOCTYPE html>
  <html class="no-js">
  <head>
  <style>
div.scroll {
    background-color: #00FFFF;
    width: 100px;
    height: 100px;
    overflow: scroll;
}

div.hidden {
    background-color: #00FF00;
    width: 100px;
    height: 100px;
    overflow: hidden;
}
</style>
           <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title>Home</title>
          <meta name="description" content="company is a real-estate template">
          <meta name="author" content="Kimarotec">
          <meta name="keyword" content="html5, css, bootstrap, property, real-estate theme , bootstrap template">
          <meta name="viewport" content="width=device-width, initial-scale=1">

          <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800' rel='stylesheet' type='text/css'>

          <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
          <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
          <link rel="icon" href="favicon.ico" type="image/x-icon">

          <link rel="stylesheet" href="assets/css/normalize.css">
          <link rel="stylesheet" href="assets/css/font-awesome.min.css">
          <link rel="stylesheet" href="assets/css/fontello.css">
          <link href="assets/fonts/icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet">
          <link href="assets/fonts/icon-7-stroke/css/helper.css" rel="stylesheet">
          <link href="assets/css/animate.css" rel="stylesheet" media="screen">
          <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
          <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
          <link rel="stylesheet" href="assets/css/icheck.min_all.css">
          <link rel="stylesheet" href="assets/css/price-range.css">
          <link rel="stylesheet" href="assets/css/owl.carousel.css">
          <link rel="stylesheet" href="assets/css/owl.theme.css">
          <link rel="stylesheet" href="assets/css/owl.transitions.css">
          <link rel="stylesheet" href="assets/css/style.css">
          <link rel="stylesheet" href="assets/css/responsive.css">
      </head>
      <body>
          <?php
          include ('nameTitle.php');
          ?>
      <div class="row">
        <div class="page-head"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <div class="">
                            <h2 class="wow fadeInLeft animated">WELCOME TO iHelp</h2>
                            <div class="title-line wow fadeInRight animated"></div>
                        </div>               
                    </div>
                </div>
            </div>
        </div>
        <!-- End page header -->

        <!-- property area -->
        <div class="properties-area recent-property" style="background-color: #FFF;">
            <div class="container">   
                <div class="row">
                    <div class="col-md-9 padding-top-40 properties-page">
                        <div class="section clear"> 
                            <div class="">
                              <h2 class="wow fadeInLeft animated">Activities</h2>
                              <div class="title-line wow fadeInRight animated"></div>
                            </div>

            
                        </div>

                        <div class="section clear"> 
                            <div id="list-type" class="proerty-th">
                                <div class="col-sm-6 col-md-4 p0">
                                    <div class="box-two proerty-item">
                                        <div class="item-thumb">
                                            <a href="property-1.html" ><img src="assets/img/demo/property-3.jpg"></a>
                                        </div>

                                        <div class="item-entry overflow">
                                            <h5><a href="property-1.html"> Event_1 Name </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Org_1 Name </span>
                                            <span class="proerty-price pull-right"> Event _1 Date</span>
                                            <div class="property-icon">
                                                <p>
                                                  Organization Event Description
                                                </p> 
                                            </div>
                                        </div>


                                    </div>
                                </div> 

                                <div class="col-sm-6 col-md-4 p0">
                                    <div class="box-two proerty-item">
                                        <div class="item-thumb">
                                            <a href="property-1.html" ><img src="assets/img/demo/property-2.jpg"></a>
                                        </div>

                                        <div class="item-entry overflow">
                                            <h5><a href="property-1.html"> Event_2 Name </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Org_2 Name </span>
                                            <span class="proerty-price pull-right"> Event _2 Date</span>
                                            <div class="property-icon">
                                                <p>
                                                  Organization Event Description
                                                </p> 
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                <div class="col-sm-6 col-md-4 p0">
                                    <div class="box-two proerty-item">
                                        <div class="item-thumb">
                                            <a href="property-1.html" ><img src="assets/img/demo/property-1.jpg"></a>
                                        </div>

                                        <div class="item-entry overflow">
                                            <h5><a href="property-1.html"> Event_3 Name </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Org_3 Name </span>
                                            <span class="proerty-price pull-right"> Event _3 Date</span>
                                            <p style="display: none;">Suspendisse ultricies Suspendisse ultricies Nulla quis dapibus nisl. Suspendisse ultricies commodo arcu nec pretium ...</p>
                                            <div class="property-icon">
                                                <p>
                                                  Organization Event Description
                                                </p> 
                                            </div>
                                        </div>
                                    </div>
                                </div>  

                        <div class="section clear"> 
                            <div class="">
                                    <h2 class="wow fadeInLeft animated">Organizations</h2>
                                    <div class="title-line wow fadeInRight animated"></div>
                                </div>
                                 </div>
                                <div class="col-sm-6 col-md-4 p0">
                                    <div class="box-two proerty-item">
                                        <div class="item-thumb">
                                            <a href="property-1.html" ><img src="assets/img/demo/property-2.jpg"></a>
                                        </div>

                                        <div class="item-entry overflow">
                                            <h5><a href="property-1.html"> Super nice villa </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Area :</b> 120m </span>
                                            <span class="proerty-price pull-right"> $ 300,000</span>
                                            <p style="display: none;">Suspendisse ultricies Suspendisse ultricies Nulla quis dapibus nisl. Suspendisse ultricies commodo arcu nec pretium ...</p>
                                            <div class="property-icon">
                                                <img src="assets/img/icon/bed.png">(5)|
                                                <img src="assets/img/icon/shawer.png">(2)|
                                                <img src="assets/img/icon/cars.png">(1)  
                                            </div>
                                        </div> 
                                    </div>
                                </div> 

                                <div class="col-sm-6 col-md-4 p0">
                                    <div class="box-two proerty-item">
                                        <div class="item-thumb">
                                            <a href="property-1.html" ><img src="assets/img/demo/property-3.jpg"></a>
                                        </div>

                                        <div class="item-entry overflow">
                                            <h5><a href="property-1.html"> Super nice villa </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Area :</b> 120m </span>
                                            <span class="proerty-price pull-right"> $ 300,000</span>
                                            <p style="display: none;">Suspendisse ultricies Suspendisse ultricies Nulla quis dapibus nisl. Suspendisse ultricies commodo arcu nec pretium ...</p>
                                            <div class="property-icon">
                                                <img src="assets/img/icon/bed.png">(5)|
                                                <img src="assets/img/icon/shawer.png">(2)|
                                                <img src="assets/img/icon/cars.png">(1)  
                                            </div>
                                        </div> 
                                    </div>
                                </div> 

                                <div class="col-sm-6 col-md-4 p0">
                                    <div class="box-two proerty-item">
                                        <div class="item-thumb">
                                            <a href="property-1.html" ><img src="assets/img/demo/property-2.jpg"></a>
                                        </div>

                                        <div class="item-entry overflow">
                                            <h5><a href="property-1.html"> Super nice villa </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Area :</b> 120m </span>
                                            <span class="proerty-price pull-right"> $ 300,000</span>
                                            <div class="property-icon">
                                                <img src="assets/img/icon/bed.png">(5)|
                                                <img src="assets/img/icon/shawer.png">(2)|
                                                <img src="assets/img/icon/cars.png">(1)  
                                            </div>
                                        </div> 
                                    </div>
                                </div> 
                            </div>
                        </div>
                        
                    </div> 
                    <div class="col-md-3 pl0 padding-top-40">
                        <div class="blog-asside-right pl0">
                            <div class="panel panel-default sidebar-menu wow fadeInRight animated" >
                                <div class="panel-body search-widget">
                                    <form action="" class=" form-inline"> 
                            <div class="panel panel-default sidebar-menu wow fadeInRight animated">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Recommended Activities for you</h3>
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
                //</div>           
            </div>
        </div>




          <!-- <div class="content-area recent-property padding-top-40" style="background-color: #FFF;">
              <div class="container">

                  <div class="col-md-9">

                      <div class="" id="contact1">
                          <div class="row">
                              <div class="col-md-6">
                                  <h2> No Activities Yet. </h2>
                                  <div class="image wow fadeInRight animated"> 
                                    <img src="assets/img/blog2.jpg" class="img-responsive" alt="Example blog post alt" height="50" width="400">
                                </div>
                                  <a href="#">Join Organization</a>
                                  </p>
                              </div>
                              <!-- /.col-sm-4
                              <div class="col-sm-5">
                                  <h3> No Recent Activities Yet </h3>
                                  <div class="image wow fadeInRight animated"> 
                                    <img src="assets/img/blog2.jpg" class="img-responsive" alt="Example blog post alt" height="50" width="400">
                                </div>
                          </div>
                          </form>
                      </div>
                  </div>
                  <!-- /.col-md-9 

                  <div class="blog-asside-right col-md-3">
                        <div class="panel panel-default sidebar-menu wow fadeInRight animated" >
                            <div class="panel-heading">
                                <h3 class="panel-title">Text widget</h3>
                            </div>
                            <div class="panel-body text-widget">
                                <p>Improved own provided blessing may peculiar domestic. Sight house has sex never. No visited raising gravity outward subject my cottage mr be. Hold do at tore in park feet near my case.
                                </p>
                            </div>
                        </div> -->


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
