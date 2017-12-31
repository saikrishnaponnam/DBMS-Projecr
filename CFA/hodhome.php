<!DOCTYPE html>
<html>
<head>
	<title>HOD homepage</title>
	<link rel="stylesheet" href="w3.css">
	<style type="text/css">
	</style>
</head>

<body>

<div class="w3-top">
  <div class="w3-bar w3-purple w3-padding w3-card-2" style="letter-spacing:4px;">
  	
  	<img src="logo.png" style="width:100px;height:90px" class="w3-bar-item">
    <h4 class="w3-bar-item">Department Of Computer Science And Engineering<br><scan class="w3-small">National Institute of Technology Calicut</span></h4>
  
    <div class="w3-right w3-hide-small">
      <div class="w3-bar-item w3-dropdown-hover w3-padding">   
 <a><?php
 session_start();
    $fn=$_SESSION['hod_id'];
     echo $fn;
   ?></a>
  <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
<a href="updateprofile.php" class="w3-bar-item w3-button">Update Profile</a>
<a href="logout.php" class="w3-bar-item w3-button">logout</a>

</div>
</div>
      
    </div>
  </div>
</div>


<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:20%;margin-top: 100px;">
  <h3 class="w3-bar-item">Functions</h3>
  
	<a href="viewstudents_hod.php" class="w3-bar-item w3-button">View Students</a>
	<a href="#a" class="w3-bar-item w3-button" onclick="document.getElementById('a').style.display='block'">Update Notifications</a>
	<a href="appointments.php" class="w3-bar-item w3-button">Appointments</a>

</div>
<hr>
<div class="w3-row w3-padding-64">
<div class="w3-third w3-padding-large">
	
</div>
<div class="w3-third w3-padding-large" >
	<div id="a" style="display:none">
	<form action="fahome.php" method="post">
	<table>
		<tr>
			<td>Notification:</td>
			<td></td>
		</tr>
		<tr>
			<td><textarea name="not" rows="10" cols="20"></textarea></td>
			<td></td>
		</tr>
		<tr>
			<td><input type="submit" name="submit" value="update"></td>
			<td></td>
		</tr>
	</table>
</form>
<?php
if(isset($_POST['submit'])){
	include('database.php');
	$not=$_POST['not'];
	$sql="INSERT INTO notifications(notification) VALUES ('".$not."')";
	$conn->query($sql);
}
?>
</div>
</div>

<div class="w3-third w3-padding-large w3-bar-block w3-card-2 w3-light-grey w3-center w3-display-right" style="width:25%">
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
				echo $row['updated_on']. "  -  " .$row['notification']. "<br><br>";
				
				
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