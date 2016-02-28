<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
<script src="js/bootstrap.min.js" type="text/javascript"></script>
</head>
<?php
if(isset($_POST['login']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$queryresult = mysql_query("select * from users where username = '$username' and password = '$password'") or die(mysql_error());
			if (mysql_num_rows($queryresult) == 1) {
				// username/password authenticated
				// and only 1 match
				$found_user = mysql_fetch_array($queryresult);
				$_SESSION['user'] = $found_user['privacy'];
				redirect_to("leftnavbar.php?user=".$found_user['privacy']);
			}
			else{
			$message = "Username/password combination incorrect.<br />
			Please make sure your caps lock key is off and try again.";
		}
}
?>
<body class="leftnavbar">
<div class="" style="margin:30px;">
<h3 align="">Login</h3>
<hr />
	<div class="row">
    <form role="form" action="" method="post">
    	<div class="col-md-4">
        	<div class="form-group">
            	<input type="text" style="width:200px;" required="required" class="form-control" name="username" value="" placeholder="UserName" />
            </div>
        </div>
    	<div class="col-md-4">
        	<div class="form-group">
            	<input type="password" required="required" style="width:200px;" class="form-control" name="password" value="" placeholder="UserName" />
            </div>
        </div>
       	<div class="col-md-4" style="float:left;">
        <table>
        <tr>
        <td>
        	 <input type="submit" style="background-color:#0F0; width:100px;" class="form-control" name="login" value="Login" />
        </td>
        <td>
        	 <input type="reset" style="width:100px;" class="form-control" name="username" value="Reset"/>
        </td>
        </tr>
        </table>
        </div>
    </form>
    </div>
</div>
</body>
</html>