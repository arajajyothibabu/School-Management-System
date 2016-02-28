<?php require_once("connection.php");?>
<?php require_once("session.php"); ?>
<?php require_once("functions.php"); ?>
<fieldset>
<legend>Academic Results</legend>
<table id="jb">
<tr>
<td>
<form action="create.php" method="post" >
<table>
<tr>
<td width="103">
<select name="dept" ><option value="">--Branch--</option><option value="CSE">CSE</option><option value="CHE">Chemical</option><option value="CIV">Civil</option><option value="ECE">ECE</option><option value="EEE">EEE</option><option value="IT">It</option><option value="MECH">Mechanical</option></select>
</td>
<td width="108">
<select name="semister"><option value="">--semister--</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option></select>
</td>
<td width="99">
<select name="suid"><option value="">--subject--</option><option value="ACT1113">CG</option><option value="ACT1114">FLAT</option><option value="ACT1131">AI</option><option value="ACT1115">MPI</option><option value="ACT1116">DAA</option><option value="ACT1117">SE</option><option value="ACT1118">MPI LAB</option><option value="AHE1103">ACS LAB</option></select>
</td>
<td width="100">
<select name="section"><option value="">--section--</option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select>
</td>
<td width="54" colspan="2"><input type="submit" name="create" value="Create" /></td>
</tr>
<tr>
<td colspan="5">Simply select subject if creation completes(Create for only subjects you have..!)</td>
</tr>
<tr>
<td><select name="suid"><option value="">--subject--</option><option value="ACT1113">CG</option><option value="ACT1114">FLAT</option><option value="ACT1131">AI</option><option value="ACT1115">MPI</option><option value="ACT1116">DAA</option><option value="ACT1117">SE</option><option value="ACT1118">MPI LAB</option><option value="AHE1103">ACS LAB</option><option value="ALL">ALL</option></select>         </td>
<td width="108">   <input type="submit" name="submit" value="View Marks" /> </td>
</tr>
</table>
</form>
</td>
</tr>
<?php 
if(isset($_POST['create'])){
$dept = $_POST['dept'];
$semister = $_POST['semister'];
$suid = $_POST['suid'];
$section = $_POST['section'];
$uid = $_SESSION['user_id'];
$queryset = mysql_query("INSERT into marks VALUES('$semister','$dept','$section','$suid','','$uid','','','','','','','','','','')");
confirm_query($queryset);
}
else if(isset($_POST['submit'])){
$suid = $_POST['suid'];
$uid = $_SESSION['user_id'];
if($suid = "ALL"){
$queryset = mysql_query("select * from marks where sid = '$uid'");
	}
	else{
$queryset = mysql_query("select * from marks where suid = '$suid' and sid = '$uid'");
	}
confirm_query($queryset);
$mark = mysql_fetch_array($queryset);
}
if(isset($mark)){
	echo '<tr><table border="1" width="600" cellpadding="10"><caption>Marks of Semister-'. $mark["semister"].'</caption><colgroup><col style="background-color:#00CCFF; font-size:48px;"><col style="background-color:#FFFFFF; color:#000000; text-align:center"></colgroup><thead><tr><th>SUBJECT</th><th>Q-1</th><th>A-1</th><th>M-1</th><th>I-1</th><th>Q-2</th><th>A-2</th><th>M-2</th><th>I-2</th><th>I-F</th><th>Final</th></tr></thead><tbody>';
	while($mark = mysql_fetch_array($queryset)){
	echo '<tr><td>'. $mark["suid"] . '</td><td>' . $mark["q1"] .'</td><td>'.$mark["a1"].'</td><td>'.$mark["m1"].'</td><td>'.$mark["i1"].'</td><td>'.$mark["q2"].'</td><td>'.$mark["a2"].'</td><td>'.$mark["m2"].'</td><td>'.$mark["i2"].'</td><td>'.$mark["inf"].'</td><td>'.$mark["f"].'</td></tr></tbody></table></tr>';
		}
	}
?>
</table>
</fieldset>