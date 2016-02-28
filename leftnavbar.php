<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<?php
$user = $_GET['user'];
if($user == "user")
echo '<body class="leftnavbar" style="margin-left:20px;">
<h2>Menu</h2>
<ul>
<li><a href="entry.php" target="main">New Admission</a></li>
<li><a href="search.php?action=2" target="main">Pay Fee</a></li>
<li><a href="search.php?action=3" target="main">Details</a></li>
<li><a href="vehicle.php" target="main">Transport Details</a></li>
<li><a href="paidclass.php" target="main">Fee Paid Status</a></li>
<li><span style="color:#FFF">Academics</span></li>
	<ul>
    	<li><a href="insertdt.php" target="main">Insert DT/UNITS</a></li>
    </ul>
</ul>
<h2>Update</h2>
<ul>
<li><a href="search.php?action=1" target="main">Student Details</a></li>
<li><a href="dtmarks.php" target="main">DT-Marks</a></li>
<li><a href="unitmarks.php" target="main">TEST-Marks</a></li>
<li><a href="attendance.php" target="main">Attendance</a></li>
<li><a href="substaff.php" target="main">Subject-Staff</a></li>
</ul>
<h2>Others</h2>
<ul>
<li><a href="logout.php?">Logout</a></li>
</ul>
';
else echo '
<body class="leftnavbar" style="margin-left:20px;">
<h2>Menu</h2>
<ul>
<li><a href="entry.php" target="main">New Admission</a></li>
<li><a href="search.php?action=2" target="main">Pay Fee</a></li>
<li><a href="search.php?action=3" target="main">Details</a></li>
<li><a href="vehicle.php" target="main">Transport Details</a></li>
<li><a href="paidclass.php" target="main">Fee Paid Status</a></li>
<li><span style="color:#FFF">Academics</span></li>
	<ul>
    	<li><a href="admininsert.php" target="main">Master_Insert<span style="color:#F00;">*</span></a></li>
        <li><a href="insertattendance.php" target="main">Insert Attendance</a></li>
    </ul>
</ul>
<h2>Update</h2>
<ul>
<li><a href="search.php?action=1" target="main">Student Details</a></li>
<li><a href="dtmarks.php" target="main">DT-Marks</a></li>
<li><a href="unitmarks.php" target="main">TEST-Marks</a></li>
<li><a href="attendance.php" target="main">Attendance</a></li>
<li><a href="substaff.php" target="main">Subject-Staff</a></li>
</ul>
<h2>Others</h2>
<ul>
<li><a href="logout.php?">Logout</a></li>
</ul>
';
?>
</body>
</html>