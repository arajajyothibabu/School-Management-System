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
if($_GET['action'] == 1)
$page = "editdetails.php";
else if($_GET['action'] == 2)
$page = "payfee.php";
else if($_GET['action'] == 3)
$page = "details.php";
?>
<body class="main">
<form role="form" name="f" action="" method="post">
<div class="row">
<h3 align="center">Search for the student</h3>
	<div class="col-md-2">
    	<div class="form-group">
        	<input type="text" list="ids" class="form-control" name="sid" id="id" placeholder="Unique-Id" value="" />
            <datalist id="ids">
            <option>NPSHS</option>
            <option>NPSES</option>
            <option>NPSKG</option>
            <option>NVHS</option>
            <option>NVES</option>
            </datalist>
        </div>
    </div>
    <div class="col-md-1">
    	<div class="form-group">
        	<p style="font-size:24px">or</p> 
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <select class="form-control" id="medium" name="medium">
            	<option value="">--Meduim--</option>
               	<option value="E">English Medium</option>
               	<option value="T">Telugu Medium</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
    	<div class="form-group">
            <select class="form-control" id="sell" name="class">
            	<option value="">--Class--</option>
               	<option value="-2">LKG</option>
               	<option value="-1">UKG</option>
               	<option value="0">Nursery</option>
               	<option value="1">1</option>
                <option value="2">2</option>
               	<option value="3">3</option>
               	<option value="4">4</option>
               	<option value="5">5</option>
                <option value="6">6</option>
               	<option value="7">7</option>
               	<option value="8">8</option>
               	<option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
    	<div class="form-group">
        	<select name="section" class="form-control">
            	<option value="">--Section--</option>
    			<option value="A">A</option>
                <option value="A">B</option>
                <option value="A">C</option>
                <option value="A">D</option>
                <option value="A">E</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-md-12">
    	<div class="form-group">
        	<input style="background-color:#0F0; font-size:18px;" type="submit" class="form-control" value="Search" name="search" />
        </div>
    </div>
</div>
</form>

<hr />
<?php
if(isset($_POST['search']))
{
	$message = "";
	if($_POST['sid'] == "" && $_POST['medium'] == "" && $_POST['class'] == "" && $_POST['section'] == "" )
	$message = "Please enter something to search..!";
	else
	{
		$i = 0;
	//***************************
	$current_year = date("Y");
		$year_from_current_id = mysql_query("select max(aca_year) from current_id");
		if($year_from_current_id)
		{
			$year_from_current_id_result = mysql_fetch_array($year_from_current_id);
			if($current_year > $year_from_current_id_result[0])
				$current_year -= 1;
			}
	//***************************
	if(isset($_POST['sid']) && $_POST['sid'] != "")
	{
		$current_id_query = mysql_query("select * from current_id where id = '$_POST[sid]' and aca_year = '$current_year'");
		if($current_id_query)
		{
			$current_id_query_result = mysql_fetch_array($current_id_query);
			$vstudent_query = mysql_query("select * from vstudent where current_id = '$current_id_query_result[0]'") or die(mysql_error());
			if($vstudent_query)
			{
				$vstudent_query_result = mysql_fetch_array($vstudent_query);
				$student_query = mysql_query("select * from student where id = '$_POST[sid]'");
				$i = 0;
				if($student_query)
				{
				while($search_result = mysql_fetch_array($student_query))
				{
			$i = 1;
			echo '<div class="row" style="border-bottom:solid;">
<div class="col-md-1" style="background-color:#F4F4F4">
<h3 align="center">SNO.</h3>
</div>
<div class="col-md-5" style="background-color:#EAEAEA" >
<h3 align="center">Unique-Id</h3>
</div>
<div class="col-md-6" style="background-color:#F8F8F8">
<h3 align="center">Student</h3>
</div>
</div>
';

					echo '<a href="'.$page.'?id='.$current_id_query_result[0].'"><div style="background-color:#FFFFFF;" class="row">
<div class="col-md-1" style="background-color:#F4F4F4">
<h5 align="center">'.$i.'</h5>
</div>
<div class="col-md-5" style="background-color:#EAEAEA" >
<h5 align="center">'.$search_result[0].'</h5>
</div>
<div class="col-md-6" style="background-color:#F8F8F8">
<h5 align="center">'.$search_result[1].' '.$search_result[2].'</h5>
</div>
</div></a>';
				}
			}
			}
		}
		}
	else
	{
		$medium = getClearedNull($_POST['medium']);
		$class = getClearedNull($_POST['class']);
		$section = getClearedNull($_POST['section']);
		if($medium != "" && $class != "" && $section != "") {
			$i = 0;
			$akey_query = mysql_query("select * from akey where medium LIKE '$medium' && class LIKE '$class' && section LIKE '$section'") or die(mysql_error());
			while ($akey = mysql_fetch_array($akey_query)) {
				//query for current id
				$current_id_query = mysql_query("select * from current_id where akey = '$akey[0]' and aca_year = '$current_year' ORDER BY id");

				$color = "#000";
				while ($current_id_query_result = mysql_fetch_array($current_id_query)) {
					$i += 1;
					if ($i == 1)
						echo '<div class="row" style="border-bottom:solid;">
<div class="col-md-1" style="background-color:#F4F4F4">
<h3 align="center">SNO.</h3>
</div>
<div class="col-md-5" style="background-color:#EAEAEA">
<h3 align="center">Unique-Id</h3>
</div>
<div class="col-md-6" style="background-color:#F8F8F8">
<h3 align="center">Student</h3>
</div>
</div>
';
					//vstudent and students query
					$vstudent_query = mysql_query("select * from vstudent where current_id = '$current_id_query_result[1]'");
					$vstudent_query_result = mysql_fetch_array($vstudent_query);
					$student_query = mysql_query("select * from student where id = '$current_id_query_result[id]'");
					$search_result = mysql_fetch_array($student_query);
					if ($color == "#FFF") $color = "#000";
					else $color = "#FFF";
					echo '<a href="' . $page . '?id=' . $current_id_query_result[0] . '"><div style="border-bottom:solid;" class="row">
<div class="col-md-1" style="background-color:#F4F4F4">
<h5 align="center">' . $i . '</h5>
</div>
<div class="col-md-5" style="background-color:#EAEAEA" >
<h5 align="center">' . $search_result[0] . '</h5>
</div>
<div class="col-md-6" style="background-color:#F8F8F8">
<h5 align="center">' . $search_result[1] . ' ' . $search_result[2] . '</h5>
</div>
</div></a>';
				}
			}
		}
			else
			$message = "Kindly select all fields, if search for an entire class..!";
		}
		if($i == 0 && empty($message))
		$message = "No results found..!";


//displaying students at a bulk
	}
}
?>
<?php if(isset($message)) echo '<h4 align="center" style="color:#FF0000; background-color:#FFF;">'.$message.'</h4>'; ?>

</div>
</body>
</html>