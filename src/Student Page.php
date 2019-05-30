
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
if(!isset($_SESSION['rollno'])){
header('location:Student Login.php');
}
	
$rollno = $_SESSION['rollno'];
$sql =  "SELECT * FROM studentreg WHERE rollno = '$rollno' " ;
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
<title>Student Page</title>
<link rel="stylesheet" type="text/css" href="form.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
  if(isset($_GET["mes"]))
{
echo $_GET["mes"];
}
?>
<style>
* {box-sizing: border-box}

/* Set height of body and the document to 100% */
body, html {
height: 100%;
margin: 0;
font-family: Arial;
background: url(bg2.jpg) center; 
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
    width: 20%;
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
	align:center;
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
    font-size: 30px;
    transform: translate(-50%,-50%);
    -ms-transform: translate(-50%,-50%);
	
	
}

#Home {background-color: transparent;}
#Upload {background-color: transparent;}
#Notification {background-color: transparent;}
#Outbox{background-color: transparent;}
#Signout {background-color: transparent;}
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    height :40px;
}

tr:nth-child(even) {
    background-color:white;
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


</style>
</head>
<body>
<button class="tablink" onclick="openPage('Home', this, 'grey')" id="defaultOpen" >Home</button>
<button class="tablink" onclick="openPage('Upload', this, 'grey')" >Upload</button>
<button class="tablink" onclick="openPage('Notification', this, 'grey')">Notification</button>
<button class="tablink" onclick="openPage('Outbox', this, 'grey')">Outbox</button>
<button class="tablink" onclick="window.location.href='studentlogout.php'">Signout</button>
 
 
<div id="Home" class="tabcontent">
<ol><center>
<img src="user.png" alt="avatar" >
<p><B>Name:</B> <input name="name" type="text" style="background-color:transparent; border:none;"  value='<?php echo $name;?>' readonly / ></br></p>
<p><B>Dept:</B><input name="dept" type="text" style="background-color:transparent; border:none;" value='<?php echo $dept; ?>' readonly /></br></p>
<p><B>RollNo:</B><input name="rollno" type="text"  style="background-color:transparent; border:none;" value='<?php echo $rollno;?>' readonly /></br></p>
</ol></center>
</div>

<div id="Upload" class="tabcontent">
<a class="inputdata">
<p><B><form action="Student Page.php" method="post" enctype="multipart/form-data">
<ol><center>
<p><B>Name       :</B> <B><input type="text" name="Name"  size="15" style="background-color:transparent; border:none;"  value='<?php echo $name;?>' readonly /></B></br></p>
<p><B>Rollno     :</B><input type="text" name="Rollno"  size="15" style="background-color:transparent; border:none;"   value='<?php echo $rollno;?>' readonly /></br></p>
<p><B>Subjectcode:</B><input type="text" name="Subcode" size="15" style="background-color:transparent; color:black; outline:20px;" required ></br></p>
<p><B>FacultyId  :</B><input type="text" name="FacultyId" size="15" style="background-color:transparent;"required ></br></p>
<p><B>Exno       :</B><input type="text" name="Exno"  size="10" style="background-color:transparent;" required></td></br></p>
<p><B>Record           :</B><input type="file" name="file" accept="application/pdf" required ></br></br></p>
<input type="submit" value="Submit" name="submit"></br>
</center></ol>
</form></B>
</a>
</div>
<?php
if(isset($_POST['submit']))
{
$Name=$_POST['Name'];
$Rollno=$_POST['Rollno'];
$Subjectcode=$_POST['Subcode'];
$FacultyId=$_POST['FacultyId'];
$Exno=$_POST['Exno'];
$fname=$_FILES['file']['name'];
$size=$_FILES['file']['size'];
$type=$_FILES['file']['type'];
$loc=$_FILES['file']['tmp_name'];
$filedir="upload/";
$filepath=$filedir.$fname;

    if($Name!=""&&$Rollno!=""&&$Subjectcode!=""&&$FacultyId!=""&&$Exno!=""&&$fname!="")

          { 

        $sqlvf="SELECT facid FROM facultyreg WHERE facid='$FacultyId' ";
 $result=$conn->query($sqlvf);
                if($result->num_rows==1)
                      {
						  

             if(move_uploaded_file($loc,$filepath))
              {
                $sql="INSERT INTO fileupload(name,rollno,subcode,facid,exno,file) VALUES ('$Name','$Rollno','$Subjectcode','$FacultyId','$Exno','$fname')";
                mysqli_query($conn,$sql);
                echo"<script type='text/javascript'>window.alert('Record has been sent!!')</script>";
				header("refresh:0; url=Student Page.php");
              }
             else
              {
                echo "<script type='text/javascript'>window.alert('Failed!!Try again...')</script>";
				header("refresh:0; url=Student Page.php");
			
              }
}					  
else
{
  echo "<script type='text/javascript'>window.alert('Sorry wrong faculty id.......')</script>";
  header( "refresh:0; url=Student Page.php" );
}

 }
    else
         {
       echo"please enter all details";
         }
		
}
?>
<div id="Notification" class="tabcontent">
<h3>Notification</h3>
<table class="ex2" border="2">
<tr>
<th>SNO</th>
<th>Subject Code</th>
<th>Ex no</th>
<th>File</th>
<th>Action</th>
</tr>
<?php
$result = mysqli_query($conn,"SELECT subcode,exno,file FROM filedownload where rollno='$rollno' order by id desc;");
?>
<?php
$i=1;
while($row = mysqli_fetch_array($result)) {
?>
<tr>
<td><?php echo $i ?></td>
<td><?php echo $row["subcode"]; ?></td>
<td><?php echo $row["exno"]; ?></td>
<td><a href="download/<?php echo $row['file'] ?>" target="_blank"> <?php echo $row["file"]; ?> </a></td>
<td><a href="sdelete.php?rollno=<?php echo $rollno; ?> & subcode=<?php echo $row["subcode"]; ?> & exno=<?php echo $row["exno"]; ?> " class="btnSelect">Delete</button></td>
</tr>
<?php
$i=$i+1;
}
?>
</table>
</div> 

<div id="Outbox" class="tabcontent">
<h3>Sent Items</h3>
<table class="ex3" border="2">
<tr>
<th>SNO</th>
<th>Subject Code</th>
<th>FacultyId</th>
<th>Ex no</th>
<th>File</th>
<th>Action</th>

</tr>
<?php
$result = mysqli_query($conn,"SELECT subcode,facid,exno,file FROM fileupload where rollno='$rollno' order by id desc;");
?>
<?php
$i=1;
while($row = mysqli_fetch_array($result)) {
?>
<tr>
<td><?php echo $i ?></td>
<td><?php echo $row["subcode"]; ?></td>
<td><?php echo $row["facid"]; ?></td>
<td><?php echo $row["exno"]; ?></td>
<td><a href="upload/<?php echo $row['file'] ?>" target="_blank"> <?php echo $row["file"]; ?> </a></td>
<td><a href="scdelete.php?rollno=<?php echo $rollno; ?> & subcode=<?php echo $row["subcode"]; ?> & exno=<?php echo $row["exno"]; ?> " class="btnSelect">Delete</button></td>
</tr>
<?php
$i=$i+1;
}
?>
</table>
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
