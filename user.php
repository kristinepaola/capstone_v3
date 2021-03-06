<?php
class User {
    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbName     = "webportal";
    private $userTbl    = 'user';
    
    function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
    
    function checkUser($userData = array()){
        if(!empty($userData)){
            $prevQuery = "SELECT * FROM ".$this->userTbl." WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
            $prevResult = $this->db->query($prevQuery);
            if($prevResult->num_rows > 0){
                $query = "UPDATE ".$this->userTbl." SET first_name = '".$userData['first_name']."', 
                last_name = '".$userData['last_name']."', 
                email_address = '".$userData['email']."', 
                gender = '".$userData['gender']."', 
                locale = '".$userData['locale']."', 
                user_prof_pic = '".$userData['picture']."', 
                link = '".$userData['link']."', 
                timestamp = '".date("Y-m-d H:i:s")."'
                WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
                $update = $this->db->query($query);


            }else{
                $query = "INSERT INTO ".$this->userTbl." SET oauth_provider = '".$userData['oauth_provider']."', oauth_uid = '".$userData['oauth_uid']."', first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."', email = '".$userData['email']."', gender = '".$userData['gender']."', locale = '".$userData['locale']."', picture = '".$userData['picture']."', link = '".$userData['link']."', timestamp = '".date("Y-m-d H:i:s")."'";
                $insert = $this->db->query($query);
            }
            
            $result = $this->db->query($prevQuery);
            $userData = $result->fetch_assoc();
            header('location:volunteer/volunteerHome.php');
        }
        
        return $userData;
    }
}
?>