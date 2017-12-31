<!DOCTYPE html>
<html>
<head>
	<title>Delete User</title>
</head>
<body>
<form action="deleteuser.php" method="POST">
<table>
	<tr>
		<td></td>
		<td><select name="type">
	<option value="hod">HOD</option>
	<option value="fa">Faculty Advisor</option>
	<option value="stu">Student</option>
</select></td>
	</tr>
	<tr>
		<td>Username:</td>
		<td><input type="text" name="un"></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="submit" value="delete"></td>
	</tr>
</table>
</form>
<?php
if(isset($_POST['submit'])){
	include("config.php");
	session_start();
	$uname=$_POST['un'];
	$type=$_POST['type'];
	$sql="DELETE FROM users WHERE username='".$uname."'";
	$conn->query($sql);
	if($type=="hod"){
		$sql="DELETE FROM hod WHERE username='".$uname."'";
		$conn->query($sql);
	}elseif ($type=="fa") {
		$sql="DELETE FROM fa WHERE username='".$uname."'";
		$conn->query($sql);
	}else{
		$sql="DELETE FROM student WHERE username='".$uname."'";
		$conn->query($sql);
	}
}

?>
</body>
</html>