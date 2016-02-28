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
if(isset($_POST['insert']))
{
	$medium = $_POST['medium'];
	$class = $_POST['class'];
	$section = $_POST['section'];
	$dtno = $_POST['dtno'];
	$subject = $_POST['subject'];
	if($medium != "" && $class != "" && $section != "" && $dtno != "" && $subject != "")
	{
		$akey_query = mysql_query("select * from akey where medium = '$medium' and class = '$class' and section = '$section'") or die(mysql_error());
		$akey_query_result = mysql_fetch_array($akey_query);
		$key_sub_query = mysql_query("select * from key_sub where sub = '$subject' and akey = '$akey_query_result[0]'");
		$key_sub_query_result = mysql_fetch_array($key_sub_query);
		//***********
		$current_year = date("Y");
		$year_from_current_id = mysql_query("select * from current_id where aca_year = '$current_year'");
		if(empty($year_from_current_id))
			$current_year -= 1;
		//*************
		$current_id_query = mysql_query("select * from current_id where akey = '$akey_query_result[0]' and aca_year = '$current_year'") or die(mysql_error());
		$i = 0;
		while($current_id_query_result = mysql_fetch_array($current_id_query))
		{
			$i += 1;
			
			$insert_academic_key_query = mysql_query("INSERT into aca_key values('','$current_id_query_result[0]','$key_sub_query_result[0]')");

			$aca_key_query = mysql_query("select max(sno) from aca_key");
			$aca_key = mysql_fetch_array($aca_key_query);
				//insering tuples for entire class
				$insert_marks_DT_query = mysql_query("INSERT into marks_dt values('','$aca_key[0]','$dtno','','1')") or die(mysql_error());
			}
			if($i == 0)
			$message = "No records inserted..! Try again..!";
			else $message = '<span style="font-size:16;">'.$i.'</span> students have their records inserted..!';
		}
	else
	{
		$message = "Please fill all the fields..!";
		}
	}
else
{
	$medium = "";
	$class = "";
	$section = "";
	$dtno = "";
	$subject = "";
	}
?>
<body class="main">
<div class="main">
<h1 align="center">Insert DT inforamtion for a class</h1>
<form role="form" action="" method="post">
<div class="row">
	<div class="col-md-4">
    	<div class="form-group">
            <select class="form-control" id="medium" name="medium">
            	<option>--Meduim--</option>
               	<option value="E" <?php if($medium == "E")echo 'selected="selected"';?>>English Medium</option>
               	<option value="T" <?php if($medium == "T")echo 'selected="selected"';?>>Telugu Medium</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
    	<div class="form-group">
            <select class="form-control" id="sel1" name="class">
            	<option>--Class--</option>
               	<option value="-2" <?php if($class == "-2")echo 'selected="selected"';?>>LKG</option>
               	<option value="-1" <?php if($class == "-1")echo 'selected="selected"';?>>UKG</option>
               	<option value="0" <?php if($class == "0")echo 'selected="selected"';?>>Nursery</option>
               	<option value="1" <?php if($class == "1")echo 'selected="selected"';?>>1</option>
                <option value="2" <?php if($class == "2")echo 'selected="selected"';?>>2</option>
               	<option value="3" <?php if($class == "3")echo 'selected="selected"';?>>3</option>
               	<option value="4" <?php if($class == "4")echo 'selected="selected"';?>>4</option>
               	<option value="5" <?php if($class == "5")echo 'selected="selected"';?>>5</option>
                <option value="6" <?php if($class == "6")echo 'selected="selected"';?>>6</option>
               	<option value="7" <?php if($class == "7")echo 'selected="selected"';?>>7</option>
               	<option value="8" <?php if($class == "8")echo 'selected="selected"';?>>8</option>
               	<option value="9" <?php if($class == "9")echo 'selected="selected"';?>>9</option>
                <option value="10" <?php if($class == "10")echo 'selected="selected"';?>>10</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
    	<div class="form-group">
        	<select name="section" class="form-control">
            	<option value="A">--Section--</option>
    			<option value="A" <?php if($section == "A")echo 'selected="selected"';?>>A</option>
                <option value="B" <?php if($section == "B")echo 'selected="selected"';?>>B</option>
                <option value="C" <?php if($section == "C")echo 'selected="selected"';?>>C</option>
                <option value="D" <?php if($section == "D")echo 'selected="selected"';?>>D</option>
                <option value="E" <?php if($section == "E")echo 'selected="selected"';?>>E</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-md-2">
    </div>
    <div class="col-md-4">
    	<div class="form-group">
        	<select name="subject" class="form-control">
            <option value="">--Subject--</option>
            <?php 
			$subject_query = mysql_query("select * from subjects") or die(mysql_error());
			while($subject_query_result = mysql_fetch_array($subject_query))
			{
				echo '<option value="'.$subject_query_result[0].'"';
				 if($subject == $subject_query_result[0]) echo 'selected="selected">';
				 else echo '>';
				 echo $subject_query_result[1].'</option>';
				}
			
			?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
    	<div class="form-group">
        	<select name="dtno" class="form-control">
            <option value="">--DT-Number--</option>
            <?php 
			$i = 1;
			while($i < 26)
			{
				echo '<option value="'.$i.'"';
				 if($dtno == $i) echo 'selected="selected">';
				 else echo '>';
				 echo $i.'</option>';
				 $i += 1;
				}
			
			?>
            </select>
        </div>
    </div>
    <div class="col-md-2">
    </div>
</div>
<hr  />
<div class="row">
	<div class="col-md-2">
    </div>
    <div class="col-md-8">
    	<div class="form-group">
        	<input type="submit" name="insert" value="INSERT" class="form-control" style="background-color:#0F0;" />
        </div>
    </div>
    <div class="col-md-2">
    </div>
</div>
</form>
<?php if(isset($message)) echo '<h4 align="center" style="color:#FF0000; background-color:#FFF;">'.$message.'</h4>'; ?>

</div>
</body>
</html>