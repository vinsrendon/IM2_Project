<?php 

require_once $_SERVER['DOCUMENT_ROOT'] .'/src/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/src/controllers/authController.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/src/controllers/userController.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/src/controllers/subjectController.php';

if (isset($_POST['choice'])) {    
    $_POST['choice'] = htmlspecialchars(strip_tags($_POST['choice']));
    switch ($_POST['choice']) {
        
        case 'login':            
            $_POST['stud_id'] = htmlspecialchars(strip_tags($_POST['stud_id']));
            $_POST['stud_pass'] = htmlspecialchars(strip_tags($_POST['stud_pass']));

            $ctr = new authController();
            $ctr->login();
            break;
        case 'logout':            
            $ctr = new authController();
            $ctr->logout();        
            break;
        case 'addUser':
            // $ctr = new userController();
            // $ctr->addUser();   
            break;
        case 'getStudents':
            $ctr = new userController();
            $st = $ctr->getStudents(); 
            echo $st;
            break;
        default:
            echo 'cannot handle request';
            // echo print_r($_REQUEST);
            break;
    }
}