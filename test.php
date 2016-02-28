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
<title>Untitled Document</title>
</head>
<?php
if(isset($_POST['submit']))
{
	$subject = $_POST['subject'];
	foreach($subject as $i => $j)
	{
		$txt .= '<h1>'.$subject[$i].'</h1>';
		}
	}
	else $txt = "";
?>
<body>
<form action="" method="get">
<div class="row">
<?php 
			$subject_query = mysql_query("select * from subjects") or die(mysql_error());
			while($subject_query_result = mysql_fetch_array($subject_query))
			{
				echo '<div class="col-md-1"><div class="form-group"><input type="checkbox" name="subject[]" class="form-control" value="'.$subject_query_result[0].'">';
				 //if($subject == $subject_query_result[0]) echo 'selected="selected">';
				 echo '<h5 align="center">'.$subject_query_result[1].'</h5></div></div>';
				}
			
			?>
            <input type="submit" value="submit" name="submit" />
            </form>
</div>
<?php echo $txt; ?>
</body>
</html>