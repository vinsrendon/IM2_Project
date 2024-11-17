<?php 

class userController{

    function trackStudId(){
        // session_start();
        try {
            $db = new database();
            $con = $db->initDatabase();
            
            $statement = $con->prepare("CALL get_students()");
            $statement->execute();
            $user = $statement->fetchAll();  

            $last_stud_id = 0;

            foreach ($user as $student) {
                $last_stud_id = $student['stud_id'];
            }
            
            $_SESSION['lastsid'] = $last_stud_id;           
        } catch (PDOException $th) {
            throw $th;
        }
    }
    function addUser(){
        try{            
            session_start();
            $this->trackStudId();

            $stud_id = 0;
            /*
            if(substr($_SESSION['lastsid'], 0, 4) == date("Y")){
                isset($_POST['stud_id'])? $stud_id = htmlspecialchars(strip_tags($_POST['stud_id'])) : $stud_id=($_SESSION['lastsid']+1);
            }
            else{
                isset($_POST['stud_id'])? $stud_id = htmlspecialchars(strip_tags($_POST['stud_id'])) : $stud_id= (int)(date("Y") . "0001");                
            }
            */

            if(isset($_POST['stud_id'])){
                $stud_id = htmlspecialchars(strip_tags($_POST['stud_id']));
            }
            else{
                if (substr($_SESSION['lastsid'], 0, 4) == date("Y")) {
                    $stud_id=((int)$_SESSION['lastsid']+1);
                } else {
                    $stud_id= (int)(date("Y") . "0001");
                }                
            }

            $Role = 0;
            if (isset($_POST['Role'])) {
                $Role = htmlspecialchars(strip_tags(string: $_POST['Role']));
            }

            $db = new database();
            $con = $db->initDatabase();
            
            $hashed = password_hash(htmlspecialchars(strip_tags($_POST['stud_pass'])),PASSWORD_BCRYPT);

            $statement = $con->prepare("CALL register_user(
            :stud_id,:stud_pass,:Role,:Flag,
            :fname,:mname,:lname,:DOB,:address,:pnumber,
            :gfname,:gmname,:glname,:gaddress,:gpnumber)");
            $statement->execute([
                'stud_id' => $stud_id,
                'stud_pass' => $hashed,
                'Role' => $Role,
                'Flag' => 1,
                'fname' => htmlspecialchars(strtoupper(strip_tags($_POST['fname']))),
                'mname' => htmlspecialchars(strtoupper(strip_tags($_POST['mname']))),
                'lname' => htmlspecialchars(strtoupper(strip_tags($_POST['lname']))),
                'DOB' => htmlspecialchars(strtoupper(strip_tags($_POST['DOB']))),
                'address' => htmlspecialchars(strtoupper(strip_tags($_POST['address']))),
                'pnumber' => htmlspecialchars(strtoupper(strip_tags($_POST['pnumber']))),
                'gfname' => htmlspecialchars(strtoupper(strip_tags($_POST['gfname']))),
                'gmname' => htmlspecialchars(strtoupper(strip_tags($_POST['gmname']))),
                'glname' => htmlspecialchars(strtoupper(strip_tags($_POST['glname']))),
                'gaddress' => htmlspecialchars(strtoupper(strip_tags($_POST['gaddress']))),
                'gpnumber' => htmlspecialchars(strtoupper(strip_tags($_POST['gpnumber'])))
            ]);

            $this->trackStudId();
            return json_encode(['status' => 'success']);
        }
        catch (PDOException $th) {            
            if ($th->getCode() == 23000) {
                return json_encode(['status' => 'duplicate']);
            } else {
                return json_encode($th);
            }
        }
    }

    function getStudents(){  
        try {
            $db = new database();
            $con = $db->initDatabase();
            
            $statement = $con->prepare("CALL get_students()");
            $statement->execute();
            $user = $statement->fetchAll();          

            session_start();
            $this->trackStudId();
            return json_encode($user);
        } catch (PDOException $th) {
            return json_encode($th);
        }
    }

    function deactStudent(){
        try {
            $db = new database();
            $con = $db->initDatabase();
            
            $statement = $con->prepare("CALL deactivate_user(:user_id)");
            $statement->execute(['user_id'=>$_POST['toDeactivate']]);

            return json_encode(['status' => 'success']);
        } catch (PDOException $th) {
            return json_encode($th);
        }
    }

    function actStudent(){
        try {
            $db = new database();
            $con = $db->initDatabase();
            
            $statement = $con->prepare("CALL reactivate_user(:user_id)");
            $statement->execute(['user_id'=>$_POST['toActivate']]);

            return json_encode(['status' => 'success']);
        } catch (PDOException $th) {
            return json_encode($th);
        }
    }
/*
    function unsetTempData(){
        
        try {
            session_start();

            unset(
                $_SESSION['temp_stud_id'],
                $_SESSION['temp_fname'],
                $_SESSION['temp_mname'],
                $_SESSION['temp_lname'],
                $_SESSION['temp_DOB'],
                $_SESSION['temp_address'],
                $_SESSION['temp_pnumber'],
                $_SESSION['temp_gfname'],
                $_SESSION['temp_gmname'],
                $_SESSION['temp_glname'],
                $_SESSION['temp_gaddress'],
                $_SESSION['temp_gpnumber']
            );

            return json_encode(['status' => 'success']);
        } catch (\Exception $th) {
            return json_encode(['status' => 'error', $th]);
        }
    }
*/
    function getStudentById(){
        try {
            $db = new database();
            $con = $db->initDatabase();
            
            $statement = $con->prepare("CALL get_user(:user_id)");
            $statement->execute(['user_id' => $_POST['user_id']]);
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            
            session_start();
            $_SESSION['temp_stud_id'] = $user['stud_id'];
            $_SESSION['temp_fname'] = $user['fname'];
            $_SESSION['temp_mname'] = $user['mname'];
            $_SESSION['temp_lname'] = $user['lname'];
            $_SESSION['temp_DOB'] = $user['DOB'];
            $_SESSION['temp_address'] = $user['address'];
            $_SESSION['temp_pnumber'] = $user['pnumber'];
            $_SESSION['temp_gfname'] = $user['gfname'];
            $_SESSION['temp_gmname'] = $user['gmname'];
            $_SESSION['temp_glname'] = $user['glname'];
            $_SESSION['temp_gaddress'] = $user['gaddress'];
            $_SESSION['temp_gpnumber'] = $user['gpnumber'];
            
            return json_encode(['status' => 'success', $user]);
        } catch (PDOException $th) {
            return json_encode($th);
        }
    }

    function changePass(){
        try {
            $old_pass = htmlspecialchars(strip_tags($_POST['old_Pass']));
            $hashed = password_hash(htmlspecialchars(strip_tags($_POST['new_Pass'])),PASSWORD_BCRYPT);

            $db = new database();
            $con = $db->initDatabase();
            
            $statement = $con->prepare("CALL login(:stud_id)");
            $statement->execute(['stud_id' => $_SESSION['stud_id']]);
            $user = $statement->fetch(PDO::FETCH_ASSOC);     
            
            if ($user && password_verify($old_pass, $user['stud_pass'])) {  
                
                $db = new database();
                $con = $db->initDatabase();
                
                $statement = $con->prepare("CALL change_pass(:newPass,:id)");
                $statement->execute(['newPass' => $hashed,'id'=> $_SESSION['user_id']]);
                
                return json_encode(['status' => 'success']);
            } 
            else {                
                return json_encode(['status' => 'invalid']);
            }
        }catch (PDOException $th) {
            return json_encode(['status' => 'error', 'message' => 'error: ' . $th->getMessage()]);
        }
    }

    function resetPass(){
        try {
            $hashed = password_hash('123123',PASSWORD_BCRYPT);

            $db = new database();
            $con = $db->initDatabase();
            
            $statement = $con->prepare("CALL reset_pass(:newPass,:id)");
            $statement->execute(['newPass' => $hashed,'id'=> $_POST['toReset']]);
                
            return json_encode(['status' => 'success']);
        }catch (PDOException $th) {
            return json_encode(['status' => 'error', 'message' => 'error: ' . $th->getMessage()]);
        }
    }
}