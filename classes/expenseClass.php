<?php
//Class for expense management
class expenseClass
{

function view(){

       $filter   =  NULL;
       if($_GET['payer']) $filter .= " AND payer_id='".$_GET['payer']."'";
       if($_GET['from'] || $_GET['to']){
          if($_GET['from']) $from = ConvertToYYYYMMDD($_GET['from']);
          if($_GET['to'])$to   = ConvertToYYYYMMDD($_GET['to']);

          if($from && $to)
              $filter .= " AND expense_date>='$from' AND expense_date<='$to'";
          else if($from)
              $filter .= " AND expense_date>='$from'";
          else if($to){

              list($dd,$tt) = explode(" ",$to);
              $filter .= " AND expense_date LIKE '$dd%'";
          }
       }

       $payer_arr   = GetDataBySql("SELECT * FROM users WHERE status=1");

       if($_GET['beneficiar'])
          $result      = GetDataBySql("SELECT e.* FROM expenses e,beneficiaries b,users u WHERE b.beneficiar_id=u.id AND e.id=b.expense_id AND u.id='{$_GET['beneficiar']}' $filter GROUP BY e.id ORDER BY expense_date DESC");
       else
          $result      = GetDataBySql("SELECT * FROM expenses WHERE 1 $filter ORDER BY expense_date DESC");

       include("templates/header.php");
       include("templates/expenses/view.php");
       include("templates/footer.php");

      }
      
      function add(){
                  if(isset($_POST['add_sub'])){
                      if($_POST['expense_name']!="" && $_POST['amount']!="" && $_POST['date']!="" && $_POST['benf']!="" && $_POST['payer']!=""){
                                 $_POST = CleanSql($_POST);
                                     extract($_POST);
                                     $ex_date        =     ConvertToYYYYMMDD($date);

                             if(!$dup_arr = GetDataBySql("SELECT id FROM expenses WHERE expense_name='{$_POST['expense_name']}' AND expense_date='{$ex_date}' AND total_amount='{$_POST['amount']}'")){


                                     $insert_id      =     TableInsert("expenses","expense_name='$expense_name',payer_id='$payer',description='$description',total_amount='$amount',expense_date='$ex_date',created_date=now()");
                                     if($insert_id){
                                        if($benf){
                                             $shared_amount = $amount/count($benf);
                                             foreach($benf as $key=>$val){
                                             $in_id      =     TableInsert("beneficiaries","expense_id='$insert_id',beneficiar_id='$val',amount='$shared_amount'");
                                          }
                                     }
                                     $_SESSION['error_message']  = "<p style='color:green;vertical-align:center;'>Expense has added successfully!</p>";
                                     header("location:index.php?module=expenses&action=view");exit;
                             }

                             }
                              else  $_SESSION['error_message']  = "<p style='color:red;vertical-align:center;'>Expense already exist!</p>";
                      }
                      else  $_SESSION['error_message']  = "<p style='color:red;vertical-align:center;'>Please fill in the mandatory fields!</p>";
                  }
                  $payer_arr   = GetDataBySql("SELECT * FROM users WHERE status=1");
                  include("templates/header.php");
                  include("templates/expenses/add.php");
                  include("templates/footer.php");
      }
      
      
      function edit(){
      $ex_id          =      $_GET['id'];
      $edit_arr       =       GetDataBySql("SELECT * FROM expenses WHERE id='$ex_id'");

              if(isset($_POST['edit_sub'])){
                      if($_POST['expense_name']!="" && $_POST['amount']!="" && $_POST['date']!="" && $_POST['benf']!="" && $_POST['payer']!=""){
                             $_POST = CleanSql($_POST);
                             extract($_POST);
                             $ex_date        =     ConvertToYYYYMMDD($date);
                             if(!$dup_arr = GetDataBySql("SELECT id FROM expenses WHERE expense_name='{$_POST['expense_name']}' AND expense_date='{$ex_date}' AND total_amount='{$_POST['amount']}' AND id!='$ex_id'")){

                             $update         =     TableUpdate("expenses","expense_name='$expense_name',payer_id='$payer',description='$description',total_amount='$amount',expense_date='$ex_date' WHERE id='$ex_id'");
                             if($update){
                                   TableDelete("beneficiaries","expense_id='$ex_id'");
                                   if($benf){
                                   $shared_amount = $amount/count($benf);
                                   foreach($benf as $key=>$val){
                                             $in_id      =     TableInsert("beneficiaries","expense_id='$ex_id',beneficiar_id='$val',amount='$shared_amount'");
                                          }
                                   }
                                   $_SESSION['error_message']  = "<p style='color:green;vertical-align:center;'>Expense has updated successfully!</p>";
                                   header("location:index.php?module=expenses&action=view");exit;
                             }
                             }
                              else  $_SESSION['error_message']  = "<p style='color:red;vertical-align:center;'>Expense already exist!</p>";
                      }
                      else  $_SESSION['error_message']  = "<p style='color:red;vertical-align:center;'>Please fill in the mandatory fields!</p>";
                  }
                  $payer_arr   = GetDataBySql("SELECT * FROM users WHERE status=1");
                  
                  include("templates/header.php");
                  include("templates/expenses/edit.php");
                  include("templates/footer.php");
      }
      
      function delete(){
           $id  = $_GET['id'];
           if($id){
              if(TableDelete("expenses","id='$id'")){
                  TableDelete("beneficiaries","expense_id='$id'");
                  $_SESSION['error_message']  = "<p style='color:green;vertical-align:center;'>Expense deleted successfully!</p>";
                  header("location:index.php?module=expenses&action=view");exit;
              }
              else
                  $_SESSION['error_message']  = "<p style='color:red;vertical-align:center;'>Deletion failed!</p>";
           }
      }
      
       function report(){

       $filter   =  NULL;
       if($_GET['from'] || $_GET['to']){
          if($_GET['from']) $from = ConvertToYYYYMMDD($_GET['from']);
          if($_GET['to'])$to   = ConvertToYYYYMMDD($_GET['to']);

          if($from && $to)
              $filter .= " AND expense_date>='$from' AND expense_date<='$to'";
          else if($from)
              $filter .= " AND expense_date>='$from'";
          else if($to){

              list($dd,$tt) = explode(" ",$to);
              $filter .= " AND expense_date LIKE '$dd%'";
          }
       }

       $payer_arr   = GetDataBySql("SELECT * FROM users WHERE status=1");

       if($_GET['type']==1){
           if($_GET['payer']){
              $result      = GetDataBySql("SELECT s.payer_id,s.expense_name,s.expense_date,b.amount FROM expenses s,beneficiaries b WHERE s.id=b.expense_id AND beneficiar_id='{$_GET['payer']}' AND payer_id!='{$_GET['payer']}' $filter GROUP BY s.id ORDER BY expense_date DESC");
           }
           include("templates/header.php");
           include("templates/expenses/report1.php");
           include("templates/footer.php");

       }
       else if($_GET['type']==2){
           $tot_amt     = 0;
           if($_GET['payer']){
              $result      = GetDataBySql("SELECT id,payer_id,expense_name,expense_date FROM expenses  WHERE payer_id='{$_GET['payer']}' $filter GROUP BY id ORDER BY expense_date DESC");

               foreach($result as $key=>$val){
                $result[$key]['benef_list'] =  GetBeneficiariesAmountMyList($val['id'],$val['payer_id']);
                $tot_amt = $tot_amt + GetMyExpenseAmount($val['id'],$val['payer_id']);
               }

           }


           include("templates/header.php");
           include("templates/expenses/report2.php");
           include("templates/footer.php");
       }
       else{
              header("location:index.php?module=expenses&action=view");exit;
       }

      }
}
?>
