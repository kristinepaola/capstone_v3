<?php
include("../sql_connect.php");
    $key=$_POST['key'];
    $array = array();

    //echo $key;
    $query= "select * from user where user_type = 'organization' AND first_name LIKE '%{$key}%'";
    $data = mysqli_query($sql,$query);

    while($row = mysqli_fetch_array($data)){
                                        $org_id = $row['user_id'];
                                        
                                        $org_img = $row['user_prof_pic'];
                                        $img_src = "admin/userProfPic/".$org_img;
                                        echo '  <div class="col-md-4 p0">
                                                    <div class="box-two proerty-item">
                                                        <div class="item-thumb">
                                                            <a href="" ><img src="'.$img_src.'"></a>
                                                        </div>
                                                        <div class="item-entry overflow">
                                                            <h1><a href="organization_profile_public.php?id='.$row['user_id'].'">'.$row['first_name'].'</a></h1>
                                                            <h5>Location:<a href="">'.$row['user_location'].'</h5>
                                                            <h6>Advocacies:<a href="">'.$row['advocacies'].'</h6>
                                                           

                                                        </div>
                                                    </div>
                                                </div> ';
                                    }
    
?>