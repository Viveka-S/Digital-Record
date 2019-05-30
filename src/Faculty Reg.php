<?php
$con=new mysqli('localhost','root','','testdb');

if($con->connect_errno)
{
       echo $con->connect_error;
         die();
}
session_start();
if(isset($_SESSION['facid']))
{
    header('location:Faculty Page.php');
}

?>

<html>
<style>
body {
	font-family:segoe Print;
}
h1{
text-align: center;
font-size: 40px;
font-family:Times New Roman;
}
.regisbox{
width: 500px;
height:600px;
color:black;
top: 40%;
left: 50%;
overflow:hidden;
position: absolute;
transform: translate(-50%,-50%);
box-sizing: border-box;
background: transparent;
padding: 80px  40px;
}

</style>
<title>Registration</title>
 <h1><b>Faculty Registration Form</b></h1>
 <body background="candy.jpg"><br/><br/><br/>
<form action="Faculty Reg.php" method="post" autocomplete="off" enctype="multipart/form-data" >
<div class=regisbox>
<table cellpadding="5" width="120" height="100" background="#000" cellspacing="2" align="center" >
<tr><td><b>Name</b></td> <td><input type="text" name="Name"  size="20" required ></td></tr>
<tr><td><b>FacultyId</b></td><td><input type="text" name="Facultyid"  size="20" required></td></tr>
<tr><td><b>Password</b></td> <td><input type="password" name="Password"  size="20" required ></td> </tr>
<tr><td><b>Confirmpassword</b></td> <td><input type="password" name="Confirmpassword" size="20" required ></td> </tr>
<tr><td><b>Lab handled</b></td> <td><input type="text" name="subcode1" size="20" required ></td></tr>
<tr><td></td>
<td><input type="text" name="subcode2" size="20" ></td> </tr>

<tr><td><b>Department</b></td>  <td><select name="Department" required >
  <option value="-1" selected>select..</option>

  <option value="CSE">CSE</option>

  <option value="EEE">EEE</option>

  <option value="CIV">CIV</option>

  <option value="IT">IT</option>

  <option value="MECH">MECH</option> 

<option value="ECE">ECE</option> 
</select></td></tr>
<tr><td><b>Designation</b></td>
<td><select name="Designation" required >

  <option value="-1" selected>select..</option>

  <option value="BACHELOR">BACHELOR</option>

  <option value="MASTER">MASTER</option>

  <option value="PHD">PHD</option>

</select></td> </tr>
<td><b>image</b></td><td><input type="file" name="file" id="files" accept=".jpg,.jpeg,.png,.pdf" required ></td> 
<td><output id="list"></td>
</tr>
<br/><br/>
 
<td><input type="reset" ></td>
<td colspan="2"><input type="submit" value="submit" name="submit"></td>
</tr>
</table>  
<?php
if(isset($_POST['submit']))
    {
$Name=$_POST['Name'];
$Facultyid=$_POST['Facultyid'];
$Password=$_POST['Password'];
$Confirmpassword=$_POST['Confirmpassword'];
$Department = $_POST['Department'];
$Designation=$_POST['Designation'];
$iname=$_FILES['file']['name'];
$size=$_FILES['file']['size'];
$type=$_FILES['file']['type'];
$loc=$_FILES['file']['tmp_name'];
$filedir="sign/";
$filepath=$filedir.$iname;

    if($Name!=""&&$Facultyid!=""&&$Password!=""&&$Confirmpassword!=""&&$Department!=""&&$Designation!=""&&$iname!="")
{ 

           if(($Password==$Confirmpassword) )
{
	   if(move_uploaded_file($loc,$filepath))
       {
         $sql="INSERT INTO facultyreg (name,facid,password,cpassword,dept,designation,image) VALUES ('$Name','$Facultyid','$Password','$Confirmpassword','$Department','$Designation','$iname')";
		 mysqli_query($con,$sql);
         echo "<script type='text/javascript'>alert ('Registered!!Please Login here...') <script>";
         header("location:Faculty Login.php");
       }
    else
{
  echo "<script type='text/javascript'>window.alert('insert data is failed')</script>";
}
}
else
{
  echo "<script type='text/javascript'>alert('password dont match')</script>";
}
}

else
{
echo"please enter all details";
}
	}
?>

</form> 
</div>
 </body>
  </html>
