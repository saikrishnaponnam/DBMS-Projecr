<!DOCTYPE html>
<html>
<head>
	<title>Messages</title>
	<style>
	#mydiv {
    width:150px;
    height:200px;
    overflow-x:scroll;
}
</style>
</head>
<body>


<?php

if(isset($_POST['submit'])){
	include('database.php');
	session_start();
	$fa=$_SESSION["fa_id"];
	
	$sql="SELECT forbatch FROM fa WHERE fa_login_fa_id='$fa'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	$year=$row['forbatch'];
	
	$msg=$_POST['msg'];
	$stu=$_POST['stu'];
	$temp=array();
	$t=0;  
	foreach($stu as $chk1)  
	{  
		$temp[$t]=$chk1;
		$t++;
	} 
	
	$sql="SELECT roll_number FROM student_login AS S1,student_details AS S2 WHERE S1.roll_number=S2.student_login_roll_number AND S2.joinyear='$year' ";
	$result=$conn->query($sql);
	//echo "out";
	$id=1;
	$i=0;
	$fr="f";
	if($result->num_rows>0)
	{
	while($row=$result->fetch_assoc())
	{
			if($i<$t &&($temp[$i])==$id)
			{
				//echo "in";
				$sql="INSERT INTO messages(message,fa_login_fa_id,student_login_roll_number,from_) VALUES ('".$msg."','".$fa."','".$row['roll_number']."','".$fr."')";
				$x=$conn->query($sql);
				if($x==TRUE)
				{
					echo "inserted";
					// $sql1="UPDATE messages SET from='f' WHERE fa_login_fa_id='$fa' AND student_login_roll_number='$row['roll_number']'";
					//   $conn->query($sql1);
					header("Location: fahome.php");
				}
				else
				echo "notins";
				$i++;
			}
			$id++;
	}
	//echo $i;
	}	
}
?>


<?php
	include('database.php');
	//session_start();
	$sessid=$_SESSION['fa_id'];
	$sql="SELECT forbatch FROM fa WHERE fa_login_fa_id='$sessid'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	$year=$row['forbatch'];
	?>

<form action="messages.php" method="post">
	<table>
		<tr>
			<td>Message:</td>
			<td><textarea name="msg" rows="10" cols="50"></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td><div id="mydiv" class="w3-container">
			<?php

			include('database.php');
			
			$sql="SELECT roll_number FROM student_login AS S1,student_details AS S2 WHERE S1.roll_number=S2.student_login_roll_number AND S2.joinyear='$year' ";
			$result=$conn->query($sql);
			
			$id=1;
			if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
			echo "<input type=\"checkbox\" name=\"stu[]\" value=\"$id\">  ";
			echo $row['roll_number'];
			echo "<br>";
			$id=$id+1;
			}
		}?></div></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="submit" value="update"></td>
		</tr>
	</table>
</form>

</body>
</html>




