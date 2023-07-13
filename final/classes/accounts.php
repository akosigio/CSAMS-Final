<?php
require_once "database.php";
class accounts extends DatabaseAccount {
    public function createUser($username, $userpassword, $user_type, $name, $course, $year,  $number, $idno){
        $password = password_hash($userpassword, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO `users`(`username`, `password`, `name`, `course`, `year`, `usertype`, `status`, `createdDate`, `number`, `id_no`) 
        VALUES ('$username','$password','$name','$course','$year','$user_type','1',CURDATE(),'$number', '$idno')";

        // EXECUTE THE QUERY
        $ret["isSuccess"] = true;
        $ret["errorMessage"] = "";
        if($this->conn->query($sql)){                 
        } else {
            $ret["isSuccess"] = false;
            $ret["errorMessage"] = $this->conn->error;
        }
        return json_encode($ret);
    }

    public function startClasses($uid, $sid){
        $check = "Select * FROM `classes` WHERE date = CURRENT_DATE() AND teacher_id = '$uid' and subject_id = '$sid'";
        $isExists = $this->conn->query($check);
        
        $ret["isSuccess"] = true;
        $ret["errorMessage"] = "";
        
        if (mysqli_num_rows($isExists) == 0){
            $getStudent = "INSERT INTO `classes`(`date`, `stud_id`, `subject_id`, `status`, `teacher_id`, `timein`, `timeout`)
                           Select CURRENT_DATE(), studid, '$sid', '0', '$uid',0,(Select timeto from subject where subject.id = studentsubject.subjectid) from `studentsubject` where subjectid = '$sid'
                           and (select `status` from `users` where `users`.id = studid) = 1
                           ";
            if($this->conn->query($getStudent)){                 
            } else {
                $ret["isSuccess"] = false;
                $ret["errorMessage"] = $this->conn->error;
            }
        }
        return json_encode($ret);
    }

    public function presentAttendance($sid, $tid){
        if (!isset($_SESSION)){ session_start(); }
        $uid = $_SESSION["acount_user_id"];
        
        $check = "SELECT * from `classes` WHERE `date` = CURRENT_DATE() 
        and subject_id = '$sid' and teacher_id = '$tid' and stud_id = '$uid' and `status` = '1'";
        
        $isExists = $this->conn->query($check);

        $ret["isSuccess"] = true;
        $ret["errorMessage"] = "";
        $count = mysqli_num_rows($isExists);
        if(mysqli_num_rows($isExists) == 0){   
            date_default_timezone_set('Asia/Manila');
            $cur_time = date("h:i:s");
            $sql = "UPDATE `classes` set `status` = '1', timein = '$cur_time' WHERE `date` = CURRENT_DATE() 
                and subject_id = '$sid' and teacher_id = '$tid' and stud_id = '$uid'";
            if($this->conn->query($sql)){                    
            } else {
                $ret["isSuccess"] = false;
                $ret["errorMessage"] = $this->conn->error;
            }                 
        } else {
            $ret["isSuccess"] = false;
            $ret["errorMessage"] = "You're already present on this class, please ask your teacher";
        }
        
        return json_encode($ret);
    }

    public function presentAttendanceManual($sid, $stud_id){
        if (!isset($_SESSION)){ session_start(); }
        $tid = $_SESSION["acount_user_id"];
        
        $check = "SELECT * from `classes` WHERE `date` = CURRENT_DATE() 
        and subject_id = '$sid' and teacher_id = '$tid' and stud_id = '$stud_id' and `status` = '1'";
        
        $isExists = $this->conn->query($check);

        $ret["isSuccess"] = true;
        $ret["errorMessage"] = "";
        $count = mysqli_num_rows($isExists);
        if(mysqli_num_rows($isExists) == 0){   
            date_default_timezone_set('Asia/Manila');
            $cur_time = date("h:i:s");
            $sql = "UPDATE `classes` set `status` = '1', timein = '$cur_time' WHERE `date` = CURRENT_DATE() 
                and subject_id = '$sid' and teacher_id = '$tid' and stud_id = '$stud_id'";
            if($this->conn->query($sql)){                    
            } else {
                $ret["isSuccess"] = false;
                $ret["errorMessage"] = $this->conn->error;
            }                 
        } else {
            $ret["isSuccess"] = false;
            $ret["errorMessage"] = "You're already present on this class, please ask your teacher";
        }
        
        return json_encode($ret);
    }


    public function updateUser($user_password, $name, $course, $year,  $number, $id, $idno){
        $sql = "";
        if ($user_password == ""){
            $sql = "UPDATE users SET `name` = '$name', name = '$name', course = '$course', year ='$year', `number`='$number', `id_no`='$idno' WHERE `id` = $id";
        }else{
            $user_password = password_hash($user_password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET `password`='$user_password', `name` = '$name', name = '$name', course = '$course', year ='$year', `number`='$number', `id_no`='$idno' WHERE `id` = $id";
        }

        $ret["isSuccess"] = true;
        $ret["errorMessage"] = "";
        if($this->conn->query($sql)){                    
        } else {
            $ret["isSuccess"] = false;
            $ret["errorMessage"] = $this->conn->error;
        }
        return json_encode($ret);
    }


    public function submitPayment($sid, $date, $amount){
        $sql = "INSERT INTO `damayan`(`date`, `amount`, `senior_id`) VALUES ('$date','$amount','$sid')";

        // EXECUTE THE QUERY
        if($this->conn->query($sql)){
            // REDIRECT
            return "success";   // go to index.php of views folder
            exit;                           // same as die()
        } else {
            die("Error creating user: " . $this->conn->error);
            return $this->conn->error;
        }
    }
    
    public function createStudentSubject($studid, $subjectid){
        $sql = "INSERT INTO `studentsubject`(`studid`, `subjectid`) 
                VALUES ('$studid','$subjectid')";

        if ($queryRes = $this->conn->query($sql)) {
            return 1;
            exit;
        }else{
            return 0;
            exit;
        }
    }

    public function addUpdateSurvey($id, $descriptionEng, $descriptionTag, $column){
        $name = str_replace("'","''",$name);
        $sql =  "";
        if ($id > 0){
            $sql = "UPDATE `survey` SET `description` = '$descriptionEng', `descriptiontag`='$descriptionTag', `column` = '$column' where id = $id";
        }else{
            $sql = "INSERT INTO `survey`(`description`, `createdDate`,`descriptiontag`,`column`) 
            VALUES ('$descriptionEng',CURDATE(), '$descriptionTag','$column')";
        }

        // EXECUTE THE QUERY
        if ($queryRes = $this->conn->query($sql)) {
            return 1;
            exit;
        }else{
            return 0;
            exit;
        }
    }
    public function addUpdatesubject($id, $subjectcode, $subjectname, $unit, $teacher, $timefrom, $timeto, $day){
        $sql =  "";
        if ($id > 0){
            $sql = "UPDATE `subject` SET `subjectcode`='$subjectcode',`subjectname`='$subjectname',`unit`='$unit',`timefrom`='$timefrom',`timeto`='$timeto',`teacher_id`='$teacher', `day`='$day' WHERE  id = $id";
        }else{
            $sql = "INSERT INTO `subject`(`subjectcode`, `subjectname`, `unit`, `timefrom`, `timeto`, `teacher_id`,`day`) 
                    VALUES ('$subjectcode','$subjectname','$unit','$timefrom','$timeto','$teacher', '$day')";
        }

        // EXECUTE THE QUERY
        if ($queryRes = $this->conn->query($sql)) {
            return 1;
            exit;
        }else{
            return 0;
            exit;
        }
    }

    public function addUpdateBanner($id, $title, $url, $description, $img){
        $title = str_replace("'","''",$title);
        $url = str_replace("'","''",$url);
        $description = str_replace("'","''",$description);
        $sql =  "";
        if ($id > 0){
            if ($img == ""){
                $sql = "UPDATE `banner` SET `title` = '$title', `url` = '$url', `description` = '$description' where id = $id";
            }else{
                $sql = "UPDATE `banner` SET `title` = '$title', `url` = '$url', `description` = '$description', `img` = '$img' where id = $id";
            }            
        }else{
            $sql = "INSERT INTO `banner`(`title`, `description`, `url`, `img`) 
                VALUES ('$title','$description','$url','$img')";
        }

        // EXECUTE THE QUERY
        if ($queryRes = $this->conn->query($sql)) {
            return 1;
            exit;
        }else{
            return 0;
            exit;
        }
    }
    public function checkIfExisting($user_name){
        $user_name = str_replace("'","''",$user_name);
        $sql = "SELECT * FROM users WHERE username = '$user_name'";

        if($result = $this->conn->query($sql)){
            // expecting one row only
            $row = $result->num_rows;
            return $row > 0;
            exit;
        }
        
    }

    public function checkIfIDExisting($id_no){
        $user_name = str_replace("'","''",$user_name);
        $sql = "SELECT * FROM users WHERE id_no = '$id_no'";

        if($result = $this->conn->query($sql)){
            // expecting one row only
            $row = $result->num_rows;
            return $row > 0;
            exit;
        }
        
    }

    public function deleteannouncement($id){
        $query = "DELETE from `announcement` where id = $id";
        if($result = $this->conn->query($query)){
            
        }else{
            return false;
            exit;
        }
        
    }
    public function deleteSubjectByStudId($id){
        $query = "DELETE from `studentsubject` where id = $id";
        if($result = $this->conn->query($query)){
            
        }else{
            return false;
            exit;
        }
        
    }
    public function deleteUser($id){
        $query = "UPDATE `users` SET `status`='0' where id = $id";
        if($result = $this->conn->query($query)){
            return true;
        }else{
            return false;
            exit;
        }
        
    }

    public function deleteSubject($id){
        $query = "DELETE from `subject` where id = $id";
        if($result = $this->conn->query($query)){
            return true;
        }else{
            return false;
            exit;
        }
        
    }

    public function deleteSurvey($id){
        $query = "DELETE from `survey` where id = $id";
        if($result = $this->conn->query($query)){
            return true;
        }else{
            return false;
            exit;
        }
        
    }

    public function deleteBanner($id){
        $query = "DELETE from `banner` where id = $id";
        if($result = $this->conn->query($query)){
            
        }else{
            return false;
            exit;
        }
        
    }

    public function updateSrRegistrationStatus($id, $status){
        $query = "Update `senior` set `status`=$status where id = $id";
        if($result = $this->conn->query($query)){
            return true;
        }else{
            return false;
            exit;
        }
        
    }
    public function updatePWDStatus($id, $status){
        $query = "Update `pwd` set `status`=$status, date=CURDATE() where id = $id";
        if($result = $this->conn->query($query)){
            return true;
        }else{
            return false;
            exit;
        }
        
    }
    public function updateSReplacementStatus($id, $status){
        $query = "Update `replacement` set `status`=$status where id = $id";
        if($result = $this->conn->query($query)){
            return true;
        }else{
            return false;
            exit;
        }
        
    }

    public function updateSrRegistrationStatusPPD($id, $type){
        $query = "";
        if ($type == 5){
            $query = "Update `senior` set `damayan`= CASE `damayan` WHEN 1 then 0 else 1 END where id = $id";
        }else if ($type == 6){
            $query = "Update `senior` set `philhealth`= CASE `philhealth` WHEN 1 then 0 else 1 END where id = $id";
        }else if ($type == 7){
            $query = "Update `senior` set `pension`= CASE `pension` WHEN 1 then 0 else 1 END where id = $id";
        }
        if($result = $this->conn->query($query)){
            return true;
        }else{
            return false;
            exit;
        }
        
    }

    public function updateSPRegistrationStatus($id, $status){
        if ($status == 2){
            $query = "Update `solo_parent` set `status`=$status and `registeration_date` = CURDATE() where id = $id";
        }else{
            $query = "Update `solo_parent` set `status`=$status where id = $id";
        }
        
        if($result = $this->conn->query($query)){
            return true;
        }else{
            return false;
            exit;
        }
        
    }

    public function updatePresident($id, $brgy){
        $queryAll = "Update `senior` set `president`=0 where `barangay`= '$brgy'";
        $query = "Update `senior` set `president`=1 where id = $id";
        if($result = $this->conn->query($queryAll)){
            if($result = $this->conn->query($query)){
                return true;
            }else{
                return false;
                exit;
            }
        }else{
            return false;
            exit;
        }
        
    }

    public function getAllUser($type){
        $sql = "";
        $sql = "SELECT * FROM `users` where usertype = '$type' and `status`='1' order by id desc";
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
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

    public function getAllMyStudentBySubjectandTeacher($uid, $sid){
        $sql = "";
        $sql = "Select *,`classes`.status from `classes` inner join `users` on `users`.id = `classes`.`stud_id` WHERE date = CURRENT_DATE() AND teacher_id = '$uid' and subject_id = '$sid' and `users`.status = '1'";
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }

    public function getSubjectByStudId($id){
        $sql = "";
        $sql = "SELECT *,`ss`.id FROM `studentsubject` as ss LEFT JOIN `subject` as s on `s`.`id` = `ss`.`subjectid`
                inner join `users` u on `u`.id = `s`.teacher_id where `studid`= $id";
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }

    public function getStudendBySubject($sid){
        $sql = "";
        $sql = "SELECT * FROM `studentsubject` inner join `users` on `users`.id = `studentsubject`.`studid` WHERE `studentsubject`.`subjectid` = '$sid' and `users`.status = 1  order by `users`.`name` DESC";
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }

    public function attendanceHistory(){
        if (!isset($_SESSION)){ session_start(); }
        $uid = $_SESSION["acount_user_id"];
        $sql = "Select *,`classes`.status from `classes` inner JOIN `subject` on `subject`.`id` = `classes`.`subject_id`
                inner join `users` on `users`.id = `classes`.`teacher_id` where `classes`.`stud_id` = '$uid' order by `classes`.`date` DESC";
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }

    public function classHistory(){
        if (!isset($_SESSION)){ session_start(); }
        $tid = $_SESSION["acount_user_id"];
        $sql = "Select *,`subject`.id as sid from 
                (Select teacher_id, date, subject_id from classes GROUP BY teacher_id, date, subject_id ) as c
                inner JOIN `subject` on `subject`.`id` = c.`subject_id` where c.teacher_id = '$tid' order by c.`date` DESC";
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }

    public function mySubject(){
        if (!isset($_SESSION)){ session_start(); }
        $tid = $_SESSION["acount_user_id"];
        $sql = "SELECT * FROM `subject` where teacher_id = '$tid'";
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }

    public function mySubjectToday(){
        if (!isset($_SESSION)){ session_start(); }
        $uid = $_SESSION["acount_user_id"];
        $sql = "SELECT * FROM `studentsubject` inner join `subject` on `studentsubject`.subjectid = `subject`.id  where studid = '$uid'";
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }   

    public function mySubjectStudentCount(){
        if (!isset($_SESSION)){ session_start(); }
        $uid = $_SESSION["acount_user_id"];
        $sql = "SELECT * FROM `studentsubject` inner join `subject` on `studentsubject`.subjectid = `subject`.id  where studid = '$uid'";
        
        if($result = $this->conn->query($sql)){
            $count = 0;
            while($row = $result->fetch_assoc()){ 
                date_default_timezone_set('Asia/Manila');
                if (strtoupper(date('l')) == strtoupper($row["day"])){ 
                    ++$count;
                }
            }
            return $count;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }


    public function todaySubject(){
        if (!isset($_SESSION)){ session_start(); }
        $tid = $_SESSION["acount_user_id"];
        $sql = "SELECT * FROM `subject` where teacher_id = '$tid'";
        
        if($result = $this->conn->query($sql)){
            $count = 0;
            while($row = $result->fetch_assoc()){ 
                date_default_timezone_set('Asia/Manila');
                if (strtoupper(date('l')) == strtoupper($row["day"])){ 
                    ++$count;
                }
            }
            return $count;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }

    public function getAllsubject($id){
        $sql = "";
        if ($id == 0){
            $sql = "SELECT *,`subject`.id FROM `subject` left join `users` on `users`.id = `subject`.teacher_id order by `subject`.id desc";
        }else{
            $sql = "SELECT *,`subject`.id FROM `subject` left join `users` on `users`.id = `subject`.teacher_id where `subject`.id = $id";
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

    public function CountSurvery($isStudent){
        $sql = "";
        if ($isStudent == 0){
            $sql = "SELECT *,`subject`.id FROM `subject` left join `users` on `users`.id = `subject`.teacher_id order by `subject`.id desc";
        }else{
            $sql = "SELECT *,`subject`.id FROM `subject` left join `users` on `users`.id = `subject`.teacher_id where `subject`.id = $id";
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

    public function getUserbyId($id){
        $sql = "";
        $sql = "SELECT * FROM `users` where `id`= $id";
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }
    
    public function getAllPWD($id, $type){
        if ($id == 0){
            if ($type == 3){
                $sql = "SELECT * FROM `pwd` where `status` in (3,8) and DATE_ADD(`date`, INTERVAL 1 YEAR) > CURDATE() order by id desc";
            }else if ($type == 6){
                $sql = "SELECT * FROM `pwd` where DATE_ADD(`date`, INTERVAL 1 YEAR) < CURDATE() and `status`=3  order by id desc";
            }else{
                $sql = "SELECT * FROM `pwd` where `status`=$type order by id desc";
            }
        }else{
            $sql = "SELECT * FROM `pwd` where id = $id order by id desc";
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

    public function submitSurvey_student($survey){
        if (!isset($_SESSION)){ session_start(); }
        $uid = $_SESSION["acount_user_id"];
        $sql = "INSERT INTO `student_survey`( `user_id`, `date`) VALUES ('$uid',CURRENT_DATE())";
        // EXECUTE THE QUERY
        $ret["isSuccess"] = true;
        $ret["errorMessage"] = "";
        if($result = $this->conn->query($sql)){
            $last_id = $this->conn->insert_id;  
            foreach ($survey as $d) {
                $id = $d["id"];
                $sqlDetails = "INSERT INTO `student_survey_details`(`survey_id`, `student_survey_id`) 
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

    public function getAllSubmitSurvey($type){
        if ($type == 1){
            $sql = "Select *,student_survey.id,
                    (Select count(*) from `student_survey_details` WHERE student_survey_id = student_survey.id) as 'survey'
                    from student_survey inner join users on `users`.`id` = student_survey.user_id order by student_survey.date desc";
        }else if ($type == 2){
            $sql = "Select * ,
                    (Select COUNT(*) from surveysubmit where visitor_id = visitor.id) as 'survey'
                    from visitor ORDER by visitor.date desc";
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

    public function getdetailsurvey($type, $id){
        $sql = "";
        if ($type == 1){
            $sql = "Select *,student_survey.id
                    from student_survey inner join users on `users`.`id` = student_survey.user_id where `student_survey`.id = '$id' order by student_survey.date desc";
        }else if ($type == 2){
            $sql = "Select * from visitor where id = '$id'";
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

    public function getSymptoms($type, $id){
        if ($type == 1){
            $sql = "Select * from student_survey_details INNER JOIN survey on survey.id = student_survey_details.survey_id where student_survey_id = '$id'";
        }else if ($type == 2){
            $sql = "Select *
                    from surveysubmit INNER JOIN survey on survey.id = surveysubmit.survey_id where surveysubmit.visitor_id = '$id'";
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

    public function getAllsenior($id, $type){
        if ($id == 0){
            if ($type == 3){
                $sql = "SELECT * FROM `senior` where `status` in (3,8) order by id desc";
            }else{
                $sql = "SELECT * FROM `senior` where `status`=$type order by id desc";
            }
        }else{
            $sql = "SELECT * FROM `senior` where id = $id order by id desc";
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

    

    public function getSrDetails($id){
        $sql = "SELECT * FROM `senior_details` where `senior_id` = $id order by id desc";
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }

    public function getAllReplacement($id, $type){
        if ($id == 0){
            if ($type == 3){
                $sql = "SELECT *, (Select `number` from `senior` where `sr_id`= `id_no`) as 'number' FROM `replacement` where `status` in (3,8) order by id desc";
            }else{
                $sql = "SELECT *, (Select `number` from `senior` where `sr_id`= `id_no`) as 'number' FROM `replacement` where `status`=$type order by id desc";
            }
        }else{
            $sql = "SELECT *, (Select `number` from `senior` where `sr_id`= `id_no`) as 'number', (Select `id` from `senior` where `sr_id`= `id_no`) as 'sr_id' FROM `replacement` where id = $id order by id desc";
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

    public function getAllseniorByBrgy($brgy){
        $sql = "SELECT * FROM `senior` where `barangay` = '$brgy' order by id desc";
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }

    public function getAlldamayanHistoryById($sid){
        $sql = "SELECT * FROM `damayan` where `senior_id` = $sid order by `date` desc";
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }

    public function getsrByDetailsid($id){
        $sql = "SELECT * FROM `senior` where `id` = $id";
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }


    public function getBrgyStatistic($type){
        if ($type == 1){
            $sql = "Select 
                    B.barangay,
                    IFNULL(CONCAT((Select count(*) from `senior` where `senior`.`barangay` = B.barangay and status = 3), '    -   ',
                    TRUNCATE(((Select count(*) from `senior` where `senior`.`barangay` = B.barangay and status = 3) * 100)/
                    (Select count(*) from `senior` WHERE status = 3),0)
                    ,'%'),'0 - 0%') as 'member',
                    
                    IFNULL(CONCAT((Select count(*) from `senior` where `senior`.`barangay` = B.barangay and status = 3 and `damayan` = 1), '    -   ',
                    TRUNCATE(((Select count(*) from `senior` where `senior`.`barangay` = B.barangay and status = 3 and `damayan` = 1) * 100)/
                    (Select count(*) from `senior` where `damayan` = 1 and status = 3),0)
                    ,'%'),'0 - 0%') as 'damayan',
                    
                    IFNULL(CONCAT((Select count(*) from `senior` where `senior`.`barangay` = B.barangay and status = 3 and `senior`.`philhealth` = 1), '    -   ',
                    TRUNCATE(((Select count(*) from `senior` where `senior`.`barangay` = B.barangay and status = 3 and `senior`.`philhealth` = 1) * 100)/
                    (Select count(*) from `senior` where `senior`.`philhealth` = 1),0)
                    ,'%'),'0 - 0%') as 'philhealth',
                    
                    IFNULL(CONCAT((Select count(*) from `senior` where `senior`.`barangay` = B.barangay and status = 3 and `pension` = 1), '    -   ',
                    TRUNCATE(((Select count(*) from `senior` where `senior`.`barangay` = B.barangay and status = 3 and `pension` = 1) * 100)/
                    (Select count(*) from `senior` where `pension` = 1 and status = 3),0)
                    ,'%'),'0 - 0%') as 'pension',
                    
                    IFNULL(CONCAT((Select count(*) from `senior` where `senior`.`barangay` = B.barangay and status = 3 and `senior`.`age` BETWEEN 60 and 70), '    -   ',
                    TRUNCATE(((Select count(*) from `senior` where `senior`.`barangay` = B.barangay and status = 3 and `senior`.`age` BETWEEN 60 and 70) * 100)/
                    (Select count(*) from `senior` where `senior`.`age` BETWEEN 60 and 70 and status = 3),0)
                    ,'%'),'0 - 0%') as 'sixty',
                    
                    IFNULL(CONCAT((Select count(*) from `senior` where `senior`.`barangay` = B.barangay and status = 3 and `senior`.`age` BETWEEN 71 and 80), '    -   ',
                    TRUNCATE(((Select count(*) from `senior` where `senior`.`barangay` = B.barangay and status = 3 and `senior`.`age` BETWEEN 71 and 80) * 100)/
                    (Select count(*) from `senior` where `senior`.`age` BETWEEN 71 and 80 and status = 3),0)
                    ,'%'),'0 - 0%') as 'seventy',
                    
                    IFNULL(CONCAT((Select count(*) from `senior` where `senior`.`barangay` = B.barangay and status = 3 and `senior`.`age` BETWEEN 81 and 90), '    -   ',
                    TRUNCATE(((Select count(*) from `senior` where `senior`.`barangay` = B.barangay and status = 3 and `senior`.`age` BETWEEN 81 and 90) * 100)/
                    (Select count(*) from `senior` where `senior`.`age` BETWEEN 81 and 90 and status = 3),0)
                    ,'%'),'0 - 0%') as 'eighty',
                    
                    IFNULL(CONCAT((Select count(*) from `senior` where `senior`.`barangay` = B.barangay and status = 3 and `senior`.`age` BETWEEN 91 and 100), '    -   ',
                    TRUNCATE(((Select count(*) from `senior` where `senior`.`barangay` = B.barangay and status = 3 and `senior`.`age` BETWEEN 91 and 100) * 100)/
                    (Select count(*) from `senior` where `senior`.`age` BETWEEN 91 and 100 and status = 3),0)
                    ,'%'),'0 - 0%') as 'ninety',
                    
                    IFNULL(CONCAT((Select count(*) from `senior` where `senior`.`barangay` = B.barangay and status = 3 and `senior`.`age` BETWEEN 101 and 110), '    -   ',
                    TRUNCATE(((Select count(*) from `senior` where `senior`.`barangay` = B.barangay and status = 3 and `senior`.`age` BETWEEN 101 and 110) * 100)/
                    (Select count(*) from `senior` where `senior`.`age` BETWEEN 101 and 110 and status = 3),0)
                    ,'%'),'0 - 0%') as 'hundred'
                    
                    from `brgy` as B
                    order by B.barangay";
        }else if ($type == 2){
            $sql = "Select 
                    B.barangay,
                    IFNULL(CONCAT((Select count(*) from `solo_parent` where `solo_parent`.`brgy` = B.barangay and status = 3), '    -   ',
                    TRUNCATE(((Select count(*) from `solo_parent` where `solo_parent`.`brgy` = B.barangay and status = 3) * 100)/
                    (Select count(*) from `solo_parent` WHERE status = 3),0)
                    ,'%'),'0 - 0%') as 'member',
                    
                    IFNULL(CONCAT((Select count(*) from `solo_parent` where `solo_parent`.`brgy` = B.barangay and status = 3 and `solo_parent`.`age` BETWEEN 11 and 20), '    -   ',
                    TRUNCATE(((Select count(*) from `solo_parent` where `solo_parent`.`brgy` = B.barangay and status = 3 and `solo_parent`.`age` BETWEEN 11 and 20) * 100)/
                    (Select count(*) from `solo_parent` where `solo_parent`.`age` BETWEEN 11 and 20 and status = 3),0)
                    ,'%'),'0 - 0%') as 'twenty',
                    
                    IFNULL(CONCAT((Select count(*) from `solo_parent` where `solo_parent`.`brgy` = B.barangay and status = 3 and `solo_parent`.`age` BETWEEN 21 and 30), '    -   ',
                    TRUNCATE(((Select count(*) from `solo_parent` where `solo_parent`.`brgy` = B.barangay and status = 3 and `solo_parent`.`age` BETWEEN 21 and 30) * 100)/
                    (Select count(*) from `solo_parent` where `solo_parent`.`age` BETWEEN 21 and 30 and status = 3),0)
                    ,'%'),'0 - 0%') as 'thirty',
                    
                    IFNULL(CONCAT((Select count(*) from `solo_parent` where `solo_parent`.`brgy` = B.barangay and status = 3 and `solo_parent`.`age` BETWEEN 31 and 40), '    -   ',
                    TRUNCATE(((Select count(*) from `solo_parent` where `solo_parent`.`brgy` = B.barangay and status = 3 and `solo_parent`.`age` BETWEEN 31 and 40) * 100)/
                    (Select count(*) from `solo_parent` where `solo_parent`.`age` BETWEEN 31 and 40 and status = 3),0)
                    ,'%'),'0 - 0%') as 'fourty',
                    
                    IFNULL(CONCAT((Select count(*) from `solo_parent` where `solo_parent`.`brgy` = B.barangay and status = 3 and `solo_parent`.`age` BETWEEN 41 and 50), '    -   ',
                    TRUNCATE(((Select count(*) from `solo_parent` where `solo_parent`.`brgy` = B.barangay and status = 3 and `solo_parent`.`age` BETWEEN 41 and 50) * 100)/
                    (Select count(*) from `solo_parent` where `solo_parent`.`age` BETWEEN 41 and 50 and status = 3),0)
                    ,'%'),'0 - 0%') as 'fifty',
                    
                    IFNULL(CONCAT((Select count(*) from `solo_parent` where `solo_parent`.`brgy` = B.barangay and status = 3 and `solo_parent`.`age` BETWEEN 51 and 60), '    -   ',
                    TRUNCATE(((Select count(*) from `solo_parent` where `solo_parent`.`brgy` = B.barangay and status = 3 and `solo_parent`.`age` BETWEEN 51 and 60) * 100)/
                    (Select count(*) from `solo_parent` where `solo_parent`.`age` BETWEEN 51 and 60 and status = 3),0)
                    ,'%'),'0 - 0%') as 'sixty'
                    
                    from `brgy` as B
                    order by B.barangay";
        }else if ($type == 3){
            $sql = "Select 
                    B.barangay,
                    IFNULL(CONCAT((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3), '    -   ',
                    TRUNCATE(((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3) * 100)/
                    (Select count(*) from `pwd` WHERE status = 3),0)
                    ,'%'),'0 - 0%') as 'member',
                    
                    
                    IFNULL(CONCAT((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 0 and 10), '    -   ',
                    TRUNCATE(((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 0 and 10) * 100)/
                    (Select count(*) from `pwd` where `pwd`.`age` BETWEEN 0 and 10 and status = 3),0)
                    ,'%'),'0 - 0%') as 'ten',
                    
                    IFNULL(CONCAT((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 11 and 20), '    -   ',
                    TRUNCATE(((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 11 and 20) * 100)/
                    (Select count(*) from `pwd` where `pwd`.`age` BETWEEN 11 and 20 and status = 3),0)
                    ,'%'),'0 - 0%') as 'twenty',
                    
                    IFNULL(CONCAT((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 21 and 30), '    -   ',
                    TRUNCATE(((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 21 and 30) * 100)/
                    (Select count(*) from `pwd` where `pwd`.`age` BETWEEN 21 and 30 and status = 3),0)
                    ,'%'),'0 - 0%') as 'thirty',
                    
                    IFNULL(CONCAT((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 31 and 40), '    -   ',
                    TRUNCATE(((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 31 and 40) * 100)/
                    (Select count(*) from `pwd` where `pwd`.`age` BETWEEN 31 and 40 and status = 3),0)
                    ,'%'),'0 - 0%') as 'fourty',
                    
                    IFNULL(CONCAT((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 41 and 50), '    -   ',
                    TRUNCATE(((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 41 and 50) * 100)/
                    (Select count(*) from `pwd` where `pwd`.`age` BETWEEN 41 and 50 and status = 3),0)
                    ,'%'),'0 - 0%') as 'fifty',
                    
                    IFNULL(CONCAT((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 51 and 60), '    -   ',
                    TRUNCATE(((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 51 and 60) * 100)/
                    (Select count(*) from `pwd` where `pwd`.`age` BETWEEN 51 and 60 and status = 3),0)
                    ,'%'),'0 - 0%') as 'sixty',
                    
                    IFNULL(CONCAT((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 61 and 70), '    -   ',
                    TRUNCATE(((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 61 and 70) * 100)/
                    (Select count(*) from `pwd` where `pwd`.`age` BETWEEN 61 and 70 and status = 3),0)
                    ,'%'),'0 - 0%') as 'seventy',
                    
                    IFNULL(CONCAT((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 71 and 80), '    -   ',
                    TRUNCATE(((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 71 and 80) * 100)/
                    (Select count(*) from `pwd` where `pwd`.`age` BETWEEN 71 and 80 and status = 3),0)
                    ,'%'),'0 - 0%') as 'eighty',
                    
                    IFNULL(CONCAT((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 81 and 90), '    -   ',
                    TRUNCATE(((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 81 and 90) * 100)/
                    (Select count(*) from `pwd` where `pwd`.`age` BETWEEN 81 and 90 and status = 3),0)
                    ,'%'),'0 - 0%') as 'ninety',
                    
                    IFNULL(CONCAT((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 91 and 100), '    -   ',
                    TRUNCATE(((Select count(*) from `pwd` where `pwd`.`brgy` = B.barangay and status = 3 and `pwd`.`age` BETWEEN 91 and 100) * 100)/
                    (Select count(*) from `pwd` where `pwd`.`age` BETWEEN 91 and 100 and status = 3),0)
                    ,'%'),'0 - 0%') as 'hundred'
                    
                    from `brgy` as B
                    order by B.barangay";
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

    public function getAllSoloParents($id, $type){
        if ($id == 0){
            if ($type == 3){
                $sql = "SELECT * FROM `solo_parent` where `status` in (3,8) order by id desc";
            }else{
                $sql = "SELECT * FROM `solo_parent` where `status`=$type order by id desc";
            }
           
        }else{
            $sql = "SELECT * FROM `solo_parent` where id = $id order by id desc";
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

    public function getAllDamayanByBrgy($brgy){
        $sql = "SELECT *, IFNULL((select sum(amount) from damayan where senior_id = `senior`.id),0) as 'total' FROM  `senior` where `barangay`='$brgy' order by id desc";
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }

    public function getAllSoloParentByBrgy($brgy){
        $sql = "SELECT * FROM `solo_parent` where `brgy`='$brgy' order by id desc";
        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
            exit;
        }
    }

    public function getAllPWDByBrgy($brgy){
        $sql = "SELECT *,DATE_ADD(`date`, INTERVAL 1 YEAR) as 'expiry' FROM `pwd` where `brgy`='$brgy' order by id desc";
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

    public function getUserByType($type){
        if (!isset($_SESSION)){ session_start(); }
        $department = $_SESSION["user_department"];
        $query = "SELECT * FROM `users` as U LEFT JOIN usertypes as ut on ut.id = U.user_type where user_department = $department and user_type = $type";
        if($result = $this->conn->query($query)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
        }
    }

    public function searchByBrgy($brgy){
        $sql = "SELECT * FROM `brgy` WHERE `barangay` like '%$brgy%'";    

        if($result = $this->conn->query($sql)){
            if ($result){
                $return_arr = array();
                while($row = $result->fetch_assoc()){
            
                    $return_arr[] = array("barangay" => $row['barangay']
                                );
                }
                return $return_arr;
                exit;
            }
            
        } else {
            die("Error retrieving all users: " . $this->conn->error);
        }
    }


    public function searchAccounts($username){
        $sql = "Select * from `users` where username like '%$username%'";
        

        if($result = $this->conn->query($sql)){
            // expecting one or more rows
            return $result;
            exit;
        } else {
            die("Error retrieving all users: " . $this->conn->error);
        }
    }

    public function getUser($user_id){
        $sql = "SELECT * FROM users WHERE `userid` = $user_id";

        if($result = $this->conn->query($sql)){
            // expecting one row only
            return $result;
            exit;
        } else {
            die("Error retrieving user: " . $this->conn->error);
        }
    }

    

    public function ActivateDeactivateUser($uid,$status){
        $sql = "UPDATE users SET `status` = '$status' WHERE `userid` = $uid";

        if($this->conn->query($sql)){
            return "success";
            exit;
        } else {
            die("Error updating user: " . $this->conn->error);
            return $this->conn->error;
        }
    }

    public function updateSettings($admin, $nurse, $guard){
        $countSQL = "Select * FROM `setting`";
        $isExists = $this->conn->query($countSQL);
        
        $sql = "";
        if (mysqli_num_rows($isExists) == 0){
            $sql = "INSERT INTO `setting`(`admin`, `nurse`, `guard`)
                        VALUES('$admin', '$nurse', '$guard')";
        }else{
            $sql = "UPDATE `setting` SET `admin`='$admin', `nurse` = '$nurse', guard = '$guard'";
        }
        if($this->conn->query($sql)){   
            $ret["isSuccess"] = true;
            $ret["errorMessage"] = "";   
        } else {
            $ret["isSuccess"] = false;
            $ret["errorMessage"] = $this->conn->error;
        }
        return json_encode($ret);
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
    
}

?>