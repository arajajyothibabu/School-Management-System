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
if(isset($_POST['update']))
{
	$medium = $_POST['medium'];
	$class = $_POST['class'];
	$section = $_POST['section'];
	$keysub = $_POST['keysub'];
	$faculty = $_POST['faculty'];

	$i = 0;
	foreach($keysub as $i => $j)
	{
		
		$qry = mysql_query("UPDATE sub_staff set staff = '$faculty[$i]' where key_sub = '$keysub[$i]' and stamp = '$current_year'") or die(mysql_error());
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
	$subject = $_POST['subject'];
}
else
{
	$medium = "";
	$class = "";
	$section = "";
	$subject = "";
	}
?>
<body class="main">
<div class="main">
<h1 align="center">Staff & Subjects</h1>
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
	<div class="col-md-3">
    </div>
    <div class="col-md-6">
    	<div class="form-group">
        	<select name="subject" class="form-control">
            <option value="">--Subject--</option>
            <?php 
			$subjects_query = mysql_query("select * from subjects") or die(mysql_error());
			while($subjects_query_result = mysql_fetch_array($subjects_query))
			{
				echo '<option value="'.$subjects_query_result[0].'"';
				 if($subject == $subjects_query_result[0]) echo 'selected="selected">';
				 else echo '>';
				 echo $subjects_query_result[1].'</option>';
				}
			
			?>
            </select>
        </div>
    </div>
    <div class="col-md-3">
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
		$akey_query = mysql_query("select * from akey where medium = '$medium' and class = '$class' and section = '$section'") or die(mysql_error());
		$akey_query_result = mysql_fetch_array($akey_query);
		if($subject != "")
			$key_sub_query = mysql_query("select * from key_sub where sub = '$subject' and akey = '$akey_query_result[0]'");
		else
			$key_sub_query = mysql_query("select * from key_sub where akey = '$akey_query_result[0]'");
			
			
			
		$i = 0;
		$color = "#000";
		while($key_sub_query_result = mysql_fetch_array($key_sub_query))
		{
		
			
			if($i == 0)
				echo '<div class="row" style="border-bottom:solid;">
    <div class="col-md-2" style="background-color:#F4F4F4">
    <h3 align="center">SNO.</h3>
    </div>
    <div class="col-md-4" style="background-color:#F8F8F8" >
    <h3 align="center">Subject</h3>
    </div>
	<div class="col-md-6" style="background-color:#F8F8F8" >
    <h3 align="center">Name</h3>
    </div>
</div>';
			$sub_staff_query = mysql_query("select * from sub_staff where key_sub = '$key_sub_query_result[0]' and stamp = '$current_year'") or die(mysql_error());
			if($sub_staff_query_result = mysql_fetch_array($sub_staff_query))
			{
				$i += 1;
							
				//$staff_query = mysql_query("select * from staff where sno = '$sub_staff_query_result[2]'");
				//$staff_query_result = mysql_fetch_array($staff_query);
				
				$subject_query = mysql_query("select * from subjects where sno = '$key_sub_query_result[sub]'") or die(mysql_error());
				$subject_query_result = mysql_fetch_array($subject_query);
			
				if($color == "#FFF") $color = "#000";
				else $color = "#FFF";
				echo '<div class="row" style="border-bottom:thick;">
				<input type="hidden" name="keysub[]" value="'.$key_sub_query_result[0].'">
    <div class="col-md-2" style="background-color:#F4F4F4">
    	<div class="form-group">
    		<input type="text" style="text-align:center;" class="form-control" readonly="readonly" value="'.$i.'">
		</div>
    </div>
    <div class="col-md-4" style="background-color:#EAEAEA" >
		<div class="form-group">
    		<input type="text" class="form-control" style="text-align:center;"  readonly="readonly" value="'.$subject_query_result['name'].'">
		</div>
    </div>
    <div class="col-md-6" style="background-color:#F8F8F8">
		<div class="form-group">
			<div class="form-group">
        	<select name="faculty[]" style="text-align:center;" class="form-control">';
			$staffs_query = mysql_query("select * from staff") or die(mysql_error());
			while($staffs_query_result = mysql_fetch_array($staffs_query))
			{
				echo '<option style="text-align:center;" value="'.$staffs_query_result[0].'"';
				 if($sub_staff_query_result[2] == $staffs_query_result[0]) echo 'selected="selected">';
				 else echo '>';
				 echo $staffs_query_result[1].'</option>';
				}
				echo '
            </select>
        </div>
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