 <?php
$con=new mysqli('localhost','root','','testdb');
if($con->connect_errno)
{
       echo $con->connect_error;
         die();
}
	 

?>



<?php
session_start();//session starts here

if(isset($_SESSION['facid'])){
    header('location:Faculty Page.php');
}



?>

<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="Faculty Login.css">
<body>
<div class="loginbox">
<?php
  if(isset($_GET["mes"]))
{
echo $_GET["mes"];
}
?>
<img src="user.png"  class="user"  width="90" height="100"> 
<h1>Faculty Login</h1>
<form action="Faculty Login.php" method="post" autocomplete="off" >
<p> Faculty Id:</p><input type="text" name="facid" placeholder="Enter the Id" required>
<p>Password:</p><input type="password"  name="password" placeholder="Enter the password"required><br/>
<input type="submit"  name="submit" value="login">
<p>Not Registered? &nbsp; <a href="Faculty Reg.php">Create an account</a></p>
 


<?php
  if(isset($_POST['submit']))
  {         $facid=$_POST['facid'];
            $password=$_POST['password'];
         
		 if($facid!=''&&$password!='') 
       {
             $sql="SELECT facid,password FROM facultyreg WHERE facid='$facid' AND password='$password' ";
         $result=$con->query($sql);
                if($result->num_rows==1)
                      {
	                      $_SESSION['facid']=$facid;
                          //echo "<script>window.location = 'Faculty Page.php'</script>";
                                 header('location:Faculty Page.php');
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


