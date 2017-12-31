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
#a {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
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
    $sessid=$_SESSION['stu_id'];
     echo $sessid;
   ?></a>
  <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
<a href="updateprofile.php" class="w3-bar-item w3-button">Update Profile</a>
<a href="logout.php" class="w3-bar-item w3-button">logout</a>

</div>
</div>
      
    </div>
  </div>


<div id="a" class="w3-card-4 w3-margin" >

<br>
<?php
//if(isset($_POST['submit'])){
include("database.php");

$sql="SELECT * FROM Student_Record WHERE student_login_roll_number='$sessid'";
$result=$conn->query($sql);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
		echo "<table   style='width:50%' align='center'>";
		echo "<tr><th colspan='2'><h2>Record</h2></th><tr>";
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

?>

</div>
<center>
<a href="studenthome.php"><h3><b> Back </h3> </a>
</center>

</body>
</html>
