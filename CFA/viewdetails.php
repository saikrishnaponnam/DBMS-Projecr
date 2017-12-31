<html>
<head>
<head>
	<title> Sudent Details</title>
	<link rel="stylesheet" href="w3.css">
	<style type="text/css">
	</style>

	<title>Student homepage</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<style type="text/css">
	
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
	
	body{
	   font-family: Verdana,sans-serif;}
	   input[type=text],input[type=number] select {
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

input[type=submit],input[type=reset] {
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
  <div class="w3-bar w3-purple w3-padding w3-card-2" style="letter-spacing:4px;">
  	
  	<img src="logo.png" style="width:100px;height:90px" class="w3-bar-item">
    <h4 class="w3-bar-item">Department Of Computer Science And Engineering<br><scan class="w3-small">National Institute of Technology Calicut</span></h4>
  
    <div class="w3-right w3-hide-small">
      <div class="w3-bar-item w3-dropdown-hover w3-padding">   
 <a><?php
	session_start();
    include("database.php");
    $fn=$_SESSION['fa_id'];
	$sql="SELECT * FROM fa WHERE fa_login_fa_id='$fn'";
	$result=$conn->query($sql);
	if($result->num_rows>0){
		$row=$result->fetch_assoc();
		echo $row['name'];	
	}
	else
		echo $fn;
   ?></a>
  <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
<a href="updateprofile.php" class="w3-bar-item w3-button">Update Profile</a>
<a href="logout.php" class="w3-bar-item w3-button">logout</a>

</div>
</div>
</div>
</div>



<div id="a" class="w3-card-4 w3-margin" >

<center>
<div class="w3-container" style="width:50%">
<form action="viewdetails.php"  method="post">
		<label>Roll Number:</label>
		<input type="text" id="roll " name="roll" >
		<input type="submit" name="submit" value="getinfo">
</form>
<center><a href="fahome.php" class="w3-button w3-green"> Back </a></center>	 
</div>
</center>


<?php
if(isset($_POST['submit'])){
	echo "<br>";
include("database.php");
$num=$_POST['roll'];
$sql="SELECT * FROM Student_Details WHERE student_login_roll_number='$num'";
$result=$conn->query($sql);
if($result->num_rows>0){
	
	//echo "<center><fieldset style='width:70%'><legend><h2><b>Personal Information</h2></legend> <br>";
	echo "<table class='w3-table w3-card-4' style='width:50%' align='center'>";
	while($row=$result->fetch_assoc()){
		echo "<tr><th colspan='2'><h2>Personal Details</h2></th></tr>";
		echo "<tr><td>Name:</td><td>	".$row['name']."</td></tr>"; 
		echo "<tr><td>Date Of Birth:</td><td>	".$row['dob']."</td></tr>"; 
		echo "<tr><td>Nationality:</td><td>	".$row['nationality']."</td></tr>"; 
		echo "<tr><td>Religion/Community:</td><td>	".$row['religion']."</td></tr>"; 
		echo "<tr><td>Caste:</td><td>	".$row['caste']."</td></tr>"; 
		echo "<tr><td>Contact No:</td><td>	".$row['contact_no']."</td></tr>"; 
		echo "<tr><td>Email Id:</td><td>	".$row['email_id']."</td></tr>"; 
		echo "<tr><td>Permanent Address:</td><td>	".$row['permanent_address']."</td></tr>"; 
		echo "<tr><td>Present Address:</td><td>	".$row['present_address']."</td></tr>"; 
		echo "<tr><td>Local Guardian:</td><td>	".$row['local_guardian']."</td></tr>"; 
		echo "<tr><td>Father Name:</td><td>	".$row['father_name']."</td></tr>"; 
		echo "<tr><td>Mother Name:</td><td>	".$row['mother_name']."</td></tr>"; 
		echo "<tr><td>Faculty Advisor:</td><td>	".$row['fa_name']."</td></tr>"; 
		echo "<tr><td>Parent Contact:</td><td>	".$row['parent_contact']."</td></tr>"; 
		echo "<tr><td>Parent Email:</td><td>	".$row['parent_email']."</td></tr>"; 
	}
		echo "</table><br>";
		//echo "</fieldset></center><br><br>";
	
	
}
$sql="SELECT * FROM Student_Record WHERE student_login_roll_number='$num'";
$result=$conn->query($sql);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
		echo "<table class='w3-table w3-card-4' style='width:50%' align='center'>";
		echo "<tr><th colspan='2'><h2>Academic Details</h2></th><tr>";
	echo "<tr><td>CGPA:</td><td>	".$row['cgpa']."</td></tr>"; 
	echo "<tr><td>Project:</td><td>	".$row['project']."</td></tr>"; 
	echo "<tr><td>Batch:</td><td>	".$row['batch']."</td></tr>"; 
	echo "<tr><td>Project Guide:</td><td>	".$row['project_guide']."</td></tr>"; 
	echo "<tr><td>Internship:</td><td>	".$row['internship']."</td></tr>"; 
	echo "<tr><td>Condonation Details:</td><td>	".$row['condonation_details']."</td></tr>"; 
	echo "<tr><td>No.Of Condonations:</td><td>	".$row['no_of_condonations']."</td></tr>"; 
	echo "<tr><td>Probation Details:</td><td>	".$row['probation_details']."</td></tr>"; 
	echo "<tr><td>Medical Discontinuation:</td><td>	".$row['medical_discontinuation']."</td></tr>";
	echo "<tr><td>Medical Discontinuation Details:</td><td>	".$row['medical_discontinuation_details']."</td></tr>";
	echo "<tr><td>Extra Curricular Activities:</td><td>	".$row['extra_curricular_activities']."</td></tr>";
	echo "<tr><td>Department Association Activities:</td><td>	".$row['Dept_association_activities']."</td></tr>";
	echo "<tr><td>Achievements:</td><td>	".$row['achievements']."</td></tr>";
	echo "<tr><td>Disciplinary Action:</td><td>	".$row['disciplinary_action']."</td></tr>";
	echo "<tr><td>Placement Details:</td><td>	".$row['placement_details']."</td></tr>";
	echo "<tr><td>Alternate Email Id:</td><td>	".$row['alternate_email']."</td></tr>";
	echo "<tr><td>Facebook :</td><td>	".$row['facebook']."</td></tr>";
	echo "<tr><td>LinkedIn:</td><td>	".$row['linkedIn']."</td></tr>";
	
	echo "</table>";
	
	}
}
}

?>

</div>

</body>
</html>
