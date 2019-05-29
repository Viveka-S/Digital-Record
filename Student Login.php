 <?php
$con=new mysqli('localhost','root','','testdb');

if($con->connect_errno)
{
       echo $con->connect_error;
         die();
}
session_start();//session starts here
if(isset($_SESSION['rollno'])){
    header('location:Student Page.php');
}
?>

<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="Student Login.css">
<body>
<div class="loginbox">
<?php
  if(isset($_GET["mes"]))
{
echo $_GET["mes"];
}
?>
<img src="user.png"  class="user"  width="90" height="100"> 
<h1>Student Login</h1>

  <form action="Student Login.php" method="post" autocomplete="off" >
 <p> Student Id:</p><input type="text" name="rollno" placeholder="Enter the Id" required >
<p>Password:</p><input type="password"  name="password" placeholder="Enter the password" required ><br/>

<input type="submit"  name="submit" value="login">
 <p>Not Registered? &nbsp; <a href="Student Reg.php">Create an account</a></p>
 


<?php
  if(isset($_POST['submit']))
{
    $rollno=$_POST['rollno'];
       $password=$_POST['password'];
         if($rollno!=''&&$password!='') 
       {
             $sql="SELECT rollno,password FROM studentreg WHERE rollno='$rollno' AND password='$password' ";
         $result=$con->query($sql);
         if($result->num_rows==1)
          {
        $_SESSION['rollno']=$rollno;
      //echo "<script>window.location = 'Student Page.php'</script>";
	  header('location:Student Page.php');
      
          }
         else
         { 
       echo "<script type='text/javascript'>alert('Invalid user')</script>";
         }
}
       else
          {
         echo "<p class='error'> please enter all the details</p>";
          }
}
?>
</form>
</div>

</body>
</head>

</html>


