<html>
<head>
<style>
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

</style>
</head>



<?php

$flag=0;

if(isset($_POST['submit'])){
	include('database.php');
	session_start();
	$stu=$_SESSION['stu_id'];
	$appointment=$_POST['appointment'];
	$faid=$_POST['faid'];
	$date=$_POST['date'];
	//echo $faid;
	$sql="SELECT * FROM appointments WHERE  student_login_roll_number='$stu' AND fa_login_fa_id='$faid' ";
	$result=$conn->query($sql);
	if($result->num_rows == 0)
	{
		//echo "1";
		$sql="INSERT INTO appointments(appointment_details,date,student_login_roll_number,fa_login_fa_id) VALUES ('".$appointment."','".$date."','".$stu."','".$faid."')";
		$result=$conn->query($sql);
		//if($result===FALSE)
			//echo "<script>alert('INVALID FA Id')</script>";
		//header("Location: studenthome.php");
		$flag=1;
	}
	else{
		//echo "2";
		$row=$result->fetch_assoc();
		if($row['appointment_status']!='A'&&$row['appointment_status']!='R')
		{
			echo "<script>alert('Appointment still not seen by FA')</script>";
			$flag=1;
		}
		else	
		{
			//echo "3";
			$sql="UPDATE appointments SET appointment_details='".$appointment."',appointment_status='NULL',date='".$date."'  WHERE appointments.student_login_roll_number='$stu' AND appointments.fa_login_fa_id='$faid' " ;
			$result=$conn->query($sql);
			if($result===FALSE)
				echo "<script>alert('INVALID FA Id')</script>";
			//header("Location: studenthome.php");
			$flag=1;
		}
	}
	if($flag!=0)
	header("Location: studenthome.php");
	
}
?>


<center>
<div class="w3-card-4" style="60%">
<form action="addappointments.php" method="post">
	<table>
		<tr>
			<td>Appointment Details:</td>
			<td><textarea name="appointment" rows="8" cols="40"></textarea></td>
			<td></td>
		</tr>
		
		<tr>
			<td>Appointment Date:</td>
			<td><input class="w3-input w3-border" type="date" name="date" value=" "></td>
			<td></td>
		</tr>
		
		<tr>
			<td>FA Id:</td>
		<td>
		<?php
		include("database.php");
		$stu=$_SESSION['stu_id'];
		$sql= "SELECT fa.name AS fname,fa_login_fa_id FROM fa,student_details WHERE fa.forbatch=student_details.joinyear AND student_details.student_login_roll_number='$stu'";
		$result=$conn->query($sql);	
		while($row=$result->fetch_assoc())
		{	

			echo "<input type='radio' name='faid' value='".$row['fa_login_fa_id']."' >";
			echo $row['fname'] ; 
			echo "<br>";
		}
		?>
	    </td>
			<td></td>
		</tr>
		
			
		
		
		<tr>
			<td> </td>
			<td><input class="w3-input w3-border" type="submit" name="submit" value="request"></td>
			<td></td>
		</tr>
	</table>
</form>
</div>
</center>


</body>
</html>