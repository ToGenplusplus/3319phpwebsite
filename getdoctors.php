<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Doctors Available</title>
</head>
<body>
<?php
include 'connectdb.php';
?>
<h1>Doctors Available:</h1>
<br>

<ol>
<?php
   $orderby = $_POST["order"];
   $ascordsc = $_POST["ascordsc"];

   if($ascordsc == "desc")
   {
	$query = 'SELECT licenseNumber,fname,lname FROM Doctor ORDER BY'. " ".$orderby ." ". 'DESC';
   	$result = mysqli_query($connection,$query);
   	if (!$result) {
        die("databases query failed.");
    	}
   	echo "Doctors First and Last names. Click doctor to view details: </br>";
	echo "<br>";
	echo '<form action="getdocinfo.php" method="post">';
  	 while ($row = mysqli_fetch_assoc($result)) {
        	echo '<input type="radio" name="doctor" value="';
        	echo $row["licenseNumber"];
        	echo '">' . $row["fname"] . " " . $row["lname"] . "<br>";
   	}
   	mysqli_free_result($result);
	echo '<br>';
	echo'<input type="submit" value="Get Doc Info">';
	echo'</form>';
	
   }
   else{
   
   $query = 'SELECT licenseNumber,fname,lname FROM Doctor ORDER BY'." ".$orderby;
   $result = mysqli_query($connection,$query);
   if (!$result) {
        die("databases query failed.");
    }
   
   echo "Doctors First and Last name. Click doctor to view details:</br>";
   echo "<br>";

   echo '<form action="getdocinfo.php" method="post">';	   
   while ($row = mysqli_fetch_assoc($result)) {
        echo '<input type="radio" name="doctor" value="';
        echo $row["licenseNumber"];
        echo '">' . $row["fname"] . " " . $row["lname"] . "<br>";
   }
   mysqli_free_result($result);
   echo '<br>';
   echo'<input type="submit" value="Get Doc Info">';
   echo'</form>';

}
?>
</ol>
<?php

 mysqli_close($connection);
?>
</body>
</html>
