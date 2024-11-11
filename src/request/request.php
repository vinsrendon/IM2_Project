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
            $ctr = new userController();
            echo $ctr->addUser();
            break;
        case 'getStudents':
            $ctr = new userController();
            echo $ctr->getStudents(); 
            break;
        case 'deactivate':
            $ctr = new userController();
            echo $ctr->deactStudent(); 
            break;
        case 'activate':
            $ctr = new userController();
            echo $ctr->actStudent(); 
            break;
        case 'addSubject':
            $ctr = new subjectController();
            echo $ctr->addSubject(); 
            break;
        case 'getSubjects':
            $ctr = new subjectController();
            echo $ctr->getSubject();
            break;
        default:
            echo 'cannot handle request';
            // echo print_r($_REQUEST);
            break;
    }
}