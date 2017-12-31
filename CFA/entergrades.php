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
<form action="entergrades.php" method="post">
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




<?php
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

<center>
<table class="w3-padding w3-margin-top">
<tr>
    <th colspan="3" rowspan="2">Courses</th>
    <th>Attempt</th>
	<th colspan="2">1st</th>
	<th colspan="2">2nd</th>
	<th colspan="2">3rd</th>
	<th colspan="2">4th</th>
  </tr>
  <tr>
    <td></td>
	<th colspan="2">Date:</th>
	<th colspan="2">Date:</th>
	<th colspan="2">Date:</th>
	<th colspan="2">Date:</th>
  </tr>
  <tr>
  <td>Code</td>
  <td  colspan="2"> Course Title</td>
  <td>Credits</td>
  <td>Grade</td>
  <td>Attnce</td>
  <td>Grade</td>
  <td>Attnce</td>
  <td>Grade</td>
  <td>Attnce</td>
  <td>Grade</td>
  <td>Attnce</td>
  </tr>
  
  <form action="entergrades.php" method="post">
	
  <?php
  echo "<input type='number' value='".$sem."' name='sem' style='display:none;'>";
	if($result->num_rows>0)
	{
		$id=1;
		while($row=$result->fetch_assoc())
		{
			
			echo "<tr>";
			echo "<td>".$row['cid']."</td>";
			echo "<td  colspan='2'>".$row['course_name']."</td>";
			echo "<td>".$row['credits']."</td>";
			if($row['grade']== NULL )
			{
				//echo "<td> NO</td>";
				echo "<td><select name='".$row['cid']."'>
				<option value='S'>S</option>
				<option value='A'>A</option>
				<option value='B'>B</option>
				<option value='C'>C</option>
				<option value='D'>D</option>
				<option value='E'>E</option>
				<option value='F'>F</option>
				<option value='R'>G</option>
				<option value='W'>H</option>
				</select></td>";
			}
			else
			{
				echo "<td><select name='".$row['cid']."' value='".$row['grade']."'>
				<option value='S'>S</option>
				<option value='A'>A</option>
				<option value='B'>B</option>
				<option value='C'>C</option>
				<option value='D'>D</option>
				<option value='E'>E</option>
				<option value='F'>F</option>
				<option value='R'>G</option>
				<option value='W'>H</option>
				</select>";
				//</td>" "<td>".;
				echo $row['grade']."</td>";
			}
			if($row['attendance']== NULL )
			{
				//echo "<td> NO </td>";
				echo"<td> <select name='".$row['course_name']."'>
				<option value='H'>H</option>
				<option value='N'>N</option>
				<option value='W'>W</option>
				</select></td>";
			}
			else
			{
				echo"<td> <select name='".$row['course_name']."' value='".$row['attendance']."'>
				<option value='H'>H</option>
				<option value='N'>N</option>
				<option value='W'>W</option>
				</select>";
				//</td>"  "<td>".;
				echo $row['attendance']."</td>";
			}
			
			echo "<td>"."</td>";
			echo "<td>"."</td>";
			echo "<td>"."</td>";
			echo "<td>"."</td>";
			echo "<td>"."</td>";
			echo "<td>"."</td>";
			echo "</tr>";
			$id++;
			$credits = $credits + $row['credits'];
		}
		
	}
	else
	{
		echo "NO Courses Registered in Selected Semester";
	}
?>
  
  
  <tr>
  <td colspan="3">TOTAL CREDITS EARNED</td>
  <td ><?php echo $credits ?></td>
  <!--td>SGPA</td>
  <td colspan="3"><input type="float" name="sgpa"></td>
  <td>CGPA</td>
  <td colspan="3"><input type="float" name="cgpa"></td-->
  </tr>
  
</table>
<input type="submit" name="enter" value="Enter">
</form>
</center>

<?php } ?>

<?php
if(isset($_POST['enter']))
{
	$sem=$_POST['sem'];
	$sessid=$_SESSION['stu_id'];
	$sql="SELECT * FROM student_academic_details AS S WHERE student_login_roll_number='$sessid' AND sem='$sem' ";
	$result=$conn->query($sql);
	
	if($result->num_rows>0)
	{
		while($row=$result->fetch_assoc())
		{
			$cid=$row['cid'];
			$crsnm=$row['course_name'];
			$grd=$_POST[$cid];
			$attd=$_POST[$crsnm];
			//echo $t;
			$sql="UPDATE student_academic_details SET grade='".$grd."', attendance='".$attd."' WHERE cid='$cid' AND student_login_roll_number='$sessid' AND sem='$sem' ";
			$conn->query($sql);
		}
	}
	//$cgpa=$_POST['cgpa'];
	//$sgpa=$_POST['sgpa'];
	
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
	
	//to display gradegrade after entering grades
	$sessid=$_SESSION['stu_id'];
	$sql="SELECT * FROM student_academic_details AS S WHERE student_login_roll_number='$sessid' AND sem='$sem' ";
	$result=$conn->query($sql);
	$credits=0;
?>	
	<div class="w3-responsive">
	<center>
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
		$sgpa=0;
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
		
		$sql="SELECT * FROM grade_report WHERE student_login_roll_number='$sessid'";
		$result=$conn->query($sql);
		if($result->num_rows ==0)
		{
			$sql="INSERT INTO grade_report (student_login_roll_number) VALUES ('".$sessid."') ";
			$result=$conn->query($sql);
		}
		$semid="s".$sem;
		$sql="UPDATE grade_report SET $semid='".$sgpa."' WHERE student_login_roll_number='$sessid' ";
		$result=$conn->query($sql);
		
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
	</center>
	
</table>

</div>

<?php 

}
?>

<br>
<center><a href="studenthome.php" class="w3-button w3-white w3-border w3-hover-blue-grey">  Back </a></center>


</body>
</html>