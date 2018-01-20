<?php
	require ("sql_connect.php");
	include ("Header.php");
	$query = "SELECT * FROM user WHERE user_type = 'organization'";
	$data = mysqli_query($sql,$query);
	if (!$data){
		echo "ERROR IN QUERY";
	}
	
	
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<body>
	<head>
		<title>iHelp | Events</title>
	</head>
 <div class="page-head"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">Browse Organizations</h1>               
                    </div>
                </div>
            </div>
        </div>
        <!-- End page header -->

        <!-- property area -->
        <div class="content-area recent-property" style="background-color: #FFF;">
            <div class="container">   
                <div class="row">

                    <div class="col-md-9 pr-30 padding-top-40 properties-page user-properties">

                        <div class="section"> 
                            <div class="page-subheader sorting pl0 pr-10">


                                <ul class="sort-by-list pull-left">
                                    <li class="active">
                                        <a href="javascript:void(0);" class="order_by_date" data-orderby="property_date" data-order="ASC">
                                            Sort by Date <i class="fa fa-sort-amount-asc"></i>					
                                        </a>
                                    </li>
                                </ul><!--/ .sort-by-list-->

                                <div class="items-per-page pull-right">
                                    <label for="items_per_page"><b>Property per page :</b></label>
                                    <div class="sel">
                                        <select id="items_per_page" name="per_page">
                                            <option value="3">3</option>
                                            <option value="6">6</option>
                                            <option value="9">9</option>
                                            <option selected="selected" value="12">12</option>
                                            <option value="15">15</option>
                                            <option value="30">30</option>
                                            <option value="45">45</option>
                                            <option value="60">60</option>
                                        </select>
                                    </div><!--/ .sel-->
                                </div><!--/ .items-per-page-->
                            </div>

                        </div>

                        <div class="section"> 
                            <div id="list-type" class="proerty-th-list">
                                <?php 
									while($row = mysqli_fetch_array($data)){
										$org_id = $row['user_id'];
										
										$org_img = $row['user_prof_pic'];
										$img_src = "admin/userProfPic/".$org_img;
										echo '	<div class="col-md-4 p0">
													<div class="box-two proerty-item">
														<div class="item-thumb">
															<a href="" ><img src="'.$img_src.'"></a>
														</div>
														<div class="item-entry overflow">
															<h1><a href="">'.$row['first_name'].'</a></h1>
															
														</div>
													</div>
												</div> ';
									}
									
								
								
								?>
                          
                            </div>
                        </div>

                        <div class="section"> 
                            <div class="pull-right">
                                <div class="pagination">
                                    <ul>
                                        <li><a href="#">Prev</a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">Next</a></li>
                                    </ul>
                                </div>
                            </div>                
                        </div>

                    </div>       

                    
                </div>
            </div>
        </div>
</body>
</html>