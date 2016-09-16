<?php
//fetching with query
	function GetDataBySql($sql)
		{                         //   echo $sql;exit;
			$fn_res		=	mysql_query($sql);
			$arrcnt		=	-1;
			$dataarr	=	array();
			while($temp	= mysql_fetch_assoc($fn_res))
				{
					$arrcnt++;
					$dataarr[$arrcnt]	=	$temp;
				}
			return $dataarr;
		}
	//inserting
	function TableInsert($table,$insert_string)
		{
		     //echo "insert into $table SET $insert_string";exit;
			return (mysql_query("insert into $table SET $insert_string")) ? mysql_insert_id() : "0";
		}
	//updating
	function TableUpdate($tbname,$field)
		{
			$updatequery	= "update $tbname set $field";
			$query       	= mysql_query($updatequery) or die(mysql_error("Update failed"));
			return $query;

		}
		
   //deletion
	function TableDelete($tbname,$field)
		{
			$updatequery	= "DELETE FROM $tbname WHERE $field";
			$query       	= mysql_query($updatequery) or die(mysql_error("Deletion failed"));
			return $query;

		}
    //Clean the content before db insertion
    function CleanSql($cln_arr){
          foreach($cln_arr as $key=>$val){
          if(!is_array($val))
             $cln_arr[key]      =     mysql_real_escape_string($val);

          }
          return $cln_arr;
    }
    

    
    
    //Common functions
    
    function GetPayerName($id){
             $user_arr = GetDataBySql("SELECT name,email FROM users WHERE id='$id'");
             return $user_arr[0]['name']." (". $user_arr[0]['email'].")";
    }
    function GetBeneficiariesAmountList($ex_id){
             $ben_arr = GetDataBySql("SELECT * FROM beneficiaries WHERE expense_id='$ex_id'");
             if($ben_arr){
             $test_string = NULL;
             //print_r($ben_arr);exit;
             foreach($ben_arr as $key=>$val){
                          $user_arr = GetDataBySql("SELECT name,email FROM users WHERE id='".$val['beneficiar_id']."'");
                          if($test_string)   $test_string .=  "<br/>";
                          $test_string .= $user_arr[0]['name'] ." - ".$val['amount'];
                          }
             }
             return $test_string;
    }
    
    function GetBeneficiariesAmountMyList($id,$payer_id){

             $ben_arr   =   GetDataBySql("SELECT * FROM beneficiaries WHERE expense_id='$id' AND beneficiar_id!='$payer_id'");
             if($ben_arr){
             $test_string = NULL;
             foreach($ben_arr as $key=>$val){
                          $user_arr = GetDataBySql("SELECT name,email FROM users WHERE id='".$val['beneficiar_id']."'");
                          if($user_arr){
                             if($test_string)   $test_string .=  "<br/>";
                                $test_string .= $user_arr[0]['name']." ( ".$user_arr[0]['email'].") - ".$val['amount']." Rs";
                             }
                          }
             }
             return $test_string;
    }
    function GetMyExpenseAmount($id,$payer_id){
             $ben_arr   =   GetDataBySql("SELECT * FROM beneficiaries WHERE expense_id='$id' AND beneficiar_id!='$payer_id'");
             if($ben_arr){
             $total = NULL;
             foreach($ben_arr as $key=>$val){
                          $user_arr = GetDataBySql("SELECT name,email FROM users WHERE id='".$val['beneficiar_id']."'");
                          if($user_arr){

                                $total = $total  + $val['amount'];
                             }
                          }
             }
             return $total;
    }
    

    function GetNutralisedToAmount($pay_from_id,$pay_to_id,$filter){
               $first_amt = GetToAmount($pay_from_id,$pay_to_id,$filter);
               $secnd_amt = GetToAmount($pay_to_id,$pay_from_id,$filter);
               $diff = $first_amt-$secnd_amt;
               if($diff>=0) return number_format($diff,2)." Rs";
               else return 0.00 ." Rs";
    }
    
    
    function GetToAmount($pay_from_id,$pay_to_id,$filter){
        $result      = GetDataBySql("SELECT s.id,s.payer_id,s.expense_name,s.expense_date,b.amount FROM expenses s,beneficiaries b WHERE s.id=b.expense_id AND beneficiar_id='$pay_from_id' AND payer_id='$pay_to_id' $filter GROUP BY s.id ORDER BY expense_date DESC");
        //print_r($result);exit;
        $total = 0;
        foreach($result as $key=>$val)$total = $total + $val['amount'];
        return $total;
    }
    
    
    function GetNutralisedFromAmount($pay_from_id,$pay_to_id,$filter){
               $first_amt = GetToAmount($pay_from_id,$pay_to_id,$filter);
               $secnd_amt = GetToAmount($pay_to_id,$pay_from_id,$filter);
               $diff = $secnd_amt - $first_amt;
               if($diff>=0) return number_format($diff,2)." Rs";
               else return 0.00 ." Rs";
    }
    
    
    function GetBeneficiarArray($ex_id){
        $ben_arr = GetDataBySql("SELECT beneficiar_id FROM beneficiaries WHERE expense_id='$ex_id'");
        $new_arr = NULL;
        if($ben_arr){
            foreach($ben_arr as $key=>$val){
               $new_arr[]  =  $val['beneficiar_id'];
            }
        }
        return $new_arr;
    }
    
    
    function ConvertToYYYYMMDD($date){
         list($dnew,$tt)     =  explode(" ",$date);
         list($dd,$mm,$yy)   =  explode("/",$dnew);
         $new_date_stamp     =  strtotime($yy.'-'.$mm.'-'.$dd.' '.$tt);
         $res_date           =  date("Y-m-d H:i",$new_date_stamp);
         return $res_date;

    }
    

    function ConvertToDDMMYYYY($date){

         list($dnew,$tt)     =  explode(" ",$date);
         list($yy,$mm,$dd)   =  explode("-",$dnew);
         $new_date_stamp     =  strtotime($yy.'-'.$mm.'-'.$dd.' '.$tt);
         $res_date           =  date('d/m/Y H:i',$new_date_stamp);
         return $res_date;
    }
    ?>
