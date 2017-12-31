<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="w3.css">
	<style>
body {font-family: "Times New Roman", Georgia, Serif;
background-color: white}
h1,h2,h3,h4,h5,h6,td,p {
    font-family: "Playfair Display";
    letter-spacing: 5px;
}
td{
  text-align:left;
}
a{
  color:white;
  }
  a:hover{
    color:blue;
  }
  input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=password], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

#div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
textarea {
    width: 100%;
    height: 150px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    font-size: 16px;
    resize: none;
}
</style>
</head>
<body>

<div class="w3-top">
	<div class="w3-bar w3-purple w3-padding w3-card-2" style="letter-spacing:4px;">
  	<img src="logo.png" style="width:100px;height:90px" class="w3-bar-item">
    <h4 class="w3-bar-item">Department Of Computer Science And Engineering<br><scan class="w3-small">National Institute of Technology Calicut</span></h4>
	<div class="w3-right w3-hide-small">
		<br>You are not logged in
	</div>
	</div>
	</div>
</div>
	
<br><br><br><br><br><br><br><br><br>
<center>
  <div id="div" class="w3-card-4" style="width: 50%">
<div class="w3-container" style="width:100%;">
<form method="post" action="login.php">
  <table align="center">
  	<tr>
  		<td></td>
  		<td><select name="type">
	<option value="admin">Admin</option>
	<option value="hod">HOD</option>
	<option value="fa" selected>Faculty Advisor</option>
	<option value="stu">Student</option>
</select></td>
  	</tr>
    <tr>
    <td><label>Username:</label></td>
    <td><input type="text" name="uname" placeholder="Username....."></td>
  </tr>
  <tr>
  <td><label>Password:</label></td>
  <td><input type="password" name="pass" placeholder="Password...."></td>
</tr>
<tr>
  <td></td>
<td><input type="submit" name="submit" value="Login"></td>

</tr>
  </table>
</form>
</div><a class="w3-button w3-block w3-dark-grey" href="forgot.php">Forgot Password?</a>
</div>
</center>

<?php

session_start();
$_SESSION['equal']=0; 
if(isset($_POST['submit'])){
	include("database.php");
	
	$flag=0;
	$username=$_POST['uname'];
	$password=$_POST['pass'];
	$type=$_POST['type'];
	
	if($username=="admin" && $password=="admin" && $type=="admin"){
		$_SESSION['start']=1;
    header("Location: adminhomepage.php");

	}else{
if($type=="fa"){
  $sql="SELECT fa_id,password FROM fa_login";
  $result=$conn->query($sql);
  if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
      if($username==$row['fa_id'] && $password==$row['password']){
        $flag=1;
        $_SESSION["fa_id"]=$username;
        $_SESSION["fa_pass"]=$password;
        header("Location: fahome.php");
      }
    }
  }
}else if($type=="hod"){
  $sql="SELECT username,password FROM HOD";
  $result=$conn->query($sql);
  if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
      if($username==$row['username'] && $password==$row['password']){
        $flag=1;
        $_SESSION["hod_id"]=$username;
        $_SESSION["hod_pass"]=$password;
        header("Location: hodhome.php");
      }
    }
  }
}else{
  $sql="SELECT roll_number,password FROM student_login";
  $result=$conn->query($sql);
  if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
      if($username==$row['roll_number'] && $password==$row['password']){
        $flag=1;
        $_SESSION["stu_id"]=$username;
        $_SESSION["stu_pass"]=$password;
        header("Location: studenthome.php");
      }
    }
  }
}
	}
	if($flag==0){
		echo "<script>alert('INVALID USERNAME OR PASSWORD')</script>";
	}
	
}

?>
</body>
</html>

