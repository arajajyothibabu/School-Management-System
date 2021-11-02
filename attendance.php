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
if(isset($_POST['update']))
{
	$medium = $_POST['medium'];
	$class = $_POST['class'];
	$section = $_POST['section'];
	$current_id = $_POST['current_id'];
	$noc = $_POST['noc'];
	$nocp = $_POST['nocp'];
	$i = 0;
	foreach($current_id as $i => $j)
	{
		if($noc != 0)
		$noca[$i] = ($nocp[$i]/$noc)*100;
		else $noca[$i] = 0;
		$qry = mysqli_query($connection,"UPDATE attendance set noc = '$noc', nocp = '$nocp[$i]', noca = '$noca[$i]' where current_id = '$current_id[$i]'") or die(mysqli_error($connection));
		$i += 1;
		}
		if($i != 0)
		$message = 'Updated successfully..!';
		else
		$message = "Something went wrong. Try again..!";
	}
?>
<?php
if(isset($_POST['submit']) || isset($_POST['update']))
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
<h1 align="center">Attendance of class</h1>
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
            	<option value="">--Class--</option>
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
            	<option value="">--Section--</option>
    			<option value="A" <?php if($section == "A")echo 'selected="selected"';?>>A</option>
                <option value="B" <?php if($section == "B")echo 'selected="selected"';?>>B</option>
                <option value="C" <?php if($section == "C")echo 'selected="selected"';?>>C</option>
                <option value="D" <?php if($section == "D")echo 'selected="selected"';?>>D</option>
                <option value="E" <?php if($section == "E")echo 'selected="selected"';?>>E</option>
            </select>
        </div>
    </div>
</div>
<hr  />
<div class="row">
    <div class="col-md-12">
    	<div class="form-group">
        	<input type="submit" name="submit" value="Search" class="form-control" style="background-color:#0F0;" />
        </div>
    </div>
</div>
<?php

if(isset($_POST['submit']) || isset($_POST['update']))
{
	if($medium != "" && $class != "" && $section != "")
	{
		$akey_query = mysqli_query($connection,"select * from akey where medium = '$medium' and class = '$class' and section = '$section'") or die(mysqli_error($connection));
		$akey_query_result = mysqli_fetch_array($akey_query);
		/*$key_sub_query = mysql_query("select * from key_sub where sub = '$subject' and akey = '$akey_query_result[0]'");
		$key_sub_query_result = mysql_fetch_array($key_sub_query);*/
		//***********
		$current_year = date("Y");
		$year_from_current_id = mysqli_query($connection,"select max(aca_year) from current_id");
		if($year_from_current_id)
		{
			$year_from_current_id_result = mysqli_fetch_array($year_from_current_id);
			if($current_year > $year_from_current_id_result[0])
				$current_year -= 1;
			}

		//*************
		$current_id_query = mysqli_query($connection,"select * from current_id where akey = '$akey_query_result[0]' and aca_year = '$current_year'") or die(mysqli_error($connection));
		$i = 0;
		$color = "#000";
		while($current_id_query_result = mysqli_fetch_array($current_id_query))
		{
			$i += 1;
			if($i == 1)
				echo '<div class="row" style="border-bottom:solid;">
    <div class="col-md-1" style="background-color:#F4F4F4">
    <h3 align="center">SNO.</h3>
    </div>
    <div class="col-md-5" style="background-color:#EAEAEA" >
    <h3 align="center">Student</h3>
    </div>
    <div class="col-md-2" style="background-color:#F8F8F8">
    <h3 align="center">No: of days</h3>
    </div>
    <div class="col-md-2" style="background-color:#EAEAEA">
    <h3 align="center">Present</h3>
    </div>
    <div class="col-md-2" style="background-color:#F8F8F8">
    <h3 align="center">Percentage</h3>
    </div>
</div>';
			//static student details
			$student_query = mysqli_query($connection,"select * from student where id = '$current_id_query_result[1]'") or die(mysqli_error($connection));
			$student_query_result = mysqli_fetch_array($student_query);
			$attendance_query = mysqli_query($connection,"select * from attendance where current_id = '$current_id_query_result[0]'") or die(mysqli_error($connection));
			$attendance_query_result = mysqli_fetch_array($attendance_query);
				if($color == "#FFF") $color = "#000";
				else $color = "#FFF";
				echo '<div class="row" style="border-bottom:thick;">
				<input type="hidden" name="current_id[]" value="'.$current_id_query_result[0].'">
    <div class="col-md-1" style="background-color:#F4F4F4">
    	<div class="form-group">
    		<input type="text" style="text-align:center;" class="form-control" readonly="readonly" value="'.$i.'">
		</div>
    </div>
    <div class="col-md-5" style="background-color:#EAEAEA" >
		<div class="form-group">
    		<input type="text" class="form-control" style="text-align:center;"  readonly="readonly" value="'.$student_query_result['firstname'].' '.$student_query_result['lastname'].'">
		</div>
    </div>
    <div class="col-md-2" style="background-color:#F8F8F8">
    	<div class="form-group">';
		if($i == 1)
		echo '<input type="text" style="text-align:center;" placeholder="NO: of days" class="form-control" name="noc" value="'.$attendance_query_result['noc'].'">';
		else
		echo'<input type="text" style="text-align:center;" readonly="readonly"  class="form-control" name="noc1" value="'.$attendance_query_result['noc'].'">';
		echo '</div>
    </div>
    <div class="col-md-2" style="background-color:#EAEAEA">
    	<div class="form-group">
			<input type="text" style="text-align:center;"  class="form-control" name="nocp[]" value="'.$attendance_query_result['nocp'].'">
		</div>
    </div>
    <div class="col-md-2" style="background-color:#F8F8F8">
		<div class="form-group">
    		<input type="text" style="text-align:center;"  class="form-control" readonly="readonly" value="'.$attendance_query_result['noca'].'">
		</div>	
    </div>
</div>';
			
			}
						if($i == 0)
						$message = "No results found..!";
						else
						echo '<hr><div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-10">
					<div class="form-group">
						<input type="submit" name="update" value="Update" class="form-control" style="background-color:#00CC33;" />
					</div>
				</div>
				<div class="col-md-1">
				</div>
			</div>';
		}
		else $message = 'Select all fields to update..!';
	
	}
else
{
	
	}
?>

</form>
<?php if(isset($message)) echo '<h4 align="center" style="color:#FF0000; background-color:#FFF;">'.$message.'</h4>'; ?>
</div>
</body>
</html>