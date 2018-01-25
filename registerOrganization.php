<?php
require ("sql_connect.php");
include("Header.php");
$dispAdv_query = "SELECT * FROM advocacies";
$dispAdv_data = mysqli_query ($sql, $dispAdv_query);
if (!$dispAdv_data){
"Error in query";

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
        <title>iHelp | Organization Registration</title>
        <meta name="description" content="GARO is a real-estate template">
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
        <link href="css/animate.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="assets/css/bootstrap-select.min.css"> 
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/icheck.min_all.css">
        <link rel="stylesheet" href="assets/css/price-range.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.css">  
        <link rel="stylesheet" href="assets/css/owl.theme.css">
        <link rel="stylesheet" href="assets/css/owl.transitions.css"> 
        <link rel="stylesheet" href="assets/css/wizard.css"> 
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
		
		<style>
			 .advicon{
			width: 50px;
			height: 50px;
			margin-right: 10px;
		  }
		</style>
    </head>
    <body>

        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>

        <div class="page-head"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">Non-Profit Organization Registrationn</h1>               
                    </div>
                </div>
            </div>
        </div>
        <!-- End page header -->

        <!-- property area -->
        <div class="content-area submit-property" style="background-color: #FCFCFC;">&nbsp;
            <div class="container">
                <div class="clearfix" > 
                    <div class="wizard-container"> 

                        <div class="wizard-card ct-wizard-orange" id="wizardProperty">
                            <form method="POST" action="Organization/insertOrganization.php" enctype="multipart/form-data">                        
                                <div class="wizard-header">
                                    <h3>
                                        <b>Welcome!</b> Enter your Organization's Basic Information <br>
                                        <small>Lorem ipsum dolor sit amet, consectetur adipisicing.</small>
                                    </h3>
                                </div>

                                <ul>
                                    <li><a href="#step1" data-toggle="tab">Step 1 </a></li>
                                    <li><a href="#step2" data-toggle="tab">Step 2 </a></li>
                                    <li><a href="#step3" data-toggle="tab">Step 3 </a></li>
                                    <li><a href="#step4" data-toggle="tab">Finished </a></li>
                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane" id="step1">
                                                                                <div class="row p-b-15  ">
                                            <h4 class="info-text"> Let's start with the basic information (with validation)</h4>
                                            <div class="col-sm-4 col-sm-offset-1">
                                                <div class="picture-container">
                                                    <div class="picture">
														<img src="assets/img/default-property.jpg" class="picture-src" id="wizardPicturePreview" title=""/>
														<input type="file" name="user_prof_pic" id="wizard-picture">
													</div> 
                                                </div>
                                            </div>
											<div class="col-sm-6">
												<div class="form-group">
													<label>Organization Name <small>(required)</small></label>
													<input type="text" name="organization_name" class="form-control" required>
												</div>

												<div class="form-group">
													<label>Email Address <small>(required)</small></label>
													<input id="email" type="email" name="email_address" class="form-control" required>
													<label><small id="email_prompt"></small></label>
												</div> 
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label> Password: <small>(required)</small></label>
													<input type="password" id="user_password" name="user_password" class="form-control" required>
                                                    
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label> Confirm Password: <small>(required)</small></label>
													<input type="password" id="user_confPass" name="user_confPass" class="form-control" required>
                                                    <label><small id="prompt"></small></label>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label> Location <small>(required)</small></label>
													<input type="name" name="user_location" class="form-control" required>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label> Date Established <small>(required)</small></label>
													<input type="date" name="organization_date_established" class="form-control" required>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label> Vision <small>(required)</small></label>
													<textarea name="organization_vision" class="form-control" required></textarea>
												</div>
											</div>
											<div class="col-sm-6">
												
													<label> Mission <small>(required)</small></label>
													<textarea name="organization_mission" class="form-control" required></textarea>
												
											</div>
										
                                        </div>
                                    </div>
                                    <!--  End step 1 -->

                                    <div class="tab-pane" id="step2">
                                            <div class="col-sm-6">
											<div class="form-group">
												<label> Upload File <small>(required)</small></label>
												<input type="file" name="organization_certificate" class="form-control" required>
												<p class="help-block">This will help us confirm the legitimization of your Non-Profit Organization.</p>
											</div>
										</div>
                                    </div>
                                    <!-- End step 2 -->

                                    <div class="tab-pane" id="step3">                                        
										<h4 class="info-text">Select Your Advocacy  </h4>
												<div class="row">  
												<div class="col-sm-6 col-md-offset-2"> 
													<div class="form-group">
														<?php
															while ($row = mysqli_fetch_array($dispAdv_data)){
															$advicon = $row['advocacy_icon'];
															$img_src = "admin/advocaciesIcon/".$advicon;
															
																echo "<img src='".$img_src."' class='advicon'>";
																echo "<input type='checkbox' name = 'advocacy[]' value='".$row['advocacy_name']."'> ".$row['advocacy_name']."<br>";
															
															
														  }
														?>
													</div> 	
												</div>
											</div>
                                    </div>
                                    <!--  End step 3 -->


                                    <div class="tab-pane" id="step4">                                        
                                        <h4 class="info-text"> Finished and submit </h4>
                                        <div class="row">  
                                            <div class="col-sm-12">
                                                <div class="">
                                                    <p>
                                                        <label><strong>Terms and Conditions</strong></label>
                                                        By accessing or using  GARO ESTATE services, such as 
                                                        posting your property advertisement with your personal 
                                                        information on our website you agree to the
                                                        collection, use and disclosure of your personal information 
                                                        in the legal proper manner
                                                    </p>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" /> <strong>Accept termes and conditions.</strong>
                                                        </label>
                                                    </div> 

                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <!--  End step 4 -->

                                </div>

                                <div class="wizard-footer">
                                    <div class="pull-right">
                                        <input type='button' class='btn btn-next btn-primary' name='next' value='Next' />
                                        <input type='submit' class='btn btn-finish btn-primary ' name='registerOrg' value='Finish' />
                                    </div>

                                    <div class="pull-left">
                                        <input type='button' class='btn btn-previous btn-default' name='previous' value='Previous' />
                                    </div>
                                    <div class="clearfix"></div>                                            
                                </div>	
                            </form>
                        </div>
                        <!-- End submit form -->
                    </div> 
                </div>
            </div>
        </div>

          <!-- Footer area-->
        <div class="footer-area">





        </div>

        <script src="assets/js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="assets/js//jquery-1.10.2.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-select.min.js"></script>
        <script src="assets/js/bootstrap-hover-dropdown.js"></script>
        <script src="assets/js/easypiechart.min.js"></script>
        <script src="assets/js/jquery.easypiechart.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/wow.js"></script>
        <script src="assets/js/icheck.min.js"></script>

        <script src="assets/js/price-range.js"></script> 
        <script src="assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
        <script src="assets/js/jquery.validate.min.js"></script>
        <script src="assets/js/wizard.js"></script>

        <script src="assets/js/main.js"></script>


    </body>
</html>
<script>
    $(document).ready(function(){
        $("#user_password").blur(function(){
            var user_password = $(this).val();
            console.log(user_password);
                $("#user_confPass").blur(function(){
                    var user_confPass = $(this).val();
                    console.log(user_confPass);
                    if (user_password!=user_confPass){
                        var prompt = '<small class="text-danger">Password do not match!</small>';
                        $("#prompt").html(prompt);
                        $("#next").prop('disabled', true);
                    }else{
                        var prompt = '<small class="text-success">Password is a match!</small>';
                        $("#prompt").html(prompt); 
                        $("#next").prop('disabled', false); 
                    }
                });
        });
		$("#email").blur(function(){
			var email = $(this).val();
			var x = $.ajax({
				url: "Organization/checkEmail.php",
				method: "POST",
				data: {check_mail:email},
				dataType: "json",
				success: function(resp){
					$("#email_prompt").html(resp[0]);
					if (resp[1] == "no"){
						$("#next").prop('disabled', true);
					}else{
						$("#next").prop('disabled', false);
					}
				}
			});
			console.log(x);
		});
    });
</script>