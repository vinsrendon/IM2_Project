<?php 

require_once $_SERVER['DOCUMENT_ROOT'] .'/src/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/src/controllers/authController.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/src/controllers/userController.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/src/controllers/subjectController.php';

if (isset($_POST['choice'])) {    
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
            $ctr->addUser();   
            break;        
        // case 'editUser':            
        //     $ctr = new userController();
        //     // $ctr->user_logout();        
        //     break;
        // case 'loadToDoList':    
        //     session_start();        
        //     $ctr = new todoController();
        //     $ctr->todoList();        
        //     break;
        // case 'updateToDo':
        //     session_start();
        //     $ctr = new todoController();
        //     $ctr->updateToDo();
        //     break;
        // case 'deleteTodo':
        //     session_start();
        //     $ctr = new todoController();
        //     $ctr->deleteTodo();
        //     break;
        // case 'updateTodoStatus':
        //     session_start();
        //     $ctr = new todoController();
        //     $ctr->updateToDoStatus();
        //     break;
        // case 'addToDoList':
        //     session_start();
        //     $ctr = new todoController();
        //     $ctr->addTodo();
        //     break;
        default:
            echo 'cannot handle request';
            break;
    }
}