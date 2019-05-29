<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "testdb";
$conn = new mysqli($servername, $username, $password,$db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
$facid=$_SESSION['facid'];	
$rollno=$_SESSION['rollno'];
$subcode=$_SESSION['subcode'];
$exno=$_SESSION['exno'];
$pdfname="";
$result = mysqli_query($conn,"SELECT * FROM fileupload WHERE rollno='$rollno' and subcode='$subcode' and exno='$exno';");
while($row = mysqli_fetch_array($result)) {
$pdfname=$row['file'];
}

$sql="DELETE FROM fileupload WHERE facid='$facid' and rollno='$rollno' and subcode='$subcode' and exno='$exno'";
if(mysqli_query($conn,$sql))
{
$file_to_delete = 'upload/'.$pdfname;
unlink($file_to_delete);
header( "refresh:0; url=Faculty Page.php" );
}
else
{
echo "<script type='text/javascript'>alert('Sorry!......')</script>";	
header( "refresh:0; url=Faculty Page.php" );
}
	

?>