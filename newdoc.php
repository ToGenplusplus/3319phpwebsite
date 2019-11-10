<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>NEW Doc</title>
</head>
<body>
<?php
include 'connectdb.php';
?>
<?php

$licnum = $_POST["lnum"];

$query1 = 'SELECT * FROM Doctor WHERE licenseNumber =' ." "."'$licnum'";

$result = mysqli_query($connection,$query1);
$length = 0;
if(!$result){
                die("Error: insert failed" . mysqli_error($connection));
        }
while($row = mysqli_fetch_assoc($result))
{
	$length++;
}
if($length == 0)
{
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$spec= $_POST["spec"];
	$licensed = $_POST["license"];
	$code = $_POST["hospcode"];

	$query2 = 'INSERT INTO Doctor(licenseNumber,fname,lname,specialty,dateLicensed,hospCode)VALUES('."'$licnum'".","."'$fname'".","."'$lname'".","."'$spec'".","."'$licensed'".","."'$code'".")";

	$res = mysqli_query($connection,$query2);
	if(!res){
		die("Error: insert failed" . mysqli_error($connection));
	}
	echo "Doctor has been added:"."<br>";
	echo $licnum.", ".$fname.", ".$lname.", ".$spec.", ".$licensed.", ".$code;
	
}
else
{
	echo $licensed ." already exist in databse, choose another ID";
}

mysqli_close($connection);
	
?>
</body>
</html>
