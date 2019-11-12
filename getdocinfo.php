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

<?php

 	$whichDoctor = $_POST["doctor"];	//get user choice for doctor

        $query1 = 'SELECT licenseNumber,fname,lname,specialty,dateLicensed,hospitalName FROM Doctor,Hospital WHERE licenseNumber ='. "'$whichDoctor'". " ". 'AND Hospital.uniqueCode = Doctor.hospCode';

        $res = mysqli_query($connection,$query1);

        if (!$res) {
        die("databases query failed.");
        }
	//after succssesful query

        while($row1 = mysqli_fetch_assoc($res))
        {
                echo '<strong>'.'Doctor License Number: '.'</strong>'.$row1["licenseNumber"]."<br>";
		echo '<strong>'.'Name: '.'</strong>'.$row1["fname"]." ". $row1["lname"]."<br>";
		echo '<strong>'.'Speciallty: '.'</strong>'.$row1["specialty"]."<br>";
		echo '<strong>'.'Date Licensed: '.'</strong>'.$row1["dateLicensed"]."<br>";
		echo '<strong>'.'Hospital: '.'</strong>'.$row1["hospitalName"]."<br>";

        }
        mysqli_free_result($res);
?>
<?php
   mysqli_close($connection);	//always close conneciton after done using.
?>
</body>
</html>
