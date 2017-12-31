<html>
<head>
<title>Grade Report</title>
<link rel="stylesheet" href="w3.css">
	<style type="text/css">
	table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;    
}
th,td{
	text-align: left;
}
	</style>
</head>


<body>

<div class="w3-top">
  <div class="w3-bar w3-purple w3-padding w3-card-2" style="letter-spacing:4px;">
  	
  	<img src="logo.png" style="width:100px;height:90px" class="w3-bar-item">
    <h4 class="w3-bar-item">Department Of Computer Science And Engineering<br><scan class="w3-small">National Institute of Technology Calicut</span></h4>
  
	<div class="w3-right w3-hide-small">
	<div class="w3-bar-item w3-dropdown-hover w3-padding " style="width:100%">   
	<a>
	<?php
		include("database.php");
		session_start();
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
</div>

<center>
<br><br><br><br><br><br><br>
<form action="gradereport.php" method="post">
	SELECT SEMESTER:
	<select name="sem">
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	</select>
	<br>
	<input type="submit" name="submit" value="Get">
</form>
</center>

<center>

<?php
$sgpa=0;
if(isset($_POST['submit']))
{
	include("database.php");
	//session_start();
    $sessid=$_SESSION['stu_id'];
	$sem=$_POST['sem'];
	$sql="SELECT * FROM student_academic_details AS S WHERE student_login_roll_number='$sessid' AND sem='$sem' ";
	$result=$conn->query($sql);
	$credits=0;
	

?>
<div class="w3-responsive">
<table class="w3-padding w3-margin-top" style="width:50%">
	
	
	<tr>
	<th > Course Code</th>
	<th > Course Title</th>
	<th >Credits</th>
	<th colspan="3">Grade</th>
	<th colspan="2">Attandence</th>
	</tr>
	

<?php
	if($result->num_rows>0)
	{
		while($row=$result->fetch_assoc())
		{
			echo "<tr>";
			echo "<td >".$row['cid']."</td>";
			echo "<td >".$row['course_name']."</td>";
			echo "<td >".$row['credits']."</td>";
			echo "<td colspan='3'>".$row['grade']."</td>";
			echo "<td colspan='2'>".$row['attendance']."</td>";
			echo "</tr>";
			$credits = $credits + $row['credits'];
			$sgpa=sg($row['credits'],$row['grade'],$sgpa);
		}
		$sgpa=round($sgpa);
		
	}
	else
	{
		echo "NO Courses Registered in Selected Semester";
	}
?>



<tr>
	<td colspan="2">TOTAL CREDITS EARNED</td>
	<td><?php echo $credits ?></td>
	<td >SGPA</td>
	<td colspan="2"><?php echo $sgpa / $credits ?></td>
	<td>CGPA</td>
	<td ></td>
	</tr>
	
	
</table>

</div>

<?php }

function sg($credits,$grd,$sgpa)
{
	$v=0;
	switch ($grd) {
    case "S":
       $v=10;
        break;
	case "A":
       $v=9;
        break;
	case "B":
       $v=8;
        break;
    case "C":
       $v=7;
        break;
	case "D":
       $v=6;
        break;		
	case "E":
       $v=5;
        break;
	case "F":
       $v=0;
        break;
	case "R":
       $v=0;
        break;
	case "W":
       $v=0;
        break;
	}
	$sgpa = $sgpa+($credits * $v);
	return $sgpa;
}

 ?>

<a href="studenthome.php" class="w3-button w3-white w3-border w3-hover-blue-grey">  Back </a>

</center>
</body>
</html>