<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("header.php"); ?>
<?php
$_SESSION['uname'] = $_GET['id'];
?>
<?php 
if(isset($_POST['submit'])){
	
$newpass = $_POST['newpass'];
$newpass1 = $_POST['newpass1'];
if(notnull($newpass) && notnull($newpass1)){
	$queryresult = mysql_query("select * from owner where and username = '{$_SESSION['uname']}'");
		confirm_query($queryresult);
				if (mysql_num_rows($queryresult) == 1) {
					// username/password authenticated
					// and only 1 match
					$pass = $newpass;
					mysql_query("UPDATE owner set password = '{$pass}' where password = '{$oldpass}' and username = '{$_SESSION['uname']}'");
					
					redirect_to("edit.php?msg=cpsuc");
				}
				else{
				$message = "Password incorrect.<br />
				Please make sure your caps lock key is off and try again.";
				
		}
	}
}
?>
<body>
<header class="header">
    <div style="margin-left:15%; top:0px; position:absolute;">
    <a href="index.php" alt="Home" ><img src="images/Logo.png" width="100px" height="60px" /></a></div>
    <div style="margin-left:40%; top:0px; position:absolute;">
    <h1 align="center">Cabs for Hire</h1></div>
    <div style="margin-left:60%; top:20px; position:absolute;">
    <?php 
	if(isset($_SESSION['uname']))
	{
		$queryresult = mysql_query("select * from owner where and username = '{$_SESSION['uname']}'");
		if($queryresult)
		{
			$qr = mysql_fetch_array($queryresult);
			$_SESSION['name'] = $qr['name'];
		}
		else
		$_SESSION['name'] = "User";
	echo "<p><span style='font-size:14px; padding:1em; color:#FFFFFF'>" . $_SESSION['name']. "</span>";
	echo '<a href="edit.php" id="editform">Edit Profile</a>&nbsp;|&nbsp;
	<a href="logout.php" id="logout">Logout</a></p>';
		}
		else
		{
			echo ' <p><a href="login.php" id="signin" >&nbsp;Sign in</a></p>';
			}
?>
    </div>
</header>
<div class="body">
    <div class="left">
    A@SCARTECH Left
    </div>
    <div class="main">
    <div class="login_form" style="box-sizing:border-box;">
    	<h2 align="center">Reset Password</h2>
			<form name="cp" action="resetpassword.php" method="post" onSubmit="return validate();">
			<table>
				<tr>
					<td>New Password</td>
					<td>:<input type="password" name="newpass" maxlength="20" value="" /></td><td><p id="err"></p></td>
				</tr>
                <tr>
					<td>Confirm Password</td>
					<td>:<input type="password" name="newpass1" maxlength="20" value="" /></td>
				</tr>
                <tr><td><h2> <h2></td></tr>
				<tr>
					<td>&nbsp;</td><td>
                    <table><tr>
                    <td><input type="submit" name="submit" value="Submit" style="width:100px;" /></td><td>&nbsp;</td>
                    <td><input type="reset" name="reset" value="Reset" id="reset" style="width:100px;"/></td>
                    </tr></table>
                    </td>
				</tr>
			</table>
			</form>
</div>
    
    </div>
<div class="right">
A@SCAR right Ads

</div>
    
<footer class="footer">
<p><span class="links"><a href="#" target="_new" >Home</a></span>|<span class="links"><a href="#" target="_new" >About Us</a></span>|<span class="links"><a href="#" target="_new" >Contact Us</a></span>|<span class="links"><a href="#" target="_new" >T & C</a></span><span class="copy">Copyright &copy; A@SCAR 2015</span></p>
</footer>
</body>
<script type="text/javascript">
	function validate()
		{
			var pwd1 = document.cp.newpass.value;
			var pwd2 = document.cp.newpass1.value;
			var msg = "";
			if(pwd1 == "" || pwd2 == "")
				{
					msg = "Every field must be filled..!";
					}
			if(pwd1 != pwd2)
			msg+="<br>Match Conflict..!";
			else if(pwd1.length < 6)
			msg += "<br>Must have greater than 6 charecters";
			if(msg == "")
			{
				return true;
			}
			else
			{
				$("#err").show();
				msg +="<img align='right' src='images/remove.png' width='15px' height='15px'>";
				document.getElementById("err").innerHTML = msg;
				 return false;
			}
		}
	$("#err").click(function(){
			$("#err").hide(500);
			});
	$("#reset").click(function(){
			$("#err").hide(500);
			});
        </script>
    
</html>