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
        case 'getStudentById':
            $ctr = new userController();
            echo $ctr->getStudentById();
            break;
        case 'deactivate':
            $ctr = new userController();
            echo $ctr->deactStudent(); 
            break;
        case 'activate':
            $ctr = new userController();
            echo $ctr->actStudent(); 
            break;
        case 'changePass':
            session_start();
            $ctr = new userController();
            echo $ctr->changePass(); 
            break;
        case 'resetPass':
            $ctr = new userController();
            echo $ctr->resetPass(); 
            break;
        case 'addSubject':
            $ctr = new subjectController();
            echo $ctr->addSubject(); 
            break;
        case 'getSubjects':
            $ctr = new subjectController();
            echo $ctr->getSubject();
            break;
        case 'dltSubject':
            $ctr = new subjectController();
            echo $ctr->dltSubject();
            break;        
        default:
            echo 'cannot handle request';
            break;
    }
}