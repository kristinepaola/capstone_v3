<?php
require ("sql_connect.php");
include("Header.php");
?>
<!DOCTYPE html>
<html class="no-js"> <!--<![endif]-->
<title>Register Volunteer</title>
    <body>

        <div class="header-connect">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-8  col-xs-12">
                        <div class="header-half header-call">
                        </div>
                    </div>
                    <div class="col-md-2 col-md-offset-5  col-sm-3 col-sm-offset-1  col-xs-12">
                        <div class="header-half header-social">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End top header -->
                <!-- Brand and toggle get grouped for better mobile display -->

                <!-- Collect the nav links, forms, and other content for toggling -->
            </div><!-- /.container-fluid -->
        </nav>
        <!-- End of nav bar -->

        <div class="page-head">
            <div class="container">
                <div class="row">
                    <div class="page-head-content"><br><br>
                        <h1 class="page-title"><center>Volunteer Registration</center></h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- End page header -->


        <!-- register-area -->
        <div class="register-area" style="background-color: rgb(249, 249, 249);">
            <div class="container">

                <div class="col-md-6">
                    <div class="box-for overflow">
                        <div class="col-md-12 col-xs-12 register-blocks">
                            <h2>Create Account </h2>
                            <form method = "POST" action = "volunteer/insertRegisteredVolunteer.php">
                            
                                <div class="form-group">
                                    <label for="name">First Name</label>
                                    <input type="text" class="form-control" name="firstName">
                                </div>
                                <div class="form-group">
                                    <label for="name">Middle Name</label>
                                    <input type="text" class="form-control" name="middleName">
                                </div>
                                <div class="form-group">
                                    <label for="email">Last Name</label>
                                    <input type="text" class="form-control" name="lastName">
                                </div>
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <input type="text" class="form-control" name="address" >
                                </div>
                                <div class="form-group">
                                    <label for="password">Email</label>
                                    <input type="text" class="form-control" name="email" id="email">
									<label><small id="prompt"></small></label>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="pass">
                                </div>
                                <div class="form-group">
                                    <label for="password">Confirm Password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="text-center">
                                    <input type="submit" name="registerVolunteer" class="btn btn-default" id="submit" value="Register">
								</div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box-for overflow">
                        <div class="col-md-12 col-xs-12 login-blocks">
                            <h2>Social login :  </h2>

                            <p>
                            <a class="login-social" href="#"><i class="fa fa-facebook"></i>&nbsp;Facebook</a>
                            <a class="login-social" href="#"><i class="fa fa-google-plus"></i>&nbsp;Gmail</a>
                            
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
<script>
		$(document).ready(function(){
		
		$("#email").blur(function(){
			$("#submit").prop('disabled', false);
			var email = $(this).val();
			var x = $.ajax({
				url: "Organization/checkEmail.php",
				method: "POST",
				data: {check_mail:email},
				dataType: "json",
				success: function(resp){
					$("#prompt").html(resp[0]);
					if (resp[1] == "no"){
						$("#submit").prop('disabled', true);
					}else{
						$("#submit").prop('disabled', false);
					}
				}
			});
			console.log(x);
			
		});
		
	});
</script>
