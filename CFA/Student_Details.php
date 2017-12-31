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
  <form method="post" action="studenthome.php">
  <table align="center">
   
<tr>
  <td><label>Roll Number:</label></td>
  <td><input type="text" id="roll" name="roll" placeholder="eg.B1#####CS"></td>
</tr>

<tr>
  <td><label>Name:</label></td>
  <td><input type="text" id="name" name="name" placeholder="enter your name"></td>
</tr>

<tr>
  <td><label>Present Sem:</label></td>
  <td><input type="number" id="sem" name="sem" ></td>
</tr>


<tr>
  <td style="width:250px;"><label>Date Of Birth:</label></td>
  <td><input type="date" id="dob" name="dob" style="width:208px;"></td>
</tr>
    <tr>
    <td><label>Nationality:</label></td>
    <td><input type="text" id="nation" name="nation" placeholder="eg.India"></td>
  </tr>
  
      <tr>
    <td><label>Religion/Community:</label></td>
    <td><input type="text" id="rel" name="rel" placeholder="eg.Hindu,Muslim"></td>
  </tr>
 
      <tr>
    <td><label>Caste:</label></td>
    <td><input type="text" id="caste" name="caste" placeholder="eg.OC,OBC,SC"></td>
  </tr>
  <br>
    
<tr>
  <td><label>Mobile Number:</label></td>
  <td><input type="int" id="mobno" name="mobno"></td>
</tr>
    <tr>
    <td><label>Email:</label></td>
    <td><input type="email" id="email" name="email" placeholder="Example@gmail.com"></td>
  </tr>
      <tr>
    <td><label>Permanent Address:</label></td>
    <td><textarea id="per_addr" name="per_addr" rows="3" cols="31"></textarea></td>
  </tr>
      <tr>
    <td><label>Present Address:</label></td>
    <td><textarea id="pre_addr" name="pre_addr" rows="3" cols="31"></textarea></td>
  </tr>
     <tr>
    <td><label>Local Guardian:</label></td>
    <td><input type="text" id="guardian" name="guardian"></td>
  </tr>
  <tr>
    <td><label>Father Name:</label></td>
    <td><input type="text" id="father" name="father"></td>
  </tr>
<tr>
<tr>
    <td><label>Mother Name:</label></td>
    <td><input type="text" id="mother" name="mother" ></td>
  </tr>
  <tr>
    <td><label>Faculty Advisor:</label></td>
    <td><input type="text" id="faname" name="faname"></td>
  </tr>
  
 <tr>
    <td><label>Parent Address:</label></td>
    <td><textarea id="par_addr" name="par_addr" rows="3" cols="31"></textarea></td>
  </tr>
  <tr>
    <td><label>Parent Email:</label></td>
    <td><input type="email" id="par_email" name="par_email" placeholder="Example@gmail.com" ></td>
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