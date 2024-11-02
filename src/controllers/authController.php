<?php 

class authController{
    function login(){
        try {
            $user_id = htmlspecialchars(strip_tags($_POST['stud_id']));
            $stud_pass = htmlspecialchars(strip_tags($_POST['stud_pass']));

            $db = new database();
            $con = $db->initDatabase();
            
            $statement = $con->prepare("CALL login(:stud_id)");
            $statement->execute(['stud_id' => $user_id]);
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($stud_pass, $user['stud_pass'])) {
                 
                session_start();
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['stud_id'] = $user['stud_id'];
                $_SESSION['Role'] = $user['Role'];
                $_SESSION['Flag'] = $user['Flag'];
                $_SESSION['isLoggedin'] = true;
                
                echo json_encode(['status' => 'success', 'message' => 'Login Successful!']); 
            } else {                
                echo json_encode(['status' => 'error', 'message' => 'Invalid username or password!']);
            }
        }catch (PDOException $th) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $th->getMessage()]);
        }
    }

    function logout(){
        try {
            session_start();
            session_unset();
            session_destroy();
            echo json_encode(['status' => 'success', 'message' => 'Logging out!']); 
        } catch (PDOException $th) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $th->getMessage()]);
        }
    }
}