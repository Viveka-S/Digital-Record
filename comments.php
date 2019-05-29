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

error_reporting(0);
ini_set('display_errors',0);
session_start();

$comment=$_GET['subject'];
$rollno=$_GET['rollno'];
$subcode=$_GET['subcode'];
$exno=$_GET['exno'];
$pdfname="";
$result = mysqli_query($conn,"SELECT * FROM fileupload WHERE rollno='$rollno' and subcode='$subcode' and exno='$exno';");
while($row = mysqli_fetch_array($result)) {
$pdfname=$row['file'];
}
$facid=$_GET['facid'];	
$sign="";
$resultsign = mysqli_query($conn,"SELECT * FROM facultyreg WHERE facid='$facid';");
while($row = mysqli_fetch_array($resultsign)) {
	
$sign=$row['image'];
}

$mypdf="upload/$pdfname";
$fsign="sign/$sign";
$pdf = new Fpdi();
$pages_count = $pdf->setSourceFile($mypdf); 
date_default_timezone_set("Asia/Kolkata");
$date = date("d-m-Y H:i:s"); 
for($i = 1; $i <= $pages_count; $i++)
{
$pdf->AddPage(); 
$tplIdx = $pdf->importPage($i);
$pdf->useTemplate($tplIdx, 0, 0); 
}


$pdf->AddPage(); 
$pdf->SetXY(20,20);
$pdf->SetFont('Arial','B',14);  
$pdf->Write(0,"comments:\n");
$pdf->Ln();
$pdf->SetXY(20,25);
$pdf->Multicell(0,5,"$comment",14);
$pdf->Image($fsign,20,240,25,25);
$pdf->SetTextColor(0,0,255);
$pdf->SetXY(20,270);  
$pdf->SetFont('Arial','B',8);  
$pdf->Write(0, "$date");

$filename="download/$pdfname";

$pdf->Output($filename,'F');

$sql="INSERT INTO filedownload(rollno,subcode,exno,file) VALUES ('$rollno','$subcode','$exno','$pdfname')";
if(mysqli_query($conn,$sql))
{
echo "<script type='text/javascript'>alert('send successfully!')</script>";
$_SESSION['rollno']=$rollno;
$_SESSION['subcode']=$subcode;
$_SESSION['exno']=$exno;
$_SESSION['facid']=$facid;
header( "refresh:0; url=fdelete.php" );

}
else
{
echo "<script type='text/javascript'>alert('Failed!......')</script>";	
header( "refresh:0; url=Faculty Page.php" );
}
			  

?>