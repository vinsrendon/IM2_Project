<?php 

class subjectController{
    function addSubject(){
        try{
            $db = new database();
            $con = $db->initDatabase();

            $statement = $con->prepare("CALL add_subject(
            :sub_Code,:sub_Name,:sub_Units)");
            $statement->execute([
                'sub_Code' => htmlspecialchars(strip_tags($_POST['sub_Code'])),
                'sub_Name' => htmlspecialchars(strip_tags($_POST['sub_Name'])),
                'sub_Units' => htmlspecialchars(strip_tags($_POST['sub_Units']))
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
}