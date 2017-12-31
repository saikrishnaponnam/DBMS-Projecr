<html>
<head>
	<title>add/remove Courses</title>
	<link rel="stylesheet" href="w3.css">
	<style type="text/css">
	</style>

<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 2px;
}
th {
    text-align: left;
}
</style>
</head>



<body>


<?php session_start(); ?>

<div class="w3-top">
  <div class="w3-bar w3-purple w3-padding w3-card-2" style="letter-spacing:4px;">
  	
  	<img src="logo.png" style="width:100px;height:90px" class="w3-bar-item">
    <h4 class="w3-bar-item">Department Of Computer Science And Engineering<br><scan class="w3-small">National Institute of Technology Calicut</span></h4>
  
    <div class="w3-right w3-hide-small">
      <div class="w3-bar-item w3-dropdown-hover w3-padding">   
 <a><?php
	
    $fn=$_SESSION['fa_id'];
	
     echo $fn;
   ?></a>
  <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0" >
<a href="updateprofile.php" class="w3-bar-item w3-button " >Update Profile</a>
<a href="logout.php" class="w3-bar-item w3-button">logout</a>

</div>
</div>
      
    </div>
  </div>
</div>


<?php
// on clicking submit add course
if(isset($_POST['submit']))
{
	include("database.php");
	$sessid=$_SESSION['fa_id'];
	$result=$conn->query($sql);
	$cid=$_POST['cid'];
	$sem=$_POST['sem'];
	$cname=$_POST['cname'];
	$crd=$_POST['credits'];
	
	
	$sql="SELECT forbatch FROM fa WHERE fa_login_fa_id='$sessid'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	$year=$row['forbatch'];
	
	$sql="SELECT * FROM courses AS C,fa AS F WHERE C.cid='$cid' AND F.forbatch='$year' AND C.fa_login_fa_id=F.fa_login_fa_id ";
	$result=$conn->query($sql);
	
	if($result->num_rows>0)
	{
		echo "<script>alert('Course Already in added List')</script>";
	}
	else
	{
		$sql="INSERT INTO courses(cid,course_name,sem,credits,fa_login_fa_id) VALUES ('".$cid."','".$cname."','".$sem."','".$crd."','".$sessid."')";
		$result=$conn->query($sql);
		//if($result==TRUE)
			//echo "<script>alert('added')</script>";
	}
}
?>


<!-- Form to add courses -->

<center>
<div class="w3-container" style="margin-top:200px;width:50%">
<form action="addcourses.php" method="post">
<table class="w3-table w3-card-4 w3-border w3-round-large">
<tr>
<td> Course Id:</td>
<td> <input class="w3-input w3-border" type="text" name="cid"></td>
</tr>

<tr>
<td> Course Name:</td>
<td> <input class="w3-input w3-border" type="text" name="cname"></td>
</tr>

<tr>
<td> Semester:</td>
<td> <select class="w3-select w3-border" style="width:50%;" name="sem">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
</select></td>
</tr>

<tr>
<td> Credits:</td>
<td> <input class="w3-input w3-border" type="text" name="credits"></td>
</tr>

<tr>
<td colspan=2><center><input class="w3-button w3-block" type="submit" name="submit" value="Add Course"></center></td>
</tr>

</table>
</form>
</div>
</center>

<?php
//on clicking remove
if(isset($_POST['remove']))
{
	//echo "sfsfd";
	include('database.php');
    $sessid=$_SESSION['fa_id'];
	$course=$_POST['course'];
	$temp=array();
	$t=0;  
	foreach($course as $chk1)  
	{  
		$temp[$t]=$chk1;
		$t++;
	} 
	
	//echo $t;
	$sql="SELECT forbatch FROM fa WHERE fa_login_fa_id='$sessid'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	$year=$row['forbatch'];
	
	$sql="SELECT * FROM courses AS C,fa AS F WHERE F.forbatch='$year' AND C.fa_login_fa_id=F.fa_login_fa_id ";
	$result=$conn->query($sql);
	
	$id=1;
	$i=0;
	if($result->num_rows>0)
	{
	while( ($row=$result->fetch_assoc() )&& ($i<=$t)  )
	{
		//echo $temp[$i];
			if(($i<$t) && ($temp[$i])==$id)
			{
				//echo "fsdf";
				$sql="DELETE FROM courses WHERE cid='".$row['cid']."' AND  fa_login_fa_id='".$row['fa_login_fa_id']."' ";
				$x=$conn->query($sql);
				//echo $row['cid'];
				$i++;
			}
			$id++;
	}
	echo $id;
	}	
}
?>

<!-- To view and delete courses added by FA's  -->

<center><h2>Courses</h2></center>
<table class="w3-table w3-card-4 w3-hoverable" style="width:50%" align="center">
  <tr>
    <th>Course ID</th>
    <th>Course Name</th> 
    <th>Semester</th>
	<th>Credits</th>
	<th>Select</th>
  </tr>

<!-- form to remove courses -->
<form action="addcourses.php" method="post">

<?php
	include("database.php");
	//session_start();
    $sessid=$_SESSION['fa_id'];
	
	
	$sql="SELECT forbatch FROM fa WHERE fa_login_fa_id='$sessid'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	$year=$row['forbatch'];
	
	$sql="SELECT * FROM courses AS C,fa AS F WHERE F.forbatch='$year' AND C.fa_login_fa_id=F.fa_login_fa_id ";
	$result=$conn->query($sql);
	
	//$sql="SELECT * FROM courses WHERE fa_login_fa_id='$sessid'";
	//$result=$conn->query($sql);
	$id=1;
	if($result->num_rows>0)
	while($row=$result->fetch_assoc()){
		
		echo "<tr>";
		echo "<td>".$row['cid']."</td>"."<td>".$row['course_name']."</td>"."<td>".$row['sem']."</td>".
		"<td>".$row['credits']."</td>"."<td><input type=\"checkbox\"  name=\"course[]\" value=\"$id\"></td>";
		echo "</tr>";
		echo"<br>";
		$id=$id+1;
	}
	
?>

</table><br><br>
<center>
<input type="submit" name="remove" value="Remove">
</center>
</form>




<center>
<h3><a href="fahome.php"><b> Back</a></h3>
</center>

</body>
</html>