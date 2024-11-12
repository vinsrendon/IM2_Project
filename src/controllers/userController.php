<?php 

class userController{
    function addUser(){
        try{
            $db = new database();
            $con = $db->initDatabase();

            
            $hashed = password_hash(htmlspecialchars(strip_tags($_POST['stud_pass'])),PASSWORD_BCRYPT);

            $statement = $con->prepare("CALL register_user(
            :stud_id,:stud_pass,:Role,:Flag,
            :fname,:mname,:lname,:DOB,:address,:pnumber,
            :gfname,:gmname,:glname,:gaddress,:gpnumber)");
            $statement->execute([
                'stud_id' => htmlspecialchars(strip_tags($_POST['stud_id'])),
                'stud_pass' => $hashed,
                'Role' => 0,
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

            return json_encode(['status' => 'success']);
        } catch (PDOException $th) {
            return json_encode($th);
        }
    }
}