<form name="add_form" method="post">
 <span><h3>Add New Expense</h3></span></p>
 <table width="50%" border="0" align="center" cellpadding="3" cellspacing="5">
                              <tr>
                      <td valign="top" colspan='2' ><?php if($_SESSION['error_message']) {echo $_SESSION['error_message'];unset($_SESSION['error_message']);}?>
                      </td>
                    </tr>
		                      <tr>
                      <td width="43%" valign="top">Expense Name<span class="mandatory">*</span></td>
                      <td width="57%" valign="top"><input name="expense_name" type="text"  size="33" value="<?php echo $_POST['expense_name'];?>" /></td>
                    </tr>
                     <tr>
                      <td width="43%" valign="top">Payer<span class="mandatory">*</span></td>
                      <td width="57%" valign="top"> <select name="payer" >
						<option value="">-Select-</option>
						<?php foreach($payer_arr as $key=>$val){?>
						<option value="<?php echo $val['id'];?>" <?php if($_POST['payer']==$val['id']) echo "selected";?>><?php echo $val['name'];?></option>
						<?php } ?>
					</select> </td>
                    </tr>
                         <tr>
                      <td width="43%" valign="top">Description</td>
                      <td width="57%" valign="top"><textarea name="description" cols="30" rows="5"><?php echo $_POST['description'];?></textarea></td>
                    </tr>
                    </tr>
                         <tr>
                      <td width="43%" valign="top">Date<span class="mandatory">*</span></td>
                      <td width="57%" valign="top"><div class="example-container" >
                  <input name="date" type="text" class="example-container" id="date" value="<?php if($_POST['date']) echo $_POST['date'];?>" readonly="readonly"/>
                  <pre style="display:none; font-size:11px;">$('#date').datetimepicker(); </pre>
                </div></td>
                    </tr>
                    <tr>
                      <td width="43%" valign="top">Beneficiaries<span class="mandatory">*</span></td>
                      <td width="57%" valign="top"> <select name="benf[]" multiple="multiple">
						<option value="">-Select-</option>
						<?php foreach($payer_arr as $key=>$val){?>
						<option value="<?php echo $val['id'];?>" <?php if($_POST['benf']) if(in_array($val['id'],$_POST['benf'])) echo "selected";?>><?php echo $val['name'];?></option>
						<?php } ?>
					</select></td>
                    </tr>
                      <tr>
                      <td width="43%" valign="top">Amount<span class="mandatory">*</span></td>
                      <td width="57%" valign="top"><input name="amount" type="text"  size="33" value="<?php echo $_POST['amount'];?>" onkeypress="return isNumberPrice(event);"/></td>
                    </tr>
                    <tr>
                     <tr>
                      <td valign="top" colspan='2' ><input name="add_sub" type="submit" value="Submit"  />&nbsp;<input name="can" type="reset" value="Reset"  /></td>
                    </tr>


<table>
</form>
<script type="text/javascript">
document.add_form.expense_name.focus();
</script>
