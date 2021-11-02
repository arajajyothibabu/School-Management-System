<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php 
$main = $_GET['main'];
$sub = $_GET['sub'];
	
if($sub == 0)
{
	$query = mysqli_query($connection,"select * from vstudent where current_id = '$main'") or die(mysqli_error($connection));	
				
				$qr = mysqli_fetch_array($query);
					$imageData = $qr['pic'];
}
else if($sub == 1)
{
	$id_query = mysqli_query($connection,"select id from current_id where sno = '$main'");
	$id = mysqli_fetch_array($id_query);
	$query = mysqli_query($connection,"select * from parent where id = '$id[id]'") or die(mysqli_error($connection));
				$qr = mysqli_fetch_array($query);
					$imageData = $qr['fpic'];
}
else if($sub == 2)
{
	$id_query = mysqli_query($connection,"select id from current_id where sno = '$main'");
	$id = mysqli_fetch_array($id_query);
	$query = mysqli_query($connection,"select * from parent where id = '$id[id]'") or die(mysqli_error($connection));	
				
				$qr = mysqli_fetch_array($query);
					$imageData = $qr['mpic'];
}
else
	{
	$query = mysqli_query($connection,"select * from admin where sno = '1'") or die(mysqli_error($connection));	
				while($qr = mysqli_fetch_array($query))
				{
					//die(mysql_error());
					$imageData = $qr[1];
					}
	}
if(empty($imageData))
{
	$query = mysqli_query($connection,"select * from admin where sno = '1'") or die(mysqli_error($connection));	
				while($qr = mysqli_fetch_array($query))
				{
					//die(mysql_error());
					$imageData = $qr[1];
					}
	
	}
	header("content-type: image/jpeg");
	echo $imageData;
//else echo "No Image";
?>