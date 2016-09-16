<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>M-EXPENSE</title>
<script type="text/javascript" src="js/validate.js"></script>
</head>

<body>
<form name="form2" method="post">
<div style="padding-left:500px;width:600px;" ><h2>M-EXPENSES</h2></div>
 <table width="50%" border="0" align="center" cellpadding="3" cellspacing="5">
                              <tr>
                      <td valign="top" colspan='2' ><?php if($_SESSION['error_message']) {echo $_SESSION['error_message'];unset($_SESSION['error_message']);}?>
                      </td>
                    </tr>
		                      <tr>
                      <td width="43%" valign="top">User Name<span class="mandatory">*</span></td>
                      <td width="57%" valign="top"><input name="username" type="text"  size="33"  /></td>
                    </tr>
                     <tr>
                      <td width="43%" valign="top">Password<span class="mandatory">*</span></td>
                      <td width="57%" valign="top"><input name="password" type="password"  size="33"  /></td>
                    </tr>
                    <tr>
                      <td valign="top" colspan='2' ><input name="login_sub" type="submit" value="Submit"  />&nbsp;<input name="can" type="reset" value="Reset"  /></td>
                    </tr>
                    </table>
                    
<table>
</form>
<script type="text/javascript">
document.form2.username.focus();
</script>
</body>
</html>


