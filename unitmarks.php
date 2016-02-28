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
	$acakey = $_POST['acakey'];
	$marks = $_POST['marks'];
	$test = $_POST['test'];
	$i = 0;
	foreach($acakey as $i => $j)
	{
		
		$qry = mysql_query("UPDATE marks_units set marks = '$marks[$i]' where aca_key = '$acakey[$i]' and test = '$test'") or die(mysql_error());
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
	$test = $_POST['test'];
	$subject = $_POST['subject'];
}
else
{
	$medium = "";
	$class = "";
	$section = "";
	$test = "";
	$subject = "";
	}
?>
<body class="main">
<div class="main">
<h1 align="center">UNIT-Test Marks</h1>
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
<div class="row">    
	<div class="col-md-2">
    </div>
    <div class="col-md-4">
    	<div class="form-group">
        	<select name="test" class="form-control">
            	<option value="">--Unit-Test/Terminals--</option>
                <?php
				$units_test_query = mysql_query("select * from test") or die(mysql_error());
				if($units_test_query)
				while($units_test_query_result = mysql_fetch_array($units_test_query))
				{
					echo '<option value="'.$units_test_query_result[0].'"';
					if($test == $units_test_query_result[0]) echo 'selected="selected">';
					else echo '>';
					echo $units_test_query_result[1].'</option>';
					}
				?>
            </select>
        </div>
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
    <div class="col-md-2">
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
	if($medium != "" && $class != "" && $section != "" && $test != "" && $subject != "")
	{
		$akey_query = mysql_query("select * from akey where medium = '$medium' and class = '$class' and section = '$section'") or die(mysql_error());
		$akey_query_result = mysql_fetch_array($akey_query);
		$key_sub_query = mysql_query("select * from key_sub where sub = '$subject' and akey = '$akey_query_result[0]'");
		$key_sub_query_result = mysql_fetch_array($key_sub_query);
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
		$current_id_query = mysql_query("select * from current_id where akey = '$akey_query_result[0]' and aca_year = '$current_year'") or die(mysql_error());
		$i = 0;
		$color = "#000";
		while($current_id_query_result = mysql_fetch_array($current_id_query))
		{
				//academic key query for sujects in unit tests
				$aca_key_query = mysql_query("select * from aca_key where current_id = '$current_id_query_result[0]' and key_sub = '$key_sub_query_result[0]'");
				$aca_key = mysql_fetch_array($aca_key_query);
				
			if($aca_key[0])
			{
			$i += 1;
			if($i == 1)
				echo '<div class="row" style="border-bottom:solid;">
    <div class="col-md-2" style="background-color:#F4F4F4">
    <h3 align="center">SNO.</h3>
    </div>
    <div class="col-md-6" style="background-color:#EAEAEA" >
    <h3 align="center">Student</h3>
    </div>
    <div class="col-md-4" style="background-color:#F8F8F8">
    <h3 align="center">Marks</h3>
    </div>
</div>';
			//static student details
			$student_query = mysql_query("select * from student where id = '$current_id_query_result[1]'") or die(mysql_error());
			$student_query_result = mysql_fetch_array($student_query);
			$tests_query = mysql_query("select * from marks_units where aca_key = '$aca_key[0]' and test = '$test'") or die(mysql_error());
			if($tests_query)
			$tests_query_result = mysql_fetch_array($tests_query);
			
				if($color == "#FFF") $color = "#000";
				else $color = "#FFF";
				echo '<div class="row" style="border-bottom:thick;">
				<input type="hidden" name="acakey[]" value="'.$aca_key[0].'">
    <div class="col-md-2" style="background-color:#F4F4F4">
    	<div class="form-group">
    		<input type="text" style="text-align:center;" class="form-control" readonly="readonly" value="'.$i.'">
		</div>
    </div>
    <div class="col-md-6" style="background-color:#EAEAEA" >
		<div class="form-group">
    		<input type="text" class="form-control" style="text-align:center;"  readonly="readonly" value="'.$student_query_result['firstname'].' '.$student_query_result['lastname'].'">
		</div>
    </div>
    <div class="col-md-4" style="background-color:#F8F8F8">
		<div class="form-group">
    		<input type="text" style="text-align:center;" name="marks[]" class="form-control" value="'.$tests_query_result['marks'].'">
		</div>	
    </div>
</div>';
			}
			}
						if($i == 0)
						$message = "No results found..!";
						else
						echo '<hr><div class="row">
				<div class="col-md-2">
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<input type="submit" name="update" value="Update" class="form-control" style="background-color:#00CC33;" />
					</div>
				</div>
				<div class="col-md-2">
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