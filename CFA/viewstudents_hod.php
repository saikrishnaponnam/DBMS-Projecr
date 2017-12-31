<html>
<head>
	<title>Student Details</title>
	<link rel="stylesheet" href="w3.css">
	<style type="text/css">
	</style>
	

<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
	
}
th, td {
    padding: 5px;
}
th {
    text-align: left;
}
</style>
</head>

<body>

<?php
function batchwise($batch)
{	
	
	echo "<table class='w3-table w3-striped w3-hoverable' style='width:50%' align='center'>";

	include("database.php");
	$sql="SELECT name,roll_number,batch,cgpa FROM student_login,student_details,student_record WHERE student_login.roll_number=student_details.student_login_roll_number AND 
	student_login.roll_number=student_record.student_login_roll_number AND (student_record.batch='$batch')";
	$result=$conn->query($sql);
	if($result->num_rows>0)
	{
		
		echo "<br><center>"."<h2>Student Details</h2>"."</center>";
		echo "<br><br>";
		echo "<tr>"."<th>"."Name"."</th>"."<th>"."Roll Number"."</th>"."<th>"."Batch"."</th>"."<th>"."C.G.P.A"."</th>"."</tr>";
		while($row=$result->fetch_assoc())
		{
			echo "<tr>";
			echo "<td>"."<a href='Student_Details.php'>".$row['name']."</a>"."</td>"."<td>".$row['roll_number']."</td>"."<td>".$row['batch']."</td>"."<td>".$row['cgpa']."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else
	{	
		echo "<center>"."No students to display"."</center>";
	}
	return 0;
	


}
?>



	<div class="w3-top">
  <div class="w3-bar w3-purple w3-padding w3-card-2" style="letter-spacing:4px;">
  	
  	<img src="logo.png" style="width:100px;height:90px" class="w3-bar-item">
    <h4 class="w3-bar-item">Department Of Computer Science And Engineering<br><scan class="w3-small">National Institute of Technology Calicut</span></h4>
  
    <div class="w3-right w3-hide-small">
      <div class="w3-bar-item w3-dropdown-hover w3-padding">   
	<a>
	<?php
	session_start();
		include("database.php");
		$fn=$_SESSION['hod_id'];
		$sql="SELECT * FROM hod WHERE username='$fn'";
		$result=$conn->query($sql);
		if($result->num_rows>0){
			$row=$result->fetch_assoc();
			echo $row['name'];	
		}
		else
			echo $fn;
	?>
   </a>
  <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0" >
<a href="updateprofile.php" class="w3-bar-item w3-button " >Update Profile</a>
<a href="logout.php" class="w3-bar-item w3-button">logout</a>

</div>
</div>
      
    </div>
  </div>
</div>
	<br><br><br><br><br><br>
	<center>
	
	<div class="w3-bar w3-light-grey w3-card-4 ">
	
	<a href="#all" class="w3-bar-item w3-button  w3-hover-green" onclick="document.getElementById('all').style.display='block';
		document.getElementById('fail').style.display='none'
		;document.getElementById('btwcg').style.display='none'
		;document.getElementById('med').style.display='none'
		;document.getElementById('B').style.display='none'
		;document.getElementById('J').style.display='none'
		;document.getElementById('cour').style.display='none'
		;document.getElementById('dasa').style.display='none'
		">All students</a>
		
	<a href="#fail" class="w3-bar-item w3-button  w3-hover-green" onclick="document.getElementById('fail').style.display='block';
		document.getElementById('all').style.display='none'
		;document.getElementById('btwcg').style.display='none'
		;document.getElementById('med').style.display='none'
		;document.getElementById('B').style.display='none'
		;document.getElementById('J').style.display='none'
		;document.getElementById('cour').style.display='none'
		;document.getElementById('dasa').style.display='none'
		">Fail</a>
	
	<a href="#btwcg" class="w3-bar-item w3-button  w3-hover-green" onclick="document.getElementById('btwcg').style.display='block';
		document.getElementById('all').style.display='none'
		;document.getElementById('fail').style.display='none'
		;document.getElementById('med').style.display='none'
		;document.getElementById('B').style.display='none'
		;document.getElementById('J').style.display='none'
		;document.getElementById('cour').style.display='none'
		;document.getElementById('dasa').style.display='none'
		">Students Between CGPA</a>
	
	<a href="#med" class="w3-bar-item w3-button  w3-hover-green" onclick="document.getElementById('med').style.display='block';
		document.getElementById('all').style.display='none'
		;document.getElementById('fail').style.display='none'
		;document.getElementById('btwcg').style.display='none'
		;document.getElementById('B').style.display='none'
		;document.getElementById('J').style.display='none'
		;document.getElementById('cour').style.display='none'
		;document.getElementById('dasa').style.display='none'
		">Medical Discontinue</a>
		
	<a href="#cour" class="w3-bar-item w3-button  w3-hover-green" onclick="document.getElementById('cour').style.display='block';
		document.getElementById('all').style.display='none'
		;document.getElementById('fail').style.display='none'
		;document.getElementById('btwcg').style.display='none'
		;document.getElementById('B').style.display='none'
		;document.getElementById('J').style.display='none'
		;document.getElementById('dasa').style.display='none'
		;document.getElementById('med').style.display='none'
		">Course</a>
		
	<a href="#dasa" class="w3-bar-item w3-button  w3-hover-green" onclick="document.getElementById('dasa').style.display='block';
		document.getElementById('all').style.display='none'
		;document.getElementById('fail').style.display='none'
		;document.getElementById('btwcg').style.display='none'
		;document.getElementById('B').style.display='none'
		;document.getElementById('J').style.display='none'
		;document.getElementById('med').style.display='none'
		;document.getElementById('cour').style.display='none'
		">DASA</a>
	
	<a href="#disp" class="w3-bar-item w3-button  w3-hover-green" onclick="document.getElementById('disp').style.display='block';
		document.getElementById('all').style.display='none'
		;document.getElementById('fail').style.display='none'
		;document.getElementById('btwcg').style.display='none'
		;document.getElementById('B').style.display='none'
		;document.getElementById('J').style.display='none'
		;document.getElementById('med').style.display='none'
		;document.getElementById('cour').style.display='none'
		">Disciplinary action</a>

	<a href="hodhome.php" class="w3-bar-item w3-button  w3-hover-green w3-right"> Back </a>
	
	</div>
	</center>


<?php
	if(isset($_POST['cgpa']))
	{
		echo "<br><br>";
		include("database.php");
		//session_start();
		
		$cgpa1=$_POST['cgpa1'];
		$cgpa2=$_POST['cgpa2'];
		$year=2012;
		$sql="SELECT * FROM student_record,grade_report WHERE cgpa>='$cgpa1' AND cgpa<='$cgpa2' AND (student_record.student_login_roll_number = grade_report.student_login_roll_number) 
		ORDER BY student_record.joinyear";
		$result=$conn->query($sql);
		if($result->num_rows>0){
		echo "<center><h2>Student Details</h2></center>";
		
		while($row=$result->fetch_assoc())
		{
			if($row['joinyear']!=$year)
			{		
			echo "</table><br>";
			echo "<table class='w3-table w3-card-4' style='width:50%' align='center'>";
			$year=$row['joinyear'];
			echo "<Center>". $year."</Center>";
			echo"<tr><td>Roll Number</td>";
			echo"<td>SEM 1</td>";
			echo"<td>SEM 2</td>";
			echo"<td>SEM 3</td>";
			echo"<td>SEM 4</td>";
			echo"<td>SEM 5</td>";
			echo"<td>SEM 6</td>";
			echo"<td>SEM 7</td>";
			echo"<td>SEM 8</td>";
			echo"<td>C.G.P.A</td></tr>";
			
			}
		echo "<tr><td>".$row['student_login_roll_number']."</td>"; 
		echo "<td>	".$row['s1']."</td>"; 
		echo "<td>	".$row['s2']."</td>"; 
		echo "<td>	".$row['s3']."</td>"; 
		echo "<td>	".$row['s4']."</td>"; 
		echo "<td>	".$row['s5']."</td>"; 
		echo "<td>	".$row['s6']."</td>"; 
		echo "<td>	".$row['s7']."</td>"; 
		echo "<td>	".$row['s8']."</td>"; 
		echo "<td> 	".$row['cgpa']."</td></tr>";
	
	}
		echo "</table>";
	}
	else
	{
		echo "<center><h4>No students in required C.G.P.A range<h4></center>";
	}
}
?>



<div id="all" style="display:none" >

<?php
	echo "<center>"."<h2>Student Details</h2>"."</center>";
	echo "<br>"."<br>"."<br>";
	
	include("database.php");
	$sql="SELECT name,student_login_roll_number,fa_name,joinyear FROM student_details ORDER BY joinyear";
	$result=$conn->query($sql);
	$year=2012;
	if($result->num_rows>0)
	{
		while($row=$result->fetch_assoc())
		{
			if($row['joinyear']!=$year)
			{
				echo "</table><br>";
				$year=$row['joinyear'];
				echo "<Center>". $year."</Center>";
				echo "<table class='w3-table w3-striped w3-hoverable' style='width:50%' align='center'>";
				echo "<tr>"."<th>"."Name"."</th>"."<th>"."Roll Number"."</th>"."<th>"."FA"."</th>"."</tr>";
			}
			echo "<tr>";
			echo "<td>".$row['name']."</a>"."</td>"."<td>".$row['student_login_roll_number']."</td>"."<td>".$row['fa_name']."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else
	{	

		echo "No students to display";
	}
?>

</div>

<div id="fail" style="display:none" >
	<?php
		$sql="SELECT * FROM student_details ORDER BY joinyear ";
		$result=$conn->query($sql);
		$year=2012;
		if($result->num_rows>0){
			
			echo "<center><h2>Student Details</h2></center>";
			while($row=$result->fetch_assoc())
			{
				if($row['joinyear']!=$year)
				{	
					echo "</table><br>";
					echo "<table class='w3-table w3-card-4' style='width:50%' align='center'>";
					$year=$row['joinyear'];
					echo "<Center>". $year."</Center>";
					echo "<tr><th>Roll Number</th>";
					echo "<th>Name</th>";
					echo "<th>Courses</th><th>sem</th>";
				}
				$name=$row['name'];
				$roll=$row['student_login_roll_number'];
				$sql2="SELECT * FROM student_academic_details  WHERE student_login_roll_number='$roll' AND  grade='F' ";
				$sql3="SELECT COUNT(*) AS c1 FROM student_academic_details  WHERE student_login_roll_number='$roll' AND  grade='F'";
		        $result3=$conn->query($sql3);
				$row3=$result3->fetch_assoc();
				$c1=$row3['c1'];
				$result2=$conn->query($sql2);
				if($result2->num_rows>0)
				{
					echo "<tr><td class ='w3-centered' rowspan='$c1'>".$row['student_login_roll_number']."</td>";
					echo "<td rowspan='$c1'>".$row['name']."</td>";
					$row2=$result2->fetch_assoc();
					echo "<td>".$row2['course_name']."</td></tr>";
					while($row2=$result2->fetch_assoc())
					{
						echo "<tr><td>".$row2['course_name']."</td></tr>";
						
					}
					//echo $row2['sem']."</td>";
				}
			}
			echo"</table>";
		}
	?>
</div>



<div id="btwcg" style="display:none" >	
	<br><br><br><br>
	<center>
	<form method='POST' action='viewstudents_hod.php'>
	<table align="center">
	<tr>
	<td>CGPA Starting from:</td>
	<td><input type='float' name='cgpa1' id='cgpa'></td>
	</tr>
	<tr>
	<td>CGPA Upto:</td>
	<td><input type='float' name='cgpa2' id='cgpa'></td>
	</tr>
	<tr>
	</table>
	<br>
	<input type="submit" name="cgpa" value="Submit">
	</form>
	</center>
	
</div>

<div id="med" style="display:none">
	<center>
	<br>
	<?php
		echo "<center>"."<h2>Student Details</h2>"."</center>";
		echo "<br>"."<br>"."<br>";
		echo "<table class='w3-table w3-striped w3-hoverable' style='width:50%' align='center'>";
		$sql="SELECT * FROM student_record AS S1,student_details AS S2 WHERE S1.joinyear='$year' AND S1.student_login_roll_number=S2.student_login_roll_number AND S1.medical_discontinuation='Y'";
		$result=$conn->query($sql);
		if($result->num_rows>0)
		{	
			echo "<tr>"."<th>"."Name"."</th>"."<th>"."Roll Number"."</th>"."<th>"."Batch"."</th>"."<th>"."Discontinuation Details"."</th>"."</tr>";
			while($row=$result->fetch_assoc())
			{
				echo "<tr>";
				echo "<td>".$row['name']."</a>"."</td>"."<td>".$row['student_login_roll_number']."</td>"."<td>".$row['batch']."</td>"."<td>".$row['medical_discontinuation_details']."</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		else	
			echo "No students to display";
	?>
	</center>
</div>

<div id="cour" style="display:none">
	<br><br>
	<center>
	<form method='POST' action='viewstudents_hod.php'>
	Course id
	<input type="text" name="cid" id="cid">
	<br>
	<input type="submit" name="cour" value="Submit">
	</form>
	
	<br>
	<?php
		
		echo "<table class='w3-table w3-striped w3-hoverable' style='width:50%' align='center'>";
		$sql="SELECT * FROM student_record AS S1,student_details AS S2 WHERE S1.joinyear='$year' AND S1.student_login_roll_number=S2.student_login_roll_number AND S1.medical_discontinuation='Y'";
		$result=$conn->query($sql);
		if($result->num_rows>0)
		{
			echo "<center>"."<h2>Student Details</h2>"."</center>";
			echo "<br>"."<br>"."<br>";			
			echo "<tr>"."<th>"."Name"."</th>"."<th>"."Roll Number"."</th>"."<th>"."Batch"."</th>"."</tr>";
			while($row=$result->fetch_assoc())
			{
				echo "<tr>";
				echo "<td>".$row['name']."</a>"."</td>"."<td>".$row['student_login_roll_number']."</td>"."<td>".$row['batch']."</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		else	
			echo "No students to display";
	?>
	</center>

</div>

<?php
	if(isset($_POST['cour']))
	{
		echo "<br><br>";
		include("database.php");
		//session_start();
		
		echo "<table class='w3-table w3-striped w3-hoverable' style='width:50%' align='center'>";

		$cid=$_POST['cid'];
		$sql="SELECT * FROM student_academic_details AS S1,student_details AS S2 WHERE S1.cid='$cid' AND 
		S1.student_login_roll_number=S2.student_login_roll_number AND S2.joinyear='$year'";
		$result=$conn->query($sql);
		
		if($result->num_rows>0)
		{
			$row=$result->fetch_assoc();
			echo "<center>"."<h2>Students Registered for  ".$row['course_name']."</h2>"."</center>";
			echo "<br>"."<br>"."<br>";			
			echo "<tr>"."<th>"."Name"."</th>"."<th>"."Roll Number"."</th>"."<th>"."Grade"."</th>"."</tr>";
				echo "<tr>";
				echo "<td>".$row['name']."</a>"."</td>"."<td>".$row['student_login_roll_number']."</td>"."<td>".$row['grade']."</td>";
				echo "</tr>";
			while($row=$result->fetch_assoc())
			{
				echo "<tr>";
				echo "<td>".$row['name']."</a>"."</td>"."<td>".$row['student_login_roll_number']."</td>"."<td>".$row['grade']."</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		else	
			echo "No students to display";
		
}
?>







<br>
<center><a href="hodhome.php" class="w3-button w3-white w3-border w3-hover-blue-grey">  Back </a></center>


</body>
</html>