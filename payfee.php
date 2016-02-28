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
					$current_id_query = mysql_query("select * from current_id where sno = '$current_id'") or die(mysql_error());
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
	//$spic = $vstudent_query_result['pic'];
	$section = $akey_query_result['section'];
	$firstname = $student_query_result['firstname'];
	$lastname = $student_query_result['lastname'];
	//$sex = $student_query_result['sex'];
	$class = $akey_query_result['class'];
	$medium = $akey_query_result['medium'];
	/*$dob = $student_query_result['dob'];
	$doj = $student_query_result['doj'];
	$caste = $student_query_result['caste'];
	$religion = $student_query_result['religion'];
	$siblings = $parent_query_result['siblings'];
	$aadhar = $student_query_result['aadhar'];
	$ration = $student_query_result['ration'];*/
	$address = $vstudent_query_result['address'];
	//$contact = $vstudent_query_result['contact'];
	$transport = $vstudent_query_result['transport'];
	$fname = $parent_query_result['fname'];
	/*$focu = $parent_query_result['focu'];
	$fedu = $parent_query_result['fedu'];
	$mname = $parent_query_result['mname'];
	$mocu = $parent_query_result['mocu'];
	$medu = $parent_query_result['medu'];
	$fpic = $parent_query_result['fpic'];
	$mpic = $parent_query_result['mpic'];*/
	$due = $vstudent_query_result['due'];
?>


<?php

if(isset($_POST['pay']))
{
/**/
									
							
	$amount = $_POST['amount'];
	$dop = $_POST['dop'];
	if($amount != "" && $dop != "")
	{
			$payfee_query = mysql_query("INSERT into payfee values('','$current_id','$dop','$amount')") or die(mysql_error());
			$final_due = $due - $amount;
			$parent_query = mysql_query("UPDATE vstudent set due = '$final_due' where current_id = '$current_id'") or die(mysql_error());
		
		$message = "Payment done successfully..!";
	}
	else 
	{
		$message = "Please enter required fields fields..!";
		}
}
?>

<body class="main">
<h1 align="center">Pay Fee</h1>
<?php if(isset($message)) echo '<h4 align="center" style="color:#F00; background-color:#FFF">'.$message.'</h4>';?>
<h2>Student Details</h2>
<div class="row">
<form role="form" action="" name="f" method="post">
    <div class="col-md-4">
    	<div class="form-group">
			<input type="text" name="firstname" readonly="readonly" class="form-control" placeholder="" maxlength="200" value="<?php echo $firstname.' '.$lastname;?>" />
		</div>        
    </div>
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

</div>
<hr />
<div class="row">
	<div class="col-md-4">
    	
    </div>
    <div class="col-md-4">
    	<div class="form-group">
        	<input type="text" class="form-control" name="id" id="id" placeholder="Unique-Id" value="<?php echo $id; ?>" />
            
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
<hr  />
<div class="row">

    <div class="col-md-4">
    	<div class="form-group">
			<input type="text" name="fname" class="form-control" placeholder="Father Name" maxlength="100" value="<?php echo $fname; ?>" />
		</div>
         <div class="form-group">
        	<select name="transport" class="form-control">
            <option value="0">-Bus Route(Transport)-</option>
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
    <div class="col-md-8">
    	<div class="form-group">
			<textarea name="address" class="form-control" rows="3" placeholder="Complete Address" maxlength="1000" valuue=""><?php echo $address; ?></textarea>
		</div>
    </div>
    
</div>
<hr />

<div class="row">

 	<div class="col-md-3">
    	<div class="form-group">
			<input type="number" name="amount" class="form-control" placeholder="Amount" maxlength="100" value="" />
		</div>
    </div>
    <div class="col-md-3">
    	<div class="form-group">
			<input type="date" name="dop" class="form-control" value="" />
		</div>
    </div>
    <div class="col-md-6">
    	<div class="form-group">
			<input type="submit" name="pay" class="form-control" value="Pay" style="background-color:#0F0;" />
		</div>
  	</div>
</div>
</form>
</div>
</body>
</html>