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
					/*$vstudent_query = mysql_query("select * from vstudent where current_id = '$current_id'") or die(mysql_error());
					$vstudent_query_result = mysql_fetch_array($vstudent_query);
					$student_query = mysql_query("select * from student where id = '$current_id_query_result[1]'") or die(mysql_error());
					$student_query_result = mysql_fetch_array($student_query);
					$parent_query = mysql_query("select * from parent where id = '$current_id_query_result[1]'") or die(mysql_error());
					$parent_query_result = mysql_fetch_array($parent_query);*/
					
//storing details

	$id = $current_id_query_result['id'];
	$section = $akey_query_result['section'];
	$class = $akey_query_result['class'];
	$medium = $akey_query_result['medium'];
?>
<?php
if(isset($_POST['submit']))
{
/*Code to upload pic of student*/
	if(isset($_FILES['spic']))
							{
							   // $check = getimagesize($_FILES["pic"]["tmp_name"]);
								if($_FILES["spic"]["size"] != 0) {
							  
							   $imageName = mysql_real_escape_string($_FILES["spic"]["name"]);
							   $imageData = mysql_real_escape_string(file_get_contents($_FILES["spic"]["tmp_name"]));
							   $imageType = mysql_real_escape_string($_FILES["spic"]["type"]);
										   if($_FILES["spic"]["type"] == "image/jpeg" || $_FILES["spic"]["type"] == "image/gif" || $_FILES["spic"]["type"] == "image/png")
										   { 
												$spic = $imageData;		
											   $vstudent_query = mysql_query("UPDATE vstudent set pic = '$spic' where current_id = '$current_id'")  or die(mysql_error());
										   }
											else
											{
												$msg = "Only images(.jpg/.jpeg) are allowed or image size must be less than 500KB..!";
												$spic = "";
												}
								}
}
else $spic = "";
									
/*code to upload pic of father*/
	if(isset($_FILES['fpic']))
							{
							   // $check = getimagesize($_FILES["pic"]["tmp_name"]);
								if($_FILES["fpic"]["size"] != 0) {
							  
							   $imageName = mysql_real_escape_string($_FILES["fpic"]["name"]);
							   $imageData = mysql_real_escape_string(file_get_contents($_FILES["fpic"]["tmp_name"]));
							   $imageType = mysql_real_escape_string($_FILES["fpic"]["type"]);
							   if($_FILES["fpic"]["type"] == "image/jpeg" || $_FILES["fpic"]["type"] == "image/gif" || $_FILES["fpic"]["type"] == "image/png")
							   { 
									$fpic = $imageData;		
									$parent_query = mysql_query("UPDATE parent set fpic = '$fpic' where id = '$id'") or die(mysql_error());
								   }
								else
								{
									$msg = "Only images(.jpg/.jpeg) are allowed or image size must be less than 500KB..!";
									$mpic = "";
									}
							}
}
else $fpic = "";
/*code to upload pic of mother*/
	if(isset($_FILES['mpic']))
							{
							   // $check = getimagesize($_FILES["pic"]["tmp_name"]);
								if($_FILES["mpic"]["size"] != 0) {
							  
							   $imageName = mysql_real_escape_string($_FILES["mpic"]["name"]);
							   $imageData = mysql_real_escape_string(file_get_contents($_FILES["mpic"]["tmp_name"]));
							   $imageType = mysql_real_escape_string($_FILES["mpic"]["type"]);
							   if($_FILES["mpic"]["type"] == "image/jpeg" || $_FILES["mpic"]["type"] == "image/gif" || $_FILES["mpic"]["type"] == "image/png")
							   { 
									$mpic = $imageData;		
									$parent_query = mysql_query("UPDATE parent set mpic = '$mpic' where id = '$id'") or die(mysql_error());
								   }
								else
								{
									$msg = "Only images(.jpg/.jpeg) are allowed or image size must be less than 500KB..!";
									$mpic = "";
									}
								
							}
}
else
$mpic = "";
/**/
									
							
	//$firstname = $_POST['firstname'];
	//$lastname = $_POST['lastname'];
	//$sex = $_POST['sex'];
	$class = $_POST['class'];
	$medium = $_POST['medium'];
	//$dob = $_POST['dob'];
	//$doj = $_POST['doj'];
	//$caste = $_POST['caste'];
	//$religion = $_POST['religion'];
	$siblings = $_POST['siblings'];
	$aadhar = $_POST['aadhar'];
	$ration = $_POST['ration'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];
	$transport = $_POST['transport'];
	//$fname = $_POST['fname'];
	//$focu = $_POST['focu'];
	//$fedu = $_POST['fedu'];
	//$mname = $_POST['mname'];
	//$mocu = $_POST['mocu'];
	//$medu = $_POST['medu'];
	//if($aadhar!= "" && $ration != "" && $address != "" && $contact != "")
	if(true)
	{
			$student_query = mysql_query("UPDATE student set aadhar = '$aadhar', ration = '$ration' where id = '$id'");
		
			//$parent_query = mysql_query("UPDATE parent set fname = '$fname', focu = '$focu', fedu = '$fedu', mname = '$mname', mocu = '$mocu', medu = '$medu', siblings = '$siblings')");
			if($section != $_POST['section'] || $class != $_POST['class'] || $medium != $_POST['medium'])
			{
				$akey_query = mysql_query("select sno from akey where class = '$class' and section = '$section' and medium = '$medium'") or die(mysql_error());
				$akey = mysql_fetch_array($akey_query);
			
				$aca_year = date('Y');
				//******************
				$current_year = date("Y");
				$year_from_current_id = mysql_query("select max(aca_year) from current_id");
				if($year_from_current_id)
				{
					$year_from_current_id_result = mysql_fetch_array($year_from_current_id);
					if($current_year > $year_from_current_id_result[0])
						$current_year -= 1;
				}
				//******************
				$update_current_id_query = mysql_query("UPDATE current_id set akey = '$akey[0]' where id = '$id' and aca_year = '$current_year'");
			
				$current_ids_query = mysql_query("select sno from current_id where id = '$id'");
				$current_ids_query_result = mysql_fetch_array($current_ids_query);
			
			$due = 0;
			$fee_query = mysql_query("select * from fee where akey = '$akey[0]'") or die(mysql_error());
				if($fee_query)
				{
				$aca_fee = mysql_fetch_array($fee_query);
				$due = $aca_fee[0];
				}
			if($transport != "0")
			{
				$transport_fee_query = mysql_query("select * from transport where sno = '$transport'");
				$transport_fee = mysql_fetch_array($transport_fee_query);
				$due += $transport_fee[0];
				}
				$vstudent_query = mysql_query("UPDATE vstudent set current_id = '$current_ids_query_result[0]', due = '$due', transport = '$transport' where current_id = '$current_id'") or die(mysql_error());
			}
			
			$vstudent_query = mysql_query("UPDATE vstudent set address = '$address', contact = '$contact', transport = '$transport' where current_id = '$current_id'") or die(mysql_error());
		
		
		$message = "Updated Successfully..!";
	}
	else 
	{
		$message = "Please enter important fields..!";
		}
}
?>
<?php

?>
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
<h1 align="center">Update Student Details</h1>
<?php if(isset($message)) echo '<h4 align="center" style="color:#F00; background-color:#FFF">'.$message.'</h4>';?>
<h2>Personal Details</h2>
<div class="row">
<form role="form" action="editdetails.php?id=<?php echo $current_id;?>" name="f" method="post" enctype="multipart/form-data">
    <div class="col-md-4">
    	<div class="form-group">
			<input type="text" name="firstname" class="form-control" readonly="readonly" placeholder="First Name" maxlength="100" value="<?php echo $firstname; ?>" />
		</div>
        <div class="form-group">
			<input type="text" name="aadhar" class="form-control" placeholder="AADHAR Number" maxlength="16" value="<?php echo $aadhar; ?>" />
		</div>
        <div class="form-group">
            <select class="form-control" id="sel1" name="caste" disabled="disabled">
            	<option>--Caste--</option>
               	<?php
				$caste_query = mysql_query("select * from caste");
				while($caste_query_result = mysql_fetch_array($caste_query))
				{
					echo '<option value="'.$caste_query_result[0].'"';
				 if($caste == $caste_query_result[0]) echo 'selected="selected">';
				 echo $caste_query_result[1].'</option>';	
				}
				?>
            </select>
        </div>        
    </div>
    <div class="col-md-4">
    	<div class="form-group">
			<input type="text" name="lastname" class="form-control" placeholder="Last Name" readonly="readonly" maxlength="100" value="<?php echo $lastname; ?>" />
		</div>
    	<div class="form-group">
			<input type="text" name="ration" class="form-control" placeholder="Ration Card Number" maxlength="16" value="<?php echo $ration; ?>" />
		</div>
        <div class="form-group">
            <select class="form-control" id="sel1" name="religion" disabled="disabled">
            	<option>--Religion--</option>
               	<?php
                $religion_query = mysql_query("select * from religion");
				while($religion_query_result = mysql_fetch_array($religion_query))
				{
				echo '<option value="'.$religion_query_result[0].'"';
				 if($religion == $religion_query_result[0]) echo 'selected="selected">';
				 echo $religion_query_result[1].'</option>';
                 }
				?>
            </select>
        </div> 
    </div>
    <div class="col-md-4">
    	<div class="form-group">
            <select class="form-control" id="sex" name="sex" disabled="disabled">
            	<option>--Gender--</option>
               	<option value="M" <?php if($sex == "M")echo 'selected="selected"';?>>Male</option>
               	<option value="F" <?php if($sex == "F")echo 'selected="selected"';?>>Female</option>
            </select>
        </div>
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
        <div class="form-group">
            <select class="form-control" id="medium" name="medium">
            	<option>--Meduim--</option>
               	<option value="E" <?php if($medium == "E")echo 'selected="selected"';?>>English Medium</option>
               	<option value="T" <?php if($medium == "T")echo 'selected="selected"';?>>Telugu Medium</option>
            </select>
        </div>
    </div>

</div>
<hr />
<div class="row">
	<div class="col-md-4">
    	<div class="form-group">
        	<input type="text" name="due" class="form-control" readonly="readonly" value="<?php echo $due; ?>" />
        </div>
    </div>
    <div class="col-md-4">
    	<div class="form-group">
        	<input type="text" list="ids" class="form-control" readonly="readonly" name="id" id="id" placeholder="Unique-Id" value="<?php echo $id; ?>" />
            <datalist id="ids">
            <option>NPSHS</option>
            <option>NPSES</option>
            <option>NPSKG</option>
            <option>NVHS</option>
            <option>NVES</option>
            </datalist>
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

    <div class="col-md-6">
    	<div class="form-group">
        	<label for="text">Date of Birth:</label>
			<input type="date" name="dob" class="form-control" readonly="readonly" placeholder="Date of Birth" value="<?php echo $dob; ?>" />
		</div>
        <div class="form-group">
        	<label for="date">Date of Joining</label>
			<input type="date" name="doj" class="form-control" readonly="readonly" placeholder="Date of Joining" value="<?php echo $doj; ?>" />
		</div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        	<label for="date">Siblings</label>
			<textarea name="siblings" class="form-control" placeholder="Brothers/Sisters" rows="5"><?php echo $siblings; ?></textarea>
		</div>
    </div>

</div>
<hr style="border:double;"/>

<div class="row">
<h2>Parent Details</h2>

    <div class="col-md-4">
    	<div class="form-group">
			<input type="text" name="fname" class="form-control" placeholder="Father Name" readonly="readonly" maxlength="100" value="<?php echo $fname; ?>" />
		</div>
        <div class="form-group">
			<input type="text" name="mname" class="form-control" placeholder="Mother Name" maxlength="100" readonly="readonly" value="<?php echo $mname; ?>" />
		</div>
    </div>
    <div class="col-md-4">
    	<div class="form-group">
			<input type="text" name="fedu" class="form-control" placeholder="Father Education" readonly="readonly" maxlength="100" value="<?php echo $fedu; ?>" />
		</div>
        <div class="form-group">
			<input type="text" name="medu" class="form-control" placeholder="Mother Education" readonly="readonly" maxlength="100" value="<?php echo $medu; ?>"/>
		</div>
    </div>
    <div class="col-md-4">
    	<div class="form-group">
			<input type="text" name="focu" class="form-control" placeholder="Father Occupation" readonly="readonly" maxlength="100" value="<?php echo $focu; ?>" />
		</div>
        <div class="form-group">
			<input type="text" name="mocu" class="form-control" placeholder="Mother Occupation" readonly="readonly" maxlength="100" value="<?php echo $mocu; ?>" />
		</div>
    </div>
    
</div>
<hr />

<div class="row">

 	<div class="col-md-8">
    	<div class="form-group">
			<textarea name="address" class="form-control" rows="3" placeholder="Complete Address" maxlength="1000" valuue=""><?php echo $address; ?></textarea>
		</div>
    </div>
    <div class="col-md-4">
    	<div class="form-group">
			<input type="text" name="contact" class="form-control" placeholder="Mobile/landline Number" maxlength="100" value="<?php echo $contact; ?>" />
		</div>
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
</div>

<hr style="border:double;" />

<div class="row">

    <div class="col-md-4">
    	<div class="container-fluid">
        <img class="img-circle" src="showimage.php?main=<?php echo $current_id; ?>&sub=0"/>
        </div>
    	<div class="form-group">
        	<label >Passport Photo of Student(must be less then 100kb)</label>
			<input type="file" name="spic" class="form-control" placeholder="Photo" value="" />
		</div>
    </div>
    <div class="col-md-4">
   		<div>
        <img class="img-circle" src="showimage.php?main=<?php echo $current_id; ?>&sub=1"/>
        </div>
        <div class="form-group">
        	<label >Passport Photo of Father(must be less then 100kb)</label>
			<input type="file" name="fpic" class="form-control" placeholder="Photo" value="" />
		</div>
    </div>
    <div class="col-md-4">
    	<div>
        <img class="img-circle" src="showimage.php?main=<?php echo $current_id; ?>&sub=2"/>
        </div>
        <div class="form-group">
        	<label >Passport Photo of Mother(must be less then 100kb)</label>
			<input type="file" name="mpic" class="form-control" placeholder="Photo" value="" />
		</div>	
    </div>

</div>
<hr style="border:double;"/>
<div class="row">
    <div class="col-md-8">
    </div>
    <div class="col-md-2">
        <div class="form-group">
        	<input type="submit" class="form-control" value="Update" name="submit" />
        </div>
    </div>
    <div class="col-md-2">
    	<div class="form-group">
		    <input type="reset" value="Clear" class="form-control" />
        </div>
    </div>
</div>
</form>
</body>
</html>