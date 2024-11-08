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
                
                if($user['Flag'] === 1){
                    session_start();
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['stud_id'] = $user['stud_id'];
                    $_SESSION['Role'] = $user['Role'];
                    $_SESSION['Flag'] = $user['Flag'];
                    $_SESSION['isLoggedin'] = true;
                    $db = new database();
                    $con = $db->initDatabase();
                    
                    $statement = $con->prepare("CALL get_user(:stud_id)");
                    $statement->execute(['stud_id' => $_SESSION['user_id']]);
                    $user1 = $statement->fetch(PDO::FETCH_ASSOC);      

                    $_SESSION['fname'] = $user1['fname'];
                    $_SESSION['mname'] = $user1['mname'];
                    $_SESSION['lname'] = $user1['lname'];
                    $_SESSION['DOB'] = $user1['DOB'];
                    $_SESSION['address'] = $user1['address'];
                    $_SESSION['pnumber'] = $user1['pnumber'];

                    $_SESSION['gfname'] = $user1['gfname'];
                    $_SESSION['gmname'] = $user1['gmname'];
                    $_SESSION['glname'] = $user1['glname'];
                    $_SESSION['gaddress'] = $user1['gaddress'];
                    $_SESSION['gpnumber'] = $user1['gpnumber'];
                    
                    
                    echo json_encode(['status' => 'success', 'message' => 'Login Successful!','role'=>$user['Role']]); 
                }
                else
                {
                    echo json_encode(['status' => 'deactivated', 'message' => 'Account Deactivated']);
                }

                
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