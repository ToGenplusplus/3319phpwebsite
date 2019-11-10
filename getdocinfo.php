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
<h3>Doctor Info:</h3>
<ol>
<?php

 	$whichDoctor = $_POST["doctor"];

        $query1 = 'SELECT licenseNumber,fname,lname,specialty,dateLicensed,hospitalName FROM Doctor,Hospital WHERE licenseNumber ='. "'$whichDoctor'". " ". 'AND Hospital.uniqueCode = Doctor.hospCode';

        $res = mysqli_query($connection,$query1);
        if (!$res) {
        die("databases query failed.");
        }

        while($row1 = mysqli_fetch_assoc($res))
        {
		echo '<li>';
                echo $row1["licenseNumber"]." ".$row1["fname"]." ". $row1["lname"]."	".$row1["specialty"]."	".$row1["dateLicensed"]."	".$row1["hospitalName"]."<br>";

        }
        mysqli_free_result($res);
?>
</ol>
<?php
   mysqli_close($connection);
?>
</body>
</html>
