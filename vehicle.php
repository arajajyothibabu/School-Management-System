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
$transport = "";
if(isset($_POST['submit']))
$transport = $_POST['transport'];
?>


<body class="main">
<h1 align="center">Transport Details</h1>
<div class="main">
<div class="row">
<form role="form" action="" method="post">
	<div class="col-md-1">
    </div>
	<div class="col-md-4">
    	<div class="form-group">
        	<select name="transport" class="form-control">
            <option value="">-Bus Route(Transport)-</option>
            <option value="0">ByWalk</option>
            <?php 
			$transport_query = mysql_query("select * from transport");
			while($result = mysql_fetch_array($transport_query))
			{
				if($transport == $result[0]) $selected = 'selected="selected"';
				else $selected = "";
			echo '<option value="'.$result[0].'"'.$selected.'>'.$result[1].' / '.$result[2].'</option>';
			}
			?>
            </select>
        </div>
	</div>
    <div class="col-md-6">
    	<div class="form-group">
        	<input type="submit" name="submit" value="Submit" class="form-control" style="background-color:#0F0;" />
        </div>
    </div>
    <div class="col-md-1">
    </div>
</div>
</form>
<hr />
<?php
if(isset($_POST['submit']))
{
	if($transport != "")
		{
					$vstudent_query = mysql_query("select * from vstudent where transport = '$transport'") or die(mysql_error());
	$i = 0;
	while($vstudent_query_result = mysql_fetch_array($vstudent_query))
		{
			$i += 1;
			if($i == 1)
			echo '
			<div class="row" style="border-bottom:solid;">
	<div class="col-md-1" style="background-color:#F1F1F1;">
    <h4 align="center">SNO.<h4></div>
    <div class="col-md-3"  style="background-color:#FFF;"><h4 align="center">Student</h4>    
    </div>
    <div class="col-md-2"  style="background-color:#F1F1F1;"><h4 align="center">Guardian</h4>
    </div>
    <div class="col-md-3"  style="background-color:#FFF;"><h4 align="center">Address</h4>
    </div>
    <div class="col-md-3"  style="background-color:#F1F1F1;"><h4 align="center">Contact</h4>
    </div>    
</div>			
			';
					
					$current_id_query = mysql_query("select * from current_id where sno = '$vstudent_query_result[1]' and aca_year = '$current_year'") or die(mysql_error());
					$current_id_query_result = mysql_fetch_array($current_id_query);

					$akey_query = mysql_query("select * from akey where sno = '$current_id_query_result[akey]'") or die(mysql_error());
					$akey_query_result = mysql_fetch_array($akey_query);
										
					$student_query = mysql_query("select * from student where id = '$current_id_query_result[1]'") or die(mysql_error());
					$student_query_result = mysql_fetch_array($student_query);
					$parent_query = mysql_query("select * from parent where id = '$current_id_query_result[1]'") or die(mysql_error());
					$parent_query_result = mysql_fetch_array($parent_query);
					
										
					
//storing details

	$id = $current_id_query_result['id'];
	$spic = $vstudent_query_result['pic'];
	$section = $akey_query_result['section'];
	$firstname = $student_query_result['firstname'];
	$lastname = $student_query_result['lastname'];
	$sex = $student_query_result['sex'];
	$class = $akey_query_result['class'];
	$medium = $akey_query_result['medium'];
	$dob = $student_query_result['dob'];
	$doj = $student_query_result['doj'];
	$caste = $student_query_result['caste'];
	$religion = $student_query_result['religion'];
	$siblings = $parent_query_result['siblings'];
	$aadhar = $student_query_result['aadhar'];
	$ration = $student_query_result['ration'];
	$address = $vstudent_query_result['address'];
	$contact = $vstudent_query_result['contact'];
	$transport = $vstudent_query_result['transport'];
	$fname = $parent_query_result['fname'];
	$focu = $parent_query_result['focu'];
	$fedu = $parent_query_result['fedu'];
	$mname = $parent_query_result['mname'];
	$mocu = $parent_query_result['mocu'];
	$medu = $parent_query_result['medu'];
	$fpic = $parent_query_result['fpic'];
	$mpic = $parent_query_result['mpic'];
	$due = $vstudent_query_result['due'];
	echo '
	<div class="row" style="border-bottom:ridge;">
	<div class="col-md-1" style="background-color:#F1F1F1;"><h5 align="center">
    '.$i.'</h5></div>
    <div class="col-md-3"  style="background-color:#FFF;"><h5 align="center">'.$firstname.' '.$lastname.'</h5>    
    </div>
    <div class="col-md-2"  style="background-color:#F1F1F1;"><h5 align="center">'.$fname.'</h5>
    </div>
    <div class="col-md-3"  style="background-color:#FFF;"><h5 align="center">'.$address.'<h5>
    </div>
    <div class="col-md-3"  style="background-color:#F1F1F1;"><h5 align="center">'.$contact.'</h5>
    </div>    
</div>
	';
		}
		if($i == 0)
		$message = "No records found..!";
	}
	else $message = "Select something to find..!";
}
	
?>


</div>
</body>
</html>