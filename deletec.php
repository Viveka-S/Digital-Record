<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "testdb";
$conn = new mysqli($servername, $username, $password,$db);
 
 session_start();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$rollno=$_GET['rollno'];
$subcode=$_GET['subcode'];
$exno=$_GET['exno'];


$facid=$_GET['facid'];	





$filename="sign/default.pdf";



$sql="INSERT INTO filedownload(rollno,subcode,exno,file) VALUES ('$rollno','$subcode','$exno','$filename')";
if(mysqli_query($conn,$sql))
{
echo "<script type='text/javascript'>alert('Signed successfully!')</script>";
header( "refresh:0; url=Faculty Page.php" );


}
else
{
echo "<script type='text/javascript'>alert('Failed!......')</script>";	
header( "refresh:0; url=Faculty Page.php" );
}
			  

?>