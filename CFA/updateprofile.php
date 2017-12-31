<!DOCTYPE html>
<html>
<head>
	<title>Update Profile</title>
</head>
<body>
<h1>Computerization of Faculty Advisor System</h1>
<hr>

<?php
if(isset($_POST['submit'])){
	include('database.php');
	session_start();
	$name=$_POST['name'];
	$email=$_POST['email'];
	$year=$_POST['year'];
	$mobile=$_POST['mob'];
	$desg=$_POST['designation'];
	$sql="UPDATE fa SET name='".$name."',email_id='".$email."',forbatch='".$year."',mobile='".$mobile."',Designation='".$desg."' WHERE fa_login_fa_id='".$_SESSION['fa_id']."'";
	if($conn->query($sql)===TRUE){
		echo "<script>alert('Profile Updated')</script>";
		header("Location: fahome.php");
	}

}
?>

<form action="updateprofile.php" method="POST">
	<table>
		<tr>
			<td>Name:</td>
			<td><input type="text" name="name"></td>
		</tr>
		<tr>
			<td>FA for year:</td>
			<td><input type="number" name="year"></td>
		</tr>
		<tr>
			<td>email:</td>
			<td><input type="text" name="email"></td>
		</tr>
		
		<tr>
			<td>mobile:</td>
			<td><input type="text" name="mob"></td>
		</tr>
		<tr>
			<td>Designation:</td>
			<td><input type="text" name="designation"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="submit" value="Update"></td>
		</tr>
	</table>
</form>

</body>
</html>