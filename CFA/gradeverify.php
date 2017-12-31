<!DOCTYPE html>
<html>


<head>

	<title>FA homepage</title>
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

  <div class="w3-bar w3-purple w3-padding w3-card-2" style="letter-spacing:4px;">
  	
  	<img src="logo.png" style="width:100px;height:90px" class="w3-bar-item">
    <h4 class="w3-bar-item">Department Of Computer Science And Engineering<br><scan class="w3-small">National Institute of Technology Calicut</span></h4>
  
    <div class="w3-right w3-hide-small">
      <div class="w3-bar-item w3-dropdown-hover w3-padding">   
 <a><?php
	session_start();
    $fn=$_SESSION['fa_id'];
	$flag=$_SESSION['flag'];
	echo $fn;
		include("database.php");
		$sql="SELECT forbatch FROM fa WHERE fa_login_fa_id='$fn'";
		$result=$conn->query($sql);
		$row=$result->fetch_assoc();
		$year=$row['forbatch'];
   ?></a>
  <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0" >
<a href="updateprofile.php" class="w3-bar-item w3-button " >Update Profile</a>
<a href="logout.php" class="w3-bar-item w3-button">logout</a>

</div>
</div>
</div>
</div>


<?php
	if($flag==0){
	$_SESSION['flag']=1;
	?>
	<br>
	<center>
	<form action="gradeverify.php" method="post">
	SEM:<input type="number" name="sem">
	<input type="submit" name="submit" value="submit">
	</form>
	</center>  
<?php } ?>


<?php
	if(isset($_POST['submit']))
	{
		
		$_SESSION['flag']=2;
		$flag=2;
		$sem=$_POST['sem'];
		$_SESSION['sem']=$sem;
	}
	  

	if($flag==2)
	{
		$sem=$_SESSION['sem'];
		$ver='v'.$sem;
		if(isset($_POST['verify']))
		{
			$roll=$_SESSION['roll'];
			$sql2="UPDATE grade_report SET $ver='y' WHERE student_login_roll_number='$roll'";
			$conn->query($sql2);
		}
		if(isset($_POST['change']))
		{
			$roll=$_SESSION['roll'];
			$sql2="UPDATE grade_report SET $ver='c' WHERE student_login_roll_number='$roll'";
			$conn->query($sql2);
		}
		echo "<br><br>";
		$sql="SELECT * FROM student_academic_details AS S,grade_report AS G WHERE S.student_login_roll_number=G.student_login_roll_number AND
		G.$ver='n' AND S.sem='$sem'";
		$result=$conn->query($sql);
		if($result->num_rows>0)
		{
			//echo $row['student_login_roll_number'];
			
			echo "<center><table class='w3-table w3-card-4' style='width:50%'>";
			echo "<tr>
			<th > Course Code</th>
			<th > Course Title</th>
			<th >Credits</th>
			<th colspan='3'>Grade</th>
			<th colspan='2'>Attandence</th>
			</tr>" ;
			while($row=$result->fetch_assoc())
			{
				$roll=$row['student_login_roll_number'];
				echo "<tr>";
				echo "<td >".$row['cid']."</td>";
				echo "<td >".$row['course_name']."</td>";
				echo "<td >".$row['credits']."</td>";
				echo "<td colspan='3'>".$row['grade']."</td>";
				echo "<td colspan='2'>".$row['attendance']."</td>";
				echo "</tr>";
			}
			echo "</table></center>";
			$_SESSION['roll']=$roll;
			$_SESSION['sem']=$sem;
?>
		<br>
		<center>
		<form action="gradeverify.php" method="post">
		<input type="submit" name="verify" value="Verified">
		<input type="submit" name="change" value="Change">
		</form>
		
		</center>
				
<?php		
		}
		else
		{
			echo "Grade verification done for this Semester";
		}
	  
	}
  
?>
  
	</center>

</body>
</html>

