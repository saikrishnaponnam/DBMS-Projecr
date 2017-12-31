<html>
<head>
  <title>Student Details</title>
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
  
  <?php
  if(isset($_POST['save']))
  {
	include("database.php");
	
	$sessid=$_SESSION['stu_id'];
	$roll_number=$_POST['roll'];
	$name=$_POST['name'];
	$join=$_POST['join'];
	$dob=$_POST['dob'];
	$sem=$_POST['sem'];
	$nation=$_POST['nation'];
	$rel=$_POST['rel'];
	$caste=$_POST['caste'];
	$mobno=$_POST['mobno'];
	$email=$_POST['email'];
	$per_addr=$_POST['per_addr'];
	$pre_addr=$_POST['pre_addr'];
	$guardian=$_POST['guardian'];
	$father=$_POST['father'];
	$mother=$_POST['mother'];
	$faname=$_POST['faname'];
	$par_addr=$_POST['par_addr'];
	$par_email=$_POST['par_email'];
	
	$sql="UPDATE  student_details SET  name='$name' , joinyear='$join', presentsem='$sem', dob='$dob', nationality='$nation', caste='$caste',religion='$rel', 
		caste='$caste', contact_no='$mobno', email_id='$email', permanent_address='$per_addr', present_address='$pre_addr', local_guardian='$guardian', father_name='$father',
		mother_name='$mother', fa_name='$faname',parent_contact='$par_addr', parent_email='$par_email'
		WHERE student_login_roll_number='$sessid' ";
	$conn->query($sql);  
	if($conn->query($sql)===TRUE)
	{
		//echo "sff";
		header("Location: updatestudentprofile.php");
	}
	else
	{
		//echo "sffsfsd";
		header("Location: updatestudentprofile.php");
	}
  }
  else{
  ?>
  
  <?php
  
  include("database.php");
  $roll=$_SESSION['stu_id'];
  $sql="SELECT * FROM student_details WHERE student_login_roll_number='$roll'";
  $result=$conn->query($sql);
  $row=$result->fetch_assoc();
  
  ?>
  
    <div id="a" class="w3-card-4 w3-margin">
  <form method="post" action="updatestudentprofile.php">
  <table align="center">
 
<tr>
  <td><label>Roll Number:</label></td>
 <td> <?php echo "<input type='text' id='roll' value='".$row['student_login_roll_number']."' name='roll' readonly>" ?> </td> 
</tr>

<tr>
  <td><label>Name:</label></td>
  <td> <?php echo " <input type='text' id='name' value='".$row['name']."' name='name'  > " ?></td>
</tr>

<tr>
  <td><label>Join Year:</label></td>
  <td> <?php echo "<input type='number' id='join' value='".$row['joinyear']."' name='join' required>" ?></td>
</tr>

<tr>
  <td><label>Present Sem:</label></td>
  <td> <?php echo "<input type='number' id='sem' value='".$row['presentsem']."' name='sem' >" ?></td>
</tr>


<tr>
  <td style='width:250px;'><label>Date Of Birth:</label></td>
  <td> <?php echo "<input type='date' id='dob' name='dob' value='".$row['dob']."' style='width:208px;' readonly>" ?></td>
</tr>
    <tr>
    <td><label>Nationality:</label></td>
    <td> <?php echo "<input type='text' id='nation' value='".$row['nationality']."' name='nation'  >" ?></td>
  </tr>
  
      <tr>
    <td><label>Religion/Community:</label></td>
    <td> <?php echo "<input type='text' id='rel' value='".$row['religion']."' name='rel'>" ?></td>
  </tr>
 
      <tr>
    <td><label>Caste:</label></td>
    <td> <?php echo "<input type='text' id='caste' value='".$row['caste']."' name='caste' >" ?></td>
  </tr>
  <br>
    
<tr>
  <td><label>Mobile Number:</label></td>
  <td> <?php echo "<input type='int' id='mobno' value='".$row['contact_no']."' name='mobno'>" ?></td>
</tr>
    <tr>
    <td><label>Email:</label></td>
    <td> <?php echo "<input type='email' id='email' value='".$row['email_id']."' name='email'>" ?></td>
  </tr>
      <tr>
    <td><label>Permanent Address:</label></td>
    <td> <?php echo "<textarea id='per_addr' name='per_addr' rows='3' cols='31'>".$row['permanent_address']."</textarea>" ?> </td>
  </tr>
      <tr>
    <td><label>Present Address:</label></td>
    <td> <?php echo "<textarea id='pre_addr' name='pre_addr' rows='3' cols='31'>".$row['present_address']."</textarea>" ?></td>
  </tr>
     <tr>
    <td><label>Local Guardian:</label></td>
    <td> <?php echo "<input type='text' id='guardian' value='".$row['local_guardian']."' name='guardian'>" ?></td>
  </tr>
  <tr>
    <td><label>Father Name:</label></td>
    <td> <?php echo "<input type='text' id='father' value='".$row['father_name']."' name='father'> " ?></td>
  </tr>
<tr>
<tr>
    <td><label>Mother Name:</label></td>
    <td> <?php echo "<input type='text' id='mother' value='".$row['mother_name']."' name='mother' >" ?></td>
  </tr>
  <tr>
    <td><label>Faculty Advisor:</label></td>
    <td><?php echo "<input type='text' id='faname' value='".$row['fa_name']."'  name='faname'>" ?></td>
  </tr>
  
 <tr>
    <td><label>Parent Contact No.:</label></td>
    <td> <?php echo "<input type='text' id='par_addr' value='".$row['parent_contact']."' name='par_addr' >" ?></td>
  </tr>
  <tr>
    <td><label>Parent Email:</label></td>
    <td><?php echo "<input type='email' id='par_email' name='par_email' value='".$row['parent_email']."' placeholder='Example@gmail.com' >" ?></td>
  </tr>
  <tr>
    <td></td><br>
	
    <td><input type="submit" id="submit" name="save" value="save">
      <input type="reset" id="reset" value="reset"></td>
  </tr>
  </table>
</form>
</div>


<?php } ?>

<center>
<a class="w3-button" href="studenthome.php">Back</a>
</center>

  </body>
  </html>