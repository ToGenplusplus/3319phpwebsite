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
<ol>
<?php

   $orderby = $_POST["order"];		//get user choice for ordering by first or last name
   $ascordsc = $_POST["ascordsc"];	// get user choice for ascending or descending

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
   else{// if user chooses normal ascending
   
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

 mysqli_close($connection);	//always close connection after done using
?>
</body>
</html>
