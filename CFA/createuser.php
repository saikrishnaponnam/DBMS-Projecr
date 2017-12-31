<!DOCTYPE html>
<html>
<head>
	<title>Create User</title>
	<link rel="stylesheet" type="text/css" href="w3.css">
</head>
<body>

<?php
if(isset($_POST['submit'])){
	include("database.php");
	session_start();
	$uname=$_POST['un'];
	$pass=$_POST['pass'];
	$type=$_POST['type'];

	
	if($type=="HOD")
	{
		$sql="INSERT INTO HOD(username,password) VALUES ('".$uname."','".$pass."')";
		$conn->query($sql);
		header("location:adminhomepage.php#create");
	}
	elseif($type=="FA")
	{
		$sql="INSERT INTO fa_login VALUES ('".$uname."','".$pass."')";
		$conn->query($sql);
		$sql="INSERT INTO fa(fa_login_fa_id) VALUES ('".$uname."')";
		$conn->query($sql);
		header("location:adminhomepage.php#create");
	}
	else
	{
		$faagn=$_POST['faagn'];
		$sql="INSERT INTO student_login(roll_number,password,fa_fa_login_fa_id) VALUES ('".$uname."','".$pass."','".$faagn."')";
		$conn->query($sql);
		header("location:adminhomepage.php#create");
	}
}


?>

<div class="w3-container">
		<h1> Select User </h1>
		<a href="#a" type="button" class="w3-btn w3-white w3-hover-green"  onclick="document.getElementById('a').style.display='block';document.getElementById('b').style.display='none';document.getElementById('c').style.display='none'">HOD</a>
		<a href="#b" type="button" class="w3-btn w3-white w3-hover-green" onclick="document.getElementById('b').style.display='block';document.getElementById('a').style.display='none';document.getElementById('c').style.display='none'">Student</a>
		<a href="#c" type="button" class="w3-btn w3-white w3-hover-green" onclick="document.getElementById('c').style.display='block';document.getElementById('b').style.display='none';document.getElementById('a').style.display='none'">FA</a>
		
</div>
<br><br>

<!-- create  hod    -->
<div id='a' style="display:none">
	<form action="createuser.php" method="POST">
<table>
	<tr>
		<td>User:</td>
		<td><input type="text" name="type" value="HOD" class="field left" readonly></td>
	</tr>
	<tr>
		<td>Username:</td>
		<td><input type="text" name="un"></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" name="pass"></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="submit" value="create"><br><a href="adminhomepage.php">Back</a></td>
	</tr>
</table>
</form>
</div>

<!-- create  student    -->
<div id='b' style="display:none">
<form action="createuser.php" method="POST">
<table>
	<tr>
		<td>User:</td>
		<td><input type="text" name="type" value="Student" class="field left" readonly></td>
	</tr>
	<tr>
		<td>Username:</td>
		<td><input type="text" name="un"></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" name="pass"></td>
	</tr>
	<tr>
		<td>FA Assigned:</td>
		<td><input type="text" name="faagn"></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="submit" value="create"><br><a href="adminhomepage.php">Back</a></td>
	</tr>
</table>
</form>
</div>

<!-- create  FA    -->
<div id='c' style="display:none">
	<form action="createuser.php" method="POST">
<table>
	<tr>
		<td>User:</td>
		<td><input type="text" name="type" value="FA" class="field left" readonly></td>
	</tr>
	<tr>
		<td>Username:</td>
		<td><input type="text" name="un"></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" name="pass"></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="submit" value="create"><br><a href="adminhomepage.php">Back</a></td>
	</tr>
</table>
</form>
</div>

</body>
</html>