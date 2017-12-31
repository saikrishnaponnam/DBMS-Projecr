<html>
<head>
  <title>Student Record</title>
  <link rel="stylesheet" href="w3.css">
  <style>
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
 

  
 <div id="a" class="w3-card-4 w3-margin" >
<?php
if(isset($_POST['submit'])){

include("database.php");

$roll_number=$_POST['roll'];
$batch=$_POST['batch'];
$cgpa=$_POST['cgpa'];
$year=$_POST['year'];
$project=$_POST['project'];
$proj_guide=$_POST['guide'];
$intern=$_POST['intern'];
$condon=$_POST['condon'];
$no_condon=$_POST['no_condon'];
$prob_details=$_POST['prob_details'];
$extra_acts=$_POST['extra_acts'];
$dept_acts=$_POST['dept_acts'];
$achieved=$_POST['achieved'];
$pla_details=$_POST['pla_details'];
$alt_email=$_POST['alt_email'];
$fb=$_POST['fb'];
$linkin=$_POST['linkin'];

$sql= "SELECT * FROM student_record WHERE student_login_roll_number='$roll_number'";
$result=$conn->query($sql);

if($result->num_rows > 0)
{
	//echo "sai";
	$sql="UPDATE student_record SET cgpa='$cgpa', project='$project', joinyear='$year', batch='$batch', internship='$intern', project_guide='$proj_guide', 
	condonation_details='$condon', no_of_condonations='$no_condon', probation_details='$prob_details',  extra_curricular_activities='$extra_acts', 
	Dept_association_activities='$dept_acts', achievements='$achieved', placement_details='$pla_details', alternate_email='$alt_email', facebook='$fb', linkedIn='$linkin'
	WHERE  student_login_roll_number='$roll_number' ";
	$result=$conn->query($sql);
	if($result==TRUE)
	header("Location:record_stu.php");
}	
else
{
	//echo "sfsd";
	$sql="INSERT INTO student_record VALUES('".$roll_number."','".$cgpa."','".$project."','".$year."','".$batch."','".$proj_guide."','".$intern."','".$condon."','".$no_condon."','".$prob_details."','".$med_disc."','".$med_disc_details."','".$extra_acts."','".$dept_acts."','".$achieved."','".$discipline."','".$pla_details."','".$alt_email."','".$fb."','".$linkin."')";
	$result=$conn->query($sql);
	if($result==TRUE){
	header("Location:record_stu.php");
	
	}
}


}

?>



	

<?php
include("database.php");
$sessid=$_SESSION['stu_id'];
$sql="SELECT * FROM student_record WHERE student_login_roll_number='$sessid' ";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

?>

<form method="post" action="record_stu.php">
	<table align="center">

	<tr>
	<td><label>Roll Number:</label></td>
	<td> <?php echo "<input type='text' id='roll' value='".$sessid."' name='roll' readonly>" ?></td>
	</tr>

  
	<tr>
	<td><label>CGPA:</label></td>
	<td> <?php echo "<input type='int' id='cgpa' value='".$row['cgpa']."' name='cgpa'> "?></td>
	</tr>
	
	<tr>
	<td><label>Join Year:</label></td>
	<td> <?php echo "<input type='int' id='cgpa' value='".$row['joinyear']."' name='year'> "?></td>
	</tr>

    <tr>
    <td><label>Project:</label></td>
    <td> <?php echo "<input type='text' id='project' value='".$row['project']."' name='project' >" ?></td>
	</tr>
  
	<tr>
	<td style="width:250px;"><label>Batch:</label></td>
	<td> <?php echo "<input type='text' id='batch' value='".$row['batch']."' name='batch'>" ?></td>
	</tr>

  
    <tr>
    <td><label>Project Guide:</label></td>
    <td> <?php echo "<input type='text' id='guide' value='".$row['project_guide']."' name='guide' >" ?></td>
	</tr>
 
	<tr>
	<td><label>Internship Details:</label></td>
    <td> <?php echo "<input type='text' id='intern' value='".$row['internship']."' name='intern'  style='width:300px;'>"  ?></td>
	</tr>
	<br>
    
	<tr>
	<td><label>Condonation Details:</label></td>
	<td> <?php echo "<input type='text' id='condon' value='".$row['condonation_details']."' name='condon'  style='width:300px;'>"  ?></td>
	</tr>
	
	<tr>
    <td><label>No.Of Condonations:</label></td>
    <td> <?php echo "<input type='int' id='no_condon' value='".$row['no_of_condonations']."' name='no_condon'>"  ?></td>
	</tr>
	
	<tr>
    <td><label>Probation Details:</label></td>
    <td> <?php echo "<input type='text' id='prob_details' value='".$row['probation_details']."' name='prob_details' style='width:300px;'>"  ?></td>
	</tr>
		
	<tr>
    <td><label>Extra Currcular Activities:</label></td>
    <td> <?php echo "<textarea id='extra_acts' name='extra_acts' rows='3' cols='21'  style='width:300px;'>".$row['extra_curricular_activities']."</textarea>"  ?></td>
	</tr>
	
	<tr>
    <td><label>Department Association Activities:</label></td>
    <td> <?php echo "<input type='text' id='dept_acts' value='".$row['Dept_association_activities']."' name='dept_acts' style='width:300px;'>"  ?></td>
	</tr>
	
	<tr>
    <td><label>Achievements:</label></td>
    <td> <?php echo "<textarea id='achieved' name='achieved' rows='3' cols='21'  style='width:300px' >".$row['achievements']."</textarea>"  ?></td>
	</tr>
		
	<tr>
    <td><label>Placement Details:</label></td>
    <td> <?php echo "<input type='text' id='pla_details' name='pla_details'  value='".$row['placement_details']."' style='width:300px;'>"  ?></td>
	</tr>
	<tr>
    <td><label>Alternate Email:</label></td>
    <td> <?php echo "<input type='email' id='alt_email' value='".$row['alternate_email']."'  name='alt_email' >"  ?></td>
	</tr>
	
	<tr>
    <td><label>Facebook:</label></td>
    <td> <?php echo "<input type='text'value='".$row['facebook']."' id='fb' name='fb' >"  ?></td>
	</tr>
	
	<tr>
    <td><label>LinkedIn:</label></td>
    <td> <?php echo "<input type='text' id='linkin' value='".$row['linkedIn']."' name='linkin' >"  ?></td>
	</tr>
	
	<tr>
    <td></td><br>  
    <td><input type="submit" id="submit" name="submit" value="save">
      <input type="reset" id="reset" value="reset"></td>
	</tr>
  
	</table>
</form>


</div>

<center>
<div class="w3-button">
	 <a href="studenthome.php" class="w3-button w3-right"> Back </a>
</div>
</center>


  </body>
</html>