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
                'Role' => htmlspecialchars(strip_tags($_POST['Role'])),
                'Flag' => htmlspecialchars(strip_tags($_POST['Flag'])),
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

            return array(['status' => 'success', 'message' => 'USER ADDED SUCCESSFULLY!']);
        }
        catch (\Exception $th) {
            echo $th;
        }
    }
}