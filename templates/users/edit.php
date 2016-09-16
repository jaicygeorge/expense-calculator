<form name="add_form" method="post">
 <span><h3>Edit User</h3></span></p>
 <table width="50%" border="0" align="center" cellpadding="3" cellspacing="5">
                              <tr>
                      <td valign="top" colspan='2' ><?php if($_SESSION['error_message']) {echo $_SESSION['error_message'];unset($_SESSION['error_message']);}?>
                      </td>
                    </tr>
		                      <tr>
                      <td width="43%" valign="top">Name<span class="mandatory">*</span></td>
                      <td width="57%" valign="top"><input name="name" type="text"  size="33" value="<?php if($_POST['name'])echo $_POST['name']; else echo $edit_arr[0]['name'];?>" /></td>
                    </tr>
                    <tr>
                      <td width="43%" valign="top">Email-Id<span class="mandatory">*</span></td>
                      <td width="57%" valign="top"><input name="email" type="text"  size="33" value="<?php if($_POST['email'])echo $_POST['email']; else echo $edit_arr[0]['email'];?>" /></td>
                    </tr>
                    <tr>
                      <td width="43%" valign="top">Phone</td>
                      <td width="57%" valign="top"><input name="phone" type="text"  size="33" value="<?php if($_POST['phone'])echo $_POST['phone']; else echo $edit_arr[0]['phone'];?>" /></td>
                    </tr>

                         <tr>
                      <td width="43%" valign="top">Address</td>
                      <td width="57%" valign="top"><textarea name="address" cols="30" rows="5"><?php if($_POST['address'])echo $_POST['address']; else echo $edit_arr[0]['address'];?></textarea></td>
                    </tr>
                    </tr>

                    <tr>
                     <tr>
                      <td valign="top" colspan='2' ><input name="edit_sub" type="submit" value="Submit"  />&nbsp;<input name="can" type="reset" value="Reset"  /></td>
                    </tr>


<table>
</form>
<script type="text/javascript">
document.add_form.name.focus();
</script>
