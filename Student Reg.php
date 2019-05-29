<?php
$con=new mysqli('localhost','root','','testdb');

if($con->connect_errno)
{
       echo $con->connect_error;
         die();
}
if(isset($_SESSION['rollno'])){
    header('location:Student Page.php');
}
?>

<html>
<head>
<title>Registeration</title>
<link rel="stylesheet" type="text/css" href="Student Reg.css">
</head>
<body background="candy.jpg">
<center><font size=8><b>Student Registration Form</b></font></center>
<div class="regisbox" >
<form action="Student Reg.php" method="post" autocomplete="off">
<p><b>Name &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;    : </b><input type="text"  name="Name" required></p><br/>
<p><b>Password &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : </b><input type="password" name="Password" required></p><br/>
<p><b>Confirmpassword      : </b><input type="password"  name="Confirmpassword" required></p><br/>
<p><b>department   &nbsp; &nbsp; &nbsp; : </b><input type="text"  name="department" required ></p><br/>
<p><b>mailid &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : </b><input type="text"  name="mailid" required ></p><br/>
<p><b>Rollno&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;  : </b><input type="text"  name="Rollno" required ></p><br/>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<input type="submit" name="submit"  value="submit"><br/>

<?php
if(isset($_POST['submit']))
    {
       $Name=$_POST['Name'];
       $Password=$_POST['Password'];
$Confirmpassword=$_POST['Confirmpassword'];
       $department = $_POST['department'];
       $mailid=$_POST['mailid'];
        $Rollno=$_POST['Rollno'];
if($Name!=""&&$Password!=""&&$Confirmpassword!=""&&$department!=""&&$mailid!=""&&$Rollno!="")
{ 
          if($Password==$Confirmpassword)
{
    $sql="INSERT INTO studentreg (name,password,cpassword,dept,rollno,mailid) VALUES ('$Name','$Password' ,'$Confirmpassword','$department','$Rollno','$mailid')";

     if($con->query($sql))
      {
      echo "<script>alert('Registered!!Please login here...');</script>";
      //echo "<script>window.location = 'Student Login.php';</script>";
	  header("location:Student Login.php?");
       }
    else
{
  echo "<script type='text/javascript'>alert ('Insert data is failed')</script>";
}
}
else
{
  echo "<script type='text/javascript'>alert('password dont match')</script>";
}

}
else
{
echo "all field required";
}
}
?>
</form>
</div>
</body>
</html>

