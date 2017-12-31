<html>
<head>
	<title>academic details</title>
	<link rel="stylesheet" href="w3.css">
	<style type="text/css">
	</style>

<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 2px;
}
th {
    text-align: left;
}
</style>
</head>

<body>

<form action="stu_academics.php" method="post">
<table>

<tr>
<td> Semester:</td>
<td> <select name="sem">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
</select></td>
</tr>

<tr>
<td><input type="submit" name="submit" value="submit"></td>
</tr>
</table>
</form>


<center><h2>Courses</h2></center>
<table class="w3-table w3-hoverable" style="width:50%" align="center">
  <tr>
    <th>Course ID</th>
    <th>Course Name</th> 
	<th>Semester</th>
	<th>credits</th>
	<th>Grade</th>
	<th>attendance</th>
	
  </tr>

<?php
	if(isset($_POST['submit'])){
	include("database.php");
	session_start();
    $stu=$_SESSION['stu_id'];
	$sem=$_POST['sem'];
	$sql="SELECT * FROM student_academic_details AS S, courses AS C WHERE S.student_login_roll_number=$stu AND C.cid=S.courses_cid AND S.sem=$sem AND C.sem=$sem";
	$result=$conn->query($sql);
	if($result->num_rows>0)
	while($row=$result->fetch_assoc())
	{
		
		echo "<tr>";
		echo "<td>".$row['cid']."</td>"."<td>".$row['course_name']."</td>"."<td>".$row['sem']."</td>"."<td>".$row['credits']."</td>"."<td>".$row['grade']."</td>"."<td>".$row['attendance']."</td>";
		echo "</tr>";
		echo"<br>";
	}
	else
		echo "NO courses registered in $sem semester";
	}
?>

</table>

<center>
<a href="studenthome.php"> Back</a>
</center>


</body>
</html>
