<?php
session_start();
?>
<html>
<head>
	<title>login</title>
</head>
<body>
	<form action="logout.php" method="POST">
<?php
$servername="localhost";
$username="root";
$password="";
$dbname="users";
$uname=$_POST['uname'];
$pass=$_POST['pass'];
$conn = new mysqli($servername,$username,$password,$dbname);

$sql="CREATE TABLE users(username VARCHAR(40) NOT NULL,password VARCHAR(40) NOT NULL)";
$conn->query($sql);
$sql="INSERT INTO users VALUES ('".$uname."','".$pass."')";
$conn->query($sql);
?>
<input type="submit" name="submit" value="logout" />
</form>
</body>
</html>