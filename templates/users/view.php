<p><h3>View Users<h3><span><a href="index.php?module=users&action=add" >Add New User</a></span></p>


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
                                      if($key=="module" || $key=="action")
                                      echo "<input type='hidden' name='".$key."' value='".$val."'/>";
                              }
                              ?>
		                   <table width="40%" border="0" align="left" cellpadding="3" cellspacing="5">
                              <tr>
                              <td> Keyword: <input type="text" name="keyword" value="<?php if($_GET['keyword']) echo $_GET['keyword'];?>" />
                                </td>
                               <td><select name="keytype" >
						<option value="">-Select-</option>
						<option value="name" <?php if($_GET['keytype']=="name") echo "selected";?>>Name</option>
						<option value="email" <?php if($_GET['keytype']=="email") echo "selected";?>>Email-Id</option>
						<option value="phone" <?php if($_GET['keytype']=="phone") echo "selected";?>>Phone Number</option>
						<option value="address" <?php if($_GET['keytype']=="address") echo "selected";?>>Address</option>
                        </select>    </td>

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
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone Number</th>
                      <th>Address</th>
                      <th>Status</th>
                      <th>Created Date</th>
                      <th>Actions</th>
                      </tr>
                      <?php
                      if($result){
                       foreach($result as $key=>$val){?>
                              <tr>
                              <td><?php echo $val['name']; ?></td>
                              <td><?php echo $val['email']; ?></td>
                              <td><?php echo $val['phone'].$val['total_amount']; ?></td>
                              <td><?php if($val['address']) echo $val['address'];else echo "N/A"; ?></td>
                              <td><?php if($val['status']==1) echo "<a href='index.php?module=users&action=view&status=".$val['id']."' title='Change status to inactive'>Active</a>";else echo "<a href='index.php?module=users&action=view&status=".$val['id']."' title='To activate the user'>Inactive</a>"; ?></td>
                              <td><?php if($val['created_date']) echo ConvertToDDMMYYYY($val['created_date']); ?></td>
                              <td><a href='index.php?module=users&action=edit&id=<?php echo $val['id'];?>'>Edit</a>  &nbsp;<a href='index.php?module=users&action=delete&id=<?php echo $val['id'];?>' onclick="if(!confirm('Do you reall want to delete this user details?'))return false;">Delete</a>
                              </tr>
                              <?php }}else{echo "<tr>
                              <td colspan='7'>No result Found</td></tr>";} ?>

                              </table>
                       </td>
                       </tr>
                    </table>

<table>
</form>
