<p><h3>View Expenses<h3><span><a href="index.php?module=expenses&action=add" >Add New Expense</a></span></p>

                
 <table width="100%" border="0" align="center" cellpadding="3" cellspacing="5">
                              <tr>
                      <td valign="top" colspan='2' ><?php if($_SESSION['error_message']) {echo $_SESSION['error_message'];unset($_SESSION['error_message']);}?>
                      </td>
                    </tr>
		                      <tr>
		                      <td valign="top" colspan='2' >
		                      <form name='filter_form' action='' method='get'>
		                   <table width="100%" border="0" align="center" cellpadding="3" cellspacing="5">
                              <tr>
                              <td> Payer:
                                <select name="payer" >
						<option value="">-Select-</option>
						<?php foreach($payer_arr as $key=>$val){?>
						<option value="<?php echo $val['id'];?>" <?php if($_GET['payer']==$val['id']) echo "selected";?>><?php echo $val['name'];?></option>
						<?php } ?>
					</select>       </td>
                               <td>Beneficiar:  <select name="beneficiar" >
						<option value="">-Select-</option>
						<?php foreach($payer_arr as $key=>$val){?>
						<option value="<?php echo $val['id'];?>" <?php if($_GET['beneficiar']==$val['id']) echo "selected";?>><?php echo $val['name'];?></option>
						<?php } ?>
					</select>     </td>
                              <td>Expense Date From :</td><td>  <div class="example-container" >
                  <input name="from" type="text" class="example-container" id="from" value="<?php if($_GET['from']) echo $_GET['from'];?>" readonly="readonly"/>
                  <pre style="display:none; font-size:11px;">$('#from').datetimepicker(); </pre>
                </div></td>
                              <td>To :       </td><td>
                               <div class="example-container" >
                  <input name="to" type="text" class="example-container" id="to" value="<?php if($_GET['to']) echo $_GET['to'];?>" readonly="readonly"/>
                  <pre style="display:none; font-size:11px;">$('#to').datetimepicker(); </pre>
                </div>
                              </td>
                              <td><input name="sub" type="submit" value="Search"/>
                              </td>
                              </tr>
                              <tr>
                              </tr>
                              </table>
                              </form>
                     </td>
                    </tr>
                    <tr>
                     <td valign="top" colspan='2' >
                      <table width="100%" border="1" align="center" cellpadding="3" cellspacing="5">
                      <tr>
                      <th>Expense Name</th>
                      <th>Payer Name</th>
                      <th>Amount</th>
                      <th>Date</th>
                      <th>Description</th>
                      <th>Beneficiaries</th>
                      <th>Created Date</th>
                      <th>Actions</th>
                      </tr>
                      <?php
                      if($result){
                       foreach($result as $key=>$val){?>
                              <tr>
                              <td><?php echo $val['expense_name']; ?></td>
                              <td><?php echo GetPayerName($val['payer_id']); ?></td>
                              <td><?php echo $val['currency_symbol'].$val['total_amount']." Rs"; ?></td>
                              <td><?php if($val['expense_date']) echo ConvertToDDMMYYYY($val['expense_date']); ?></td>
                              <td><?php echo $val['description']; ?></td>
                              <td><?php echo GetBeneficiariesAmountList($val['id']); ?></td>
                              <td><?php if($val['created_date']) echo ConvertToDDMMYYYY($val['created_date']); ?></td>
                              <td><a href='index.php?module=expenses&action=edit&id=<?php echo $val['id'];?>'>Edit</a>  &nbsp;<a href='index.php?module=expenses&action=delete&id=<?php echo $val['id'];?>' onclick="if(!confirm('Do you reall want to delete this expense details?'))return false;">Delete</a>
                              </tr>
                              <?php }}else{echo "<tr>
                              <td colspan='8'>No result Found</td></tr>";} ?>
                              
                              </table>
                       </td>
                       </tr>
                    </table>

<table>
</form>
