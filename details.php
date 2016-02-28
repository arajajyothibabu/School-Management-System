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
$current_id = $_GET['id'];
					$current_id_query = mysql_query("select * from current_id where sno = '$current_id' and aca_year = '$current_year'") or die(mysql_error());
					$current_id_query_result = mysql_fetch_array($current_id_query);
					$akey_query = mysql_query("select * from akey where sno = '$current_id_query_result[akey]'") or die(mysql_error());
					$akey_query_result = mysql_fetch_array($akey_query);
					$vstudent_query = mysql_query("select * from vstudent where current_id = '$current_id'") or die(mysql_error());
					$vstudent_query_result = mysql_fetch_array($vstudent_query);
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
?>

<body class="main">
<h1 align="center">Student Details</h1>
<div class="row" style="border-bottom:ridge; border-top:ridge; background-color:#FAFAFA;">
<h2>Personal Details</h2>
</div>
<div class="row" style="background-color:#F1F1F1;">
	<div class="col-md-2">
        <h4 align="right">Name:</h4>
        <h4 align="right">Aadhar:</h4>
        <h4 align="right">Ration:</h4>
        <h4 align="right">Address:</h4>
        <h4 align="right">Contact:</h4>
        <h4 align="right">Transport:</h4>
        <h4 align="right">Fee Due:</h4>
    </div>
    <div class="col-md-3" style="background-color:#FFF;">
        <h4 align="left"><?php echo $firstname.' '.$lastname; ?></h4>
        <h4 align="left"><?php echo $aadhar; ?></h4>
        <h4 align="left"><?php echo $ration; ?></h4>
        <h4 align="left"><?php echo $address; ?></h4>
        <h4 align="left"><?php echo $contact; ?></h4>
        <h4 align="left"><?php 
			$transport_query = mysql_query("select * from transport where sno = '$transport'");
			while($result = mysql_fetch_array($transport_query))
			{
				echo $result[1].' / '.$result[2];
			}
			?></h4>
        <h4 align="left"><?php echo $due; ?><span style="font-size:12px;"><a href="paidfee.php?id=<?php echo $current_id;?>">View Details</a></span></h4>
    </div>
    <div class="col-md-2">
    	<h4 align="right">Medium:</h4>
        <h4 align="right">Class:</h4>
        <h4 align="right">Section:</h4>
        <h4 align="right">Gender:</h4>
        <h4 align="right">Caste:</h4>
        <h4 align="right">Religion:</h4>
        <h4 align="right">Date of Joining:</h4>
    </div>
    <div class="col-md-2" style="background-color:#FFF;">
    	<h4 align="left"><?php echo $medium; ?></h4>
        <h4 align="left"><?php echo $class; ?></h4>
        <h4 align="left"><?php echo $section; ?></h4>
        <h4 align="left"><?php echo $sex; ?></h4>
        <h4 align="left"><?php
		$caste_query = mysql_query("select * from caste where sno = '$caste'");
				while($caste_query_result = mysql_fetch_array($caste_query))
				{
				 echo $caste_query_result[1];	
				}
			?></h4>
        <h4 align="left"><?php 
		$religion_query = mysql_query("select * from religion where sno = '$religion'");
				while($religion_query_result = mysql_fetch_array($religion_query))
				{
				 echo $religion_query_result[1];
                 }
				?></h4>
        <h4 align="left"><?php echo $doj; ?></h4>
    </div>
    <div class="col-md-3">
    	<div align="center">
        <img class="img-circle" width="180" height="180" src="showimage.php?main=<?php echo $current_id; ?>&sub=0"/>
        </div>
        <div class="form-group" style="background-color:#FFF;">
        	<h4 align="center">Date of Birth: <?php echo $dob; ?></h4>
        </div>
    </div>
</div>
<div class="row" style="border-bottom:ridge; border-top:ridge; background-color:#FAFAFA;">
<h2>Parent Details:</h2>
</div>
<div class="row" style="background-color:#F1F1F1;">
	<div class="col-md-2">
        <h4 align="right">Father:</h4>
        <h4 align="right">Qualification:</h4>
        <h4 align="right">Occupation:</h4>
    </div>
    <div class="col-md-2" style="background-color:#FFF;">
    	<h4 align="left"><?php echo $fname; ?></h4>
        <h4 align="left"><?php echo $fedu; ?></h4>
        <h4 align="left"><?php echo $focu; ?></h4>
    </div>
    <div class="col-md-2">
    	<div>
        <img class="img-circle" width="120" height="120" src="showimage.php?main=<?php echo $current_id; ?>&sub=1"/>
        </div>
    </div>
	<div class="col-md-2">
    	<div>
        <img class="img-circle" width="120" height="120" src="showimage.php?main=<?php echo $current_id; ?>&sub=2"/>
        </div>
    </div>
    <div class="col-md-2" style="background-color:#FFF;">
    	<h4 align="right"><?php echo $mname; ?></h4>
        <h4 align="right"><?php echo $medu; ?></h4>
        <h4 align="right"><?php echo $mocu; ?></h4>
    </div>
	<div class="col-md-2">
        <h4 align="left">:Mother</h4>
        <h4 align="left">:Qualification</h4>
        <h4 align="left">:Occupation</h4>
    </div>
</div>
<?php
					//academic detials..
					$key_sub_query = mysql_query("select * from key_sub where akey = '$akey_query_result[0]'");
				while($key_sub_query_result = mysql_fetch_array($key_sub_query))
				{
					
					$sub_staff_query = mysql_query("select * from sub_staff where key_sub = '$key_sub_query_result[0]' and stamp = '$current_year'") or die(mysql_error());
					while($sub_staff_query_result = mysql_fetch_array($sub_staff_query))
					{
						//storing subjects in an array
						$subjects = 
						
						//staff names
						$staff_query = mysql_query("select * from staff where sno = '$sub_staff_query_result[2]'");
						$staff_query_result = mysql_fetch_array($staff_query);
						
						//storing staff names in an array
						$staff = 
						$aca_key_query = mysql_query("select * from aca_key where current_id = '$current_id' and key_sub = '$key_sub_query_result[0]'");
						while($aca_key_query_result = mysql_fetch_array($aca_key_query))
						{
							$dtmarks_query = mysql_query("select * from marks_dts where aca_key = '$aca_key_query_result[0]'");
							
							}
							
							
							
						}
					
				}

?>
<hr />
<div class="row">
<h2>Weekly Assessments</h2>
</div>

<div class="row">
<h2>Monthly Assessments</h2>
</div>

</div>
</body>
</html>