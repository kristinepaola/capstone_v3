
<?php
	require ("sql_connect.php");
	include ("Header.php");

    //set display organization per page
    $result_per_page = 5;

	$query = "SELECT * FROM user WHERE user_type = 'organization' ";
	$data = mysqli_query($sql,$query);
    $number_Result = mysqli_num_rows($data);

	if (!$data){
		echo "ERROR IN QUERY";
	}
        //algo for page number 
        $numberPage = ceil($number_Result/$result_per_page);

     if(!isset($_GET['page'])) {
        $page = 1;
     }else{
        $page = $_GET['page'];
     }
        //pila ka page 
    $page_first_result = ($page-1)*$result_per_page;

     $page_query = "SELECT * FROM user WHERE user_type = 'organization'LIMIT ".$page_first_result.", ".$result_per_page."";
     $page_query;
     $page_data = mysqli_query($sql,$page_query);
	
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

        <style>
        .pagination {
            text-align: right;
           
        }

        .pagination a {
            color: black;
            padding: 2px 18px;
            text-decoration: roboto;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }

        .pagination a:hover:not(.active) {background-color: #ffde4c;}
        </style>    
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

                        <div class="section"> 
                            <div id="list-type" class="proerty-th-list">
                                <?php 
                                if($number_Result > $result_per_page){
                                        echo '<div class="pagination pull-right">
                                        <a href="events.php?page='.($page-1).'">&laquo;</a>
                                        <a href for ($page=1; $page<=$numberPage; $page++) 
                                        echo <a href="events.php?page='. $page .'">'.$page.'</a>
                                       <a href="events.php?page='.($page+1).'">&raquo;</a>
                                        </div>';
                                    }else{
                                        echo '';
                                    }
                                    echo'
                                    <div class="col-sm-6 col-lg-6">
                                        <input type="text" class="form-control" placeholder="search for organizations" id="txtSearch" onKeyUp="txtSearch_submit()">

                                      </div>
                                      <div id="suggestion"></div>'
                                      ;

                                    echo '<div id="lists">';
									while($row = mysqli_fetch_array($page_data)){
										$org_id = $row['user_id'];
										$org_img = $row['user_prof_pic'];
										$img_src = "admin/userProfPic/".$org_img;
										echo '	<div  class="col-md-4 p0">
													<div class="box-two proerty-item">
														<div class="item-thumb">
															<a href="login.php" ><img src="'.$img_src.'"></a>
														</div>
														<div class="item-entry overflow">
															<h1><a href="login.php">'.$row['first_name'].'</a></h1>
                                                            <h5>Location:'.$row['user_location'].'</h5>
                                                            <h6>Advocacies'.$row['advocacies'].'</h6>
                                                           

														</div>
													</div>
												</div> ';
									}


								
								
								?>
                          
                            </div>
                        </div>
                    </div>       

                    
                </div>
            </div>
        </div>
</body>
</html>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/typeahead.min.js"></script>

<script>
  function txtSearch_submit()
  {
    var search = document.getElementById("txtSearch").value;
    var xhr;
    if(window.XMLHttpRequest){
        xhr = new XMLHttpRequest();
    }
    else if(window.ActiveXObject)
    {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var data = "key=" + search;
    xhr.open("POST", "search.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(data);
    xhr.onreadystatechange = display_data;

    function display_data()
    {
        if(xhr.readyState ==4)
        {
            if(xhr.status == 200)
            {
                document.getElementById("suggestion").innerHTML = xhr.responseText;
                document.getElementById("lists").style.display = 'none';
            }
            else
            {
                alert('There was a problem with the request.')
            }
        }
    }
  }
</script>