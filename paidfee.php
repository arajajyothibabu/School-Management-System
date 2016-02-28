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
$current_id = $_GET['id'];
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


$paid_fee_query = mysql_query("select * from payfee where current_id = '$current_id'");
$current_id_query = mysql_query("select * from current_id where sno = '$current_id' and aca_year = '$current_year'") or die(mysql_error());
$current_id_query_result = mysql_fetch_array($current_id_query);
?>
<body class="main">
<div class="main">
<h2 align="center">Paid history of student</h2>
<div class="row" style="background-color:#FFF">
	<div class="col-md-10">
    <h3 align="right">Total Amount for academic year:</h3>
    </div>
    <div class="col-md-2" style="background-color:#F00">
    <?php
	$fee_query = mysql_query("select * from fee where akey = '$current_id_query_result[2]'") or die(mysql_error());
	$fee_query_result = mysql_fetch_array($fee_query);
	echo '<h3>'.$fee_query_result['fee'].'</h3>';
	?>
    </div>
</div>
	<div class="row" style="border-bottom:solid;">
    	<div class="col-md-1" style="background-color:#F4F4F4">
        <h3 align="center">SNO.</h3>
        </div>
        <div class="col-md-5" style="background-color:#EAEAEA">
        <h3 align="center">Date of Payment</h3>
        </div>
        <div class="col-md-6" style="background-color:#F8F8F8">
        <h3 align="center">Amount Paid</h3>
        </div>
    </div>
<?php
	$i = 0;
	$sum = 0;
while($paid_fee_query_result = mysql_fetch_array($paid_fee_query))
{
	$i += 1;
	$sum += $paid_fee_query_result['amount'];
	echo '
	<div class="row" style="border-bottom:ridge;">
    	<div class="col-md-1" style="background-color:#F4F4F4">
        <h3 align="center">'.$i.'</h3>
        </div>
        <div class="col-md-5" style="background-color:#EAEAEA">
        <h3 align="center">'.$paid_fee_query_result['dop'].'</h3>
        </div>
        <div class="col-md-6" style="background-color:#F8F8F8">
        <h3 align="center">'.$paid_fee_query_result['amount'].'</h3>
        </div>
    </div>
	';
	
	}
	if($i == 0)
	$mesaage = "No paid yet..!";

?>
<div class="row" style="background-color:#FFF">
	<div class="col-md-10">
    <h3 align="right">Total Amount paid:</h3>
    </div>
    <div class="col-md-2" style="background-color:#0F0;">
    <?php
	echo '<h3>'.$sum.'</h3>';
	?>
    </div>
</div>
<div class="row">
	<div class="col-md-10">
    </div>
    <div class="col-md-2">
    <a href="details.php?id=<?php
	echo $current_id.'"><h3>Back</h3></a>';
	?>
    </div>
</div>
<?php if(isset($message)) echo '<h4 align="center" style="color:#FF0000; background-color:#FFF;">'.$message.'</h4>'; ?>
</div>
</body>
</html>