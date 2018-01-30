<!DOCTYPE html>
<?php include("Header.php") 

?>

<!-- End of nav bar -->

<div class="page-head">
    <div class="container">
        <div class="row">
            <div class="page-head-content">
                <h1 class="page-title">i HELP / Sign in </h1>
            </div>
        </div>
    </div>
</div>
<!-- End page header -->


<!-- register-area -->
<div class="register-area" style="background-color: rgb(249, 249, 249);">
    <div class="container">
        <div class="col-md-6 col-sm-offset-3">
            <div class="box-for overflow">
                <div class="col-md-12 col-xs-12 login-blocks">
                    <h2>Login : </h2>
                    <form id="formSubmission" action="check.php" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="id1" name="id[]">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="id2" name="id[]">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-default" onclick="SubmitForm()">Log in</button>
                        </div>
                    </form>
                    <br>

                    <h2>Social login :  </h2>

                    <p>
                    <a class="login-social" href="#"><i class="fa fa-facebook"></i>&nbsp;Facebook</a>
                    <a class="login-social" href="#"><i class="fa fa-google-plus"></i>&nbsp;Gmail</a>
                    <a class="login-social" href="#"><i class="fa fa-twitter"></i>&nbsp;Twitter</a>
                    </p>
                </div>

            </div>
        </div>

    </div>
</div>
</body>
</html>
<script>
  function SubmitForm(){
	    var y;
	    var max=2;

	    for(y=0 ; y != max && document.getElementById('id'+y).value != '';y++){}

	    if(y == max){
            document.getElementById('formSubmit').click();
        }
	}
</script>
