<!DOCTYPE html>
<html>
<head>
	<title>FA homepage</title>
	<link rel="stylesheet" href="w3.css">
	<style type="text/css">
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

#a {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
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
      <div class="w3-bar-item w3-dropdown-hover w3-padding">   
 <a>
	<?php
	session_start();
	include("database.php");
    $fn=$_SESSION['fa_id'];
	$_SESSION['flag']=0;
	$sql="SELECT * FROM fa WHERE fa_login_fa_id='$fn'";
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


<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:20%;margin-top: 100px;">
  <h3 class="w3-bar-item">Functions</h3>
  
	<a href="viewstudents.php" class="w3-bar-item w3-button">View Students</a>
	<a href="record_fa.php" class="w3-bar-item w3-button" >Update Student Record</a>
	<a href="viewdetails.php" class="w3-bar-item w3-button">View Student Details</a>
	
	<a href="addcourses.php" class="w3-bar-item w3-button">Add courses</a>
	<a href="gradeverify.php" class="w3-bar-item w3-button">verify Grades</a>
	
	<a href="#a" class="w3-bar-item w3-button" onclick="document.getElementById('a').style.display='block';
	document.getElementById('appo').style.display='none';
	document.getElementById('msg').style.display='none'"
	>Update Notifications</a>
	
	<a href="#msg" class="w3-bar-item w3-button" onclick="document.getElementById('msg').style.display='block';
	document.getElementById('appo').style.display='none';
	document.getElementById('a').style.display='none'"
	>Messages</a>
	
	<a href="#appo" class="w3-bar-item w3-button" onclick="document.getElementById('appo').style.display='block';
	document.getElementById('msg').style.display='none';
	document.getElementById('a').style.display='none'"
	>Appointments 
	
	<span class="w3-badge w3-light-grey">
	<?php include('database.php');
		$fa=$_SESSION['fa_id'];
	    $sql="SELECT COUNT(*) AS c1 FROM appointments WHERE appointment_status IS NULL AND fa_login_fa_id='$fa'";
	    $result=$conn->query($sql);
	    $row=$result->fetch_assoc();
	    echo $row['c1'];?></span>
	</a>
	

		

</div>
<hr>
<div class="w3-row w3-padding-64">
<div class="w3-third w3-padding-large">
	
	
</div>


<div class="w3-container w3-third w3-padding-large w3-display-middle" >

<div id="a"  class="w3-card-4" style="display:none">
	<div class="w3-container">
	<form action="fahome.php" method="post">
	<label><b>Notification:</b></label><br><br>
	<textarea name="not" rows="10" cols="40" class="w3-small">Enter the notification...</textarea>
	<input type="submit" name="submit" value="update">
</form>
</div>
<?php
if(isset($_POST['submit'])){
	include('database.php');
	$not=$_POST['not'];
	$sql="INSERT INTO notifications(notification) VALUES ('".$not."')";
	$conn->query($sql);
}
?>
</div>


<div id="appo" style="display:none">
	<form action="fahome.php" method="POST">
	<?php
	include('database.php');
	$fa=$_SESSION['fa_id'];
	$sql="SELECT * FROM appointments WHERE fa_login_fa_id='$fa' AND appointment_status IS NULL LIMIT 1";
	$result=$conn->query($sql);
	if($result->num_rows>0){
		$row=$result->fetch_assoc();
		echo "Appointment Details: ".$row['appointment_details']."<br>";
		echo "Requested Date: ".$row['date']."<br>";
		echo "Student: ".$row['student_login_roll_number']."<br>";
		?>
		<input type="submit" name="submit1" value="accept"><input type="submit" name="submit3" value="reject">
		<?php		
	}
	else
	{
		echo "<div class='w3-panel w3-light-grey w3-border w3-bottombar'>";
		echo "<p classs='w3-large'>FURTHER MORE APPOINTMENTS ARE NOT REQUESTED BY ANY STUDENT</p>";
		echo "</div>";
	}

?>

</form>
<?php
	if(isset($_POST['submit1'])){
	include('database.php');
	$fa=$_SESSION['fa_id'];
	$sql="SELECT * FROM appointments WHERE fa_login_fa_id='$fa' AND appointment_status IS NULL LIMIT 1";
	$result=$conn->query($sql);
	if($result->num_rows>0){
		$row=$result->fetch_assoc();
		$roll=$row['student_login_roll_number'];
		$sql="UPDATE appointments SET appointment_status='A' WHERE student_login_roll_number='$roll' AND fa_login_fa_id='$fa'";
		$conn->query($sql);
		header("Location: fahome.php#b");
	}
}

	if(isset($_POST['submit3'])){
		include('database.php');
		$sql="SELECT * FROM appointments WHERE fa_login_fa_id='$fa' AND appointment_status IS NULL LIMIT 1";
		$result=$conn->query($sql);
		if($result->num_rows>0){
			$row=$result->fetch_assoc();
			$roll=$row['student_login_roll_number'];
			$sql="UPDATE appointments SET appointment_status='R' WHERE student_login_roll_number='$roll' AND fa_login_fa_id='$fa'";
			$conn->query($sql);
			header("Location: fahome.php#b");
		}
}

?>

</div>


<div id="msg" style="display:none">
	<?php include("messages.php"); ?>

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
</body>
</html>