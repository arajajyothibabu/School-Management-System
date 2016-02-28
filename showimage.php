<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php 
$main = $_GET['main'];
$sub = $_GET['sub'];
	
if($sub == 0)
{
	$query = mysql_query("select * from vstudent where current_id = '$main'") or die(mysql_error());	
				
				$qr = mysql_fetch_array($query);
					$imageData = $qr['pic'];
}
else if($sub == 1)
{
	$id_query = mysql_query("select id from current_id where sno = '$main'");
	$id = mysql_fetch_array($id_query);
	$query = mysql_query("select * from parent where id = '$id[id]'") or die(mysql_error());
				$qr = mysql_fetch_array($query);
					$imageData = $qr['fpic'];
}
else if($sub == 2)
{
	$id_query = mysql_query("select id from current_id where sno = '$main'");
	$id = mysql_fetch_array($id_query);
	$query = mysql_query("select * from parent where id = '$id[id]'") or die(mysql_error());	
				
				$qr = mysql_fetch_array($query);
					$imageData = $qr['mpic'];
}
else
	{
	$query = mysql_query("select * from admin where sno = '1'") or die(mysql_error());	
				while($qr = mysql_fetch_array($query))
				{
					//die(mysql_error());
					$imageData = $qr[1];
					}
	}
if(empty($imageData))
{
	$query = mysql_query("select * from admin where sno = '1'") or die(mysql_error());	
				while($qr = mysql_fetch_array($query))
				{
					//die(mysql_error());
					$imageData = $qr[1];
					}
	
	}
	header("content-type: image/jpeg");
	echo $imageData;
//else echo "No Image";
?>