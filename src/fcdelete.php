<?php
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

require_once('fpdf/fpdf.php');
require_once('FPDI/src/autoload.php');

$servername = "localhost";
$username = "root";
$password = "";
$db = "testdb";
$conn = new mysqli($servername, $username, $password,$db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
$facid=$_GET['facid'];	
$rollno=$_GET['rollno'];
$subcode=$_GET['subcode'];
$exno=$_GET['exno'];
$pdfname="";
$result = mysqli_query($conn,"SELECT * FROM fileupload WHERE rollno='$rollno' and subcode='$subcode' and exno='$exno';");
while($row = mysqli_fetch_array($result)) {
$pdfname=$row['file'];
}
$mypdf="upload/warning.pdf";
$pdf = new Fpdi();
$pages_count = $pdf->setSourceFile($mypdf); 
for($i = 1; $i <= $pages_count; $i++)
{
$pdf->AddPage(); 
$tplIdx = $pdf->importPage($i);
$pdf->useTemplate($tplIdx, 0, 0); 
}


$filename="warning_".$pdfname;
$fname="download/$filename";

$pdf->Output($fname,'F');




$sql="INSERT INTO filedownload(rollno,subcode,exno,file) VALUES ('$rollno','$subcode','$exno','$filename')";
if(mysqli_query($conn,$sql))
{
$sql1="DELETE FROM fileupload WHERE facid='$facid' and rollno='$rollno' and subcode='$subcode' and exno='$exno'";
if(mysqli_query($conn,$sql1))
{
$file_to_delete = 'upload/'.$pdfname;
unlink($file_to_delete);
echo "<script type='text/javascript'>alert('deleted successfully!')</script>";

header( "refresh:0; url=Faculty Page.php" );
}
else
{
echo "<script type='text/javascript'>alert('Sorry!......')</script>";	
header( "refresh:0; url=Faculty Page.php" );
}


}
else
{
echo "<script type='text/javascript'>alert('Failed!......')</script>";	
header( "refresh:0; url=Faculty Page.php" );
}

	

?>
