
<!DOCTYPE html>
<html>
<head>
	<title>Student homepage</title>
	<link rel="stylesheet" href="w3.css">
	<style type="text/css">
	#not {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
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
	<a href="chngpass.php" class="w3-bar-item w3-button">Change Password</a>
	<a href="logout.php" class="w3-bar-item w3-button">logout</a>

	</div>
	</div>
      
    </div>
  </div>
</div>


<div class="w3-container" style="width:60%" >
<br>
<?php
include("database.php");

$sessid=$_SESSION['stu_id'];

$sql="SELECT * FROM student_login WHERE roll_number='$sessid'";
$result=$conn->query($sql);
if($result)
{
	if($result->num_rows > 0)
	{
		while($row=$result->fetch_assoc())
		{
			$filled=$row['details_filled'];
		}
	}
	else
	{
		echo "ZERO RESULTS RETURNED";
	}
	
}
else{
	
	echo "ERROR IN EXECUTING QUERY";
}
if($filled=='n')
{
include("registration.php");	
}

else
{
	

?>

</div>


<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:15%;margin-top: 100px;">
  <h3 class="w3-bar-item">Functions</h3>
  
	<a href="record_stu.php" class="w3-bar-item w3-button">Update Record</a>
	<a href="entergrades.php" class="w3-bar-item w3-button">Enter Grades</a>
	<a href="GradeReport.php" class="w3-bar-item w3-button">GradeReport</a>
	<a href="viewrecord.php" class="w3-bar-item w3-button">ViewRecord</a>
	<a href="registercourses.php" class="w3-bar-item w3-button">Register Courses</a>
	<a href="#msg" class="w3-bar-item w3-button" onclick="document.getElementById('msg').style.display='block'
	;document.getElementById('request').style.display='none'
	;document.getElementById('status').style.display='none'
	;document.getElementById('appo').style.display='none'"
	>Messages</a>
	
	<a href="#appo" class="w3-bar-item w3-button" onclick="document.getElementById('appo').style.display='block'
	;document.getElementById('request').style.display='none'
	;document.getElementById('status').style.display='none'
	;document.getElementById('msg').style.display='none'"
	>Appointments</a>

	
	
	
</div>
<hr>
<div class="w3-row w3-padding-64">

<div class="w3-third w3-padding-large">
	
</div>


<div class=" w3-container w3-third w3-padding-large w3-display-middle">
	<div id="appo" style="display:none" >
		<br><br>
		<a href="#status" class="w3-button w3-border w3-padding-small w3-hover-green" style="width:50%" onclick="document.getElementById('status').style.display='block';document.getElementById('appo').style.display='none'">Appointment status</a><br>
		<a href="#request" class="w3-button w3-border w3-padding-small w3-hover-green" style="width:50%" onclick="document.getElementById('request').style.display='block';document.getElementById('appo').style.display='none'">Appointment Request</a>
	</div>
	<div id="status" style="display:none" >
		<br><br>
		<?php
			$name=$_SESSION['stu_id'];
			$sql="SELECT * FROM appointments WHERE  student_login_roll_number='$name' ";
			$result=$conn->query($sql);
			if($result->num_rows == 0)
			{
				//echo "<script>alert('No appointments')</script>";
			}
			else
			{
					while($row=$result->fetch_assoc())
					{
						$sql= "SELECT name FROM fa WHERE fa_login_fa_id='".$row['fa_login_fa_id']."' ";
						$faname=$conn->query($sql);
						
						$fa=$faname->fetch_assoc();
						if($row['appointment_status']=='A')
							echo "Mr/Mrs.      ".$fa['name']."           Accepted your appointment on ".$row['date'] ;
						else if($row['appointment_status']=='R')
							echo "Mr/Mrs.      ".$fa['name']."           Rejected your appointment on".$row['date']."  please try for some other slot";
						else
							echo "Mr/Mrs.      ".$fa['name']."           Not yet checked your appointment, check after some time";
						echo "<br>";
					}
					//echo "<center>";
					echo "<a href='studenthome.php'><b>          Back</a>";
					//echo "</center>";

			}
		?>
		
	</div>
	<div id="request" style="display:none" >
		<br><br>
		<?php
		include("addappointments.php");
		?>
	</div>
	
	<div id="msg" style="display:none">
		<br><br>
		<?php
		include("msgforstu.php");
		?>
	
	</div>
	
</div>

<div id="not" class="w3-third w3-padding-large w3-bar-block w3-card-2 w3-center w3-display-right" style="width:25%">
	<div>
		<b><u>Notifications</u></b>
	</div><hr>
	<div class="w3-bar-block">
	<?php
		include('database.php');
		$sql="SELECT notification,updated_on FROM notifications ORDER BY updated_on DESC LIMIT 5";
		$result=$conn->query($sql);
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				echo $row['notification']."<br>-".$row['updated_on']."<br><br>";
				
				
			}
		}else{
			echo "0 results";
		}
	?>
	
		
</div>
</div>
</div>

<?php
}
?>

</body>
</html>
