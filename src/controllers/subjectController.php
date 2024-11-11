<?php 

class subjectController{
    function addSubject(){
        try{
            $db = new database();
            $con = $db->initDatabase();

            $statement = $con->prepare("CALL add_subject(
            :sub_Code,:sub_Name,:sub_Units,:sub_Course)");
            $statement->execute([
                'sub_Code' => htmlspecialchars(strip_tags($_POST['sub_Code'])),
                'sub_Name' => htmlspecialchars(strip_tags($_POST['sub_Name'])),
                'sub_Units' => htmlspecialchars(strip_tags($_POST['sub_Units'])),
                'sub_Course' => htmlspecialchars(strip_tags($_POST['sub_Course']))
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

    function getSubject(){
        try {
            $db = new database();
            $con = $db->initDatabase();
            
            $statement = $con->prepare("CALL get_subjects()");
            $statement->execute();
            $subjects = $statement->fetchAll();

            return json_encode($subjects);
        } catch (PDOException $th) {
            return json_encode($th);
        }
    }
}