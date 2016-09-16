<p><h3>My Payments<h3></p>


 <table width="100%" border="0" align="center" cellpadding="3" cellspacing="5">
                              <tr>
                      <td valign="top" colspan='2' ><?php if($_SESSION['error_message']) {echo $_SESSION['error_message'];unset($_SESSION['error_message']);}?>
                      </td>
                    </tr>
		                      <tr>
		                      <td valign="top" colspan='2' >
		                      <form name='filter_form' action='' method='get'>
		                      <?php
                              foreach($_GET as $key=>$val){
                                      if($key=="module" || $key=="action"  || $key=="type")
                                      echo "<input type='hidden' name='".$key."' value='".$val."'/>";
                              }
                              ?>
                    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="5">
                              <tr>
                              <td> Select User:
                                <select name="payer" >
						<option value="">-Select-</option>
						<?php foreach($payer_arr as $key=>$val){?>
						<option value="<?php echo $val['id'];?>" <?php if($_GET['payer']==$val['id']) echo "selected";?>><?php echo $val['name'];?></option>
						<?php } ?>
					</select>       </td>

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
                      <th>Date</th>
                      <th>From Whom to Get</th>
                      </tr>
                     <?php
                      $total = 0;
                      if($result){

                       foreach($result as $key=>$val){$total = $total + $val['amount'];?>
                              <tr>
                              <td><?php echo $val['expense_name']; ?></td>
                              <td><?php if($val['expense_date']) echo ConvertToDDMMYYYY($val['expense_date']); ?></td>
                              <td><?php echo $val['benef_list']; ?></td>
                              </tr>
                              <?php }}else{echo "<tr>
                              <td colspan='7'>No expenses Found</td></tr>";} ?>
                                 <tr>
                              <td colspan="3" align="right">Total Amount To get : <?php echo $tot_amt." Rs";?></td>
                                  </tr>

                                <?php if($_GET['payer']){ ?>
                              <tr>
                              <td colspan="3" align="left">Consolidated Summary :
                              <table width="60%" border="1" align="center" cellpadding="3" cellspacing="5">
						      <?php foreach($payer_arr as $key=>$val){
                              if($val['id']!=$_GET['payer']){?>
                                 <tr>
                                       <td>From <?echo $val['name']." ( ".$val['email'].")"?> :</td>
                                       <td><?php echo GetNutralisedFromAmount($_GET['payer'],$val['id'],$filter);?></td>
                                       </tr>
						      <?php } } ?>
                                  <?php } ?>
                              </tr>
                              </table>
                       </td>
                       </tr>
                    </table>

<table>
</form>
