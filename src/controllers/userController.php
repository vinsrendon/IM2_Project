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
                'fname' => htmlspecialchars(strip_tags($_POST['fname'])),
                'mname' => htmlspecialchars(strip_tags($_POST['mname'])),
                'lname' => htmlspecialchars(strip_tags($_POST['lname'])),
                'DOB' => htmlspecialchars(strip_tags($_POST['DOB'])),
                'address' => htmlspecialchars(strip_tags($_POST['address'])),
                'pnumber' => htmlspecialchars(strip_tags($_POST['pnumber'])),
                'gfname' => htmlspecialchars(strip_tags($_POST['gfname'])),
                'gmname' => htmlspecialchars(strip_tags($_POST['gmname'])),
                'glname' => htmlspecialchars(strip_tags($_POST['glname'])),
                'gaddress' => htmlspecialchars(strip_tags($_POST['gaddress'])),
                'gpnumber' => htmlspecialchars(strip_tags($_POST['gpnumber']))
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
}