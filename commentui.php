
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
error_reporting(0);
ini_set('display_errors',0);

$rollno=$_GET['rollno'];
$subcode=$_GET['subcode'];
$exno=$_GET['exno'];
$facid=$_GET['facid'];	

?>
<html>
<style>
.body,html
{
background: url(bg2.jpg)center; 
}



.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
   padding-bottom: 100px; 
    left: 30%;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: hidden; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
background: transparent;

}

/* Modal Content */
.modal-content {
    position: absolute;
    background-color:  transparent;
    margin: hidden;
    padding: 100px 100px;
 width: 80%;
   
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s

}
textarea {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
}
.container {
    padding: 50px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}


</style>
<body>
<form class="modal-content animate" action="comments.php">

<div class="container">

<label for="uname"><b>Comments</b></label>
<textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
<input type='hidden' name='rollno' id="HiddenInputID" value=<?php echo $rollno; ?> />
<input type='hidden' name='subcode' id="HiddenInputID" value=<?php echo $subcode; ?> />
<input type='hidden' name='exno'   id="HiddenInputID"  value=<?php echo $exno; ?> />  
<input type='hidden' name='facid'   id="HiddenInputID"  value=<?php echo $facid; ?> /> 

<button style="background-color: #4CAF50; color:white; cursor: pointer; width: 100%;padding: 14px 20px; margin: 8px 0;" type="submit"  > SEND</button>
</div>
</form> 
</body>

</html>