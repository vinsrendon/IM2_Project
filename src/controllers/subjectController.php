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

    function dltSubject(){
        try {
            $db = new database();
            $con = $db->initDatabase();
            
            $statement = $con->prepare("CALL delete_subject(:sub_id)");
            $statement->execute(['sub_id'=>$_POST['sub_id']]);

            return json_encode(['status' => 'success']);
        } catch (PDOException $th) {
            return json_encode($th);
        }
    }

    function setStudSubToGet(){
        try {
            session_start();
            $_SESSION['stud_id_to_get_sub'] = $_POST['stud_id_to_get'];

            return json_encode(['status' => 'success']);
        } catch (\Exception $th) {
            return json_encode($th);
        }
        
    }
    function getSubjectsBySid(){        
        try {            
            $db = new database();
            $con = $db->initDatabase();
            
            $statement = $con->prepare("CALL get_sub_by_sid(:sid)");
            $statement->execute(['sid'=>$_POST['StudSubId']]);
            $user = $statement->fetchAll();


            return json_encode($user);
        } catch (PDOException $th) {
            return json_encode($th);
        }
    }

    function addSubToStud(){
        try{
            $db = new database();
            $con = $db->initDatabase();

            $statement = $con->prepare("CALL add_subject_to_student(:sid,:subId,:time,:room,:day)");
            $statement->execute([
                'sid' => htmlspecialchars(strip_tags($_POST['stud_id'])),
                'subId' => htmlspecialchars(strip_tags($_POST['sub_Id'])),
                'time' => htmlspecialchars(strip_tags($_POST['time'])),
                'room' => htmlspecialchars(strip_tags($_POST['room'])),
                'day' => htmlspecialchars(strip_tags($_POST['day']))
            ]);

            return json_encode(['status' => 'success']);
        }
        catch (PDOException $th) {            
            if ($th->getCode() == 23000) {
                return json_encode(['status' => 'duplicate']);
            } 
            else if($th->getCode() == 45000){
                return json_encode(['status' => 'limit']);
            }
            else if($th->getCode() == 23001)
            {
                return json_encode(['status' => 'conflict']);
            }
            else if($th->getCode() == 23002)
            {
                return json_encode(['status' => 'subExist']);
            }
            else {
                return json_encode($th);
            }
        }
    }

    function dltStudSub(){
        try {
            $db = new database();
            $con = $db->initDatabase();
            
            $statement = $con->prepare("CALL dltStudSub(:sid,:sub_id)");
            $statement->execute(['sid'=>$_POST['stud_id'],'sub_id'=>$_POST['sub_id']]);

            return json_encode(['status' => 'success']);
        } catch (PDOException $th) {
            return json_encode($th);
        }
    }
}