<!DOCTYPE html>
<html>
<head>
	<title>Messages</title>
	<style>
	#mydiv {
    width:150px;
    height:200px;
    overflow-x:scroll;
}
</style>
</head>
<body>

<?php

if(isset($_POST['submit'])){
	include('database.php');
	session_start();
	$msg=$_POST['msg'];
	$faid=$_POST['faid'];
	$sessid=$_SESSION['stu_id'];
	//$fr="y";
	$sql="INSERT INTO messages (message,from_,fa_login_fa_id,student_login_roll_number) VALUES ('".$msg."','s','".$faid."','".$sessid."')";
	$conn->query($sql);
	header("Location:studenthome.php");
}
?>

<?php
	include('database.php');
	$sessid=$_SESSION['stu_id'];
?>

<form action="msgforstu.php" method="post">
	<table>
		<tr>
			<td>Message:</td>
			<td><textarea name="msg" rows="10" cols="50"></textarea></td>
		</tr>
		<tr>
			<td>FA Id:</td>
		<td>
		<?php
		include("database.php");
		$stu=$_SESSION['stu_id'];
		$sql= "SELECT fa.name AS fname,fa_login_fa_id FROM fa,student_details WHERE fa.forbatch=student_details.joinyear AND student_details.student_login_roll_number='$stu'";
		$result=$conn->query($sql);	
		while($row=$result->fetch_assoc())
		{	

			echo "<input type='radio' name='faid' value='".$row['fa_login_fa_id']."' >";
			echo $row['fname'] ; 
			echo "<br>";
		}
		?>
	    </td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="submit" value="update"></td>
		</tr>
	</table>
</form>

</body>
</html>




