<?php
    require ("../sql_connect.php");
    require("Header_Organization.php");
    $id = $_SESSION['num'];

    $prof_query = "SELECT * FROM user WHERE user_id = $id";
	$prof_result = mysqli_query($sql, $query);
	$prof_row = mysqli_fetch_array ($prof_result);
	
	
    $query = "SELECT * FROM organization_details WHERE user_id = $id";
    $edit_result = mysqli_query ($sql, $query);
    if (!$edit_result){
        echo "Error in query";
        exit();
    }

    $row = mysqli_fetch_array ($edit_result);

?>
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>iHelp | Edit your Profile </title>

    </head>
    <body>

        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>
        <div class="content-area user-profiel" style="background-color: #FCFCFC;">&nbsp;
            <div class="container">   
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 profiel-container">
                      <fieldset>
                        <form action="update_organization_profile.php" method="POST" enctype="multipart/form-data">
                            <div class="profiel-header">
                                <h3>
                                    <b>EDIT</b> YOUR PROFILE <br>
                                    <small>Change your information.</small>
                                </h3>
                                <hr>
                            </div>

                            <div class="clear">
                                <div class="col-sm-3 col-sm-offset-1">
                                    <div class="picture-container">
                                        <div class="picture">
                                            <label>Organization Profile:<small>(required)</small></label>
                                            <input name="user_prof_pic" type ="file" id ="user_prof_pic" >
											<?php echo "<img src=../admin/userProfPic/".$prof_row['user_prof_pic'].">";?>
                                        </div>
                                        <h6>Choose Picture</h6>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Organization Name:<small>(required)</small></label>
                                        <input name="organization_name" type="text" class="form-control" id ="organization_name" value ="<?php echo $row['organization_name'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Organization Mission:<small>(required)</small></label>
                                        <input name="organization_mission" type ="text" id ="oranization_mission" value ="<?php echo $row['organization_mission'];?>">
                                    </div> 
                                    <div class="form-group">
                                        <label>Organization Vision: <small>(required)</small></label>
                                        <input name="organization_vision" type ="text" id ="organization_vission" value ="<?php echo $row['organization_vision'];?>">
                                    </div> 
                                    <div class="form-group">
                                        <label>Organization Date Established:<small>(required)</small></label>
                                        <input name="organization_date_established" type ="date" id ="organization_date_established" value ="<?php echo $row['organization_date_established'];?>">
                                    </div> 
                                    <div class="form-group">
                                        <label>Organization Certificate:<small>(required)</small></label>
                                        <input name="organization_certificate" type ="file" id ="organization_certificate" value ="<?php echo $row['organization_certificate'];?>">
                                    </div> 

                                </div>   
                            </div>
                    
                            <div class="col-sm-8 col-sm-offset-1 pull-right">
                                <br>
                                <input type='submit' class='btn btn-finish btn-primary' name='submit' value='Update' />
                            </div>
                            <br>
                    </form>
                    </fieldset>

                </div>
            </div><!-- end row -->

        </div>
    </div>
</body>
</html>