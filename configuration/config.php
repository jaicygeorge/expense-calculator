<?php
ob_start();
session_start();
error_reporting(E_ALL ^ E_NOTICE);


include("configuration/dbconnect.php");
include("functions/common.php");
include("classes/loginClass.php");
include("classes/userClass.php");
include("classes/expenseClass.php");

$log_obt     = new loginClass;
$user_obt    = new userClass;
$expense_obt = new expenseClass;

if($_SESSION['LoggedUser']){

switch($_GET['module']){

       case "expenses":

              if($_GET['action']=="add")
                 $expense_obt->add();
              else if($_GET['action']=="edit")
                 $expense_obt->edit();
              else if($_GET['action']=="report")
                 $expense_obt->report();
              else if($_GET['action']=="delete")
                 $expense_obt->delete();
              else if($_GET['action']=="view")
                 $expense_obt->view();
              else
                 $expense_obt->view();
                 exit;
            break;
            
            case "users":

              if($_GET['action']=="add")
                 $user_obt->add();
              else if($_GET['action']=="edit")
                 $user_obt->edit();
              else if($_GET['action']=="delete")
                 $user_obt->delete();
              else if($_GET['action']=="login")
                 $log_obt->login();
              else if($_GET['action']=="logout")
                 $log_obt->logout();
              else if($_GET['action']=="delete")
                 $user_obt->delete();
              else if($_GET['action']=="view"){
                 $user_obt->view();
                 }
              else
                 $user_obt->view();
                 exit;
            break;
            
            default:
                   $expense_obt->view();
                   break;
}
}
else $log_obt->login();

?>

