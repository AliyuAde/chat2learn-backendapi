<?php

class  Query {
        
        public $dbConn;
        public function __construct(){
            $db = new DbConnect;
            $this->dbConn = $db->connect();

        }
        public function saveChats($from, $msg, $to){
            return true;

        }

        
        public function getAllTeachers(){
            $stmt = $this->dbConn->prepare("SELECT * FROM `teachers` ORDER BY `id` ");
            $stmt->execute();
            $teachers = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $teachers;
           
        }

        public function getSubjectByTeacher($teacher_id){
            $stmt = $this->dbConn->prepare("SELECT * FROM `subjects` INNER JOIN `teachers_subject` ON `subject`.`id` = `teachers_subject`.`subject_id`  WHERE `teacher_id` = :id ORDER BY `subject`.`name` ASC");
            $stmt->execute(array(':id'=> $teacher_id));
            $teacher_id = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $teacher_id;    
        }

        public function count_ratings($teacher_id){
            $stmt = $this->dbConn->prepare("SELECT count(*) FROM `ratings` WHERE teacher_id = $teacher_id ");
            $stmt->execute();
            $rating_count = $stmt->fetchColumn(); 
            return $rating_count;
        }

        public function sum_ratings($teacher_id){
            $stmt = $this->dbConn->prepare("SELECT sum(rating) FROM `ratings` WHERE teacher_id = $teacher_id ");
            $stmt->execute();
            $rating_sum = $stmt->fetchColumn(); 
            return $rating_sum;
        }

       
        
        public function addChat($user_from, $user_to, $user_msg){
                $user_froms = $user_from;
                $user_tos = $user_to;
                $user_msgs = $user_msg;

               $stmt = $this->dbConn->prepare("INSERT INTO chat_chats  (user_from, user_to, msg) VALUES (:user_from, :user_to, :user_msg) ");
               $stmt->bindParam(':user_from', $user_froms);
               $stmt->bindParam(':user_to', $user_tos);
               $stmt->bindParam(':user_msg', $user_msgs);
                $stmt->execute();
                //$result = $this->pdo->lastInsertId();
                //$stmt = null;
                if($stmt){ 
                    return true;
                }else{
                    return false;
                }
               
                
    
        }

        public function addSubject($name, $class){
            $sname = $name;
            $classes = $class;
          

           $stmt = $this->dbConn->prepare("INSERT INTO chat_subjects  (sname, class) VALUES (:sname, :class) ");
           $stmt->bindParam(':sname', $sname);
           $stmt->bindParam(':class', $classes);
           $stmt->execute();
            //$result = $this->pdo->lastInsertId();
            //$stmt = null;
            if($stmt){ 
                return true;
            }else{
                return false;
            }         
            

        }
        function online(){
            global $con;
            global $app;
            $cur_user = (int)$app->user['id'];
            
            $newtimestamp = strtotime(date("Y-m-d H:i:s").' - 7 MINUTE');
            $_date_time = date("Y-m-d H:i:s", $newtimestamp);
            
            $now_date_time = date("Y-m-d H:i:s");
        
            //query("UPDATE chat_users SET status = 0 WHERE lastOnline <= '$_date_time'", false);
            //query("UPDATE chat_users SET status = 1, lastOnline = '$now_date_time' WHERE id = $cur_user", false);
        }

        public function addChatUser($firstname, $lastname, $email, $password, $push_id, $photo, $type, $city, $country, $phone, $school, $education, $career_experience, $bio, $other_interests, $status, $lastOnline){
            $firstnames = $firstname;
            $lastnames = $lastname;
            $emails = $email;
            $passwords = MD5($password);
            $push_ids = $push_id;
            $photos = $photo;
            $types = $type;
            $citys = $city;
            $countrys = $country;
            $phones = $phone;
            $schools = $school;
            $educations = $education;
            $career_experiences = $career_experience;
            $bios = $bio;
            $other_interest = $other_interests;
            $statu = $status;
            $lastOnlines = $lastOnline;
          

            $stmt = $this->dbConn->prepare("INSERT INTO chat_users  (firstname, lastname, email, password, push_id, photo, type, city, country, phone, school, education, career_experience, bio, other_interests, status, lastOnline) VALUES (:firstname, :lastname, :email, :password, :push_id, :photo, :type, :city, :country, :phone, :school, :education, :career_experience, :bio, :other_interests, :status, :lastOnline) ");

            $stmt->bindParam(':firstname', $firstnames);
            $stmt->bindParam(':lastname', $lastnames);
            $stmt->bindParam(':email', $emails);
            $stmt->bindParam(':password', $passwords);
            $stmt->bindParam(':push_id', $push_ids);
            $stmt->bindParam(':photo', $photos);
            $stmt->bindParam(':type', $types);
            $stmt->bindParam(':city', $citys);
            $stmt->bindParam(':country', $countrys);
            $stmt->bindParam(':phone', $phones);
            $stmt->bindParam(':school', $schools);
            $stmt->bindParam(':education', $educations);
            $stmt->bindParam(':career_experience', $career_experiences);
            $stmt->bindParam(':bio', $bios);
            $stmt->bindParam(':other_interests', $other_interest);
            $stmt->bindParam(':status', $statu);
            $stmt->bindParam(':lastOnline', $lastOnlines);

            $stmt->execute();
             //$result = $this->pdo->lastInsertId();
                //$stmt = null;
                if($stmt){ 
                    return true;
                }else{
                    return false;
                }
               
        }

     
}