<form name="add_form" method="post">
 <span><h3>Edit Expense</h3></span></p>
 <table width="50%" border="0" align="center" cellpadding="3" cellspacing="5">
                              <tr>
                      <td valign="top" colspan='2' ><?php if($_SESSION['error_message']) {echo $_SESSION['error_message'];unset($_SESSION['error_message']);}?>
                      </td>
                    </tr>
		                      <tr>
                      <td width="43%" valign="top">Expense Name<span class="mandatory">*</span></td>
                      <td width="57%" valign="top"><input name="expense_name" type="text"  size="33" value="<?php if($_POST['expense_name'])echo $_POST['expense_name']; else echo $edit_arr[0]['expense_name'];?>" /></td>
                    </tr>
                     <tr>
                      <td width="43%" valign="top">Payer<span class="mandatory">*</span></td>
                      <td width="57%" valign="top">
                      <?php if($_POST['expense_name']) $sel_payer = $_POST['payer'];
                      else $sel_payer = $edit_arr[0]['payer_id'];

                     ?>
                      <select name="payer" >
						<option value="">-Select-</option>
						<?php foreach($payer_arr as $key=>$val){?>
						<option value="<?php echo $val['id'];?>" <?php if($sel_payer==$val['id']) echo "selected";?>><?php echo $val['name'];?></option>
						<?php } ?>
					</select> </td>
                    </tr>
                         <tr>
                      <td width="43%" valign="top">Description</td>
                      <td width="57%" valign="top"><textarea name="description" cols="30" rows="5"><?php if($_POST['description'])echo $_POST['description'];else echo $edit_arr[0]['description'];?></textarea></td>
                    </tr>
                    </tr>
                         <tr>
                      <td width="43%" valign="top">Date<span class="mandatory">*</span></td>
                      <td width="57%" valign="top"><div class="example-container" >
                  <input name="date" type="text" class="example-container" id="date" value="<?php if($_POST['date']) echo $_POST['date'];else echo ConvertToDDMMYYYY($edit_arr[0]['expense_date']);?>" readonly="readonly"/>
                  <pre style="display:none; font-size:11px;">$('#date').datetimepicker(); </pre>
                </div></td>
                    </tr>
                    <tr>
                      <td width="43%" valign="top">Beneficiaries<span class="mandatory">*</span></td>
                      <td width="57%" valign="top">
                       <?php if($_POST['benf']) $sel_arr = $_POST['benf'];
                      else $sel_arr = GetBeneficiarArray($edit_arr[0]['id']);

                      ?>
                       <select name="benf[]" multiple="multiple">
						<option value="">-Select-</option>
						<?php foreach($payer_arr as $key=>$val){?>
						<option value="<?php echo $val['id'];?>" <?php if($sel_arr) if(in_array($val['id'],$sel_arr)) echo "selected";?>><?php echo $val['name'];?></option>
						<?php } ?>
					</select></td>
                    </tr>
                      <tr>
                      <td width="43%" valign="top">Amount<span class="mandatory">*</span></td>
                      <td width="57%" valign="top"><input name="amount" type="text"  size="33" value="<?php if($_POST['amount']) echo $_POST['amount'];else echo $edit_arr[0]['total_amount'];?>" onkeypress="return isNumberPrice(event);"/></td>
                    </tr>
                    <tr>
                      <td valign="top" colspan='2' ><input name="edit_sub" type="submit" value="Submit"  />&nbsp;<input name="can" type="reset" value="Reset"  /></td>
                    </tr>
                    </table>

<table>
</form>
<script type="text/javascript">
document.add_form.expense_name.focus();
</script>
