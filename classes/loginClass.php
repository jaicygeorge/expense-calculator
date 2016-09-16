<?php
//Class for Login
class loginClass
{

      function login(){

      if(isset($_POST['login_sub'])){
         if($_POST['password']!="" && $_POST['password']!=""){
             $user_arr = GetDataBySql("SELECT id FROM admin WHERE username='".$_POST['username']."' AND password='".md5($_POST['password'])."'");
             if($user_arr){
                  $_SESSION['LoggedUser']    =    $user_arr[0]['id'];
                  header("location:index.php?module=expenses&action=view");exit;
             }
             else{
               $_SESSION['error_message']  = "<p style='color:red;vertical-align:center;'>Invalid Username/Password</p>";
             }
         }
         else  $_SESSION['error_message']  = "<p style='color:red;vertical-align:center;'>Please enter username and password!</p>";
      }

      include("templates/login.php");

      }
      
      function logout(){
          unset($_SESSION['LoggedUser']);
          header("location:index.php");exit;
      }
}
?>
