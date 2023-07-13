<?php
require_once "database.php";
class user_login extends DatabaseLogin {
    public function login($username, $password){
        $username = str_replace("'","''",$username);
        $sql = "SELECT *,(SELECT 1 as value from `student_survey` WHERE date = CURRENT_DATE() and user_id = `users`.`id`) as haveSurvey FROM `users` where `username`='$username' and status=1";    

        if($result = $this->conn->query($sql)){
            if ($result){
                $return_arr = array();
                while($row = $result->fetch_assoc()){
                    $passwordHash = $row['password'];
                    if (password_verify($password, $passwordHash)){
                        $return_arr[] = array("id" => $row['id'],
                                    "haveSurvey" => $row["haveSurvey"],
                                    "username" => $row['username'],
                                    "name" => $row['name'],
                                    "user_type" => $row['usertype'],
                                    "status" => $row['status'],
                                    "createdDate" => $row['createdDate'],
                                );
                    }
                }
                return $return_arr;
                exit;
            }
            
        } else {
            die("Error retrieving all users: " . $this->conn->error);
        }
    }
    public function getsetting(){
        $sql = "SELECT * FROM `setting`";
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }
    public function getacount(){
        $return_arr["id"] = "";
        $return_arr["username"] = "";
        $return_arr["name"] = "";
        $return_arr["course"] = "";
        $return_arr["year"] = "";
        $return_arr["usertype"] = "";
        $return_arr["status"] = "";
        $return_arr["number"] = "";
        $return_arr["id_no"] = "";
        $return_arr["createdDate"] = "";
        
        if (!isset($_SESSION)){ session_start(); }
        $uid = isset($_SESSION["acount_user_id"]) ? $_SESSION["acount_user_id"] : 0;
        $sql = "SELECT * FROM `users` WHERE `id` = $uid";    
        
        if($result = $this->conn->query($sql)){
            while($row = $result->fetch_assoc()){
                $return_arr["id"] = $row['id'];
                $return_arr["username"] = $row['username'];
                $return_arr["name"] = $row['name'];
                $return_arr["course"] = $row['course'];
                $return_arr["year"] = $row['year'];
                $return_arr["usertype"] = $row['usertype'];
                $return_arr["number"] = $row['number'];
                $return_arr["id_no"] = $row['id_no'];
                $return_arr["status"] = $row['status'];
                $return_arr["createdDate"] = $row['createdDate'];
            }
            return $return_arr;
            exit;           
        } else {
            die("Error retrieving all users: " . $this->conn->error);
        }   
    }

    public function getAllSurvey($id){
        if ($id == 0){
            $sql = "SELECT * FROM `survey` order by `column` desc";
        }else{
            $sql = "SELECT * FROM `survey` where id = $id order by `column` desc";
        }
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }

    public function getAllbanner($id){
        $sql = "";
        if ($id == 0){
            $sql = "SELECT * FROM `banner` order by id desc";
        }else{
            $sql = "SELECT * FROM `banner` where id = $id order by id desc";
        }
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }

    public function submitSurveyVisitor($name, $address, $number,$survey){
        $sql = "INSERT INTO `visitor`(`date`, `name`, `address`, `number`, `type`) 
                VALUES (CURDATE(),'$name','$address','$number','0')";
                

        // EXECUTE THE QUERY
        $ret["isSuccess"] = true;
        $ret["errorMessage"] = "";
        if($result = $this->conn->query($sql)){  
            $last_id = $this->conn->insert_id;
            foreach ($survey as $d) {
                $id = $d["id"];
                $sqlDetails = "INSERT INTO `surveysubmit`(`survey_id`, `visitor_id`) 
                            VALUES ('$id','$last_id')";

                if ($this->conn->query($sqlDetails)){

                }else{
                    $ret["isSuccess"] = true;
                    $ret["errorMessage"] = $this->conn->error;
                    die("Error creating user: " . $this->conn->error);
                }
            }
        } else {
            $ret["isSuccess"] = true;
            $ret["errorMessage"] = $this->conn->error;
            die("Error creating user: " . $this->conn->error);
        }
        return $ret;
    }

    public function submitApplication($first_name, $last_name, $middle_name,$date_birth, $age, $gender,  $cstatus, $brgy, $sitio, $place_birth, $educational, $isSenior, $isPWD, $is4p, $family, $number){
        $first_name = str_replace("'","''",$first_name);
        $last_name = str_replace("'","''",$last_name);
        $middle_name = str_replace("'","''",$middle_name);
        $sitio = str_replace("'","''",$sitio);
        $place_birth = str_replace("'","''",$place_birth);
        $educational = str_replace("'","''",$educational);

        $sql = "INSERT INTO `senior`(`first_name`, `last_name`, `middle_name`, `date_birth`, `age`, `gender`, `civil_status`, `barangay`, `street_sitio`, `place_birth`, `educational`, `isSenior`, `isPWD`, `is4p`, `status`, `registered_date`,`president`,`number`,`damayan`,`pension`,`philhealth`,`sr_id`) 
                VALUES ('$first_name','$last_name','$middle_name','$date_birth','$age','$gender','$cstatus','$brgy','$sitio','$place_birth','$educational','$isSenior','$isPWD','$is4p','0',CURDATE(),0, '$number','0','0','0','')";

        // EXECUTE THE QUERY
        $ret["isSuccess"] = true;
        $ret["errorMessage"] = "";
        if($result = $this->conn->query($sql)){   
            $last_id = $this->conn->insert_id;
            date_default_timezone_set('Asia/Manila');
            $date = date('y-m-d h:i:s');
            $date=date_create($date);
            $sr_id = "SC".$last_id.date_format($date,"ymd");
            $this->conn->query("Update `senior` set sr_id = '$sr_id' where id = $last_id");
            foreach ($family as $d) {
                $name = $d["name"];
                $ralation = $d["relation"];
                $age = $d["age"];
                $cStatus = $d["cStatus"];
                $occupation = $d["occupation"];
                $sqlDetails = "INSERT INTO `senior_details`(`name`, `relation`, `age`, `civil_status`, `occupation`,`senior_id`) 
                               VALUES ('$name','$ralation','$age','$cStatus','$occupation',$last_id)";

                if ($this->conn->query($sqlDetails)){

                }else{
                    $ret["isSuccess"] = true;
                    $ret["errorMessage"] = $this->conn->error;
                    die("Error creating user: " . $this->conn->error);
                }
            }
            
        } else {
            $ret["isSuccess"] = true;
            $ret["errorMessage"] = $this->conn->error;
            die("Error creating user: " . $this->conn->error);
        }
        return $ret;
    }

    public function submitReplacement($first_name, $last_name, $middle_name, $date_birth, $age, $place_birth, $brgy, $sitio, $gender, $sr_id, $reason){
        $first_name = str_replace("'","''",$first_name);
        $last_name = str_replace("'","''",$last_name);
        $middle_name = str_replace("'","''",$middle_name);
        $place_birth = str_replace("'","''",$place_birth);
        $sitio = str_replace("'","''",$sitio);
        $reason = str_replace("'","''",$reason);
        
        $sql = "INSERT INTO `replacement`(`last_name`, `first_name`, `middle_name`, `birthdate`, `age`, `birth_place`, `brgy`, `sitio_street`, `gender`, `id_no`, `reason`, `status`, `date`) 
                VALUES ('$last_name','$first_name','$middle_name','$date_birth','$age','$place_birth','$brgy','$sitio','$gender','$sr_id','$reason','0',CURDATE())";

        // EXECUTE THE QUERY
        $ret["isSuccess"] = true;
        $ret["errorMessage"] = "";
        if($result = $this->conn->query($sql)){   

        } else {
            $ret["isSuccess"] = true;
            $ret["errorMessage"] = $this->conn->error;
            die("Error creating user: " . $this->conn->error);
        }
        return $ret;
    }


    public function submitPWD($last_name,$first_name,$middle_name,$suffix,$date_birth, $gender, $civil_status, $number, $brgy, $street_sitio,
                              $place_birth, $occupation, $typedisability, $cousedisability, $flast_name, $ffirst_name, $fmiddle_name, $mlast_name,
                              $mfirst_name, $mmiddle_name, $glast_name, $gfirst_name, $gmiddle_name){
        $first_name = str_replace("'","''",$first_name);
        $last_name = str_replace("'","''",$last_name);
        $middle_name = str_replace("'","''",$middle_name);
        $suffix = str_replace("'","''",$suffix);
        $street_sitio = str_replace("'","''",$street_sitio);
        $place_birth = str_replace("'","''",$place_birth);
        $occupation = str_replace("'","''",$occupation);
        $flast_name = str_replace("'","''",$flast_name);
        $ffirst_name = str_replace("'","''",$ffirst_name);
        $fmiddle_name = str_replace("'","''",$fmiddle_name);
        $mlast_name = str_replace("'","''",$mlast_name);
        $mfirst_name = str_replace("'","''",$mfirst_name);
        $mmiddle_name = str_replace("'","''",$mmiddle_name);
        $glast_name = str_replace("'","''",$glast_name);
        $gfirst_name = str_replace("'","''",$gfirst_name);
        
        $dateOfBirth = "1993-05-20";
        $today = date('Y-m-d');
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        $age = $diff->format('%y');
        
        
        $sql = "INSERT INTO `pwd`(`last_name`, `first_name`, `middle_name`, `suffix`, `birthdate`, `gender`, `civil_status`, `typeofdisability`, `couseofdisability`, `sitio_street`, `brgy`, `number`, `occupation`, `flast_name`, `ffirst_name`, `fmiddle_name`, `mlast_name`, `mfirst_name`, `mmiddle_name`, `gfirst_name`, `glast_name`, `gmiddle_name`, `date`, `status`,`age`)
                                       VALUES ('$last_name','$first_name','$middle_name','$suffix','$date_birth','$gender','$civil_status','$typedisability','$cousedisability','$street_sitio','$brgy','$number','$occupation','$flast_name','$ffirst_name','$fmiddle_name','$mlast_name','$mfirst_name','$mmiddle_name','$glast_name','$gfirst_name','$gmiddle_name',CURDATE(),0, '$age')";

        // EXECUTE THE QUERY
        $ret["isSuccess"] = true;
        $ret["errorMessage"] = "";
        if($result = $this->conn->query($sql)){   
            $last_id = $this->conn->insert_id;
            date_default_timezone_set('Asia/Manila');
            $date = date('y-m-d h:i:s');
            $date=date_create($date);
            $id_no = "PWD".$last_id.date_format($date,"ymd");
            $this->conn->query("Update `pwd` set id_no = '$id_no' where id = $last_id");
        } else {    
            $ret["isSuccess"] = true;
            $ret["errorMessage"] = $this->conn->error;
            die("Error creating user: " . $this->conn->error);
        }
        return $ret;
    }

    public function submitApplicationSoloParent($last_name, $first_name, $middle_name, $date_birth, $age, $gender, $brgy, $street_sitio, $place_birth,
                                                $education, $occupation, $income, $mincome, $family, $number, $classification, $problem, $resources){
        
        $first_name = str_replace("'","''",$first_name);
        $last_name = str_replace("'","''",$last_name);
        $middle_name = str_replace("'","''",$middle_name);
        $street_sitio = str_replace("'","''",$street_sitio);
        $place_birth = str_replace("'","''",$place_birth);
        $educational = str_replace("'","''",$educational);
        $occupation = str_replace("'","''",$occupation);
        $income = str_replace("'","''",$income);
        $mincome = str_replace("'","''",$mincome);
        $classification = str_replace("'","''",$classification);
        $problem = str_replace("'","''",$problem);
        $resources = str_replace("'","''",$resources);

        $sql = "INSERT INTO `solo_parent`(`last_name`, `first_name`, `middle_name`, `date_birth`, `age`, `gender`, `brgy`, `street_sitio`, `place_birth`, `occupation`, `income`, `mincome`, `education`, `number`, `classification`, `problem`, `resources`, `status`, `registeration_date`,`sp_id`) 
                            VALUES ('$last_name','$first_name','$middle_name','$date_birth','$age','$gender','$brgy','$street_sitio','$place_birth','$occupation','$income','$mincome','$education','$number','$classification','$problem','$resources','0',CURDATE(),'')";

        // EXECUTE THE QUERY

        $ret["isSuccess"] = true;
        $ret["errorMessage"] = "";
        if($result = $this->conn->query($sql)){   
            $last_id = $this->conn->insert_id;
            date_default_timezone_set('Asia/Manila');
            $date = date('y-m-d h:i:s');
            $date=date_create($date);
            $sr_id = "SP".$last_id.date_format($date,"ymd");
            $this->conn->query("Update `solo_parent` set sp_id = '$sr_id' where id = $last_id");
            foreach ($family as $d) {
                $name = $d["name"];
                $ralation = $d["relation"];
                $age = $d["age"];
                $cStatus = $d["cStatus"];
                $education = $d["education"];
                $occupation = $d["occupation"];
                $sqlDetails = "INSERT INTO `solo_parent_details`(`name`, `relation`, `age`, `civil_status`, `education`, `occupation`,`solo_parent_id`) 
                               VALUES ('$name','$ralation','$age','$cStatus','$education', '$occupation',$last_id)";

                if ($this->conn->query($sqlDetails)){

                }else{
                    $ret["isSuccess"] = true;
                    $ret["errorMessage"] = $this->conn->error;
                    die("Error creating user: " . $this->conn->error);
                }
            }
            
        } else {
            $ret["isSuccess"] = true;
            $ret["errorMessage"] = $this->conn->error;
            die("Error creating user: " . $this->conn->error);
        }

        return $ret;
    }
    public function checkIfMember($sr_id){
        $sql = "SELECT * FROM `senior` WHERE sr_id = '$sr_id' and `status` = 3";

        if($result = $this->conn->query($sql)){
            // expecting one row only
            $row = $result->num_rows;
            return $row > 0;
            exit;
        }
        
    }
    public function getAllPWDBYidno($id_no){
        $sql = "SELECT * FROM `pwd` where id_no = '$id_no'";
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }
}

?>