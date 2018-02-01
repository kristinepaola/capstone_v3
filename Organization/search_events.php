<?php
include("../sql_connect.php");
    $key=$_POST['key'];
    $array = array();

    $query= "select * from event where event_name LIKE '%{$key}%'";

    $data = mysqli_query($sql,$query);

    while($row = mysqli_fetch_array($data)){
                                        $event_image = $row['event_img'];
                                        $img_src = "../admin/eventImages/".$event_image;
                                        echo '  <div class="col-md-4 p0">
                                                    <div class="box-two proerty-item">
                                                        <div class="item-thumb">
                                                            <a href="" ><img src="'.$img_src.'"></a>
                                                        </div>
                                                        <div class="item-entry overflow">
                                                            <h5><a href="">'.$row['event_name'].'</a></h5>
                                                            <div class="dot-hr"></div>
                                                            <span class="pull-left"><b>Location :</b> '.$row['event_location'].' </span>
                                                            <span class="proerty-price pull-right">'.date("M d Y h:i A", strtotime($row['event_start'])).'</span>
                                                            <p style="display: none;">'.$row['event_description'].'.</p>
                                                            <div class="property-icon">
                                                                <button class="btn btn-warning view" data-target='.$row['event_id'].'>VIEW </button> 
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> ';
                                    }
                                    
    
?>