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

//***********
		$current_year = date("Y");
		$year_from_current_id = mysql_query("select max(aca_year) from current_id");
		if($year_from_current_id)
		{
			$year_from_current_id_result = mysql_fetch_array($year_from_current_id);
			if($current_year > $year_from_current_id_result[0])
				$current_year -= 1;
			}

		//*************

?>
<?php
if(isset($_POST['submit']))
{
	$medium = $_POST['medium'];
	$class = $_POST['class'];
	$section = $_POST['section'];	
	}
else
{
	$medium = "";
	$class = "";
	$section = "";
	}
?>
<body class="main">
<div class="main">
<h1 align="center">Fee- Paid Status of a class</h1>
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
    <div class="col-md-8" id="submit">
    	<div class="form-group">
        	<input type="submit" name="submit" value="Search" class="form-control" style="background-color:#0F0;" />
        </div>
    </div>
    <div class="col-md-2">
    </div>
</div>
</form>

<?php
if(isset($_POST['submit']))
{
	if($medium != "" && $class != "" && $section != "" )
	{
		$akey_query = mysql_query("select * from akey where medium = '$medium' and class = '$class' and section = '$section'") or die(mysql_error());
		$akey_query_result = mysql_fetch_array($akey_query);
		
		$current_id_query = mysql_query("select * from current_id where akey = '$akey_query_result[0]' and aca_year = '$current_year'") or die(mysql_error());
		$i = 0;
		while($current_id_query_result = mysql_fetch_array($current_id_query))
		{
			$i += 1;
			$vstudent_query = mysql_query("select * from vstudent where current_id = '$current_id_query_result[0]'") or die(mysql_error());
			$vstudent_query_result = mysql_fetch_array($vstudent_query);
			$student_query = mysql_query("select * from student where id = '$current_id_query_result[1]'") or die(mysql_error());
			$student_query_result = mysql_fetch_array($student_query);
				$firstname = $student_query_result['firstname'];
				$lastname = $student_query_result['lastname'];
				$due = $vstudent_query_result['due'];
			if($i == 1)
			echo '
			<div class="row" style="border-bottom:solid;">
    	<div class="col-md-1" style="background-color:#F4F4F4">
        <h4 align="center">SNO.</h4>
        </div>
        <div class="col-md-7" style="background-color:#EAEAEA">
        <h4 align="center">Student</h4>
        </div>
        <div class="col-md-4" style="background-color:#F8F8F8">
        <h4 align="center">Due Amount</h4>
        </div>
    </div>
			';
			
			echo '
			<div class="row" style="border-bottom:ridge;">
    	<div class="col-md-1" style="background-color:#F4F4F4">
        <h5 align="center">'.$i.'</h5>
        </div>
        <div class="col-md-7" style="background-color:#EAEAEA">
        <h5 align="center">'.$firstname.' '.$lastname.'</h5>
        </div>
        <div class="col-md-4" style="background-color:#F8F8F8">
        <h5 align="center">'.$due.'</h5>
        </div>
    </div>
			';
			}
		if($i == 0)
		$message = "No results found..!";
		else echo '<hr>
		<div id="print" align="center">
<input type="button" name="print" style="width:100px;" id="button" class="form-control" value="Print" onclick="printer()" />
</div>
</div>
<script type="text/javascript">
function printer(){
	document.getElementById("print").style.display= "none";
	window.print();
}
</script>
		';
		//$key_sub_query_result = mysql_fetch_array($key_sub_query);
		}
	else
	{
		$message = "Please fill all the fields..!";
		}
	}
else
{

	}
?>
<?php if(isset($message)) echo '<h4 align="center" style="color:#FF0000; background-color:#FFF;">'.$message.'</h4>'; ?>

</div>
</body>
</html>