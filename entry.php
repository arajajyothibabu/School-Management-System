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
ini_set('display_errors', 1);
if(isset($_POST['submit']))
{
/*Code to upload pic of student*/
	if(isset($_FILES['spic']))
							{
							   // $check = getimagesize($_FILES["pic"]["tmp_name"]);
								if($_FILES["pic"]["size"] != 0) {
							  
							   $imageName = mysql_real_escape_string($_FILES["spic"]["name"]);
							   $imageData = mysql_real_escape_string(file_get_contents($_FILES["spic"]["tmp_name"]));
							   $imageType = mysql_real_escape_string($_FILES["spic"]["type"]);
										   if($_FILES["spic"]["type"] == "image/jpeg" || $_FILES["spic"]["type"] == "image/gif" || $_FILES["spic"]["type"] == "image/png" && $_FILES["spic"]["size"] < 2120000)
										   { 
												$spic = $imageData;		
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
							   if($_FILES["fpic"]["type"] == "image/jpeg" || $_FILES["fpic"]["type"] == "image/gif" || $_FILES["fpic"]["type"] == "image/png" && $_FILES["fpic"]["size"] < 2120000)
							   { 
									$fpic = $imageData;		
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
							   if($_FILES["mpic"]["type"] == "image/jpeg" || $_FILES["mpic"]["type"] == "image/gif" || $_FILES["mpic"]["type"] == "image/png" && $_FILES["mpic"]["size"] < 2120000)
							   { 
									$mpic = $imageData;		
						
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
									
							
	$id = $_POST['id'];
	$section = $_POST['section'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$sex = $_POST['sex'];
	$coj = $_POST['coj'];
	$moj = $_POST['moj'];
	$dob = $_POST['dob'];
	$doj = $_POST['doj'];
	$caste = $_POST['caste'];
	$religion = $_POST['religion'];
	$siblings = $_POST['siblings'];
	$aadhar = $_POST['aadhar'];
	$ration = $_POST['ration'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];
	$transport = $_POST['transport'];
	$fname = $_POST['fname'];
	$focu = $_POST['focu'];
	$fedu = $_POST['fedu'];
	$mname = $_POST['mname'];
	$mocu = $_POST['mocu'];
	$medu = $_POST['medu'];
	if($firstname != "" && $lastname != "" && $id != "" && $coj != "" && $moj != "" && $doj != "" && $section != "" && $sex != "")
	{
			$student_query = mysql_query("INSERT into student values('$id','$firstname','$lastname','$sex','$dob','$caste','$religion','$doj','$aadhar','$ration')") or die(mysql_error());
		
			$parent_query = mysql_query("INSERT into parent values('$id','$fname','$fpic','$focu','$fedu','$mname','$mpic','$mocu','$medu','$siblings')") or die(mysql_error());
			
			$akey_query = mysql_query("select sno from akey where class = '$coj' and section = '$section' and medium = '$moj'") or die(mysql_error());
			$akey = mysql_fetch_array($akey_query);
			
			$aca_year = date('Y');
			$current_id_query = mysql_query("INSERT into current_id values('','$id','$akey[0]','$aca_year')") or die(mysql_error());
			
			$current_ids_query = mysql_query("select sno from current_id where id = '$id'") or die(mysql_error());
			$current_id = mysql_fetch_array($current_ids_query);
			
			$fee_query = mysql_query("select * from fee where akey = '$akey[0]'") or die(mysql_error());
				$aca_fee = mysql_fetch_array($fee_query);
				$due = $aca_fee['fee'];
			if($transport != "0")
			{
				$transport_fee_query = mysql_query("select * from transport where sno = '$transport'") or die(mysql_error());
				$transport_fee = mysql_fetch_array($transport_fee_query);
				$due += $transport_fee['fee'];
				}
			
			$vstudent_query = mysql_query("INSERT into vstudent values('','$current_id[0]','$spic','$address','$contact','$due','$transport')") or die(mysql_error());
		
		
		$message = "Registered successfully..!";
	}
	else 
	{
		$message = "Please enter important fields..!";
		}
}
?>
<body class="main">
<h1 align="center">New Admission</h1>
<?php if(isset($message)) echo '<h4 align="center" style="color:#F00; background-color:#FFF">'.$message.'</h4>';?>
<h2>Personal Details</h2>
<div class="row">
<form role="form" action="" name="f" method="post">
    <div class="col-md-4">
    	<div class="form-group">
			<input type="text" name="firstname" class="form-control must-field" placeholder="First Name" maxlength="100" value="" />
		</div>
        <div class="form-group">
			<input type="text" name="aadhar" class="form-control" placeholder="AADHAR Number" maxlength="12" value="" />
		</div>
        <div class="form-group">
            <select class="form-control" id="sel1" name="caste">
            	<option>--Caste--</option>
               	<?php
				$caste_query = mysql_query("select * from caste");
				while($caste_query_result = mysql_fetch_array($caste_query))
				{
					echo '<option value="'.$caste_query_result[0].'">';
				// if($caste == $religion_query_result[0]) echo 'selected="selected"';
				 echo $caste_query_result[1].'</option>';	
				}
				?>
            </select>
        </div>        
    </div>
    <div class="col-md-4">
    	<div class="form-group">
			<input type="text" name="lastname" class="form-control must-field" placeholder="Last Name" maxlength="100" value="" />
		</div>
    	<div class="form-group">
			<input type="text" name="ration" class="form-control" placeholder="Ration Card Number" maxlength="16" value="" />
		</div>
        <div class="form-group">
            <select class="form-control" id="sel1" name="religion">
            	<option>--Religion--</option>
               <?php
                $religion_query = mysql_query("select * from religion");
				while($religion_query_result = mysql_fetch_array($religion_query))
				{
				echo '<option value="'.$religion_query_result[0].'">'.$religion_query_result['religion'].'</option>';
				 //if($religion == $religion_query_result[0]) echo 'selected="selected">';
                 }
				?>
            </select>
        </div> 
    </div>
    <div class="col-md-4">
    	<div class="form-group">
            <select class="form-control must-field" id="sex" name="sex">
            	<option>--Gender--</option>
               	<option value="M">Male</option>
               	<option value="F">Female</option>
            </select>
        </div>
        <div class="form-group">
            <select class="form-control must-field" id="sel1" name="coj">
            	<option>--Class of Joining--</option>
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
        <div class="form-group">
            <select class="form-control must-field" id="meduim" name="moj">
            	<option>--Meduim of Joining--</option>
               	<option value="E">English Medium</option>
               	<option value="T">Telugu Medium</option>
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
        	<input type="text" list="ids" maxlength="10" class="form-control must-field" name="id" id="id" placeholder="Unique-Id" value="" />
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
        	<select name="section" class="form-control must-field">
            	<option value="A">--Section--</option>
    			<option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
            </select>
        </div>
    </div>
</div>
<hr  />
<div class="row">

    <div class="col-md-6">
    	<div class="form-group">
        	<label for="text">Date of Birth</label>
			<input type="date" name="dob" class="form-control must-field" placeholder="Date of Birth" value="" />
		</div>
        <div class="form-group">
        	<label for="date">Date of Joining</label>
			<input type="date" name="doj" class="form-control must-field" placeholder="Date of Joining" value="" />
		</div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        	<label for="date">Siblings</label>
			<textarea name="siblings" class="form-control" placeholder="Brothers/Sisters" rows="5" value=""></textarea>
		</div>
    </div>

</div>
<hr style="border:double;"/>

<div class="row">
<h2>Parent Details</h2>

    <div class="col-md-4">
    	<div class="form-group">
			<input type="text" name="fname" class="form-control" placeholder="Father Name" maxlength="100" value="" />
		</div>
        <div class="form-group">
			<input type="text" name="mname" class="form-control" placeholder="Mother Name" maxlength="100" value="" />
		</div>
    </div>
    <div class="col-md-4">
    	<div class="form-group">
			<input type="text" name="fedu" class="form-control" placeholder="Father Education" maxlength="100" value="" />
		</div>
        <div class="form-group">
			<input type="text" name="medu" class="form-control" placeholder="Mother Education" maxlength="100"/>
		</div>
    </div>
    <div class="col-md-4">
    	<div class="form-group">
			<input type="text" name="focu" class="form-control" placeholder="Father Occupation" maxlength="100" value="" />
		</div>
        <div class="form-group">
			<input type="text" name="mocu" class="form-control" placeholder="Mother Occupation" maxlength="100" value="" />
		</div>
    </div>
    
</div>
<hr />

<div class="row">

 	<div class="col-md-8">
    	<div class="form-group">
			<textarea name="address" class="form-control" rows="3" placeholder="Complete Address" maxlength="1000" valuue=""></textarea>
		</div>
    </div>
    <div class="col-md-4">
    	<div class="form-group">
			<input type="text" name="contact" class="form-control" placeholder="Mobile/landline Number" maxlength="100" value="" />
		</div>
        <div class="form-group">
        	<select name="transport" class="form-control">
            <option value="0">-Bus Route(Transport)-</option>
            <option value="0">ByWalk</option>
            <?php 
			$transport_query = mysql_query("select * from transport");
			while($result = mysql_fetch_array($transport_query))
			echo '<option value="'.$result[0].'">'.$result[1].' / '.$result[2].'</option>';
			?>
            </select>
		</div>
  	</div>
</div>

<hr style="border:double;" />

<div class="row">

    <div class="col-md-4">
    	<div class="form-group">
        	<label >Passport Photo of Student(must be less then 100kb)</label>
			<input type="file" name="spic" class="form-control" />
		</div>
    </div>
    <div class="col-md-4">
   		<div class="form-group">
        	<label >Passport Photo of Father(must be less then 100kb)</label>
			<input type="file" name="fpic" class="form-control" placeholder="Photo" value="" />
		</div>
    </div>
    <div class="col-md-4">
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
        	<input type="submit" class="form-control" value="Submit" name="submit" />
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