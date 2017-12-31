<html>
<head>
	<title>admin homepage</title>
	<link rel="stylesheet" href="w3.css">
	<style type="text/css">
	</style>
</head>

<body>


  <div class="w3-bar w3-purple w3-padding w3-card-2" style="letter-spacing:4px;">
  	
  	<img src="logo.png" style="width:100px;height:90px" class="w3-bar-item">
    <h4 class="w3-bar-item">Department Of Computer Science And Engineering<br><span class="w3-small">National Institute of Technology Calicut</span></h4>
  
    <div class="w3-right w3-hide-small">
      <div class="w3-bar-item w3-dropdown-hover w3-padding">   
 <a><?php
 session_start();
     echo "admin";
   ?></a>
  <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
<a href="logout.php" class="w3-bar-item w3-button">logout</a>

</div>
</div>      
</div>
</div>


<?php 
if($_SESSION['start']==1){
	
?>

<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:15%;margin-top: 100px;">
  <h3 class="w3-bar-item">Functions</h3>

		<a href="#create" class="w3-bar-item w3-button" onclick="document.getElementById('create').style.display='block'
		;document.getElementById('delete').style.display='none'
		;document.getElementById('view').style.display='none'">Create Users</a>
		
		<a href="#delete" class="w3-bar-item w3-button" onclick="document.getElementById('delete').style.display='block'
		;document.getElementById('create').style.display='none'
		;document.getElementById('view').style.display='none'">Delete Users</a>
		
		<a href="#view" class="w3-bar-item w3-button" onclick="document.getElementById('view').style.display='block'
		;document.getElementById('delete').style.display='none'
		;document.getElementById('create').style.display='none'
		;document.getElementById('fa').style.display='none'
		;document.getElementById('stu').style.display='none'
		;document.getElementById('hod').style.display='none'">View Users</a>
  
	</div>
<hr>

<div class="w3-third w3-padding-large">
	
</div>

<div class="w3-third w3-padding-large w3-display-middle" >

<div id="create" name="create" style="display:none" >
<?php
include("createuser.php");
?>
</div>

<div id="delete" name="delete" style="display:none" >
<?php
include("deleteuser.php");
?>
</div>

<div id="view" style="display:none" >
		<a href="#fa" type="button" class="w3-button w3-white w3-hover-green"  onclick="document.getElementById('fa').style.display='block';document.getElementById('stu').style.display='none';document.getElementById('hod').style.display='none'">FA</a>
		<a href="#stu" type="button" class="w3-button w3-white w3-hover-green"  onclick="document.getElementById('stu').style.display='block';document.getElementById('hod').style.display='none';document.getElementById('fa').style.display='none'">Students</a>
		<a href="#hod" type="button" class="w3-button w3-white w3-hover-green"  onclick="document.getElementById('hod').style.display='block';document.getElementById('stu').style.display='none';document.getElementById('fa').style.display='none'">HOD</a>
		<br><br>
		<div id="fa" style="display:none" >
		<h1> FA</h1>
		<?php
		include("database.php");
		$sql="SELECT * FROM fa_login";
		$result=$conn->query($sql);
		if($result->num_rows>0){
			echo "<ul class='w3-ul w3-card-4'>";
			while($row=$result->fetch_assoc())
			{
				echo "<li>".$row['fa_id']."</li>";
			}
			echo "</ul>";
		}
		
		else{
			echo "0 results";
		}
		?>
		</div>
		<div id="stu" style="display:none" >
		<h1> STUDENT</h1>
		<?php
		include("database.php");
		$sql="SELECT * FROM student_login";
		$result=$conn->query($sql);
		
		
		if($result->num_rows>0)
		{
			echo "<ul class='w3-ul w3-card-4'>";
			while($row=$result->fetch_assoc()){
				echo "<li>".$row['roll_number']."</li>";
			
			}
			echo "</ul>";
		}
		
		else
		{
			echo "0 results";
		}
		?>
		</div>
		<div id="hod" style="display:none" >
		<h1> HOD</h1>
		<?php
		include("database.php");
		$sql="SELECT * FROM hod";
		$result=$conn->query($sql);
		if($result->num_rows>0)
		{
			echo "<ul class='w3-ul w3-card-4'>";
			while($row=$result->fetch_assoc()){
				echo "<li>".$row['username']."</li>";
			}
			echo "</ul>";
		}
		else
		{
			echo "0 results";
		}
		?>
		</div>
</div>
</div>

<?php
}
else
{
	echo "your page has expired";
}
?>
</body>
</html>