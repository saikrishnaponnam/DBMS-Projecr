<html>
<head>
<title>Forgot Password</title>

</head>

<body>



<?php 
session_start();
if(isset($_POST['submit'])){
	include("database.php");
	//session_start();
	$flag=0;
	$username=$_POST['uname'];
	$_SESSION['name']=$username;
	$mobno=$_POST['mobno'];
	$type=$_POST['type'];
	$_SESSION['type']=$type;
	if($type=="fa"){
		$sql="SELECT fa_login_fa_id,mobile FROM fa";
		$result=$conn->query($sql);
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				if($username==$row['fa_login_fa_id'] && $mobno==$row['mobile']){
					$_SESSION['equal']=1;
					$flag=1;
					$_SESSION["fa_id"]=$username;
					$_SESSION["fa_mob"]=$mobno;
				change($username);
			}
		}
	}
}
else if($type=="hod"){
  $sql="SELECT username,mobile FROM hod";
  $result=$conn->query($sql);
  if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
      if($username==$row['username'] && $mobno==$row['mobile']){
        $flag=1;
		$_SESSION['equal']=1;
        $_SESSION["hod_id"]=$username;
        $_SESSION["hod_mob"]=$mobno;
        change($username);
      }
    }
  }	
}
	
	else{
  $sql="SELECT student_login_roll_number,contact_no FROM student_details";
  $result=$conn->query($sql);
  if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
      if($username==$row['student_login_roll_number'] && $mobno==$row['contact_no']){
        $flag=1;
		$_SESSION['equal']=1;
        $_SESSION["stu_id"]=$username;
        $_SESSION["stu_pass"]=$password;
        change($username);
      }
    }
  }
}
if($flag==0){
	
	echo "<script>alert('NO SUCH REGISTERED USER')</script>";
}
}

?>

<?php
{
if(isset($_POST['chng'])){
	include("database.php");
	//session_start();
	$pass1=$_POST['pass1'];
	$pass2=$_POST['pass2'];
	$type=$_SESSION['type'];
	$uname=$_SESSION['name'];
	if($type=="fa" && $pass1==$pass2){
	
		$sql="UPDATE fa_login SET password='$pass1' WHERE fa_id='$uname'";
		$result=$conn->query($sql);
		if($result==true){
				//echo $uname;
			header("Location: login.php");
		}
	}
else if($type=="hod"  && $pass1==$pass2){
	
	$sql="UPDATE hod SET password='$pass1' WHERE username='$uname'";
		$result=$conn->query($sql);
		if($result==true){
			header("Location: login.php");
		}
	
}
else if ($type=="stu" && $pass1==$pass2){
	
	$sql="UPDATE student_login SET password='$pass1' WHERE roll_number='$uname'";
		$result=$conn->query($sql);
		if($result==true){
			header("Location:login.php");
		}
}
}
}
?>

<?php
if($_SESSION['equal']==0)
{


?>


<form method="post" action="forgot.php">
  <table align="center">
	<tr>
	<td></td>
  	<td><select name="type">
	<option value="hod">HOD</option>
	<option value="fa" selected>Faculty Advisor</option>
	<option value="stu">Student</option>
	</select></td>
  	</tr>
  <tr>
    <td>Username:</td>
    <td><input type="text" name="uname" /></td>
  </tr>
  <tr>
  <td>Mobile:</td>
  <td><input type="int" name="mobno"></td>
</tr>
<tr>
  <td></td>
<td><input type="submit" name="submit" value="Submit"></td>
</tr>
</table>

</form>

<?php } ?>



<?php 

function change ($username)
{

?>
<form method="post" action="forgot.php">
  <table align="center">
  <tr>
    <td>Enter New Password:</td>
    <td><input type="text" name="pass1" /></td>
	</tr>
  <tr>
  <td>ReEnter NEW PASSWORD:</td>
  <td><input type="text" name="pass2"></td>
	</tr>
	<tr>
  <td></td>
	<td><input type="submit" name="chng" value="Submit"></td>
</tr>
</table>

</form>

<?php
}

?>
</body>

</html>