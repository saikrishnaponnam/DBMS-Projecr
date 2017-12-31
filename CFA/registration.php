<html>
<head>
  <title>Student Details</title>
  <link rel="stylesheet" href="w3.css">
   <style>
  body{
	   font-family: Verdana,sans-serif;

   
   }
  </style>
  </head>
  <body>
   <div class=" w3-card-2 w3-black  w3-padding ">
  <h3 style="text-align:center;"><label>Student Details</label></h3></div>
    <div class="w3-card-4 w3-khaki w3-margin">
  
<?php


if(isset($_POST['save']))
{
//echo "fsdf";
include("database.php");

session_start();
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
$sql="INSERT INTO student_details VALUES('".$roll_number."','".$name."','".$join."','".$sem."','".$dob."','".$nation."','".$rel."','".$caste."','".$mobno."','".$email."','".$per_addr."','".$pre_addr."','".$guardian."','".$father."','".$mother."','".$faname."','".$par_addr."','".$par_email."')";

$return=$conn->query($sql);


$sql="SELECT * FROM student_login WHERE roll_number='$sessid'";
$result=$conn->query($sql);
if($result)
{
	if($result->num_rows > 0)
	{
	$sessid=$_SESSION['stu_id'];	
		$sql="UPDATE student_login SET details_filled='y' WHERE roll_number='$sessid'";
		if($conn->query($sql)===true)
		{
			echo "updated";
			header ("location: studenthome.php");
		}
		else
		{
			echo "not updated";
		}
	}
	else
	{
		echo "student doesn't exist with the rollnumber";
	}
	
}
else{
	
	echo "ERROR IN EXECUTING QUERY";
}
}	


?>  
  
  
  
  
  
  
  
  <form method="post" action="registration.php">
  <table align="center">
   
<tr>
  <td><label>Roll Number:</label></td>
  <td><input type="text" id="roll" name="roll" placeholder="eg.B1#####CS" required></td>
</tr>

<tr>
  <td><label>Name:</label></td>
  <td><input type="text" id="name" name="name" placeholder="enter your name"required></td>
</tr>

<tr>
  <td><label>Join Year:</label></td>
  <td><input type="number" id="join" value="2012" name="join" required></td>
</tr>


<tr>
  <td><label>Present Sem:</labelrequired></td>
  <td><input type="number" id="sem" name="sem" required></td>
</tr>



<tr>
  <td style="width:250px;"><label>Date Of Birth:</label></td>
  <td><input type="date" id="dob" name="dob" style="width:208px;"required></td>
</tr>
    <tr>
    <td><label>Nationality:</label></td>
    <td><input type="text" id="nation" name="nation" placeholder="eg.India"required></td>
  </tr>
  
      <tr>
    <td><label>Religion/Community:</label></td>
    <td><input type="text" id="rel" name="rel" placeholder="eg.Hindu,Muslim"required></td>
  </tr>
 
      <tr>
    <td><label>Caste:</label></td>
    <td><input type="text" id="caste" name="caste" placeholder="eg.OC,OBC,SC"required></td>
  </tr>
  <br>
    
<tr>
  <td><label>Mobile Number:</label></td>
  <td><input type="int" id="mobno" name="mobno"required></td>
</tr>
    <tr>
    <td><label>Email:</label></td>
    <td><input type="email" id="email" name="email" placeholder="Example@gmail.com"required></td>
  </tr>
      <tr>
    <td><label>Permanent Address:</label></td>
    <td><textarea id="per_addr" name="per_addr" rows="3" cols="31" required></textarea></td>
  </tr>
      <tr>
    <td><label>Present Address:</label></td>
    <td><textarea id="pre_addr" name="pre_addr" rows="3" cols="31"></textarea></td>
  </tr>
     <tr>
    <td><label>Local Guardian:</label></td>
    <td><input type="text" id="guardian" name="guardian"required></td>
  </tr>
  <tr>
    <td><label>Father Name:</label></td>
    <td><input type="text" id="father" name="father"required></td>
  </tr>
<tr>
<tr>
    <td><label>Mother Name:</label></td>
    <td><input type="text" id="mother" name="mother" required></td>
  </tr>
  <tr>
    <td><label>Faculty Advisor:</label></td>
    <td><input type="text" id="faname" name="faname"required></td>
  </tr>
  
 <tr>
    <td><label>Parent Contact:</label></td>
    <td><input type="text" id="par_addr" name="par_addr"  required></td>
  </tr>
  <tr>
    <td><label>Parent Email:</label></td>
    <td><input type="email" id="par_email" name="par_email" placeholder="Example@gmail.com" required></td>
  </tr>
  <tr>
    <td></td><br>
	
    <td><input type="submit" id="submit" name="save" value="save">
      <input type="reset" id="reset" value="reset"></td>
  </tr>
  </table>
</form>
</div>


  </body>
  </html>