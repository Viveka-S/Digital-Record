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
if(!isset($_SESSION['facid'])){
    header('location:Faculty Login.php');
}

error_reporting(E_ALL); ini_set('display_errors', 1); 
$facid = $_SESSION['facid'];
$sql =  " SELECT * FROM facultyreg WHERE facid = '$facid' " ;
$result = $conn->query($sql);
if($result-> num_rows > 0)
{
while($row = $result->fetch_assoc())
{	
    $name=$row['name'];
    $dept=$row['dept'];
	}
}
else{
	echo 'Invalid query:' .mysqli_error(). "\n" ;
}
?>
<html>
<head>
<title>Faculty Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<style>
* {box-sizing: border-box}

/* Set height of body and the document to 100% */
body, html {
    height: 100%;
    margin: 0;
    font-family: Arial;
	background: url(bg2.jpg)center; 
}

/* Style tab links */
.tablink {
    background-color: #555;
    color: white;
    float: left;
    border: none;
    outline: none;
    cursor: hand;
    padding: 14px 16px;
    font-size: 17px;
    width: 33.33%;
}

.tablink:hover {
    background-color: #777;
}


/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
    color: black;
    display: none;
    padding: 100px 20px;
    height: 100%;
}
ol{
font-size:20px;
align:center;
}

img {
    border-radius: 50%;
      height:100px;
      width:100px;
}



   
#text{
    position: absolute;
    top: 50%;
    left: 50%;
    font-size: 25px;
    transform: translate(-50%,-50%);
    -ms-transform: translate(-50%,-50%);
}

#Home {background:transparent;}
#Notification {background-color:transparent;}
#Signout {background-color: transparent;}
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    
}

td, th {
    border: 1px solid #e6e6db;
    text-align: left;
    padding: 8px;
    height :40px;
}

tr:nth-child(even) {
    background-color:#e4f6fb;
}
table.ex2 {
    empty-cells: show;
}
a:link {
    text-decoration: none;
}
a:hover{
color:black;
text-decoration:bold;
}
.btnSelect {
    background-color: #f44336;
    border: 2px solid #f44336;
    border-radius: 4px;
    color: white;
    cursor: pointer;
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

/* Set a style for all buttons 
button {
    background-color: #4CAF50;
    color: white;
    padding: 2px 2px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}
*/

button:hover {
    opacity: 0.8;
}
.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    text-decoration: none;
    cursor: pointer;
}



.modal-body {padding: 2px 16px;}


</style>
</head>
<body >
<?php
  if(isset($_GET["mes"]))
{
echo $_GET["mes"];
}
?>
<button class="tablink" onclick="openPage('Home', this, 'grey')" id="defaultOpen" >Home</button>
<button class="tablink" onclick="openPage('Notification', this, 'grey')">Notification</button>
<button class="tablink" onclick="window.location.href='facultylogout.php'">Signout</button>



<div id="Home" class="tabcontent">
<center><ol>
<img src="user.png" alt="avatar" >
<p><br><B>Name :</B><input name="name" type="text" style="background-color:transparent; border:none;" value='<?php echo $name;?>' readonly /></br></p>
<p><br><B>Dept :</B><input name="dept" type="text" style="background-color:transparent; border:none;" value='<?php echo $dept; ?>' readonly /></br></p>
<br><B>Faculty id :</B><input name="facid" type="text" style="background-color:transparent; border:none;"  value='<?php echo $facid;?>' readonly /></br><p>
</ol></center>
</div>


<div id="Notification" class="tabcontent">
<h3>Notification</h3>
<table border="2" class= "ex2" id="mytable">
<tr>
          <th>SNO</th>
          <th>StudentName</th>
          <th>Rollno</th>
          <th>Subjectcode</th>
          <th>Ex_No</th>
          <th>Record</th>
          <th>Action</th>
</tr>

<?php
$result = mysqli_query($conn,"SELECT name,rollno,subcode,exno,file FROM fileupload where facid='$facid' order by id desc");
?>

<?php
$i=1;
while($row = mysqli_fetch_array($result)) {
?>
<tr>
<td><?php echo $i ?></td>
<td><?php echo $row["name"]; ?></td>
<td><?php echo $row["rollno"]; ?></td>
<td><?php echo $row["subcode"]; ?></td>
<td><?php echo $row["exno"]; ?></td>
<td><a href="upload/<?php echo $row['file'] ?>" target="_blank"> <?php echo $row["file"]; ?> </a></td>
<td>
<a href=" sign.php?facid=<?php echo $facid; ?> & rollno=<?php echo $row["rollno"]; ?> & subcode=<?php echo $row["subcode"]; ?> & exno=<?php echo $row["exno"]; ?> " class="btnSelect">Accept</a>
<a href=" commentui.php?facid=<?php echo $facid; ?> & rollno=<?php echo $row["rollno"]; ?> & subcode=<?php echo $row["subcode"]; ?> & exno=<?php echo $row["exno"]; ?> " class="btnSelect">Deny</a>
<a href="fcdelete.php?facid=<?php echo $facid; ?> & rollno=<?php echo $row["rollno"]; ?> & subcode=<?php echo $row["subcode"]; ?> & exno=<?php echo $row["exno"]; ?> " class="btnSelect">Delete</button></td>
</td>
</tr>

<?php
$i=$i+1;
}
?>
</table>






<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display ="none";
    }
}
function handleClick(val){
    document.getElementById('HiddenInputID').value = val;
    return true;
}
</script>
</div> 



<script>
function openPage(pageName,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;

}
document.getElementById("defaultOpen").click();


</script>
     
</body>
</html> 
