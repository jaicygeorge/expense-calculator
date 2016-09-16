<?php
//Class for Login
class userClass
{
function view(){
       $filter   =  NULL;
       
       if($_GET['status']){
             $update         =     TableUpdate("users","status = !status WHERE id='".$_GET['status']."'");
             if($update) {
                   header("location:index.php?module=users&action=view");exit;
             }
             else $_SESSION['error_message']  = "<p style='color:red;vertical-align:center;'>Status updation failed!</p>";
       }
       if($_GET['keyword'] && !$_GET['keytype'])
             $filter .= " AND (name LIKE '".$_GET['keyword']."%' OR phone like '".$_GET['keyword']."%' OR email like '".$_GET['keyword']."%' OR address like '".$_GET['keyword']."%' )";
       else if($_GET['keyword'] && $_GET['keytype'])
           $filter .= " AND  ".$_GET['keytype']." LIKE '".$_GET['keyword']."%' ";

       $result      = GetDataBySql("SELECT * FROM users WHERE 1 $filter ORDER BY created_date DESC");

       include("templates/header.php");
       include("templates/users/view.php");
       include("templates/footer.php");

}

      function add(){
                  if(isset($_POST['add_sub'])){
                      if($_POST['name']!="" && $_POST['email']!=""){
                                      if(!$dup_arr = GetDataBySql("SELECT id FROM users WHERE email='{$_POST['email']}'")){
                                      $_POST = CleanSql($_POST);
                                      extract($_POST);
                                      $insert_id      =     TableInsert("users","name='$name',email='$email',phone='$phone',address='$address',created_date=now()");
                                      if($insert_id){
                                          $_SESSION['error_message']  = "<p style='color:green;vertical-align:center;'>User has added successfully!</p>";
                                      }
                                      else   $_SESSION['error_message']  = "<p style='color:red;vertical-align:center;'>Insertion Failed!</p>";
                                      header("location:index.php?module=users&action=view");exit;
                             } else  $_SESSION['error_message']  = "<p style='color:red;vertical-align:center;'>Email-Id already exist!</p>";
                      }
                      else  $_SESSION['error_message']  = "<p style='color:red;vertical-align:center;'>Please fill in the mandatory fields!</p>";
                  }

                  include("templates/header.php");
                  include("templates/users/add.php");
                  include("templates/footer.php");
      }


      function edit(){
      $u_id          =      $_GET['id'];
      $edit_arr       =       GetDataBySql("SELECT * FROM users WHERE id='$u_id'");

              if(isset($_POST['edit_sub'])){
                      if($_POST['name']!="" && $_POST['email']!=""){
                             if(!$dup_arr = GetDataBySql("SELECT id FROM users WHERE name='{$_POST['name']}' AND email='{$email}' AND id!='$u_id'")){
                             $_POST = CleanSql($_POST);
                             extract($_POST);
                             $update         =     TableUpdate("users","name='$name',email='$email',phone='$phone',address='$address' WHERE id='$u_id'");
                             if($update){
                                   $_SESSION['error_message']  = "<p style='color:green;vertical-align:center;'>User has updated successfully!</p>";
                                   header("location:index.php?module=users&action=view");exit;
                             }
                             }
                              else  $_SESSION['error_message']  = "<p style='color:red;vertical-align:center;'>Email-Id already exist!</p>";
                      }
                      else  $_SESSION['error_message']  = "<p style='color:red;vertical-align:center;'>Please fill in the mandatory fields!</p>";
                  }
                  $payer_arr   = GetDataBySql("SELECT * FROM users WHERE status=1");

                  include("templates/header.php");
                  include("templates/users/edit.php");
                  include("templates/footer.php");
      }

      function delete(){
           $id  = $_GET['id'];
           if($id){
              $user_arr =  GetDataBySql("SELECT * FROM expenses WHERE payer_id='$id'");
              if($user_arr || $benf_arr) {
                  $_SESSION['error_message']  = "<p style='color:red;vertical-align:center;'>Cannot delete, Expenses existing realated to the selected user!</p>";
              }
              else{
                  if(TableDelete("users","id='$id'")){
                      $_SESSION['error_message']  = "<p style='color:green;vertical-align:center;'>User deleted successfully!</p>";
                      header("location:index.php?module=users&action=view");exit;
                 }
              else
                  $_SESSION['error_message']  = "<p style='color:red;vertical-align:center;'>Deletion failed!</p>";
           }

           }
      }
}
?>
