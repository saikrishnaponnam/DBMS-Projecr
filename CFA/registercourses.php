<html>
<head>
	<title>Register Courses</title>
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
<?php session_start(); ?>


  <div class="w3-bar w3-purple w3-padding w3-card-2" style="letter-spacing:4px;">
  	
  	<img src="logo.png" style="width:100px;height:90px" class="w3-bar-item">
    <h4 class="w3-bar-item">Department Of Computer Science And Engineering<br><scan class="w3-small">National Institute of Technology Calicut</span></h4>
  
	<div class="w3-right w3-hide-small">
	<div class="w3-bar-item w3-dropdown-hover w3-padding " style="width:100%">   
	<a>
	<?php
		include("database.php");
		$sessid=$_SESSION['stu_id'];
		$sql="SELECT name FROM student_details WHERE student_login_roll_number='$sessid' ";
		$result=$conn->query($sql);
		if($result->num_rows>0){
			$row=$result->fetch_assoc();
			echo $row['name'];
		}
		else
			echo $sessid;
	?>
	</a>
	<div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
	<a href="updatestudentprofile.php" class="w3-bar-item w3-button">Update Profile</a>
	<a href="logout.php" class="w3-bar-item w3-button">logout</a>

	</div>
	</div>
      
    </div>
  </div>


<center><h2>Courses</h2></center>
<table class="w3-table w3-hoverable w3-card-4" style="width:60%" align="center">
  <tr class="w3-purple w3-padding">
    <th>Course ID</th>
    <th>Course Name</th> 
    <th>Semester</th>
	<th>Credits</th>
	<th>Select</th>
  </tr>
  
  
<form action="registercourses.php" method="post">
 
<?php
	include("database.php");
    $stu=$_SESSION['stu_id'];
	$sql="SELECT joinyear FROM student_details WHERE student_login_roll_number='$stu'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	$year=$row['joinyear'];
	
	$sql="SELECT * FROM courses AS C,fa AS F WHERE F.forbatch='$year' AND C.fa_login_fa_id=F.fa_login_fa_id ";
	$result=$conn->query($sql);
	$id=1;
	if($result->num_rows>0)
	while($row=$result->fetch_assoc()){
		
		echo "<tr>";
		echo "<td>".$row['cid']."</td>"."<td>".$row['course_name']."</td>"."<td>".$row['sem']."</td>"."<td>".$row['credits']."</td>".
		"<td><input type=\"checkbox\"  name=\"course[]\" value=\"$id\"></td>";
		echo "</tr>";
		echo "<br>";
		$id=$id+1;
	}
	
?>

</table>
<center><br><br>
<input type="submit" name="submit" value="register">
</center>
</form>

<?php
if(isset($_POST['submit']))
{
	include('database.php');
    $stu=$_SESSION['stu_id'];
	$course=$_POST['course'];
	$temp=array();
	$t=0;  
	foreach($course as $chk1)  
	{  
		$temp[$t]=$chk1;
		$t++;
	} 
	
	$sql="SELECT joinyear FROM student_details WHERE student_login_roll_number='$stu'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	$year=$row['joinyear'];
	
	$sql="SELECT * FROM courses AS C,fa AS F WHERE F.forbatch='$year' AND C.fa_login_fa_id=F.fa_login_fa_id ";
	$result=$conn->query($sql);
	
	$id=1;
	$i=0;
	if($result->num_rows>0)
	{
	while($row=$result->fetch_assoc())
	{
			if(($i<$t) && ($temp[$i])==$id)
			{
				$sql="INSERT INTO student_academic_details(cid,course_name,sem,credits,student_login_roll_number) VALUES ('".$row['cid']."','".$row['course_name']."','".$row['sem']."','".$row['credits']."','".$stu."')";
				$x=$conn->query($sql);
				//echo $row['cid'];
				$i++;
			}
			$id++;
	}
	//echo $i;
	}	
}
?>





<center><br><br>
<a href="studenthome.php"> Back</a>
</center>

</body>
</html>