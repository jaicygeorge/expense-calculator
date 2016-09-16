<form name="add_form" method="post">
 <span><h3>Add New User</h3></span></p>
 <table width="50%" border="0" align="center" cellpadding="3" cellspacing="5">
                              <tr>
                      <td valign="top" colspan='2' ><?php if($_SESSION['error_message']) {echo $_SESSION['error_message'];unset($_SESSION['error_message']);}?>
                      </td>
                    </tr>
		                      <tr>
                      <td width="43%" valign="top">Name<span class="mandatory">*</span></td>
                      <td width="57%" valign="top"><input name="name" type="text"  size="33" value="<?php echo $_POST['name'];?>" /></td>
                    </tr>
                    <tr>
                      <td width="43%" valign="top">Email-Id<span class="mandatory">*</span></td>
                      <td width="57%" valign="top"><input name="email" type="text"  size="33" value="<?php echo $_POST['email'];?>" /></td>
                    </tr>
                    <tr>
                      <td width="43%" valign="top">Phone</td>
                      <td width="57%" valign="top"><input name="phone" type="text"  size="33" value="<?php echo $_POST['phone'];?>" /></td>
                    </tr>

                         <tr>
                      <td width="43%" valign="top">Address</td>
                      <td width="57%" valign="top"><textarea name="address" cols="30" rows="5"><?php echo $_POST['address'];?></textarea></td>
                    </tr>
                    </tr>

                    <tr>
                     <tr>
                      <td valign="top" colspan='2' ><input name="add_sub" type="submit" value="Submit"  />&nbsp;<input name="can" type="reset" value="Reset"  /></td>
                    </tr>


<table>
</form>
<script type="text/javascript">
document.add_form.name.focus();
</script>
