<!DOCTYPE html>
<html>
<head>
	<title>Appointments</title>
</head>
<body>
<h1>Appointments</h1>
<hr>
<form action="appointments.php" method="POST">
<?php
include('database.php');
session_start();
$sql="SELECT appointment_details,appointment_status,requested_date,student_login_roll_number,fa_login_fa_id FROM appointments";
$result=$conn->query($sql);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
		if($_SESSION['fa_id']==$row['fa_login_fa_id'] && $row['appointment_status']!='A' && $row['appointment_status']!='R') {
			echo "Appointment Details: ".$row['appointment_details']."<br>";
			echo "Requested Date: ".$row['requested_date']."<br>";
			echo "Student: ".$row['student_login_roll_number']."<br>";
			break;
		}
	}
}
?>
<input type="submit" name="submit1" value="accept"><input type="submit" name="submit2" value="reject">
</form>
<?php
if(isset($_POST['submit1'])){
	include('database.php');
	$sql="SELECT appointment_details,appointment_status,requested_date,student_login_roll_number,fa_login_fa_id FROM appointments";
$result=$conn->query($sql);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
		if($_SESSION['fa_id']==$row['fa_login_fa_id'] && $row['appointment_status']!='A' && $row['appointment_status']!='R') {
		$sql="UPDATE appointments SET appointment_status='A' WHERE student_login_roll_number='".$row['student_login_roll_number']."'   ";
	$conn->query($sql);
	header("Location: appointments.php");
		}
	}
}
}
if(isset($_POST['submit2'])){
	include('database.php');
	$sql="SELECT appointment_details,appointment_status,requested_date,student_login_roll_number,fa_login_fa_id FROM appointments";
$result=$conn->query($sql);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
		if($_SESSION['fa_id']==$row['fa_login_fa_id'] && $row['appointment_status']!='A' && $row['appointment_status']!='R') {
		$sql="UPDATE appointments SET appointment_status='R' WHERE student_login_roll_number='".$row['student_login_roll_number']."' AND '".$_SESSION['fa_id']."'='".$row['fa_login_fa_id']."' ";
	$conn->query($sql);
	header("Location: appointments.php");
		}
	}
}
}
?>
</body>
</html>