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
	$amount = $_POST['amount'];
	if($medium != "" && $class != "" && $section != "" && $amount != "")
	{
		$akey_query = mysql_query("select * from akey where medium = '$medium' and class = '$class' and section = '$section'") or die(mysql_error());
		$akey_query_result = mysql_fetch_array($akey_query);
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
		$fee_query = mysql_query("INSERT into fee values('','$akey_query_result[0]','$amount')") or die(mysql_error());
		if($fee_query)
			$message = "Inserted successfully..!";
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
	}
?>
<body class="main">
<div class="main">
<h1 align="center">Insert fee for a class</h1>
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
	<div class="col-md-4">
    </div>
    <div class="col-md-4">
    	<div class="form-group">
        	<input type="text" name="amount" value="" class="form-control" placeholder="Enter Amount"/>
        </div>
    </div>
    <div class="col-md-4">
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